<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216123753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wakfu_action (id SERIAL NOT NULL, effect TEXT NOT NULL, description TEXT NOT NULL, wakfu_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE wakfu_equipment_item_type (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, recyclable BOOLEAN NOT NULL, visible_in_animation BOOLEAN NOT NULL, title TEXT NOT NULL, wakfu_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2C63FF85727ACA70 ON wakfu_equipment_item_type (parent_id)');
        $this->addSql('CREATE TABLE wakfu_equipment_item_type_equipment_positions (wakfu_equipment_item_type_id INT NOT NULL, wakfu_equipment_position_id INT NOT NULL, PRIMARY KEY(wakfu_equipment_item_type_id, wakfu_equipment_position_id))');
        $this->addSql('CREATE INDEX IDX_2F13BAF7C620D1E7 ON wakfu_equipment_item_type_equipment_positions (wakfu_equipment_item_type_id)');
        $this->addSql('CREATE INDEX IDX_2F13BAF781C2230B ON wakfu_equipment_item_type_equipment_positions (wakfu_equipment_position_id)');
        $this->addSql('CREATE TABLE wakfu_equipment_item_type_disabled_positions (wakfu_equipment_item_type_id INT NOT NULL, wakfu_equipment_position_id INT NOT NULL, PRIMARY KEY(wakfu_equipment_item_type_id, wakfu_equipment_position_id))');
        $this->addSql('CREATE INDEX IDX_408C0006C620D1E7 ON wakfu_equipment_item_type_disabled_positions (wakfu_equipment_item_type_id)');
        $this->addSql('CREATE INDEX IDX_408C000681C2230B ON wakfu_equipment_item_type_disabled_positions (wakfu_equipment_position_id)');
        $this->addSql('CREATE TABLE wakfu_equipment_position (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type ADD CONSTRAINT FK_2C63FF85727ACA70 FOREIGN KEY (parent_id) REFERENCES wakfu_equipment_item_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_equipment_positions ADD CONSTRAINT FK_2F13BAF7C620D1E7 FOREIGN KEY (wakfu_equipment_item_type_id) REFERENCES wakfu_equipment_item_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_equipment_positions ADD CONSTRAINT FK_2F13BAF781C2230B FOREIGN KEY (wakfu_equipment_position_id) REFERENCES wakfu_equipment_position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_disabled_positions ADD CONSTRAINT FK_408C0006C620D1E7 FOREIGN KEY (wakfu_equipment_item_type_id) REFERENCES wakfu_equipment_item_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_disabled_positions ADD CONSTRAINT FK_408C000681C2230B FOREIGN KEY (wakfu_equipment_position_id) REFERENCES wakfu_equipment_position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type DROP CONSTRAINT FK_2C63FF85727ACA70');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_equipment_positions DROP CONSTRAINT FK_2F13BAF7C620D1E7');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_equipment_positions DROP CONSTRAINT FK_2F13BAF781C2230B');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_disabled_positions DROP CONSTRAINT FK_408C0006C620D1E7');
        $this->addSql('ALTER TABLE wakfu_equipment_item_type_disabled_positions DROP CONSTRAINT FK_408C000681C2230B');
        $this->addSql('DROP TABLE wakfu_action');
        $this->addSql('DROP TABLE wakfu_equipment_item_type');
        $this->addSql('DROP TABLE wakfu_equipment_item_type_equipment_positions');
        $this->addSql('DROP TABLE wakfu_equipment_item_type_disabled_positions');
        $this->addSql('DROP TABLE wakfu_equipment_position');
    }
}
