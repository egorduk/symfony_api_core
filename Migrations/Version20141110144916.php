<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141110144916 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE phone_verification (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, phone VARCHAR(255) NOT NULL, pin VARCHAR(255) NOT NULL, confirmed TINYINT(1) NOT NULL, sent TINYINT(1) NOT NULL, INDEX IDX_24C0F4DAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phone_verification ADD CONSTRAINT FK_24C0F4DAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD hotp_auth_key VARCHAR(50) DEFAULT NULL, ADD hotp_auth_counter INT DEFAULT NULL, ADD hotp_sent_times SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE phone_verification');
        $this->addSql('ALTER TABLE user DROP hotp_auth_key, DROP hotp_auth_counter, DROP hotp_sent_times');
    }
}
