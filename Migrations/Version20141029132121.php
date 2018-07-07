<?php

namespace Btc\CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141029132121 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, confirmation_token_expires_at DATETIME DEFAULT NULL, confirmation_retries SMALLINT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', phone VARCHAR(64) DEFAULT NULL, birthdate DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(64) DEFAULT NULL, auth_key VARCHAR(50) DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, currency_id INT NOT NULL, amount_total NUMERIC(16, 8) NOT NULL, amount_reserved NUMERIC(16, 8) NOT NULL, amount_available NUMERIC(16, 8) NOT NULL, fee_percent NUMERIC(16, 8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_7C68921FA76ED395 (user_id), INDEX IDX_7C68921F38248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, extension VARCHAR(16) NOT NULL, originalName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_rate (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, rated_at DATE NOT NULL, rate NUMERIC(16, 8) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_555B7C4D38248176 (currency_id), UNIQUE INDEX currency_date_idx (rated_at, currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fee_set (id INT AUTO_INCREMENT NOT NULL, parent_fee_set_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, `default` TINYINT(1) NOT NULL, rule NUMERIC(16, 8) DEFAULT NULL, INDEX IDX_F6DA234F826BC7C0 (parent_fee_set_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, crypto TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deals (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operations (id BIGINT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, type VARCHAR(64) NOT NULL, reference_name VARCHAR(32) NOT NULL, reference_id INT NOT NULL, available NUMERIC(16, 8) NOT NULL, reserved NUMERIC(16, 8) NOT NULL, total NUMERIC(16, 8) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_28145348712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kraken_orders (id INT AUTO_INCREMENT NOT NULL, transaction_id INT NOT NULL, order_id VARCHAR(255) DEFAULT NULL, last_response LONGTEXT DEFAULT NULL, status INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C487391A2FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_fee (id INT AUTO_INCREMENT NOT NULL, bank_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, name VARCHAR(32) NOT NULL, fixed NUMERIC(16, 8) NOT NULL, percent NUMERIC(16, 8) NOT NULL, term VARCHAR(64) DEFAULT NULL, INDEX IDX_A12AA58111C8FB41 (bank_id), INDEX IDX_A12AA58138248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_limit (id INT AUTO_INCREMENT NOT NULL, bank_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, name VARCHAR(32) NOT NULL, `limit` NUMERIC(16, 8) NOT NULL, INDEX IDX_28DFDED211C8FB41 (bank_id), INDEX IDX_28DFDED238248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE market (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, with_currency_id INT NOT NULL, slug VARCHAR(16) NOT NULL, name VARCHAR(32) NOT NULL, internal TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6BAC85CB989D9B62 (slug), INDEX IDX_6BAC85CB38248176 (currency_id), INDEX IDX_6BAC85CB4017923F (with_currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, deal_id INT NOT NULL, order_id INT DEFAULT NULL, market_id INT NOT NULL, amount NUMERIC(16, 8) NOT NULL, fee NUMERIC(16, 8) NOT NULL, price NUMERIC(16, 8) NOT NULL, status INT NOT NULL, type VARCHAR(6) NOT NULL, platform VARCHAR(3) NOT NULL, executed_at DATETIME NOT NULL, completed_at DATETIME DEFAULT NULL, INDEX IDX_EAA81A4CF60E2305 (deal_id), INDEX IDX_EAA81A4C8D9F6D38 (order_id), INDEX IDX_EAA81A4C622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email_template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, subject VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hw_withdrawals (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, currency_id INT NOT NULL, address VARCHAR(255) NOT NULL, amount NUMERIC(16, 8) NOT NULL, tx VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9105B1BAA76ED395 (user_id), INDEX IDX_9105B1BA38248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_notifications (id INT AUTO_INCREMENT NOT NULL, market_id INT NOT NULL, email VARCHAR(255) NOT NULL, price NUMERIC(16, 8) NOT NULL, hash VARCHAR(40) NOT NULL, status SMALLINT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_3F20F66622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_verification (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, id_photo_attachment_id INT DEFAULT NULL, residence_proof_attachment_id INT DEFAULT NULL, id_back_attachment_id INT DEFAULT NULL, business_info_id INT DEFAULT NULL, status SMALLINT NOT NULL, type VARCHAR(16) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, reason_declined LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_DA3DB909A76ED395 (user_id), UNIQUE INDEX UNIQ_DA3DB909C6BF5097 (id_photo_attachment_id), UNIQUE INDEX UNIQ_DA3DB9097CD40C1 (residence_proof_attachment_id), UNIQUE INDEX UNIQ_DA3DB9094A94776 (id_back_attachment_id), UNIQUE INDEX UNIQ_DA3DB909B87AB5 (business_info_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, market_id INT NOT NULL, in_wallet_id INT NOT NULL, out_wallet_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, completed_at DATETIME DEFAULT NULL, cancelled_at DATETIME DEFAULT NULL, status SMALLINT NOT NULL, current_amount NUMERIC(16, 8) NOT NULL, asked_unit_price NUMERIC(16, 8) NOT NULL, fee_percent NUMERIC(16, 8) NOT NULL, fee_amount_reserved NUMERIC(16, 8) NOT NULL, fee_amount_taken NUMERIC(16, 8) NOT NULL, type SMALLINT NOT NULL, amount NUMERIC(16, 8) NOT NULL, side VARCHAR(4) NOT NULL, reserve_total NUMERIC(16, 8) NOT NULL, reserve_spent NUMERIC(16, 8) NOT NULL, old_ref INT DEFAULT NULL, INDEX IDX_E52FFDEE622F3F37 (market_id), INDEX IDX_E52FFDEE13BFC450 (in_wallet_id), INDEX IDX_E52FFDEEBD677E4 (out_wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, published_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coin_deposit_address (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, currency_id INT NOT NULL, address VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_17866CEEA76ED395 (user_id), INDEX IDX_17866CEE38248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fee_action (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, for_market TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, slug VARCHAR(64) NOT NULL, fiat TINYINT(1) NOT NULL, payment_method VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D860BF7A989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bitfinex_orders (id INT AUTO_INCREMENT NOT NULL, transaction_id INT NOT NULL, order_id INT NOT NULL, last_response LONGTEXT DEFAULT NULL, status INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AE444FA52FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translations (id INT AUTO_INCREMENT NOT NULL, object_id INT DEFAULT NULL, locale VARCHAR(8) NOT NULL, field VARCHAR(32) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_78AB76C9232D562B (object_id), UNIQUE INDEX UNIQ_78AB76C94180C698232D562B5BF54558 (locale, object_id, field), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_activity (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, action VARCHAR(255) NOT NULL, ip_address VARCHAR(255) NOT NULL, additional_info LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, INDEX IDX_4CF9ED5AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, market_id INT DEFAULT NULL, slug VARCHAR(32) NOT NULL, name VARCHAR(32) NOT NULL, value LONGTEXT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_E545A0C5622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vouchers (id INT AUTO_INCREMENT NOT NULL, currency_id INT NOT NULL, created_by_user_id INT NOT NULL, redeemed_by_user_id INT DEFAULT NULL, code VARCHAR(50) NOT NULL, amount NUMERIC(16, 8) NOT NULL, status SMALLINT NOT NULL, created_at DATETIME NOT NULL, redeemed_at DATETIME DEFAULT NULL, INDEX IDX_9315074838248176 (currency_id), INDEX IDX_931507487D182D95 (created_by_user_id), INDEX IDX_9315074830F0B8CF (redeemed_by_user_id), INDEX code_idx (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_business_info (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, company_details_1_attachment_id INT DEFAULT NULL, company_details_2_attachment_id INT DEFAULT NULL, company_details_3_attachment_id INT DEFAULT NULL, company_details_4_attachment_id INT DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, vat_id VARCHAR(255) DEFAULT NULL, registration_number VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, building VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(64) DEFAULT NULL, office_number VARCHAR(64) DEFAULT NULL, INDEX IDX_759C9E0AF92F3E70 (country_id), UNIQUE INDEX UNIQ_759C9E0A34431AE (company_details_1_attachment_id), UNIQUE INDEX UNIQ_759C9E0A12395BD7 (company_details_2_attachment_id), UNIQUE INDEX UNIQ_759C9E0AABC2803F (company_details_3_attachment_id), UNIQUE INDEX UNIQ_759C9E0A30C38F25 (company_details_4_attachment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fixtures (name VARCHAR(255) NOT NULL, PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(100) NOT NULL, title VARCHAR(128) NOT NULL, description VARCHAR(512) NOT NULL, html LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_preference (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, preference_id INT NOT NULL, value INT NOT NULL, INDEX IDX_FA0E76BFA76ED395 (user_id), INDEX IDX_FA0E76BFD81022C0 (preference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fee_set (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, fee_set_id INT NOT NULL, fallback_fee_set_id INT NOT NULL, created_at DATETIME NOT NULL, expires_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_AED73D45A76ED395 (user_id), INDEX IDX_AED73D45C5284390 (fee_set_id), INDEX IDX_AED73D458028A15E (fallback_fee_set_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, iso2 VARCHAR(2) NOT NULL, iso3 VARCHAR(3) NOT NULL, hidden TINYINT(1) NOT NULL, restricted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fee (id INT AUTO_INCREMENT NOT NULL, fee_set_id INT NOT NULL, fee_action_id INT NOT NULL, market_id INT DEFAULT NULL, fixed NUMERIC(16, 8) NOT NULL, percent NUMERIC(16, 8) NOT NULL, INDEX IDX_964964B5C5284390 (fee_set_id), INDEX IDX_964964B53345B3D (fee_action_id), INDEX IDX_964964B5622F3F37 (market_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotional_email (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, registered TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C5287FD1E7927C74 (email), INDEX hash_idx (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE currency_rate ADD CONSTRAINT FK_555B7C4D38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE fee_set ADD CONSTRAINT FK_F6DA234F826BC7C0 FOREIGN KEY (parent_fee_set_id) REFERENCES fee_set (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_28145348712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE kraken_orders ADD CONSTRAINT FK_C487391A2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transactions (id)');
        $this->addSql('ALTER TABLE payment_fee ADD CONSTRAINT FK_A12AA58111C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE payment_fee ADD CONSTRAINT FK_A12AA58138248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE payment_limit ADD CONSTRAINT FK_28DFDED211C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE payment_limit ADD CONSTRAINT FK_28DFDED238248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE market ADD CONSTRAINT FK_6BAC85CB38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE market ADD CONSTRAINT FK_6BAC85CB4017923F FOREIGN KEY (with_currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CF60E2305 FOREIGN KEY (deal_id) REFERENCES deals (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE hw_withdrawals ADD CONSTRAINT FK_9105B1BAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hw_withdrawals ADD CONSTRAINT FK_9105B1BA38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE price_notifications ADD CONSTRAINT FK_3F20F66622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT FK_DA3DB909A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT FK_DA3DB909C6BF5097 FOREIGN KEY (id_photo_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT FK_DA3DB9097CD40C1 FOREIGN KEY (residence_proof_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT FK_DA3DB9094A94776 FOREIGN KEY (id_back_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_verification ADD CONSTRAINT FK_DA3DB909B87AB5 FOREIGN KEY (business_info_id) REFERENCES user_business_info (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE13BFC450 FOREIGN KEY (in_wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEBD677E4 FOREIGN KEY (out_wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE coin_deposit_address ADD CONSTRAINT FK_17866CEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coin_deposit_address ADD CONSTRAINT FK_17866CEE38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE bitfinex_orders ADD CONSTRAINT FK_AE444FA52FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transactions (id)');
        $this->addSql('ALTER TABLE page_translations ADD CONSTRAINT FK_78AB76C9232D562B FOREIGN KEY (object_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_activity ADD CONSTRAINT FK_4CF9ED5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C5622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE vouchers ADD CONSTRAINT FK_9315074838248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE vouchers ADD CONSTRAINT FK_931507487D182D95 FOREIGN KEY (created_by_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vouchers ADD CONSTRAINT FK_9315074830F0B8CF FOREIGN KEY (redeemed_by_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_business_info ADD CONSTRAINT FK_759C9E0AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user_business_info ADD CONSTRAINT FK_759C9E0A34431AE FOREIGN KEY (company_details_1_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_business_info ADD CONSTRAINT FK_759C9E0A12395BD7 FOREIGN KEY (company_details_2_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_business_info ADD CONSTRAINT FK_759C9E0AABC2803F FOREIGN KEY (company_details_3_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_business_info ADD CONSTRAINT FK_759C9E0A30C38F25 FOREIGN KEY (company_details_4_attachment_id) REFERENCES attachment (id)');
        $this->addSql('ALTER TABLE user_preference ADD CONSTRAINT FK_FA0E76BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_preference ADD CONSTRAINT FK_FA0E76BFD81022C0 FOREIGN KEY (preference_id) REFERENCES preference (id)');
        $this->addSql('ALTER TABLE user_fee_set ADD CONSTRAINT FK_AED73D45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_fee_set ADD CONSTRAINT FK_AED73D45C5284390 FOREIGN KEY (fee_set_id) REFERENCES fee_set (id)');
        $this->addSql('ALTER TABLE user_fee_set ADD CONSTRAINT FK_AED73D458028A15E FOREIGN KEY (fallback_fee_set_id) REFERENCES fee_set (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B5C5284390 FOREIGN KEY (fee_set_id) REFERENCES fee_set (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B53345B3D FOREIGN KEY (fee_action_id) REFERENCES fee_action (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B5622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921FA76ED395');
        $this->addSql('ALTER TABLE hw_withdrawals DROP FOREIGN KEY FK_9105B1BAA76ED395');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB909A76ED395');
        $this->addSql('ALTER TABLE coin_deposit_address DROP FOREIGN KEY FK_17866CEEA76ED395');
        $this->addSql('ALTER TABLE user_activity DROP FOREIGN KEY FK_4CF9ED5AA76ED395');
        $this->addSql('ALTER TABLE vouchers DROP FOREIGN KEY FK_931507487D182D95');
        $this->addSql('ALTER TABLE vouchers DROP FOREIGN KEY FK_9315074830F0B8CF');
        $this->addSql('ALTER TABLE user_preference DROP FOREIGN KEY FK_FA0E76BFA76ED395');
        $this->addSql('ALTER TABLE user_fee_set DROP FOREIGN KEY FK_AED73D45A76ED395');
        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_28145348712520F3');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE13BFC450');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEBD677E4');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB909C6BF5097');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB9097CD40C1');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB9094A94776');
        $this->addSql('ALTER TABLE user_business_info DROP FOREIGN KEY FK_759C9E0A34431AE');
        $this->addSql('ALTER TABLE user_business_info DROP FOREIGN KEY FK_759C9E0A12395BD7');
        $this->addSql('ALTER TABLE user_business_info DROP FOREIGN KEY FK_759C9E0AABC2803F');
        $this->addSql('ALTER TABLE user_business_info DROP FOREIGN KEY FK_759C9E0A30C38F25');
        $this->addSql('ALTER TABLE fee_set DROP FOREIGN KEY FK_F6DA234F826BC7C0');
        $this->addSql('ALTER TABLE user_fee_set DROP FOREIGN KEY FK_AED73D45C5284390');
        $this->addSql('ALTER TABLE user_fee_set DROP FOREIGN KEY FK_AED73D458028A15E');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B5C5284390');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F38248176');
        $this->addSql('ALTER TABLE currency_rate DROP FOREIGN KEY FK_555B7C4D38248176');
        $this->addSql('ALTER TABLE payment_fee DROP FOREIGN KEY FK_A12AA58138248176');
        $this->addSql('ALTER TABLE payment_limit DROP FOREIGN KEY FK_28DFDED238248176');
        $this->addSql('ALTER TABLE market DROP FOREIGN KEY FK_6BAC85CB38248176');
        $this->addSql('ALTER TABLE market DROP FOREIGN KEY FK_6BAC85CB4017923F');
        $this->addSql('ALTER TABLE hw_withdrawals DROP FOREIGN KEY FK_9105B1BA38248176');
        $this->addSql('ALTER TABLE coin_deposit_address DROP FOREIGN KEY FK_17866CEE38248176');
        $this->addSql('ALTER TABLE vouchers DROP FOREIGN KEY FK_9315074838248176');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4CF60E2305');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C622F3F37');
        $this->addSql('ALTER TABLE price_notifications DROP FOREIGN KEY FK_3F20F66622F3F37');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE622F3F37');
        $this->addSql('ALTER TABLE settings DROP FOREIGN KEY FK_E545A0C5622F3F37');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B5622F3F37');
        $this->addSql('ALTER TABLE user_preference DROP FOREIGN KEY FK_FA0E76BFD81022C0');
        $this->addSql('ALTER TABLE kraken_orders DROP FOREIGN KEY FK_C487391A2FC0CB0F');
        $this->addSql('ALTER TABLE bitfinex_orders DROP FOREIGN KEY FK_AE444FA52FC0CB0F');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C8D9F6D38');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B53345B3D');
        $this->addSql('ALTER TABLE payment_fee DROP FOREIGN KEY FK_A12AA58111C8FB41');
        $this->addSql('ALTER TABLE payment_limit DROP FOREIGN KEY FK_28DFDED211C8FB41');
        $this->addSql('ALTER TABLE user_verification DROP FOREIGN KEY FK_DA3DB909B87AB5');
        $this->addSql('ALTER TABLE page_translations DROP FOREIGN KEY FK_78AB76C9232D562B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE user_business_info DROP FOREIGN KEY FK_759C9E0AF92F3E70');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE currency_rate');
        $this->addSql('DROP TABLE fee_set');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE deals');
        $this->addSql('DROP TABLE operations');
        $this->addSql('DROP TABLE kraken_orders');
        $this->addSql('DROP TABLE payment_fee');
        $this->addSql('DROP TABLE payment_limit');
        $this->addSql('DROP TABLE market');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE email_template');
        $this->addSql('DROP TABLE hw_withdrawals');
        $this->addSql('DROP TABLE price_notifications');
        $this->addSql('DROP TABLE user_verification');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE coin_deposit_address');
        $this->addSql('DROP TABLE fee_action');
        $this->addSql('DROP TABLE bank');
        $this->addSql('DROP TABLE bitfinex_orders');
        $this->addSql('DROP TABLE page_translations');
        $this->addSql('DROP TABLE user_activity');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE vouchers');
        $this->addSql('DROP TABLE user_business_info');
        $this->addSql('DROP TABLE fixtures');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE user_preference');
        $this->addSql('DROP TABLE user_fee_set');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE fee');
        $this->addSql('DROP TABLE promotional_email');
        $this->addSql('DROP TABLE wallet');
    }
}
