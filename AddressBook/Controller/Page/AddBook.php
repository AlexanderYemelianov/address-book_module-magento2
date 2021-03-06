<?php


namespace Customer\AddressBook\Controller\Page;

use \Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class AddBook extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * AddBook constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer: create address book'));
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        return $resultPage;
    }
}