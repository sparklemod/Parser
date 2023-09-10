<?php

declare(strict_types=1);

namespace App\Services\DataBase\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909133637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Categories_Cards (category_id INT NOT NULL, card_id INT NOT NULL, INDEX IDX_D63F19C912469DE2 (category_id), INDEX IDX_D63F19C94ACC9A20 (card_id), PRIMARY KEY(category_id, card_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Categories_Cards ADD CONSTRAINT FK_D63F19C912469DE2 FOREIGN KEY (category_id) REFERENCES Categories (id)');
        $this->addSql('ALTER TABLE Categories_Cards ADD CONSTRAINT FK_D63F19C94ACC9A20 FOREIGN KEY (card_id) REFERENCES Cards (id)');
        $this->addSql('ALTER TABLE Cards CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE Categories ADD links VARCHAR(255) NOT NULL, DROP link, CHANGE name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Categories_Cards DROP FOREIGN KEY FK_D63F19C912469DE2');
        $this->addSql('ALTER TABLE Categories_Cards DROP FOREIGN KEY FK_D63F19C94ACC9A20');
        $this->addSql('DROP TABLE Categories_Cards');
        $this->addSql('ALTER TABLE Cards CHANGE name name VARCHAR(100) NOT NULL, CHANGE description description VARCHAR(250) NOT NULL');
        $this->addSql('ALTER TABLE Categories ADD link VARCHAR(250) NOT NULL, DROP links, CHANGE name name VARCHAR(50) NOT NULL');
    }
}
