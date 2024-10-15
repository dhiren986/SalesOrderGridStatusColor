<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class EnableDisable implements ArgumentInterface
{
    /**
     *
     * @var [type]
     */
    private $scopeConfig;
    /**
     * Construct
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }
    /**
     * Extension enable
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return (bool) $this->scopeConfig->getValue('checkout_custom_field/general/enable_custom_field');
    }
    /**
     * Post number enable
     *
     * @return void
     */
    public function postNumberEnabled()
    {
        return (bool) $this->scopeConfig->getValue('checkout_custom_field/general/post_number');
    }
    /**
     * VAT number enable
     *
     * @return void
     */
    public function vatNumberEnabled()
    {
        return (bool) $this->scopeConfig->getValue('checkout_custom_field/general/vat_number');
    }
}
