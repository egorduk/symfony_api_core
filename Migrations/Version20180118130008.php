<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180118130008 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_personal_info (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, id_back_attachment_id INT DEFAULT NULL, id_photo_attachment_id INT DEFAULT NULL, residence_proof_attachment_id INT DEFAULT NULL, firstname VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, lastname VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, address VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, zip_code VARCHAR(35) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, birthdate DATE DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, status TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX country_id (country_id), INDEX id_back_attachment_id (id_back_attachment_id), INDEX id_photo_attachment_id (id_photo_attachment_id), INDEX residence_proof_attachment_id (residence_proof_attachment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_personal_info ADD CONSTRAINT user_personal_info_ibfk_1 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user_personal_info ADD CONSTRAINT user_personal_info_ibfk_2 FOREIGN KEY (id_back_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_personal_info ADD CONSTRAINT user_personal_info_ibfk_3 FOREIGN KEY (id_photo_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_personal_info ADD CONSTRAINT user_personal_info_ibfk_4 FOREIGN KEY (residence_proof_attachment_id) REFERENCES attachment (id)');

        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP phone, DROP birthdate, DROP address, DROP city, DROP zip_code');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('DROP INDEX IDX_8D93D649F92F3E70 ON user');
        $this->addSql('ALTER TABLE user DROP country_id');

        $this->addSql('ALTER TABLE user_business_info ADD status TINYINT(1) DEFAULT \'0\' NOT NULL');

        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB909C6BF5097');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB9097CD40C1');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB9094A94776');
        $this->addSql('DROP INDEX UNIQ_DA3DB909C6BF5097 ON user_verification');
        $this->addSql('DROP INDEX UNIQ_DA3DB9097CD40C1 ON user_verification');
        $this->addSql('DROP INDEX UNIQ_DA3DB9094A94776 ON user_verification');
        $this->addSql('ALTER TABLE user_verification ADD personal_info_id INT DEFAULT NULL, DROP id_photo_attachment_id, DROP residence_proof_attachment_id, DROP id_back_attachment_id, DROP status, DROP type, CHANGE reason_declined reason_declined VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT user_verification_ibfk_1 FOREIGN KEY (personal_info_id) REFERENCES user_personal_info (id)');
        $this->addSql('CREATE INDEX personal_info_id ON user_verification (personal_info_id)');

        $this->addSql('ALTER TABLE user_verification DROP reason_declined');

        $this->addSql('ALTER TABLE user_personal_info ADD reason_declined VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE user_business_info ADD reason_declined VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
