<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;

class ShippingInformationManagement
{
    /**
     *
     * @var [type]
     */
    protected $quoteRepository;

    /**
     * Construct
     *
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }
    /**
     * Before save address
     *
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param [type] $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return void
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        // Check for extension attributes
        $extensionAttributes = $addressInformation->getExtensionAttributes();
        if (!$extensionAttributes = $addressInformation->getExtensionAttributes()) {
            return;
        }
        
        if ($extensionAttributes) {
            $postNumber = $extensionAttributes->getPostNumber();
            $vatNumber = $extensionAttributes->getVatNumber();
    
            $quote = $this->quoteRepository->getActive($cartId);
            $quote->setPostNumber($postNumber);
            $quote->setVatNumber($vatNumber);
        }
    }    
}