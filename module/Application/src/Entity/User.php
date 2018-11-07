<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 0:59
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Application\Repositories\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="login")
     */
    protected $login;

    /**
     * @ORM\Column(name="password")
     */
    protected $password;

    /**
     * @ORM\Column(name="date_created")
     */
    protected $dateCreated;


    // get user id
    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getLogin():string
    {
        return $this->login;
    }

    public function setLogin(string $login):void
    {
        $this->login = $login;
    }

    public function getPassword() :string
    {
        return $this->password;
    }

    public function setPassword(string $password):void
    {
        $this->password = $password;
    }

    public function getDateCreated() :string
    {
        return $this->dateCreated;
    }

    public function setDateCreated(string $dateCreated):void
    {
        $this->dateCreated = $dateCreated;
    }

}