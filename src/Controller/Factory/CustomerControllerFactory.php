<?php
namespace BasicInvoices\Customer\Controller\Factory;

use BasicInvoices\Customer\Controller\CustomersController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use BasicInvoices\Customer\CustomerManager;

class CustomerControllerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return CustomersController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $customerManager = $container->get(CustomerManager::class);
        return new CustomersController($customerManager);
    }
}