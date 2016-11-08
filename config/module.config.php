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
        'template_map' => [
            'customer/partial/details'           => __DIR__ . '/../view/partial/customer-details.phtml',
            'customer/partial/address'           => __DIR__ . '/../view/partial/customer-address.phtml',
            'customer/partial/notes'           => __DIR__ . '/../view/partial/customer-notes.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
