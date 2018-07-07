<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180330192648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE api_key (user_id INT NOT NULL, `key` VARCHAR(25) NOT NULL, secret VARCHAR(50) NOT NULL, permissions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C912ED9DA76ED395 (user_id), PRIMARY KEY(`key`)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_key ADD CONSTRAINT FK_C912ED9DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');

        $this->addSql('CREATE TABLE api_nonce (nonce BIGINT NOT NULL, api_key_id VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_96B1C62D8BE312B3 (api_key_id), PRIMARY KEY(nonce, api_key_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_nonce ADD CONSTRAINT FK_96B1C62D8BE312B3 FOREIGN KEY (api_key_id) REFERENCES api_key (`key`) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE api_key DROP FOREIGN KEY FK_C912ED9DA76ED395');
        $this->addSql('DROP TABLE api_key');

        $this->addSql('ALTER TABLE api_nonce DROP FOREIGN KEY FK_96B1C62D8BE312B3');
        $this->addSql('DROP TABLE api_nonce');
    }
}
