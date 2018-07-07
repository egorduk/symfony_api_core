<?php namespace Btc\CoreBundle\Command;

use Btc\CoreBundle\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command will have impact on wallet_operations,
 * as wallet_operations hold a reference to the buy/sell deal.
 *
 * More over the trade_transactions will be impacted as well and
 * should be migrated.
 *
 * @package Btc\CoreBundle\Command
 */
class MigrateOrdersCommand extends DoctrineCommand
{
    /**
     * @var array map of order types between old => new
     */
    protected $typeMap = [
        0 => 1, // LIMIT
        1 => 2  // MARKET
    ];

    /**
     * @var array map of order status between old => new
     */
    protected $statusMap = [
        0 => 1, // OPEN
        1 => 2, // COMPLETED
        2 => 3, // CANCELED
        4 => 4  // PENDING CANCEL
    ];

    protected function configure()
    {
        $this
            ->setName('migrate:orders')
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command')
            ->setDescription('Merges buy and sell deal tables into one - orders');
    }

    protected function execute(InputInterface $in, OutputInterface $out)
    {
        $dbal = $this->getContainer()->get('doctrine')->getConnection($in->getOption('em'));

        try {
            $dbal->beginTransaction();

            $out->writeln('Migrating buy_deal table');
            $stmt = $dbal->query("SELECT * FROM buy_deal");
            $this->migrateDeals($out, $dbal, $stmt);
            $out->writeln('Finished migrating buy_deal table');

            $out->writeln('Migrating sell_deal table');
            $stmt = $dbal->query("SELECT * FROM sell_deal");
            $this->migrateDeals($out, $dbal, $stmt);
            $out->writeln('Finished migration sell_deal table');

            $dbal->commit();
        } catch (\Exception $e) {
            $dbal->rollBack();
            $out->writeln($e->getMessage());
        }
    }

    /**
     * @param OutputInterface $out
     * @param $stmt
     */
    private function migrateDeals(OutputInterface $out, $dbal, $stmt)
    {
        while ($deal = $stmt->fetch()) {
            $dbal->insert('orders', $this->mapToOrder($deal));
            $out->writeln("Inserting order {$deal['id']}");
        }
    }

    /**
     * Maps to new order structure
     * @param array $deal row form buy or sell deal table
     * @return array
     */
    private function mapToOrder($deal)
    {
        return [
            'market_id' => $deal['market_id'],
            'in_wallet_id' => $deal['in_wallet_id'],
            'out_wallet_id' => $deal['out_wallet_id'],
            'current_amount' => $deal['current_amount'],
            'created_at' => $deal['created_at'],
            'updated_at' => $deal['updated_at'],
            'completed_at' => $deal['completed_at'],
            'cancelled_at' => $deal['cancelled_at'],
            'asked_unit_price' => $deal['asked_unit_price'],
            'fee_percent' => $deal['fee_percent'],
            'fee_amount_reserved' => $deal['fee_amount_reserved'],
            'fee_amount_taken' => $deal['fee_amount_taken'],
            'amount' => isset($deal['buy_amount']) ? $deal['buy_amount']: $deal['sell_amount'],
            // @TODO these to lines need to be revisited if they are truly correct
            'reserve_total' => isset($deal['amount_to_spend'])? $deal['amount_to_spend']: 0,
            'reserve_spent' => isset($deal['amount_spent']) ? $deal['amount_spent']: 0,
            'side' => isset($deal['buy_amount']) ? Order::SIDE_BUY : Order::SIDE_SELL,
            'status' => $this->statusMap[$deal['status']],
            'type' => $this->typeMap[$deal['type']],
            'old_ref' => $deal['id']
        ];
    }
}
