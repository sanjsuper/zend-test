<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 18:43
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Answer
 * @package Application\Entity
 * @ORM\Table(name="answers")
 * @ORM\Entity
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\Column(name="answer_num")
     * @var int $answerNum
     */
    protected $answerNum;

    /**
     * @var int $isRight
     * ORM\Column(name="is_right")
     */
    protected $isRight;

    /**
     * @var string $title
     * @ORM\Column(type="text", name="title", nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="\Application\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getAnswerNum(): int
    {
        return $this->answerNum;
    }

    /**
     * @return int
     */
    public function getIsRight(): int
    {
        return $this->isRight;
    }


    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $answerNum
     */
    public function setAnswerNum(int $answerNum): void
    {
        $this->answerNum = $answerNum;
    }

    /**
     * @param int $isRight
     */
    public function setIsRight(int $isRight): void
    {
        $this->isRight = $isRight;
    }


    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        $question->addAnswer($this);
    }

}