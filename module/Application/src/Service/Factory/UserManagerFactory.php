<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 13:33
 */

namespace Application\Service\Factory;


use Application\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new UserManager($entityManager);
    }
}