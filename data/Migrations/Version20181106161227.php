<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106161227 extends AbstractMigration
{
    public function getDescription()
    {
        $description = 'This migration adds indexes and foreign key constraints.';
        return $description;
    }


    public function up(Schema $schema) : void
    {
        $table_questions = $schema->getTable('questions');
        $table_questions->addIndex(['ticket_num'], 'ticket_num_index');
        $table_questions->addForeignKeyConstraint('themes', ['theme_id'], ['id'], [], 'questions_themes_id_fk');
        $table_questions->addForeignKeyConstraint('publishers', ['publisher_id'], ['id'], [], 'questions_publishers_id_fk');

        $table_answers = $schema->getTable('answers');
        $table_answers->addForeignKeyConstraint('questions', ['question_id'], ['id'], [], 'answers_questions_id_fk');
    }

    public function down(Schema $schema) : void
    {
        $table_questions = $schema->getTable('questions');
        $table_questions->removeForeignKey('questions_themes_id_fk');
        $table_questions->removeForeignKey('questions_publishers_id_fk');
        $table_questions->dropIndex('ticket_num_index');

        $table_answers = $schema->getTable('answers');
        $table_answers->removeForeignKey('answers_questions_id_fk');
    }
}
