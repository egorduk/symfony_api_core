<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180513151220 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, address VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4CF9ED5AA76ED391 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_4CF9ED5AA76ED394 FOREIGN KEY (user_id) REFERENCES user (id)');

        $this->addSql('CREATE TABLE wallet_transaction (
id INT AUTO_INCREMENT NOT NULL, 
transaction_id VARCHAR(100) NOT NULL, 
confirmations INT UNSIGNED NOT NULL, 
block INT UNSIGNED NOT NULL, 
fee NUMERIC(24, 8) NOT NULL, 
time INT UNSIGNED NOT NULL,
created_at DATETIME NOT NULL,
UNIQUE INDEX transaction_id_idx (transaction_id),
PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('CREATE TABLE address_transaction (
id INT AUTO_INCREMENT NOT NULL, 
wallet_transaction_id INT NOT NULL, 
user_address_id INT NULL, 
amount NUMERIC(24, 8) UNSIGNED NOT NULL,
created_at DATETIME NOT NULL,
PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE address_transaction ADD CONSTRAINT FK_4CF9ED5AA76ED001 FOREIGN KEY (wallet_transaction_id) REFERENCES wallet_transaction (id)');
        $this->addSql('ALTER TABLE address_transaction ADD CONSTRAINT FK_4CF9ED5AA76ED002 FOREIGN KEY (user_address_id) REFERENCES user_address (id)');
        
        $this->addSql('CREATE TABLE muhhamad_wallet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, key_store VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE muhhamad_wallet ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE muhhamad_wallet ADD CONSTRAINT FK_4CF9ED5AA76ED402 FOREIGN KEY (currency_id) REFERENCES currency (id)');

        $this->addSql('ALTER TABLE user_address ADD is_used TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_address ADD muhhamad_wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_4CF9ED5AA76ED393 FOREIGN KEY (muhhamad_wallet_id) REFERENCES muhhamad_wallet (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address_transaction DROP FOREIGN KEY FK_4CF9ED5AA76ED001');
        $this->addSql('ALTER TABLE address_transaction DROP FOREIGN KEY FK_4CF9ED5AA76ED002');
        $this->addSql('DROP TABLE address_transaction');

        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_4CF9ED5AA76ED393');
        $this->addSql('ALTER TABLE user_address DROP COLUMN muhhamad_wallet_id');
        $this->addSql('ALTER TABLE user_address DROP COLUMN is_used');

        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_4CF9ED5AA76ED394');
        $this->addSql('DROP TABLE user_address');

        $this->addSql('ALTER TABLE muhhamad_wallet DROP FOREIGN KEY FK_4CF9ED5AA76ED402');
        $this->addSql('ALTER TABLE muhhamad_wallet DROP COLUMN currency_id');

        $this->addSql('DROP TABLE muhhamad_wallet');

        $this->addSql('DROP TABLE wallet_transaction');
    }
}