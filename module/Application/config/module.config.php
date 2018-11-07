<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\IndexController;
use Application\Controller\User\AuthController;
use Application\Controller\User\UserController;
use Application\Service\AuthManager;
use Application\Service\Factory\AuthenticationServiceFactory;
use Application\Service\Factory\AuthManagerFactory;
use Application\Service\Ticket\Factory\TicketManagerFactory;
use Application\Service\Ticket\TicketManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Authentication\AuthenticationService;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'register' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/register',
                    'defaults' => [
                        'controller' => Controller\User\UserController::class,
                        'action' => 'register'
                    ]
                ]
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\User\AuthController::class,
                        'action' => 'login'
                    ]
                ]
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\User\AuthController::class,
                        'action' => 'logout'
                    ]
                ]
            ]
//            'application' => [
//                'type'    => Segment::class,
//                'options' => [
//                    'route'    => '/application[/:action]',
//                    'defaults' => [
//                        'controller' => Controller\IndexController::class,
//                        'action'     => 'index',
//                    ],
//                ],
//            ],
        ],
    ],
    'controllers' => [
        'factories' => [
//            Controller\IndexController::class => InvokableFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\User\UserController::class => Controller\User\Factory\UserControllerFactory::class,
            Controller\User\AuthController::class => Controller\User\Factory\AuthControllerFactory::class
        ],
    ],
    // We register module-provided controller plugins under this key.
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\CurrentUserPlugin::class => Controller\Plugin\Factory\CurrentUserPluginFactory::class,
        ],
        'aliases' => [
            'currentUser' => Controller\Plugin\CurrentUserPlugin::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            AuthManager::class => AuthManagerFactory::class,
            Service\UserManager::class => Service\Factory\UserManagerFactory::class,
            TicketManager::class => TicketManagerFactory::class
        ]
    ],
    // The 'access_filter' key is used by the User module to restrict or permit
    // access to certain controller actions for unauthorized visitors.
    'access_filter' => [
        'controllers' => [
            IndexController::class => [
                ['actions' => ['index'], 'allow' => '*']
            ],
            UserController::class => [
                ['actions' => ['register'], 'allow' => '*']
            ],
            AuthController::class => [
                ['actions' => ['login'], 'allow' => '*'],
                ['actions' => ['logout'], 'allow' => '@'],
            ],

//            Controller\User\UserController::class => [
//                // Give access to "resetPassword", "message" and "setPassword" actions
//                // to anyone.
//                ['actions' => ['resetPassword', 'message', 'setPassword'], 'allow' => '*'],
//                // Give access to "index", "add", "edit", "view", "changePassword" actions to authorized users only.
//                ['actions' => ['index', 'add', 'edit', 'view', 'changePassword'], 'allow' => '@']
//            ],
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    // We register module-provided view helpers under this key.
    'view_helpers' => [
        'factories' => [
            View\Helper\CurrentUser::class => View\Helper\Factory\CurrentUserFactory::class,
        ],
        'aliases' => [
            'currentUser' => View\Helper\CurrentUser::class,
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
