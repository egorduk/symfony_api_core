<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141029140230 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this one removes legacy migrations, to prevent further warnings
        $this->addSql('DELETE FROM migration_versions WHERE version != \'20141029132121\'');
    }

    public function down(Schema $schema)
    {
    }
}
