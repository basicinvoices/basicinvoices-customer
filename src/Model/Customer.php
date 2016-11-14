<?php
namespace BasicInvoices\Customer\Model;

use BasicInvoices\Customer\Exception;
use BasicInvoices\Iso\Country\Model\Country;

class Customer implements CustomerInterface
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
    
    public function __call($name,  $arguments)
    {
        $argNum = count($arguments);
        
        if (strcmp('exchangeArray', $name) === 0) {
            if ($argNum === 1) {
                return $this->exchangeArray($arguments[0]);
            } elseif ($argNum < 1) {
                trigger_error(sprintf('Missing argument 1 for %s::%s()', __CLASS__, $name), E_USER_ERROR);
            } else {
                trigger_error(sprintf('Too many arguments for %s::%s()', __CLASS__, $name), E_USER_ERROR);
            }
        }
        
        trigger_error(sprintf('Call to undefined method %s::%s()', __CLASS__, $name), E_USER_ERROR);  
    }
    
    /**
     * Read properties.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $name)));
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
    
        trigger_error(sprintf('Cannot access protected property %s::$%s', __CLASS__, $name), E_USER_ERROR);
    }
    
    public function __set($name, $value) 
    {
        $setter = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $name)));
        if (method_exists($this, $setter)) {
            return $this->$setter($value);
        }
        
        trigger_error(sprintf('Cannot access protected property %s::$%s', __CLASS__, $name), E_USER_ERROR);
    }
    
    protected function exchangeArray($input)
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
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getCompany()
    {
        return $this->company;
    }
    
    public function getVatType()
    {
        return $this->vatType;
    }
    
    public function getVatNumber()
    {
        return $this->vatNumber;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
    
    public function getMobile()
    {
        return $this->mobile;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    protected function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }
    
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new Exception\InvalidArgumentException('The customer name must be a non-empty string');
        }
        
        $name = trim($name);
        if (empty($name)) {
            throw new Exception\InvalidArgumentException('The customer name can not be empty');
        }
        
        $this->name = $name;
        return $this;
    }
    
    public function setCompany($company)
    {
        if (!is_null($company)) {
            if (!is_string($company)) {
                throw new Exception\InvalidArgumentException('The customer company name must be a string or null');
            }
            
            $company = trim($company);
            if (empty($company)) {
                $company = null;
            }
        }
        
        $this->company = $company;
        return $this;
    }
    
    public function setPhone($phone)
    {
        if (!is_null($phone)) {
            if (!is_string($phone)) {
                throw new Exception\InvalidArgumentException('The customer phne must be a string or null');
            }
        
            $phone = trim($phone);
            if (empty($phone)) {
                $phone = null;
            }
        }
        
        $this->phone = $phone;
        return $this;
    }
    
    public function setMobile($phone)
    {
        if (!is_null($phone)) {
            if (!is_string($phone)) {
                throw new Exception\InvalidArgumentException('The customer mobile must be a string or null');
            }
        
            $phone = trim($phone);
            if (empty($phone)) {
                $phone = null;
            }
        }
    
        $this->mobile = $phone;
        return $this;
    }
    
    public function setEmail($email)
    {
        if (!is_null($email)) {
            if (!empty(trim($email))) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception\InvalidArgumentException('The customer email must be a valid email address');
                }
            } else {
                $email = null;
            }
        }
        
        $this->email = $email;
        return $this;
    }
    
    public function setVatNumber($vatNumber)
    {
        if (!is_null($vatNumber)) {
            if (empty(trim($vatNumber))) {
                $vatNumber = null;
            }
        }
        
        $this->vatNumber = $vatNumber;
        return $this;
    }
    
    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }
}