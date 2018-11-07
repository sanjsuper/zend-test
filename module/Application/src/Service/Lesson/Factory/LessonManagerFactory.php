<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 07.11.18
 * Time: 13:44
 */

namespace Application\Service\Lesson\Factory;


use Application\Service\Lesson\LessonManager;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LessonManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var EntityManager
         */
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new LessonManager($entityManager);
    }
}