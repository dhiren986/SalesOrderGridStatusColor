<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class SaveCustomFieldsInOrder implements ObserverInterface
{
    /**
     *
     * @var [type]
     */
    protected $orderRepository;
    /**
     * Construct
     *
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Execute
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $PostNumber = $quote->getData('post_number');
        $vatNumber = $quote->getData('vat_number');

        if ($PostNumber || $vatNumber) {
            $order->setData('post_number', $PostNumber);
            $order->setData('vat_number', $vatNumber);

            try {
                $this->orderRepository->save($order);
                $shippingAddress = $order->getShippingAddress();
                $shippingAddress->setData('post_number', $PostNumber);
                $shippingAddress->setData('vat_number', $vatNumber);
                $shippingAddress->save();
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }
        return $this;
    }
}