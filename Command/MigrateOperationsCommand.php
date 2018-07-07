<?php namespace Btc\CoreBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateOperationsCommand extends DoctrineCommand
{
    protected function configure()
    {
        $this
            ->setName('migrate:operations')
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command')
            ->setDescription('Migrates operations');
    }

    protected function execute(InputInterface $in, OutputInterface $out)
    {
        $dbal = $this->getContainer()->get('doctrine')->getConnection($in->getOption('em'));

        try {
            $dbal->beginTransaction();
            // take current balances from wallets and add them into operations

            $selectWallets = "SELECT * FROM wallet";
            $stmt = $dbal->query($selectWallets);

            while($wallet = $stmt->fetch()) {
                $dbal->insert(
                    'operations',
                    [
                        'wallet_id' => $wallet['id'],
                        'type' => 'migrate',
                        'reference_name' => 'wallet',
                        'reference_id' => $wallet['id'],
                        'available' => $wallet['amount_available'],
                        'reserved' => $wallet['amount_reserved'],
                        'total' => $wallet['amount_total'],
                        'created_at' => date('Y-m-d H:i:s')
                    ]
                );
                $out->writeln('Inserting operation #' . $dbal->lastInsertId());
            }

            $dbal->commit();
        } catch (\Exception $e) {
            $dbal->rollback();
            $out->writeln($e->getMessage());
        }
    }
}
