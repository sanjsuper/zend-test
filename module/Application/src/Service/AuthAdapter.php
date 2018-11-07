<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 13:08
 */

namespace Application\Service;


use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface
{
    /**
     * User login
     * @var string
     */
    private $login;

    /**
     * password
     * @var string
     */
    private $password;

    /**
     * Entity manager
     * @var EntityManager
     */
    private $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function authenticate()
    {
        // Check the database if there is a user with such email.
        $user = $this->entityManager->getRepository(User::class)
            ->findOneByLogin($this->login);

        // If there is no such user, return 'Identity Not Found' status.
        if ($user == null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']);
        }


        // Now we need to calculate hash based on user-entered password and compare
        // it with the password hash stored in database.
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($this->password, $passwordHash)) {
            // saved in session for later use.
            return new Result(
                Result::SUCCESS,
                $this->login,
                ['Authenticated successfully.']);
        }

        // If password check didn't pass return 'Invalid Credential' failure status.
        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials.']);
    }

    /**
     * Sets user login.
     * @param string $login
     */
    public function setLogin(string $login):void
    {
        $this->login = $login;
    }

    /**
     * Sets password.
     * @param string $password
     */
    public function setPassword(string $password):void
    {
        $this->password = $password;
    }
}