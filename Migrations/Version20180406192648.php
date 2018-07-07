<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406192648 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_volume (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, volume_day_at DATE NOT NULL, volume NUMERIC(16, 8) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DCC8D6E3A76ED395 (user_id), UNIQUE INDEX user_date_idx (volume_day_at, user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_volume ADD CONSTRAINT FK_DCC8D6E3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE user_volume DROP FOREIGN KEY FK_DCC8D6E3A76ED395');
        $this->addSql('DROP TABLE user_volume');
    }
}
