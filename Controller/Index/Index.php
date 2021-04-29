<?php
namespace Excellence\Storelocator\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    /** @var Excellence\Storebase\Helper\Data\Data */
    protected $_dataHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Excellence\Storebase\Helper\Data $dataHelper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_dataHelper = $dataHelper;
        return parent::__construct($context);
    }
    
    public function execute() {
        $storeTitile = $this->_dataHelper->getPageTitile();
        $resultPage = $this->resultPageFactory->create();
        if ($storeTitile) {
            $resultPage->getConfig()->getTitle()->set($storeTitile);
        } else {
            $resultPage->getConfig()->getTitle()->set(__('Store Locator'));
        }
        return $resultPage;
    }
}