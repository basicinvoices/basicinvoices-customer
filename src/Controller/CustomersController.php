<?php
namespace BasicInvoices\Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BasicInvoices\Customer\Form\CustomerForm;
use BasicInvoices\Customer\Model\Customer;
use BasicInvoices\Customer\Model\CustomerNote;

class CustomersController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function addAction()
    {
        $form = new CustomerForm();
        
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // TODO: Store customer
                $customer = new Customer();
                $customer->exchangeArray($request->getPost());
                
                // TODO: Save it
                
                $customerNote = new CustomerNote();
                $customerNote->customer_id = $customer->getId();
                $customerNote->note        = $request->getPost('note');
                
                // TODO: Save Note
                
            } else {
                // TODO: Error messages
            }
        }
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
    
    public function editAction()
    {
        $form = new CustomerForm();
        
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // TODO: Store customer
            }
        }
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
}