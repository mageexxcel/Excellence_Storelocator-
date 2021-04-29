<?php
namespace Excellence\Storelocator\Block\Index;
  
class Locatorlink extends \Magento\Framework\View\Element\Html\Link\Current
{
    protected $storeCollection;
    
    /**
     * Default path
     *
     * @var \Magento\Framework\App\DefaultPathInterface
     */
    protected $_defaultPath;

    /** @var Excellence\Storebase\Helper\Data\Data */
    
    protected $_dataHelper;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Storebase\Model\ResourceModel\Storebase\Collection $storeCollection,
        \Excellence\Storebase\Helper\Data $dataHelper,
        \Magento\Framework\App\DefaultPathInterface $defaultPath        
    ) {
        parent::__construct($context, $defaultPath);
        $this->storeCollection = $storeCollection;
        $this->_dataHelper = $dataHelper;
    }
    
    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml() {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }

        $highlight = '';

        if ($this->getIsHighlighted()) {
            $highlight = ' current';
        }

        if ($this->isCurrent()) {
            $html = '<li class="nav item current">';
            $html .= '<strong>'
                . $this->escapeHtml((string)new \Magento\Framework\Phrase($this->getLocatorLinkText()))
                . '</strong>';
            $html .= '</li>';
        } else {
            $html = '<li class="nav item' . $highlight . '"><a href="' . $this->escapeHtml($this->getHref()) . '"';
            $html .= $this->getTitle()
                ? ' title="' . $this->escapeHtml((string)new \Magento\Framework\Phrase($this->getTitle())) . '"'
                : '';
            $html .= $this->getAttributesHtml() . '>';

            if ($this->getIsHighlighted()) {
                $html .= '<strong>';
            }

            $html .= $this->escapeHtml((string)new \Magento\Framework\Phrase($this->getLocatorLinkText()));

            if ($this->getIsHighlighted()) {
                $html .= '</strong>';
            }

            $html .= '</a></li>';
        }

        return $html;
    }

    public function getLocatorLinkText() {
        $dealerId = $this->_dataHelper->getDealerGroupId();
        $customerGroupId = $this->_dataHelper->getCurrentCustomerGroupId();
        if (($customerGroupId) && ($dealerId == $customerGroupId)) {
            return __('Dealer Locator');
        } else {
            return __('Store Locator');
        }
    }
}