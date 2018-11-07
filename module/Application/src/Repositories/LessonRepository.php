<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 23:54
 */

namespace Application\Repositories;

use Application\Entity\Answer;
use Application\Entity\Question;
use Doctrine\ORM\EntityRepository;

class LessonRepository extends EntityRepository
{

    /**
     * @param int $lessonId
     * @return array
     * @throws \Exception
     */
    public function getQuestionsByLessonId(int $lessonId):array
    {
        $lesson = $this->findOneById($lessonId);

        if (!$lesson) {
            throw new \Exception('Lesson ' . $lessonId . ' not found');
        }

        /**
         * @var Question []$questions
         */
        $questions = $lesson->getQuestions();

        $returnArr = [];

        foreach ($questions as $question) {
            $data = [];
            $data['id'] = $question->getId();
            $data['title'] = $question->getTitle();
            $data['helpWrap'] = $question->getHelpWrap();

            /**
             * @var Answer []$answers
             */
            $answers = $question->getAnswers();

            $i = 0;
            foreach ($answers as $answer) {
                $data['answers'][$i]['id'] = $answer->getId();
                $data['answers'][$i]['title'] = $answer->getTitle();
                $data['answers'][$i]['answerNum'] = $answer->getAnswerNum();
                ++$i;
            }
            array_push($returnArr, $data);
        }

        return $returnArr;
    }

    /**
     * @param int $lessonId
     * @return int
     * @throws \Exception
     */
    public function getCountQuestionsByLessonId(int $lessonId)
    {
        $lesson = $this->findOneById($lessonId);

        if (!$lesson) {
            throw new \Exception('Lesson ' . $lessonId . ' not found');
        }

        return count($lesson->getQuestions());
    }
}