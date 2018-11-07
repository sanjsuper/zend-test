<?php
namespace Application\Controller\Factory;

use Application\Controller\IndexController;
use Application\Service\Ticket\TicketManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,$requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $ticketManager = $container->get(TicketManager::class);
        return new IndexController(
            $entityManager,
            $ticketManager
        );
    }
}