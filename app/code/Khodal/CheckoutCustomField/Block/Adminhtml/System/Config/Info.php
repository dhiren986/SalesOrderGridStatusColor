<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Khodal\CheckoutCustomField\Helper\Data as Helper;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Backend\Block\AbstractBlock;

class Info extends AbstractBlock implements RendererInterface
{
    /**
     * @var Helper
     */
    protected $helper;
    
    /**
     * Constructor
     * @param Context $context
     * @param Helper $helper
     */
    public function __construct(
        Context $context,
        Helper $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context);
    }
    
    /**
     * Render form element as HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $version  = $this->helper->getExtensionVersion();
        $name = $this->helper->getExtensionName();
        $logoUrl = '';
        
        $html  = <<<HTML
            <div style="background: url('$logoUrl') no-repeat scroll 15px 15px #fff;
            border:1px solid #e3e3e3; display;block;
            padding:15px;">
            <p>
            Add custom field in checkout shipping address form.
            </p>
            </div>
            HTML;
        return $html;
    }
}
