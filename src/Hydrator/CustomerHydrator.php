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
        $object->name = $data['name'];
        
        if (isset($data['country'])) {
            if ($data['country'] instanceof Country) {
                $data['country'] = $data['country']->getAlpha3();
            }
            
            if (!empty($data['country'])) {
                $object->setCountry($this->countryManager->get($data['country']));
            }
        }
        
        
        
        return $object;
    }
}