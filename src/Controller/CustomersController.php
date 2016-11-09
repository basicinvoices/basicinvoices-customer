<?php
namespace BasicInvoices\Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BasicInvoices\Customer\Form\CustomerForm;

class CustomersController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction()
    {
        $form = new CustomerForm();
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
    
    public function editAction()
    {
        return new ViewModel();
    }
}