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
        
        $object->id         = isset($data['id'])         ? (int) $data['id']   : 0;
        $object->name       = isset($data['name'])       ? $data['name']       : null;
        $object->company    = isset($data['company'])    ? $data['company']    : null;
        $object->vat_number = isset($data['vat_number']) ? $data['vat_number'] : null;
        $object->phone      = isset($data['phone'])      ? $data['phone']      : null;
        $object->mobile     = isset($data['mobile'])     ? $data['mobile']     : null;
        $object->email      = $data['email'];
        
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