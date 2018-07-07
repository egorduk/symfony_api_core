<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180104163233 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE IF EXISTS  ohlcv');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv12h');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv15m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1d');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1h');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1w');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv30m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv3d');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv5m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv6h');
        $this->addSql('CREATE TABLE ohlcv (interval_id INT NOT NULL COMMENT \'number of minute since beginning of unix epoch\', market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv12h (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv15m (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv1d (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv1h (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv1w (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv30m (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv3d (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv5m (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ohlcv6h (interval_id INT NOT NULL, market_id INT NOT NULL, open NUMERIC(16, 8) NOT NULL, high NUMERIC(16, 8) NOT NULL, low NUMERIC(16, 8) NOT NULL, close NUMERIC(16, 8) NOT NULL, volume NUMERIC(16, 8) NOT NULL, PRIMARY KEY(interval_id, market_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv12h');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv15m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1d');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1h');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv1w');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv30m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv3d');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv5m');
        $this->addSql('DROP TABLE IF EXISTS  ohlcv6h');

    }
}
