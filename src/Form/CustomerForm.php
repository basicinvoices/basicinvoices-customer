<?php
namespace BasicInvoices\Customer\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilterProviderInterface;

class CustomerForm extends Form implements InputFilterProviderInterface
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
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ],
        ]);
        
        $this->add([
            'name' => 'company',
            'type' => 'Text',
            'options' => [
                'label' => 'Company',
            ],
            'attributes' => [
                'autocomplete' => 'off',
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
            'attributes' => [
                'autocomplete' => 'off',
            ],
        ]);
        
        $this->add([
            'name' => 'phone',
            'type' => 'Zend\Form\Element\Tel',
            'options' => [
                'label' => 'Phone',
            ],
            'attributes' => [
                'autocomplete' => 'off',
            ],
        ]);
        
        $this->add([
            'name' => 'mobile',
            'type' => 'Zend\Form\Element\Tel',
            'options' => [
                'label' => 'Mobile',
            ],
            'attributes' => [
                'autocomplete' => 'off',
            ],
        ]);
        
        $this->add([
            'name' => 'email',
            'type' => 'Email',
            'options' => [
                'label' => 'E-Mail Address',
            ],
            'attributes' => [
                'autocomplete' => 'off',
            ],
        ]);
        
        
        //
        // Address
        //
        $this->add([
            'name' => 'street_1',
            'type' => 'Text',
            'options' => [
                'label' => 'Street',
            ],
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ],
        ]);
        
        $this->add([
            'name' => 'street_2',
            'type' => 'Text',
            'options' => [
                'label' => 'Street (Additional)',
            ],
            'attributes' => [
                'autocomplete' => 'off',
            ],
        ]);
        
        $this->add([
            'name' => 'city',
            'type' => 'Text',
            'options' => [
                'label' => 'City',
            ],
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ],
        ]);
        
        $this->add([
            'name' => 'state',
            'type' => 'Text',
            'options' => [
                'label' => 'State',
            ],
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ],
        ]);
        
        $this->add([
            'name' => 'postal_code',
            'type' => 'Text',
            'options' => [
                'label' => 'Postal code',
            ],
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ],
        ]);
        
        $this->add([
            'name' => 'country',
            'type' => 'BasicInvoices\Iso\Country\Form\Element\CountrySelect',
            'options' => [
                'label'    => 'Country',
            ],
            'attributes' => [
                'autocomplete' => 'off',
                'required'     => 'required',
            ]
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
                'autocomplete' => 'off',
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
    
    public function getInputFilterSpecification() 
    {
        return [
            'company' => [
                'required' => false,
            ],
            'vat_type' => [
                'required' => false,
            ],
            'vat_number' => [
                'required' => false,
            ],
            'phone' => [
                'required' => false,
            ],
            'mobile' => [
                'required' => false,
            ],
            'email' => [
                'required' => false,
            ]
        ];
    }
}