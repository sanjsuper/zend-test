<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.11.18
 * Time: 15:32
 */

namespace Application\Controller\User;


use Application\Form\LoginForm;
use Application\Service\AuthManager;
use Application\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Result;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Uri\Uri;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var EntityManager
     */
    private $entityManager;
    /**
     * Auth manager.
     * @var AuthManager
     */
    private $authManager;
    /**
     * User manager.
     * @var UserManager
     */
    private $userManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $authManager, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
        $this->userManager = $userManager;
    }


    /**
     * @return ViewModel|Response
     * @throws \Exception
     */
    public function loginAction()
    {
        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');

        if (strlen($redirectUrl) > 2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        // Create login form
        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);
        // Store login status.
        $isLoginError = false;

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);

            // Validate form
            if ($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                // Perform login attempt.
                $result = $this->authManager->login($data['login'],
                    $data['password'], $data['remember_me']);

                // Check result.
                if ($result->getCode() == Result::SUCCESS) {
                    // Get redirect URL.
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');
                    if (!empty($redirectUrl)) {
                        // The below check is to prevent possible redirect attack
                        // (if someone tries to redirect user to another domain).
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost() != null)
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                    }
                    // If redirect URL is provided, redirect the user to that URL;
                    // otherwise redirect to Home page.
                    if (empty($redirectUrl)) {
                        return $this->redirect()->toRoute('home');
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }
                } else {
                    $isLoginError = true;
                }

            } else {
                $isLoginError = true;
            }
        }
        return new ViewModel(
            [ 'content' =>
                [
                    'form' => $form,
                    'isLoginError' => $isLoginError,
                    'redirectUrl' => $redirectUrl
                ]
            ]
        );
    }

    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction()
    {
        try {
            $this->authManager->logout();
            return $this->redirect()->toRoute('login');
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('login');
        }
    }
}