<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218113228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payments_customer (id VARCHAR(26) NOT NULL, public_user_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE payments_invoice (id VARCHAR(26) NOT NULL, order_id VARCHAR(26) NOT NULL, customer_id VARCHAR(26) NOT NULL, status VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, amount INT NOT NULL, items json NOT NULL NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C02EC5E68D9F6D38 ON payments_invoice (order_id)');
        $this->addSql('COMMENT ON COLUMN payments_invoice.items IS \'(DC2Type:invoice_items)\'');
        $this->addSql('COMMENT ON COLUMN payments_invoice.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE payments_payment (id VARCHAR(26) NOT NULL, invoice_id VARCHAR(26) NOT NULL, customer_id VARCHAR(26) NOT NULL, external_payment_id VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, response JSON DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D6356AF2989F1FD ON payments_payment (invoice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D6356AF1E3D2C69 ON payments_payment (external_payment_id)');
        $this->addSql('COMMENT ON COLUMN payments_payment.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE payments_customer');
        $this->addSql('DROP TABLE payments_invoice');
        $this->addSql('DROP TABLE payments_payment');
    }
}
