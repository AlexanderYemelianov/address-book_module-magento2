<?php

namespace Customer\AddressBook\Controller\Page;

use Customer\AddressBook\Model\AddressBook;
use Customer\AddressBook\Model\AddressBookFactory;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBook;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBookFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;

class Delete extends Action
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var UrlInterface
     */
    private $urlBuilder;
    /**
     * @var ResourceAddressBookFactory
     */
    private $resourceAddressBookFactory;
    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param Session $session
     * @param UrlInterface $urlBuilder
     * @param ResourceAddressBookFactory $resourceAddressBookFactory
     * @param AddressBookFactory $addressBookFactory
     */
    public function __construct(
        Context $context,
        Session $session,
        UrlInterface $urlBuilder,
        ResourceAddressBookFactory $resourceAddressBookFactory,
        AddressBookFactory $addressBookFactory
    )
    {
        $this->session = $session;
        $this->urlBuilder = $urlBuilder;
        $this->addressBookFactory = $addressBookFactory;
        $this->resourceAddressBookFactory = $resourceAddressBookFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');
        /** @var AddressBook $addressBook */
        $addressBook = $this->addressBookFactory->create();
        /** @var ResourceAddressBook $resourceAddressBook */
        $resourceAddressBook = $this->resourceAddressBookFactory->create();
        $resourceAddressBook->load($addressBook, $id, ResourceAddressBook::ID_FIELD_TITLE)->delete($addressBook);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $url = $this->urlBuilder->getUrl('book/page/view');
        $resultRedirect->setUrl($url);
        return $resultRedirect;
    }
}
//add new line
