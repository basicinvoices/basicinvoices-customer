<?php
namespace BasicInvoices\Customer\Hydrator;

use BasicInvoices\Customer\Model\CustomerInterface;

use BasicInvoices\Iso\Country\CountryManager;
use Zend\Hydrator\AbstractHydrator;

class CustomerHydrator extends AbstractHydrator
{
    /**
     * @var CountryManager
     */
    protected $countryManager;
    
    public function __construct(CountryManager $countryManager)
    {
        $this->countryManager = $countryManager;
    }
    
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof CustomerInterface) {
            throw new Exception\BadMethodCallException(sprintf(
                '%s expects the provided $object to be an instance of BasicInvoices\Customer\Model\CustomerInterface)',
                __METHOD__
            ));
        }
        
        // TODO: We should inject the country.
    }
}