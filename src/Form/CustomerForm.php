<?php
namespace BasicInvoices\Customer\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class CustomerForm extends Form
{
    public function __construct($name = null, $options = null)
    {
        parent::__construct($name);
        
        $this->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        
        $this->add([
            'name' => 'company',
            'type' => 'Text',
            'options' => [
                'label' => 'Company',
            ],
        ]);
        
        // TODO: VAT ID: TYPE
        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'vat_type',
            'options' => [
                'label' => 'VAT ID Type',
                'value_options' => [
                    '1' => 'NIF',
                    '2' => 'NIF/IVA (NIF Operador intracomunitario)',
                    '3' => 'Pasaporte',
                    '4' => 'Documento oficial de identificación expedido por el país o territorio de residencia',
                    '5' => 'Certificado de residencia fiscal',
                    '6' => 'Otro documento probatorio'
                ],
            ],
        ]);
        
        $this->add([
            'name' => 'vat_number',
            'type' => 'Text',
            'options' => [
                'label' => 'VAT ID Number',
            ],
        ]);
        
        $this->add([
            'name' => 'phone',
            'type' => 'Zend\Form\Element\Tel',
            'options' => [
                'label' => 'Phone',
            ],
        ]);
        
        $this->add([
            'name' => 'mobile',
            'type' => 'Zend\Form\Element\Tel',
            'options' => [
                'label' => 'Mobile',
            ],
        ]);
        
        $this->add([
            'name' => 'email',
            'type' => 'Email',
            'options' => [
                'label' => 'E-Mail Address',
            ],
        ]);
        
        
        //
        // Address
        //
        $this->add([
            'name' => 'country',
            'type' => 'BasicInvoices\Iso\Form\Element\CountrySelect',
            'options' => [
                'label' => 'Country',
            ],
        ]);
        
        //
        // Notes
        //
        
        $this->add([
            'type' => 'Zend\Form\Element\TextArea',
            'name' => 'notes',
            'options' => [
                'label' => 'Notes',
            ],
            'attributes' => [
                'rows' => 10,
            ],
        ]);
        
        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ]);
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save'
            )
        ));
    }
}