<?php

namespace Btc\CoreBundle\Command;

use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Btc\CoreBundle\Entity\Transaction;

/**
 * Class MigrateTransactionsCommand
 *
 * New transactions table:
 *   deal_id => needs to be created
 *   order_id => find in order table by old ref and side
 *   market_id => copy from order
 *   amount => tx the amount (BUY HAS with + SELL with -)
 *   price => tx price
 *   platform => EXM
 *   executed_at => tx.created_at
 *   completed_at => tx.completed_at
 * @package Btc\CoreBundle\Command
 */
class MigrateTransactionsCommand extends DoctrineCommand
{
    protected function configure()
    {
        $this
            ->setName("migrate:transactions")
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command')
            ->setDescription("Migrates from new order table deal transactions");
    }

    protected function execute(InputInterface $in, OutputInterface $out)
    {
        $dbal = $this->getContainer()->get('doctrine')->getConnection($in->getOption('em'));

        try {
            $dbal->beginTransaction();

            $selectTx = "SELECT DISTINCT(buy_deal_id) FROM trade_transaction";
            $orderBuySelect = "SELECT id, market_id FROM orders WHERE old_ref = ? and side = 'BUY'";
            $orderSellSelect = "SELECT id, market_id FROM orders WHERE old_ref = ? and side = 'SELL'";
            $selectBuyDealTransactions = "SELECT * FROM trade_transaction WHERE buy_deal_id = ?";
            $stmt = $dbal->query($selectTx);

            $selectBuyOrderStmt = $dbal->prepare($orderBuySelect);
            $selectSellOrderStmt = $dbal->prepare($orderSellSelect);
            $dealTxStmt = $dbal->prepare($selectBuyDealTransactions);

            while($row = $stmt->fetch()) { // iterate over distinct buy deals
                $dealTxStmt->execute([$row['buy_deal_id']]); // select all tx for this buy deal

                $selectBuyOrderStmt->execute([$row['buy_deal_id']]);
                $buyOrder = $selectBuyOrderStmt->fetch();
                $dbal->insert('deals', []);
                $dealId = $dbal->lastInsertId();

                while($tx = $dealTxStmt->fetch()) {
                    $selectSellOrderStmt->execute([$tx['sell_deal_id']]);
                    $sellOrder = $selectSellOrderStmt->fetch();
                    // insert a deal

                    // BUY SIDE
                    $dbal->insert(
                        'transactions',
                        [
                            'deal_id' => $dealId,
                            'order_id' => $buyOrder['id'],
                            'market_id' => $buyOrder['market_id'],
                            'amount' => $tx['amount'],
                            'price' => $tx['unit_price'],
                            'fee' => $tx['buy_fee_amount'],
                            'platform' => 'EXM',
                            'status' => Transaction::STATUS_COMPLETED,
                            'executed_at' => $tx['created_at'],
                            'completed_at' => $tx['created_at']
                        ]
                    );

                    // SELL SIDE
                    $dbal->insert(
                        'transactions',
                        [
                            'deal_id' => $dealId,
                            'order_id' => $sellOrder['id'],
                            'market_id' => $sellOrder['market_id'],
                            'amount' => bcmul($tx['amount'], '-1', 8),
                            'price' => $tx['unit_price'],
                            'fee' => $tx['buy_fee_amount'],
                            'platform' => 'EXM',
                            'status' => Transaction::STATUS_COMPLETED,
                            'executed_at' => $tx['created_at'],
                            'completed_at' => $tx['created_at']
                        ]
                    );
                }
            }

            $dbal->commit();
        } catch (\Exception $e) {
            $dbal->rollback();
            $out->writeln($e->getMessage());
        }
    }
}
