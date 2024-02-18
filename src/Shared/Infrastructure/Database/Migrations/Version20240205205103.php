<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205205103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE saga_create_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orders_customer (id VARCHAR(26) NOT NULL, public_user_id VARCHAR(26) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE orders_order (id VARCHAR(26) NOT NULL, customer_id VARCHAR(26) NOT NULL, status VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, total_price INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, state VARCHAR(255) DEFAULT \'created\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN orders_order.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE orders_order_item (id VARCHAR(26) NOT NULL, order_id VARCHAR(26) DEFAULT NULL, price INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, product_id VARCHAR(26) NOT NULL, product_name VARCHAR(255) NOT NULL, product_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3728068E8D9F6D38 ON orders_order_item (order_id)');
        $this->addSql('COMMENT ON COLUMN orders_order_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F2195C74F2195 ON refresh_token (refresh_token)');
        $this->addSql('CREATE TABLE saga_create_order (id VARCHAR(255) NOT NULL, order_id VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, payload TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN saga_create_order.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE skills_skill (id VARCHAR(26) NOT NULL, skill_group_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, owner_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F3520F17BCFCB4B5 ON skills_skill (skill_group_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3520F175E237E06BCFCB4B5 ON skills_skill (name, skill_group_id)');
        $this->addSql('CREATE TABLE skills_skill_confirmation (id VARCHAR(26) NOT NULL, specialist_id VARCHAR(26) DEFAULT NULL, skill_id VARCHAR(26) DEFAULT NULL, level VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, actualized_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_722F1C197B100C1A ON skills_skill_confirmation (specialist_id)');
        $this->addSql('CREATE INDEX IDX_722F1C195585C142 ON skills_skill_confirmation (skill_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_722F1C197B100C1A5585C1429AEACC13 ON skills_skill_confirmation (specialist_id, skill_id, level)');
        $this->addSql('COMMENT ON COLUMN skills_skill_confirmation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN skills_skill_confirmation.actualized_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE skills_skill_confirmation_proof (id VARCHAR(26) NOT NULL, skill_confirmation_id VARCHAR(26) DEFAULT NULL, test_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F2C86C75D6D96DB ON skills_skill_confirmation_proof (skill_confirmation_id)');
        $this->addSql('CREATE TABLE skills_skill_group (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, hidden BOOLEAN DEFAULT false NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, owner_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADFD070B5E237E06 ON skills_skill_group (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADFD070B7E3C61F95E237E06 ON skills_skill_group (owner_id, name)');
        $this->addSql('CREATE TABLE skills_specialist (id VARCHAR(26) NOT NULL, public_user_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skills_specialist_speciality (specialist_id VARCHAR(26) NOT NULL, speciality_id VARCHAR(26) NOT NULL, PRIMARY KEY(specialist_id, speciality_id))');
        $this->addSql('CREATE INDEX IDX_9B70D7337B100C1A ON skills_specialist_speciality (specialist_id)');
        $this->addSql('CREATE INDEX IDX_9B70D7333B5A08D7 ON skills_specialist_speciality (speciality_id)');
        $this->addSql('CREATE TABLE skills_speciality (id VARCHAR(26) NOT NULL, owner_id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, publication_status VARCHAR(50) DEFAULT \'draft\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skills_speciality_skill (id VARCHAR(26) NOT NULL, speciality_id VARCHAR(26) NOT NULL, skill_id VARCHAR(26) NOT NULL, level VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A1DD72EA3B5A08D7 ON skills_speciality_skill (speciality_id)');
        $this->addSql('CREATE INDEX IDX_A1DD72EA5585C142 ON skills_speciality_skill (skill_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A1DD72EA3B5A08D75585C142 ON skills_speciality_skill (speciality_id, skill_id)');
        $this->addSql('CREATE TABLE testing_answer_option (id VARCHAR(26) NOT NULL, question_id VARCHAR(26) DEFAULT NULL, description VARCHAR(255) NOT NULL, correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62DD1EDE1E27F6BF ON testing_answer_option (question_id)');
        $this->addSql('CREATE TABLE testing_question (id VARCHAR(26) NOT NULL, test_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, position_number INT DEFAULT NULL, published BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_804A23011E5D0459 ON testing_question (test_id)');
        $this->addSql('CREATE TABLE testing_test (id VARCHAR(26) NOT NULL, owner_id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, correct_answers_percentage INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, skill_id VARCHAR(26) DEFAULT NULL, difficulty_level VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F8FA01C5E237E06 ON testing_test (name)');
        $this->addSql('COMMENT ON COLUMN testing_test.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE testing_testing_session (id VARCHAR(26) NOT NULL, test_id VARCHAR(26) DEFAULT NULL, user_id VARCHAR(26) NOT NULL, correct_answers_percentage INT DEFAULT 0 NOT NULL, is_passed_successfully BOOLEAN DEFAULT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_485F2E0A1E5D0459 ON testing_testing_session (test_id)');
        $this->addSql('COMMENT ON COLUMN testing_testing_session.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_testing_session.completed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE testing_user_answer (id VARCHAR(26) NOT NULL, testing_session_id VARCHAR(26) DEFAULT NULL, question_id VARCHAR(26) DEFAULT NULL, answered_options TEXT DEFAULT \'[]\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE8BD7CFBBB901EE ON testing_user_answer (testing_session_id)');
        $this->addSql('CREATE INDEX IDX_EE8BD7CF1E27F6BF ON testing_user_answer (question_id)');
        $this->addSql('COMMENT ON COLUMN testing_user_answer.answered_options IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE training_material (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN training_material.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN training_material.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE users_user (id VARCHAR(26) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT \'[]\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_421A9847E7927C74 ON users_user (email)');
        $this->addSql('CREATE TABLE orders_outbox_message (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8F01EC0FB7336F0 ON orders_outbox_message (queue_name)');
        $this->addSql('CREATE INDEX IDX_E8F01EC0E3BD61CE ON orders_outbox_message (available_at)');
        $this->addSql('CREATE INDEX IDX_E8F01EC016BA31DB ON orders_outbox_message (delivered_at)');
        $this->addSql('COMMENT ON COLUMN orders_outbox_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN orders_outbox_message.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN orders_outbox_message.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_orders_outbox_message() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'orders_outbox_message\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON orders_outbox_message;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON orders_outbox_message FOR EACH ROW EXECUTE PROCEDURE notify_orders_outbox_message();');
        $this->addSql('CREATE TABLE inventory_outbox_message (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52E1360FB7336F0 ON inventory_outbox_message (queue_name)');
        $this->addSql('CREATE INDEX IDX_F52E1360E3BD61CE ON inventory_outbox_message (available_at)');
        $this->addSql('CREATE INDEX IDX_F52E136016BA31DB ON inventory_outbox_message (delivered_at)');
        $this->addSql('COMMENT ON COLUMN inventory_outbox_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN inventory_outbox_message.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN inventory_outbox_message.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_inventory_outbox_message() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'inventory_outbox_message\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON inventory_outbox_message;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON inventory_outbox_message FOR EACH ROW EXECUTE PROCEDURE notify_inventory_outbox_message();');
        $this->addSql('CREATE TABLE payments_outbox_message (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2471313FFB7336F0 ON payments_outbox_message (queue_name)');
        $this->addSql('CREATE INDEX IDX_2471313FE3BD61CE ON payments_outbox_message (available_at)');
        $this->addSql('CREATE INDEX IDX_2471313F16BA31DB ON payments_outbox_message (delivered_at)');
        $this->addSql('COMMENT ON COLUMN payments_outbox_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN payments_outbox_message.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN payments_outbox_message.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_payments_outbox_message() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'payments_outbox_message\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON payments_outbox_message;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON payments_outbox_message FOR EACH ROW EXECUTE PROCEDURE notify_payments_outbox_message();');
        $this->addSql('ALTER TABLE orders_order_item ADD CONSTRAINT FK_3728068E8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill ADD CONSTRAINT FK_F3520F17BCFCB4B5 FOREIGN KEY (skill_group_id) REFERENCES skills_skill_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill_confirmation ADD CONSTRAINT FK_722F1C197B100C1A FOREIGN KEY (specialist_id) REFERENCES skills_specialist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill_confirmation ADD CONSTRAINT FK_722F1C195585C142 FOREIGN KEY (skill_id) REFERENCES skills_skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill_confirmation_proof ADD CONSTRAINT FK_5F2C86C75D6D96DB FOREIGN KEY (skill_confirmation_id) REFERENCES skills_skill_confirmation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_specialist_speciality ADD CONSTRAINT FK_9B70D7337B100C1A FOREIGN KEY (specialist_id) REFERENCES skills_specialist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_specialist_speciality ADD CONSTRAINT FK_9B70D7333B5A08D7 FOREIGN KEY (speciality_id) REFERENCES skills_speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_speciality_skill ADD CONSTRAINT FK_A1DD72EA3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES skills_speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_speciality_skill ADD CONSTRAINT FK_A1DD72EA5585C142 FOREIGN KEY (skill_id) REFERENCES skills_skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_answer_option ADD CONSTRAINT FK_62DD1EDE1E27F6BF FOREIGN KEY (question_id) REFERENCES testing_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_question ADD CONSTRAINT FK_804A23011E5D0459 FOREIGN KEY (test_id) REFERENCES testing_test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_testing_session ADD CONSTRAINT FK_485F2E0A1E5D0459 FOREIGN KEY (test_id) REFERENCES testing_test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_user_answer ADD CONSTRAINT FK_EE8BD7CFBBB901EE FOREIGN KEY (testing_session_id) REFERENCES testing_testing_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_user_answer ADD CONSTRAINT FK_EE8BD7CF1E27F6BF FOREIGN KEY (question_id) REFERENCES testing_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE saga_create_order_id_seq CASCADE');
        $this->addSql('ALTER TABLE orders_order_item DROP CONSTRAINT FK_3728068E8D9F6D38');
        $this->addSql('ALTER TABLE skills_skill DROP CONSTRAINT FK_F3520F17BCFCB4B5');
        $this->addSql('ALTER TABLE skills_skill_confirmation DROP CONSTRAINT FK_722F1C197B100C1A');
        $this->addSql('ALTER TABLE skills_skill_confirmation DROP CONSTRAINT FK_722F1C195585C142');
        $this->addSql('ALTER TABLE skills_skill_confirmation_proof DROP CONSTRAINT FK_5F2C86C75D6D96DB');
        $this->addSql('ALTER TABLE skills_specialist_speciality DROP CONSTRAINT FK_9B70D7337B100C1A');
        $this->addSql('ALTER TABLE skills_specialist_speciality DROP CONSTRAINT FK_9B70D7333B5A08D7');
        $this->addSql('ALTER TABLE skills_speciality_skill DROP CONSTRAINT FK_A1DD72EA3B5A08D7');
        $this->addSql('ALTER TABLE skills_speciality_skill DROP CONSTRAINT FK_A1DD72EA5585C142');
        $this->addSql('ALTER TABLE testing_answer_option DROP CONSTRAINT FK_62DD1EDE1E27F6BF');
        $this->addSql('ALTER TABLE testing_question DROP CONSTRAINT FK_804A23011E5D0459');
        $this->addSql('ALTER TABLE testing_testing_session DROP CONSTRAINT FK_485F2E0A1E5D0459');
        $this->addSql('ALTER TABLE testing_user_answer DROP CONSTRAINT FK_EE8BD7CFBBB901EE');
        $this->addSql('ALTER TABLE testing_user_answer DROP CONSTRAINT FK_EE8BD7CF1E27F6BF');
        $this->addSql('DROP TABLE orders_customer');
        $this->addSql('DROP TABLE orders_order');
        $this->addSql('DROP TABLE orders_order_item');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE saga_create_order');
        $this->addSql('DROP TABLE skills_skill');
        $this->addSql('DROP TABLE skills_skill_confirmation');
        $this->addSql('DROP TABLE skills_skill_confirmation_proof');
        $this->addSql('DROP TABLE skills_skill_group');
        $this->addSql('DROP TABLE skills_specialist');
        $this->addSql('DROP TABLE skills_specialist_speciality');
        $this->addSql('DROP TABLE skills_speciality');
        $this->addSql('DROP TABLE skills_speciality_skill');
        $this->addSql('DROP TABLE testing_answer_option');
        $this->addSql('DROP TABLE testing_question');
        $this->addSql('DROP TABLE testing_test');
        $this->addSql('DROP TABLE testing_testing_session');
        $this->addSql('DROP TABLE testing_user_answer');
        $this->addSql('DROP TABLE training_material');
        $this->addSql('DROP TABLE users_user');
        $this->addSql('DROP TABLE orders_outbox_message');
        $this->addSql('DROP TABLE inventory_outbox_message');
        $this->addSql('DROP TABLE payments_outbox_message');
    }
}
