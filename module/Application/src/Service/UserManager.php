<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 13:08
 */

namespace Application\Service;

use Zend\Crypt\Password\Bcrypt;
use Application\Entity\User;
use Doctrine\ORM\EntityManager;

class UserManager
{
    /**
     * @var EntityManager|null
     */
    private $entityManager = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function addUser(array $data):User
    {
        if($this->checkUserExists($data['login'])) {
            throw new \Exception("User with login address " .
                $data['login'] . " already exists");
        }

        $user = new User();
        $user->setLogin($data['login']);

        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);


        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return $user;
    }

    /**
     * Checks whether an active user with given email address already exists in the database.
     * @param string $email
     * @return boolean
     */
    public function checkUserExists(string $login):bool
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByLogin($login);

        return $user !== null;
    }

    /**
     * Checks that the given password is correct.
     *
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function validatePassword(User $user, string $password)
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }

        return false;
    }
}