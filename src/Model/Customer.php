<?php
namespace BasicInvoices\Customer\Model;

class Customer
{
    protected $id = 0;
    
    protected $name;
    
    protected $company;
    
    protected $vatType;
    
    protected $vatNumber;
    
    protected $phone;
    
    protected $mobile;
    
    protected $email;
    
    
    //
    // Address
    //
    protected $street1;
    protected $street2;
    protected $city;
    protected $state;
    protected $postalCode;
    protected $country;
    
    //
    // Notes
    //
    
    /**
     * Read properties.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
       switch ($name)
       {
           case 'id':
               return $this->id;
               break;
           case 'name':
               return $this->name;
               break;
           case 'company':
               return $this->company;
               break;
           case 'vatType':
           case 'vat_type':
               return $this->vatType;
               break;
           case 'vatNumber':
           case 'vat_number':
               return $this->vatNumber;
               break;
           case 'phone':
               return $this->phone;
               break;
           case 'mobile':
               return $this->mobile;
               break;
           case 'email':
               return $this->email;
               break;
       }
    }
    
    public function exchangeArray($input)
    {
        if ($input instanceof \ArrayObject) {
            $input = $input->getArrayCopy();
        }
        
        $this->name       = isset($input['name'])        ? $input['name']        : null;
        $this->company    = isset($input['company'])     ? $input['company']     : null;
        $this->vatType    = isset($input['vat_type'])    ? $input['vat_type']    : null;
        $this->vatNumber  = isset($input['vat_number'])  ? $input['vat_number']  : null;
        $this->phone      = isset($input['phone'])       ? $input['phone']       : null;
        $this->mobile     = isset($input['mobile'])      ? $input['mobile']      : null;
        $this->email      = isset($input['email'])       ? $input['email']       : null;
        
        // Address
        $this->street1    = isset($input['street_1'])    ? $input['street_1']    : null;
        $this->street2    = isset($input['street_2'])    ? $input['street_2']    : null;
        $this->city       = isset($input['city'])        ? $input['city']        : null;
        $this->state      = isset($input['state'])       ? $input['state']       : null;
        $this->postalCode = isset($input['postal_code']) ? $input['postal_code'] : null;
        $this->country    = isset($input['country'])     ? $input['country']     : null;
    }
    
    public function getArrayCopy()
    {
        return [
            'name'        => $this->name,
            'company'     => $this->company,
            'vat_type'    => $this->vatType,
            'vat_number'  => $this->vatNumber,
            'phone'       => $this->phone,
            'mobile'      => $this->mobile,
            'email'       => $this->email,
            // Address
            'street_1'    => $this->street1,
            'street_2'    => $this->street2,
            'city'        => $this->city,
            'state'       => $this->state,
            'postal_code' => $this->postalCode,
            'country'     => $this->country,
        ];
    }
    
    public function getId()
    {
        return $this->id;
    }
}