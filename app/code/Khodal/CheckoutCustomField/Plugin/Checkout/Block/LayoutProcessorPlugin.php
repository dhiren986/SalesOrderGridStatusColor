<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */

namespace Khodal\CheckoutCustomField\Plugin\Checkout\Block;

use Khodal\CheckoutCustomField\ViewModel\EnableDisable;

class LayoutProcessorPlugin
{
    /**
     *
     * @var [type]
     */
    private $enableDisableViewModel;
    /**
     * Construct
     *
     * @param EnableDisable $enableDisableViewModel
     */
    public function __construct(
        EnableDisable $enableDisableViewModel
    ) {
        $this->enableDisableViewModel = $enableDisableViewModel;
    }
    /**
     * After process
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return void
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        if ($this->enableDisableViewModel->isEnabled()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['post_number'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'post-number'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.post_number',
                'label' => 'Post Number',
                'provider' => 'checkoutProvider',
                'visible' => $this->enableDisableViewModel->postNumberEnabled(),
                'validation' => [
                    'required-entry' => true
                ],
                'sortOrder' => 250,
                'id' => 'post-number'
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['vat_number'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'options' => [],
                    'id' => 'vat-number'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.vat_number',
                'label' => 'Account VAT Number',
                'provider' => 'checkoutProvider',
                'visible' => $this->enableDisableViewModel->vatNumberEnabled(),
                'validation' => [
                    'required-entry' => true
                ],
                'sortOrder' => 260,
                'id' => 'vat-number'
            ];
            return $jsLayout;
        }
        return $jsLayout;
    }
}