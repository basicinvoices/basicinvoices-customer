<?php
namespace BasicInvoices\Customer\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use BasicInvoices\Customer\Hydrator\CustomerHydrator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BasicInvoices\Iso\Country\CountryManager;

class CustomerHydratorFactory implements FactoryInterface
{
    /**
     * Creates DelegatingHydrator (v2)
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return DelegatingHydrator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, '');
    }
    
    /**
     * Creates CustomergHydrator (v3)
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CustomerHydrator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $countryManager = $container->get(CountryManager::class);
        return new CustomerHydrator($countryManager);
    }
   
}