<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 23:06
 */

namespace Application\Service\Lesson;


use Application\Entity\Lesson;
use Application\Repositories\LessonRepository;
use Doctrine\ORM\EntityManager;

class LessonManager
{
    /**
     * @var EntityManager|null
     */
    protected $entityManager = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function allLessons()
    {
        /**
         * @var LessonRepository
         */
        $repository = $this->entityManager->getRepository(Lesson::class);

        /**
         * @var Lesson []$lessons
         */
        $lessons = $repository->findAll();

        $returnArr = [];
        for ($i = 0; $i <= count($lessons); $i++) {
            $data[$i] = [];
            $data[$i]['id'] = $lessons[$i]->getId();
            $data[$i]['title'] = $lessons[$i]->getTitle();
            $data[$i]['description'] = $lessons[$i]->getDescription();
            $data[$i]['lessonNum'] = $lessons[$i]->getLessonNum();
            try {
                $data[$i]['questionCount'] = $lessons[$i]->getCountQuestionsByLessonId($data[$i]['id']);
            } catch (\Exception $e) {
                return false;
            }
        }

    }
}