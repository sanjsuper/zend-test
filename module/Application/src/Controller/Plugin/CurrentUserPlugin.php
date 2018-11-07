<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 16:31
 */

namespace Application\Controller\Plugin;

use Application\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CurrentUserPlugin extends AbstractPlugin
{

    /**
     * Entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Authentication service.
     * @var AuthenticationService
     */
    private $authService;

    /**
     * Logged in user.
     * @var User|null
     */
    private $user = null;

    /**
     * Constructor.
     */
    public function __construct(EntityManager $entityManager, AuthenticationService $authService)
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    /**
     * This method is called when you invoke this plugin in your controller: $user = $this->currentUser();
     * @param bool $useCachedUser If true, the User entity is fetched only on the first call (and cached on subsequent calls).
     * @return User|null
     * @throws \Exception
     */
    public function __invoke($useCachedUser = true)
    {
        // If current user is already fetched, return it.
        if ($useCachedUser && $this->user !== null)
            return $this->user;

        // Check if user is logged in.
        if ($this->authService->hasIdentity()) {

            // Fetch User entity from database.
            $this->user = $this->entityManager->getRepository(User::class)
                ->findOneByLogin($this->authService->getIdentity());
            if ($this->user == null) {
                // Oops.. the identity presents in session, but there is no such user in database.
                // We throw an exception, because this is a possible security problem.
                throw new \Exception('Not found user with such email');
            }

            // Return found User.
            return $this->user;
        }

        return null;
    }
}