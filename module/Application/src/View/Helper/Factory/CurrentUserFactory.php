<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 16:21
 */

namespace Application\View\Helper\Factory;


use Application\View\Helper\CurrentUser;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CurrentUserFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new CurrentUser($entityManager, $authService);
    }
}