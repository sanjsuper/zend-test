<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 18:43
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 * @package Application\Entity
 * @ORM\Table(name="questions")
 * @ORM\Entity
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="has_image")
     */
    protected $hasImage;

    /**
     * @ORM\Column(name="answer_as_image")
     */
    protected $answerAsImage;

    /**
     * @ORM\Column(name="ticket_num")
     */
    protected $ticketNum;

    /**
     * @ORM\Column(name="theme_id")
     */
    protected $themeId;

    /**
     * @ORM\Column(name="publisher_id")
     */
    protected $publisherId;

    /**
     * @ORM\Column(name="title")
     */
    private $title;

    /**
     * @ORM\Column(name="help_wrap")
     */
    protected $helpWrap;

    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Lesson", mappedBy="lessons")
     */
    private $lessons;

    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Answer", mappedBy="question")
     * @ORM\JoinColumn(name="id", referencedColumnName="question_id")
     */
    private $answers;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return int
     */
    public function getAnswerAsImage():int
    {
        return $this->answerAsImage;
    }

    /**
     * @return int
     */
    public function getHasImage():int
    {
        return $this->hasImage;
    }

    /**
     * @return string
     */
    public function getHelpWrap():string
    {
        return $this->helpWrap;
    }

    /**
     * @return int
     */
    public function getPublisherId():int
    {
        return $this->publisherId;
    }

    /**
     * @return int
     */
    public function getThemeId():int
    {
        return $this->themeId;
    }

    /**
     * @return int
     */
    public function getTicketNum():int
    {
        return $this->ticketNum;
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param int $answerAsImage
     */
    public function setAnswerAsImage(int $answerAsImage): void
    {
        $this->answerAsImage = $answerAsImage;
    }

    /**
     * @param int $hasImage
     */
    public function setHasImage(int $hasImage): void
    {
        $this->hasImage = $hasImage;
    }

    /**
     * @param string $helpWrap
     */
    public function setHelpWrap(string $helpWrap): void
    {
        $this->helpWrap = $helpWrap;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $publisherId
     */
    public function setPublisherId(int $publisherId): void
    {
        $this->publisherId = $publisherId;
    }

    /**
     * @param int $themeId
     */
    public function setThemeId(int $themeId): void
    {
        $this->themeId = $themeId;
    }

    /**
     * @param int $ticketNum
     */
    public function setTicketNum(int $ticketNum): void
    {
        $this->ticketNum = $ticketNum;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param $answer
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;
    }

}