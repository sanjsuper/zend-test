<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 13:24
 */

namespace Application\Controller\User\Factory;


use Application\Controller\User\UserController;
use Application\Service\UserManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userManager = $container->get(UserManager::class);
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new UserController($userManager, $entityManager);
    }
}