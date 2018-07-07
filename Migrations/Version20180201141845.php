<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180201141845 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE coin_submission CHANGE icoTokenPrice icoTokenPrice VARCHAR(255) DEFAULT NULL, CHANGE saleEnd saleEnd VARCHAR(255) DEFAULT NULL, CHANGE saleEndTime saleEndTime VARCHAR(255) DEFAULT NULL, CHANGE saleStart saleStart VARCHAR(255) DEFAULT NULL, CHANGE saleStartTime saleStartTime VARCHAR(255) DEFAULT NULL, CHANGE tokenTicker tokenTicker VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coin_submission CHANGE icoTokenPrice icoTokenPrice VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE saleEnd saleEnd VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE saleEndTime saleEndTime VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE saleStart saleStart VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE saleStartTime saleStartTime VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE tokenTicker tokenTicker VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
