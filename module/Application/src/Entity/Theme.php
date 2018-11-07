<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 18:24
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Theme
 * @package Application\Entity
 * @ORM\Table(name="themes")
 * @ORM\Entity()
 */
class Theme
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
     * @ORM\Column(name="theme_num")
     */
    protected $themeNum;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getThemeNum():int
    {
        return (int) $this->themeNum;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    public function setThemeNum(int $themeNum):void
    {
        $this->themeNum = $themeNum;
    }

}