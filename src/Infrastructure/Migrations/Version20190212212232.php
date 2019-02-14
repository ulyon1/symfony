<?php

declare(strict_types=1);

namespace Metinet\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212212232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Job table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE job (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , title VARCHAR(255) NOT NULL, description CLOB NOT NULL, soft_skills CLOB NOT NULL --(DC2Type:array)
        , hard_skills CLOB NOT NULL --(DC2Type:array)
        , contract_type VARCHAR(255) NOT NULL, publication_date DATE NOT NULL --(DC2Type:date_immutable)
        , PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE job');
    }
}
