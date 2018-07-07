<?php
namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171110091314 extends AbstractMigration
{

    private $tables = [
        'ohlcv1m', 'ohlcv15m', 'ohlcv30m', 'ohlcv1h', 'ohlcv6h', 'ohlcv12h',
        'ohlcv24h', 'ohlcv3d', 'ohlcv1w'
    ];

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        foreach ($this->tables as $tableName) {
            $table = $schema->createTable($tableName);

            $table->addColumn('price_open',  'decimal')
                ->setPrecision(16)
                ->setScale(8)
                ->setUnsigned(true);

            $table->addColumn('price_close',  'decimal')
                ->setPrecision(16)
                ->setScale(8)
                ->setUnsigned(true);

            $table->addColumn('price_high',  'decimal')
                ->setPrecision(16)
                ->setScale(8)
                ->setUnsigned(true);

            $table->addColumn('price_low',  'decimal')
                ->setPrecision(16)
                ->setScale(8)
                ->setUnsigned(true);

            $table->addColumn('volume',  'integer')
                ->setPrecision(12)
                ->setUnsigned(true);

            $table->addColumn('time',  'integer')
                ->setPrecision(8)
                ->setUnsigned(true);

            $table->addColumn('market_from', 'string')
                ->setFixed(true)
                ->setLength(3);

            $table->addColumn('market_to', 'string')
                ->setFixed(true)
                ->setLength(3);

            $table->addIndex(['market_from', 'market_to', 'time']);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        foreach($this->tables as $tableName) {
            $schema->dropTable($tableName);
        }
    }
}