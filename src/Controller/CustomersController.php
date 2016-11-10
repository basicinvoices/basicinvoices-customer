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