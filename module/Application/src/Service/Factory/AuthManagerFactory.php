<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 15:25
 */

namespace Application\Service\Factory;


use Application\Service\AuthManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;

class AuthManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Instantiate dependencies.
        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $sessionManager = $container->get(SessionManager::class);

        // Get contents of 'access_filter' config key (the AuthManager service
        // will use this data to determine whether to allow currently logged in user
        // to execute the controller action or not.
        $config = $container->get('Config');
        if (isset($config['access_filter']))
            $config = $config['access_filter'];
        else
            $config = [];

        // Instantiate the AuthManager service and inject dependencies to its constructor.
        return new AuthManager($authenticationService, $sessionManager, $config);
    }
}