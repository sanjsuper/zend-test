<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106205829 extends AbstractMigration
{
    public function getDescription()
    {
        $description = 'This migration create lessons and lesson_questions table.';
        return $description;
    }

    public function up(Schema $schema) : void
    {
        $table_lesson = $schema->createTable('lessons');

        $table_lesson->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_lesson->addColumn('title', 'string', ['notnull' => true]);
        $table_lesson->addColumn('description', 'text', ['notnull' => true]);
        $table_lesson->addColumn('lesson_num', 'integer', ['notnull' => true]);
        $table_lesson->addColumn('theme_id', 'integer', ['notnull' => false]);
        $table_lesson->addColumn('publisher_id', 'integer', ['notnull' => true]);
        $table_lesson->setPrimaryKey(['id']);
        $table_lesson->addOption('engine' , 'InnoDB');

        $table_lesson_questions = $schema->createTable('lesson_questions');
        $table_lesson_questions->addColumn('id', 'integer', ['autoincrement' => true]);
        $table_lesson_questions->addColumn('lesson_id', 'integer', ['notnull' => true]);
        $table_lesson_questions->addColumn('question_id', 'integer', ['notnull' => true]);
        $table_lesson_questions->setPrimaryKey(['id']);
        $table_lesson_questions->addOption('engine' , 'InnoDB');

    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('lessons');
        $schema->dropTable('lesson_questions');
    }
}
