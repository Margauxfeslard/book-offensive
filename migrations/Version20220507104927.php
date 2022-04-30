<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507104927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id UUID NOT NULL, isbn VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, writer_firstname VARCHAR(255) DEFAULT NULL, writer_lastname VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, publisher VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, summary TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN book.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE borrow (id UUID NOT NULL, physical_book_id UUID DEFAULT NULL, borrower_id UUID DEFAULT NULL, provisional_end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, restitution_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_55DBA8B021A1BAC ON borrow (physical_book_id)');
        $this->addSql('CREATE INDEX IDX_55DBA8B011CE312B ON borrow (borrower_id)');
        $this->addSql('COMMENT ON COLUMN borrow.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN borrow.physical_book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN borrow.borrower_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN borrow.provisional_end_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN borrow.start_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN borrow.restitution_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE physical_book (id UUID NOT NULL, book_id UUID DEFAULT NULL, owner_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF7E4EFD16A2B381 ON physical_book (book_id)');
        $this->addSql('CREATE INDEX IDX_AF7E4EFD7E3C61F9 ON physical_book (owner_id)');
        $this->addSql('COMMENT ON COLUMN physical_book.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN physical_book.book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN physical_book.owner_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE review (id UUID NOT NULL, author_id UUID DEFAULT NULL, book_id UUID DEFAULT NULL, note INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, body VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C6F675F31B ON review (author_id)');
        $this->addSql('CREATE INDEX IDX_794381C616A2B381 ON review (book_id)');
        $this->addSql('COMMENT ON COLUMN review.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN review.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN review.book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B021A1BAC FOREIGN KEY (physical_book_id) REFERENCES physical_book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE borrow ADD CONSTRAINT FK_55DBA8B011CE312B FOREIGN KEY (borrower_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE physical_book ADD CONSTRAINT FK_AF7E4EFD16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE physical_book ADD CONSTRAINT FK_AF7E4EFD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE physical_book DROP CONSTRAINT FK_AF7E4EFD16A2B381');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C616A2B381');
        $this->addSql('ALTER TABLE borrow DROP CONSTRAINT FK_55DBA8B021A1BAC');
        $this->addSql('ALTER TABLE borrow DROP CONSTRAINT FK_55DBA8B011CE312B');
        $this->addSql('ALTER TABLE physical_book DROP CONSTRAINT FK_AF7E4EFD7E3C61F9');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6F675F31B');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE borrow');
        $this->addSql('DROP TABLE physical_book');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
