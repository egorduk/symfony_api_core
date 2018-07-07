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
use Btc\CoreBundle\Entity\Currency;
use Btc\CoreBundle\Entity\Operation;
use Btc\CoreBundle\Entity\ApiKey;

class DemoDataCommand extends ContainerAwareCommand
{
    private $accounts = [
        'A111111' => [
            'firstname' => 'Buyer',
            'lastname' => 'Doe',
            'email' => 'buyer.doe@exmarkets.com',
            'roles' => ['ROLE_VERIFIED_BUSINESS', 'ROLE_EXCHANGER'],
            'plainPassword' => 'S3cretpassword',
        ],

        'A222222' => [
            'firstname' => 'Seller',
            'lastname' => 'Doe',
            'email' => 'seller.doe@exmarkets.com',
            'roles' => ['ROLE_VERIFIED_BUSINESS'],
            'plainPassword' => 'S3cretpassword',
        ],

        'A333333' => [
            'firstname' => 'Rich',
            'lastname' => 'Guy',
            'email' => 'rich.guy@exmarkets.com',
            'roles' => ['ROLE_VERIFIED_PERSONAL'],
            'plainPassword' => 'S3cretpassword',
        ],

        'A444444' => [
            'firstname' => 'Business',
            'lastname' => 'Person',
            'email' => 'business.person@exmarkets.com',
            'roles' => ['ROLE_VERIFIED_BUSINESS'],
            'plainPassword' => 'S3cretpassword',
        ],

        'A555555' => [
            'firstname' => 'Poor',
            'lastname' => 'Guy',
            'email' => 'poor.guy@exmarkets.com',
            'roles' => ['ROLE_VERIFIED_PERSONAL'],
            'plainPassword' => 'S3cretpassword',
        ],

        'A666666' => [
            'firstname' => 'Unverified',
            'lastname' => 'Doe',
            'email' => 'unverified.doe@exmarkets.com',
            'roles' => [],
            'plainPassword' => 'S3cretpassword',
        ],

        'A999999' => [
            'firstname' => 'Hero',
            'lastname' => 'Admin',
            'email' => 'hero.admin@exmarkets.com',
            'roles' => [User::ADMIN],
            'plainPassword' => 'S3cretpassword',
        ],
    ];

    private $deposits = [
        'A111111' => [
            'USD' => 100000,
            'EUR' => 100000,
        ],

        'A222222' => [
            'BTC' => 100,
            'LTC' => 120,
        ],

        'A333333' => [
            'BTC' => 500,
            'LTC' => 1400,
            'USD' => 100000,
            'EUR' => 70000,
        ],

        'A444444' => [
            'BTC' => 10,
            'LTC' => 20,
            'USD' => 5000,
            'EUR' => 1500,
        ],

        'A555555' => [
            'BTC' => 2,
            'LTC' => 6,
            'USD' => 500,
            'EUR' => 100,
        ],

        'A666666' => [],

        'A999999' => [],
    ];

    public function configure()
    {
        $this->setName('demo:data')
            ->setDescription('Create demo data')
            ->setHelp(<<<EOF
The <info>%command.name%</info> generates demo data

<info>php %command.full_name%</info>
<info>php %command.full_name% --env=prod</info>
EOF
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->getContainer()->getParameter('kernel.environment') === 'prod') {
            $output->writeLn("Are you nuts? this is <error>production!</error>");
            return;
        }
        $this->makeUsers($output);
        $this->makeDeposits($output);
    }

    private function makeUsers(OutputInterface $output)
    {
        $em = $this->getManager();
        $output->writeLn("Creating accounts...");
        foreach ($this->accounts as $username => $acc) {
            $user = new User;
            $user->setUsername($username);
            $user->setEmail($acc['email']);
            $user->setPlainPassword($acc['plainPassword']);
            $user->setCountry($em->getRepository('BtcCoreBundle:Country')->findOneByName('ALBANIA'));
            $user->setFirstname($acc['firstname']);
            $user->setLastname($acc['lastname']);
            $user->setRoles($acc['roles']);

            $registration = $this->get('core.user_registration_service');
            $registration->encryptPassword($user);
            $registration->createWallets($this->get('em'), $user);
            $registration->assignDefaultPlans($user);
            $registration->assignDefaultPreferences($this->get('em'), $user);
            $registration->setNewsletterPreference($this->get('em'), $user, true);

            if ($username === 'A999999') {
                $user->setAuthKey('CVOEZSH4GCIVOVBYHGQ6BE5HIZOULVPC'); // two factor for admin
            }
            $apiKey = new ApiKey($user, true);
            $apiKey->addPermission(ApiKey::PERM_ACCOUNT);
            $apiKey->addPermission(ApiKey::PERM_TRADES);
            $em->persist($user);
            $em->persist($apiKey);
            $output->writeLn("  -> created user <comment>{$username}: {$user->getEmail()}</comment>");

            $this->accounts[$username] = $user;
        }
        $em->flush();
    }

    private function makeDeposits(OutputInterface $output)
    {
        $em = $this->getManager();
        $output->writeLn('Making deposits...');
        foreach ($this->deposits as $username => $deposit) {
            foreach ($deposit as $currencyCode => $amount) {
                $currency = $em->getRepository('BtcCoreBundle:Currency')->findOneByCode($currencyCode);
                $user = $this->accounts[$username];
                $wallet = $this->getWallet($user, $currency);

                // make deposit
                $this->deposit($wallet, $amount, $output);
            }
        }
    }

    private function getWallet(User $user, Currency $currency)
    {
        return $this->getManager()->getRepository('BtcCoreBundle:Wallet')->findOneBy(compact('user', 'currency'));
    }

    private function deposit(Wallet $wallet, $amount, OutputInterface $output)
    {
        $em = $this->getManager();
        // some object was proxy
        $wallet->getCurrency()->getCode();
        $wallet->getId();
        $faker = \Faker\Factory::create();
        // get rand amount to deposit in total and a set of banks as deposit origin
        if ($wallet->getCurrency()->isCrypto()) {
            $banks = [$em->getRepository('BtcCoreBundle:Bank')->findOneByName($wallet->getCurrency()->getCode())];
        } else {
            $banks = $em->getRepository('BtcCoreBundle:Bank')->findBy(['fiat' => true]);
        }

        // make random bank deposits, split by a number of available banks
        for ($i = 0; $i < count($banks); $i++) {
            $bank = $banks[array_rand($banks)];
            $am = $amount / count($banks);

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

    private function getManager()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    private function get($service)
    {
        return $this->getContainer()->get($service);
    }
}

