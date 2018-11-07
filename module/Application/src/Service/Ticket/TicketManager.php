<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 21:14
 */

namespace Application\Service\Ticket;


use Application\Entity\Publisher;
use Application\Entity\Question;
use Doctrine\ORM\EntityManager;
use Zend\Debug\Debug;

class TicketManager
{
    /**
     * @var EntityManager|null
     */
    private $entityManager = null;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllTickets()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $query = $queryBuilder->select(['q.ticketNum', 'q.publisherId', 'p.shortName'])
                                ->from(Question::class, 'q')
                                ->join(Publisher::class, 'p')
                                ->groupBy('q.ticketNum', 'q.publisherId', 'p.shortName')
                                ->getDQL();
        $res = $this->entityManager->createQuery($query)->getArrayResult();
        Debug::dump($res);
//        return $queryBuilder->select(['q.ticket_num'])
//                            ->from('questions', 'q')->getFirstResult();
    }
}