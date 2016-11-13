<?php
namespace BasicInvoices\Customer;

use Zend\Router\Http\Segment;

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
            Controller\CustomersController::class => Controller\Factory\CustomerControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            CustomerManager::class => Service\CustomerManagerFactory::class,
            Hydrator\CustomerHydrator::class => Service\CustomerHydratorFactory::class,
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],
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
