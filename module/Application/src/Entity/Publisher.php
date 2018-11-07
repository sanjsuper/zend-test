<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 18:38
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publisher
 * @package Application\Entity
 * @ORM\Table(name="publishers")
 * @ORM\Entity
 */
class Publisher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="short_name")
     */
    protected $shortName;


    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="question_in_card")
     */
    protected $questionInCard;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuestionInCard():int
    {
        return $this->questionInCard;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function setShortName(string $shortName):void
    {
        $this->shortName = $shortName;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function setQuestionInCard(int $questionInCard):void
    {
        $this->questionInCard = $questionInCard;
    }
}