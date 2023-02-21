<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221072619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA pz');
        $this->addSql('CREATE SEQUENCE pz.add_document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pz.add_document (id INT NOT NULL, request_url VARCHAR(255) NOT NULL, document_info VARCHAR(255) NOT NULL, request_wide_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pz.add_document.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE pz.init_request (redirect_url VARCHAR(255) NOT NULL, request_info VARCHAR(255) DEFAULT NULL, auth_subject VARCHAR(255) DEFAULT NULL, extra VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(redirect_url))');
        $this->addSql('COMMENT ON COLUMN pz.init_request.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP TABLE p1.init_request');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA p1');
        $this->addSql('DROP SEQUENCE pz.add_document_id_seq CASCADE');
        $this->addSql('CREATE TABLE p1.init_request (redirect_url VARCHAR(255) NOT NULL, request_info VARCHAR(255) DEFAULT NULL, auth_subject VARCHAR(255) DEFAULT NULL, extra VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(redirect_url))');
        $this->addSql('COMMENT ON COLUMN p1.init_request.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP TABLE pz.add_document');
        $this->addSql('DROP TABLE pz.init_request');
    }
}
