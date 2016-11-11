<?php
namespace BasicInvoices\Customer;

use BasicInvoices\Customer\Model\Customer;
use BasicInvoices\Customer\Model\CustomerNote;
use BasicInvoices\Iso\Country\Model\Country;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\TableIdentifier;
use BasicInvoices\Iso\Country\CountryManager;

class CustomerManager
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;
    
    /**
     * @var CountryManager
     */
    protected $countryManager;
    
    /**
     * @var string|array|TableIdentifier
     */
    protected $table = null;
    
    public function __construct(AdapterInterface $adapter, $table = 'customers')
    {
        // table
        if (!(is_string($table) || $table instanceof TableIdentifier || is_array($table))) {
            throw new Exception\InvalidArgumentException('Table name must be a string or an instance of Zend\Db\Sql\TableIdentifier');
        }
        $this->table = $table;
        
        // adapter
        $this->adapter = $adapter;
    }
    
    public function save(Customer $customer, CustomerNote $note = null)
    {
        $data = $customer->getArrayCopy();
        
        if ($data['country'] instanceof Country) {
            $data['country'] = $data['country']->getAlpha3();
        }
        
        
    }
}