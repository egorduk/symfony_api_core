<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180201132939 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coin_submission (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, blockchain VARCHAR(255) NOT NULL, icoTokenPrice VARCHAR(255) NOT NULL, isListingToken VARCHAR(255) NOT NULL, projectLink VARCHAR(255) NOT NULL, representativeEmail VARCHAR(255) NOT NULL, representativeName VARCHAR(255) NOT NULL, representativePosition VARCHAR(255) NOT NULL, saleEnd VARCHAR(255) NOT NULL, saleEndTime VARCHAR(255) NOT NULL, saleStart VARCHAR(255) NOT NULL, saleStartTime VARCHAR(255) NOT NULL, socialThreads VARCHAR(255) NOT NULL, tokenName VARCHAR(255) NOT NULL, tokenSupply VARCHAR(255) NOT NULL, tokenTicker VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP TABLE coin_submission');
    }
}
