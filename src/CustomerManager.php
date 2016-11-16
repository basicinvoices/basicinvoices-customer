<?php
namespace BasicInvoices\Customer;

use BasicInvoices\Customer\Model\Customer;
use BasicInvoices\Customer\Model\CustomerNote;
use BasicInvoices\Iso\Country\Model\Country;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\TableIdentifier;
use BasicInvoices\Iso\Country\CountryManager;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
use BasicInvoices\Customer\Hydrator\CustomerHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

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
    
    protected $hydrator;
    
    /**
     * @var string|array|TableIdentifier
     */
    protected $table = null;
    
    public function __construct(AdapterInterface $adapter, $table = 'customers', $hydrator)
    {
        // table
        if (!(is_string($table) || $table instanceof TableIdentifier || is_array($table))) {
            throw new Exception\InvalidArgumentException('Table name must be a string or an instance of Zend\Db\Sql\TableIdentifier');
        }
        $this->table = $table;
        
        // adapter
        $this->adapter = $adapter;
        
        $this->hydrator = $hydrator;
    }
    
    public function executeInsert(Insert $insert)
    {
        
    }
    
    public function executeUpdate(Update $insert)
    {
    
    }
    
    public function executeSelect(Select $select)
    {
        $sql = new Sql($this->adapter);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
        
        $resultSet = new HydratingResultSet();
        $resultSet->setObjectPrototype(new Customer());
        $resultSet->setHydrator($this->hydrator);
        $resultSet->initialize($result);
        
        return $resultSet;
    }
    
    public function getAll($paginated = false)
    {
        $sql    = new Sql($this->adapter);
        $select = $sql->select($this->table);
        
        if ($paginated) {
            // create a new result set based on the Album entity
            $resultSetPrototype = new HydratingResultSet();
            $resultSetPrototype->setObjectPrototype(new Customer());
            $resultSetPrototype->setHydrator($this->hydrator);
            
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
                // our configured select object
                $select,
                // the adapter to run it against
                $this->adapter,
                // the result set to hydrate
                $resultSetPrototype
            );
            
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        
        return $this->executeSelect($select);
    }
    
    public function save(Customer $customer, CustomerNote $note = null)
    {
        $data = $customer->getArrayCopy();
        
        if ($data['country'] instanceof Country) {
            $data['country'] = $data['country']->getAlpha3();
        }
        
        $sql    = new Sql($this->adapter);
        $select = $sql->select($this->table);
        
        return $this->executeSelect($select);
        
    }
}