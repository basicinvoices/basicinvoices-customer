<?php
namespace BasicInvoices\Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BasicInvoices\Customer\Form\CustomerForm;
use BasicInvoices\Customer\Model\Customer;
use BasicInvoices\Customer\Model\CustomerNote;
use BasicInvoices\Customer\CustomerManager;

class CustomersController extends AbstractActionController
{
    protected $customerManager;
    
    public function __construct(CustomerManager $customerManager)
    {
        $this->customerManager = $customerManager;
    }
    
    public function indexAction()
    {
        //$customers = $this->customerManager->getAll();
        //
        //return new ViewModel([
        //    'customers' => $customers
        //]);
        
        // grab the paginator from the AlbumTable
        $paginator = $this->customerManager->getAll(true);

        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel([
            'paginator' => $paginator
        ]);
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
                
                $this->customerManager->save($customer);
                
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