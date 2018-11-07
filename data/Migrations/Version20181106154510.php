<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106154510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create few tables for work with tickets';
    }


    public function up(Schema $schema): void
    {
//        publishers table
        $table_publishers = $schema->createTable('publishers');
        $table_publishers->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_publishers->addColumn('short_name', 'string', ['notnull' => true]);
        $table_publishers->addColumn('name', 'string', ['notnull' => true]);
        $table_publishers->addColumn('question_in_card', 'integer', ['default' => 20]);
        $table_publishers->setPrimaryKey(['id']);
        $table_publishers->addOption('engine' , 'InnoDB');


//        themes table
        $table_themes = $schema->createTable('themes');
        $table_themes->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_themes->addColumn('title', 'string', ['notnull' => true]);
        $table_themes->addColumn('theme_num', 'integer', ['notnull' => true]);
        $table_themes->setPrimaryKey(['id']);
        $table_themes->addOption('engine' , 'InnoDB');

//        questions table
        $table_questions = $schema->createTable('questions');
        $table_questions->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_questions->addColumn('has_image', 'integer', ['notnull' => true]);
        $table_questions->addColumn('answer_as_image', 'integer', ['notnull' => true]);
        $table_questions->addColumn('ticket_num', 'integer', ['notnull' => true]);
        $table_questions->addColumn('theme_id', 'integer', ['notnull' => true]);
        $table_questions->addColumn('publisher_id', 'integer', ['notnull' => true]);
        $table_questions->addColumn('title', 'text', ['notnull' => true]);
        $table_questions->addColumn('help_wrap', 'text', ['notnull' => true]);

        $table_questions->setPrimaryKey(['id']);
        $table_questions->addOption('engine' , 'InnoDB');

//        answers table
        $table_answers = $schema->createTable('answers');
        $table_answers->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_answers->addColumn('answer_num', 'integer', ['notnull' => true]);
        $table_answers->addColumn('question_id', 'integer', ['notnull' => true]);
        $table_answers->addColumn('is_right', 'integer', ['notnull' => true]);
        $table_answers->addColumn('title', 'text', ['notnull' => false]);

        $table_answers->setPrimaryKey(['id']);
        $table_answers->addOption('engine' , 'InnoDB');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('answers');
        $schema->dropTable('questions');
        $schema->dropTable('themes');
        $schema->dropTable('publishers');

    }
}
