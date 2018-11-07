<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Controller\Plugin\CurrentUserPlugin;
use Application\Entity\Answer;
use Application\Entity\Lesson;
use Application\Entity\User;
use Application\Repositories\LessonRepository;
use Application\Service\Ticket\TicketManager;
use Doctrine\ORM\EntityManager;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var EntityManager|null
     */
    protected $entityManager = null;

    /**
     * @var TicketManager|null
     */
    protected $ticketManager = null;

    public function __construct(EntityManager $entityManager, TicketManager $ticketManager)
    {
        $this->entityManager = $entityManager;
        $this->ticketManager = $ticketManager;
    }


    public function indexAction()
    {
//        $current_user = $this->plugin(CurrentUserPlugin::class);
//        Debug::dump($this->ticketManager->getAllTickets());
        /**
         * @var LessonRepository $users
         */
        $users = $this->entityManager->getRepository(Lesson::class);
        Debug::dump($users->getQuestionsByLessonId(1));

//        $users[0]->setLogin('alex_kruze');
//        $this->entityManager->persist($users[0]);
//        $this->entityManager->flush();
//        Debug::dump($users);
        return new ViewModel();
    }
}
