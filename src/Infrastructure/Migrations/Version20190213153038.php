<?php

declare(strict_types=1);

namespace Metinet\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213153038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE conference (
          id CHAR(36) NOT NULL --(DC2Type:uuid)
          , 
          date DATE NOT NULL --(DC2Type:date_immutable)
          , 
          max_attendees INTEGER NOT NULL, 
          attendees CLOB NOT NULL --(DC2Type:object)
          , 
          registration_rule CLOB NOT NULL --(DC2Type:object)
          , 
          details_title VARCHAR(255) NOT NULL, 
          details_description VARCHAR(255) NOT NULL, 
          details_keywords CLOB NOT NULL --(DC2Type:simple_array)
          , 
          location_place_name VARCHAR(255) NOT NULL, 
          location_address_street VARCHAR(255) NOT NULL, 
          location_address_postal_code VARCHAR(255) NOT NULL, 
          location_address_city VARCHAR(255) NOT NULL, 
          location_address_country VARCHAR(255) NOT NULL, 
          time_slot_start TIME NOT NULL --(DC2Type:conference_time)
          , 
          time_slot_end TIME NOT NULL --(DC2Type:conference_time)
          , 
          PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE conference');
    }
}
