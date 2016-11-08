<?php
namespace BasicInvoices\Customer;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'customers' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/contacts/customers[/:action]',
                    'defaults' => [
                        'controller' => Controller\CustomersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\CustomersController::class => InvokableFactory::class,
        ],
    ],
    //'service_manager' => [
    //    'factories' => [
    //        'TaxManager' => Service\TaxManagerServiceFactory::class,
    //    ],
    //],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
