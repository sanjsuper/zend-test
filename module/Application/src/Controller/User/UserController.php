<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 13:24
 */

namespace Application\Controller\User;


use Application\Form\UserForm;
use Application\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    /**
     * @var UserManager|null
     */
    protected $userManager = null;

    /**
     * @var EntityManager|null
     */
    protected $entityManager = null;

    public function __construct(UserManager $userManager, EntityManager $entityManager)
    {
        $this->userManager = $userManager;
        $this->entityManager = $entityManager;
    }

    public function registerAction()
    {
        $form = new UserForm('create', $this->entityManager);

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Add user.
                $user = $this->userManager->addUser($data);

                // Redirect to "view" page
                return $this->redirect()->toRoute('home',
                    ['action'=>'index']);
            }
        }

        return new ViewModel(['content' => ['form' => $form]]);
    }
}