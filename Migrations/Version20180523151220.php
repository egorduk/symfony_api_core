<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180523151220 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE wire_withdraw');
        $this->addSql('DROP TABLE wire_deposit');

        $this->addSql('DROP TABLE withdraw_log');
        $this->addSql('DROP TABLE deposit_log');

        $this->addSql('DROP TABLE virtual_withdraw');
        $this->addSql('DROP TABLE virtual_deposit');

        $this->addSql('DROP TABLE deposit_only');

        $this->addSql('DROP TABLE manual_withdraw');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}