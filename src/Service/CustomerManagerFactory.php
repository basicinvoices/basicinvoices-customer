<?php
namespace BasicInvoices\Customer\Service;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use BasicInvoices\Customer\CustomerManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\AdapterInterface;

class CustomerManagerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return CustomerManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(AdapterInterface::class);
        return new CustomerManager($adapter);
    }
    
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, CustomerManager::class);
    }
    
}