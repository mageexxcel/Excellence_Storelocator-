<?php
namespace Excellence\Storelocator\Block\Index;
  
class Index extends \Magento\Framework\View\Element\Template
{
    /** @var Excellence\Storebase\Helper\Data\Data */
    protected $_dataHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Storebase\Helper\Data $dataHelper
    ) {
        parent::__construct($context);
        $this->_dataHelper = $dataHelper;
    }
    public function getAllStores() {
        return $this->_dataHelper->getAvailableStores();
    }
}