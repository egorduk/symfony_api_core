<?php

namespace Btc\CoreBundle\Command;

use Btc\CoreBundle\Entity\Bank;
use Btc\CoreBundle\Entity\Deposit;
use Btc\CoreBundle\Entity\DepositOnly;
use Btc\CoreBundle\Entity\UserPreference;
use Btc\CoreBundle\Entity\VirtualDeposit;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Btc\CoreBundle\Entity\User;
use Btc\CoreBundle\Entity\Wallet;
use Btc\CoreBundle\Entity\Operation;
use Btc\CoreBundle\Entity\ApiKey;

class DemoTradersCommand extends ContainerAwareCommand
{
    private $randFiatAmountsToDeposit = [5000, 15000, 50000, 100000];
    private $randVirtualAmountsToDeposit = [10, 50, 100, 300, 150];

    public function configure()
    {
        $this->setName('demo:traders')
            ->addArgument('num-traders', InputArgument::REQUIRED, "Number of traders to create.")
            ->addArgument('virtual-deposit', InputArgument::OPTIONAL, "Amount to deposit virtual currency.")
            ->addArgument('fiat-deposit', InputArgument::OPTIONAL, "Amount to deposit fiat currency.")
            ->setDescription('Create demo data')
            ->setHelp(<<<EOF
The <info>%command.name%</info> makes a given number of traders
to trade in market.

<info>php %command.full_name% 5</info>
<info>php %command.full_name% 30 --env=prod</info>
EOF
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getManager();
        if ($this->getContainer()->getParameter('kernel.environment') === 'prod') {
            $output->writeLn("Are you nuts? this is <error>production!</error>");
            return;
        }
        $faker = \Faker\Factory::create();
        // create traders
        $output->writeLn("Creating traders...");
        $traders = [];
        for ($i = 1; $i <= intval($input->getArgument('num-traders')); $i++) {
            $trader = new User;
            $trader->setUsername('A' . str_pad ((string)$i, 6, '0', STR_PAD_LEFT));
            $trader->setEmail($faker->safeEmail);
            $trader->setPlainPassword('S3cretpassword');
            $trader->setCountry($em->getRepository('BtcCoreBundle:Country')->findOneByName('ALBANIA'));
            $trader->setFirstname($faker->firstName);
            $trader->setLastname($faker->lastName);
            $trader->setRoles(['ROLE_VERIFIED_PERSONAL']);

            $registration = $this->get('core.user_registration_service');
            $registration->encryptPassword($trader);
            $registration->createWallets($this->get('em'), $trader);
            $registration->assignDefaultPlans($trader);
            $registration->assignDefaultPreferences($this->get('em'), $trader);
            $registration->setNewsletterPreference($this->get('em'), $trader, true);

            $apiKey = new ApiKey($trader, true);
            $apiKey->addPermission(ApiKey::PERM_ACCOUNT);
            $apiKey->addPermission(ApiKey::PERM_TRADES);
            $em->persist($apiKey);
            $em->persist($trader);
            $traders[] = $trader;
            $output->writeLn("  -> created trader <comment>{$trader->getUsername()}: {$trader->getEmail()}</comment>");
        }

        $output->writeLn("Making deposits for traders...");
        foreach ($traders as $trader) {
            foreach ($trader->getWallets() as $wallet) {
                $this->deposits($wallet, $faker, $output, $input);
            }
        }
    }

    private function deposits(Wallet $wallet, $faker, OutputInterface $output, InputInterface $input)
    {
        $em = $this->getManager();
        // some object was proxy
        $wallet->getCurrency()->getCode();
        $wallet->getId();
        // get rand amount to deposit in total and a set of banks as deposit origin
        if ($wallet->getCurrency()->isCrypto()) {
            $banks = [$em->getRepository('BtcCoreBundle:Bank')->findOneByName($wallet->getCurrency()->getCode())];
            if ($virtualDeposit = $input->getArgument('virtual-deposit')) {
                $allAmount = $virtualDeposit;
            } else {
                $allAmount = $this->randVirtualAmountsToDeposit[array_rand($this->randVirtualAmountsToDeposit)];
            }
        } else {
            $banks = $em->getRepository('BtcCoreBundle:Bank')->findBy(['fiat' => true]);
            if ($fiatDeposit = $input->getArgument('fiat-deposit')) {
                $allAmount = $fiatDeposit;
            } else {
                $allAmount = $this->randFiatAmountsToDeposit[array_rand($this->randFiatAmountsToDeposit)];
            }
        }

        // make random bank deposits, split by a number of available banks
        for ($i = 0; $i < count($banks); $i++) {
            $bank = $banks[array_rand($banks)];
            $am = $allAmount / count($banks);

            if ($am <= 0) {
                continue;
            }

            switch ($bank->getPaymentMethod()) {
                case Bank::PAYMENT_METHOD_DEPOSIT_ONLY:
                case Bank::PAYMENT_METHOD_WIRE:
                    $deposit = new DepositOnly();
                    break;
                case Bank::PAYMENT_METHOD_VIRTUAL_CURRENCY:
                    $deposit = new VirtualDeposit();
                    break;
                default:
                    $deposit = new Deposit();

            }
            $deposit->setAmount($am);
            if ($bank->getFiat()) {
                // random fee amount for fiat currency
                $deposit->setFeeAmount(1);
            } else {
                $deposit->setFeeAmount(0);
            }
            $deposit->setWallet($wallet);
            $deposit->setBank($bank);
            $deposit->completed();

            $wallet->credit($deposit->getAmountAfterFee());
            $em->persist($deposit);
            $em->persist($wallet);
            $em->flush(); // need to have deposit id

            // create deposit operation
            $op = new Operation;
            $op->setWallet($wallet);
            $op->setType("in");
            $op->setReference($deposit->getId());
            $op->setReferenceName('deposit');
            $op->setTotal($deposit->getAmount());
            $op->setAvailable($deposit->getAmount());
            $em->persist($op);

            if ($bank->getFiat()) {
                $op = new Operation;
                $op->setWallet($wallet);
                $op->setType("fee");
                $op->setReference($deposit->getId());
                $op->setReferenceName('deposit');
                $op->setTotal($deposit->getFeeAmount() * -1);
                $op->setAvailable($deposit->getFeeAmount() * -1);
                $em->persist($op);
            }
            $em->flush();

            $output->writeLn(sprintf(
                "    -> Have deposited <comment>%f %s</comment> to <info>%s</info> wallet.",
                $am,
                $wallet->getCurrency()->getCode(),
                $wallet->getUser()->getUsername()
            ));
        }
    }

    private function get($service)
    {
        return $this->getContainer()->get($service);
    }

    private function getManager()
    {
        return $this->get('doctrine.orm.entity_manager');
    }
}

