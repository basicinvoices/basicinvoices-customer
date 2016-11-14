<?php
namespace BasicInvoices\Customer\Hydrator;

use BasicInvoices\Customer\Model\CustomerInterface;

use BasicInvoices\Iso\Country\CountryManager;
use Zend\Hydrator\AbstractHydrator;
use BasicInvoices\Iso\Country\Model\Country;

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
    
    public function extract($object)
    {
        var_dump($object);
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
                '%s expects the provided $object to be an instance of BasicInvoices\Customer\CustomerInterface)',
                __METHOD__
            ));
        }
        
        if (isset($data['country'])) {
            if ($data['country'] instanceof Country) {
                $data['country'] = $data['country']->getAlpha3();
            }
            
            if (!empty($data['country'])) {
                $country = $this->countryManager->get($data['country']);
                $data['country'] = $country;
            }
        }
        
        // Call hidden exchangeArray method
        $object->exchangeArray($data);
        
        return $object;
    }
}