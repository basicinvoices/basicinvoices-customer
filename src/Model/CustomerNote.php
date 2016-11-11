<?php
namespace BasicInvoices\Customer\Model;

class CustomerNote
{
    protected $customerId = 0;

    protected $note;

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
            case 'customer_id':
            case 'customerId':
                return $this->customerId;
                break;
            case 'note':
                return $this->note;
                break;
        }
    }
    
    public function __set($name, $value)
    {
        switch ($name)
        {
            case 'customer_id':
            case 'customerId':
                // TODO: Check for a valid int
                $this->customerId = $value;
                break;
            case 'note':
                $this->note = $value;
                break;
        }
    }

    public function exchangeArray($input)
    {
        if ($input instanceof \ArrayObject) {
            $input = $input->getArrayCopy();
        }

        $this->note       = isset($input['customer_id']) ? $input['customer_id'] : null;
        $this->note       = isset($input['note'])        ? $input['note']        : null;
    }

    public function getArrayCopy()
    {
        return [
            'customer_id' => $this->customerId,
            'note'        => $this->note,
        ];
    }
}