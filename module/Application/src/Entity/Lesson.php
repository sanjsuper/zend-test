<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 23:06
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Lesson
 * @package Application\Entity
 * @ORM\Table(name="lessons")
 * @ORM\Entity(repositoryClass="Application\Repositories\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="title")
     */
    protected $title;


    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="lesson_num")
     */
    protected $lessonNum;

    /**
     * @ORM\Column(name="theme_id")
     */
    protected $themeId;

    /**
     * @ORM\Column(name="publisher_id")
     */
    protected $publisherId;

    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Question", fetch="EAGER")
     * @ORM\JoinTable(name="lesson_questions",
     *      joinColumns={@ORM\JoinColumn(name="lesson_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id")}
     *      )
     */
    protected $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @return mixed
     */
    public function getPublisherId()
    {
        return $this->publisherId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLessonNum()
    {
        return $this->lessonNum;
    }

    /**
     * @return mixed
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $themeId
     */
    public function setThemeId($themeId): void
    {
        $this->themeId = $themeId;
    }

    /**
     * @param mixed $publisherId
     */
    public function setPublisherId($publisherId): void
    {
        $this->publisherId = $publisherId;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $lessonNum
     */
    public function setLessonNum($lessonNum): void
    {
        $this->lessonNum = $lessonNum;
    }

    /**
     * @param $question
     */
    public function addQuestion($question):void
    {
        $this->questions[] = $question;
    }

    /**
     * @param $question
     */
    public function removeQuestionAssociation($question):void
    {
        $this->questions->removeElement($question);
    }

}