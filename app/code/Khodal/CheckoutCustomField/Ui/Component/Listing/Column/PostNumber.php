<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Sales\Model\OrderRepository;
use Magento\Quote\Model\QuoteRepository;

class PostNumber extends Column
{
    /**
     *
     * @var [type]
     */
    protected $orderRepository;
    /**
     *
     * @var [type]
     */
    protected $quoteRepository;
    /**
     * Construct
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderRepository $orderRepository
     * @param QuoteRepository $quoteRepository
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderRepository $orderRepository,
        QuoteRepository $quoteRepository,
        array $components = [],
        array $data = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $orderId = $item['entity_id'];

                $postNumber = $this->getPostNumberFromQuote($orderId);

                $item[$this->getData('name')] = $postNumber;
            }
        }

        return $dataSource;
    }
    /**
     * Get post number from quote
     *
     * @param [type] $orderId
     * @return void
     */
    protected function getPostNumberFromQuote($orderId)
    {
        $postNumber = 'N/A';
        try {
            $order = $this->orderRepository->get($orderId);

            $quoteId = $order->getQuoteId();

            if ($quoteId) {
                $quote = $this->quoteRepository->get($quoteId);
                $postNumber = $quote->getPostNumber();
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
        return $postNumber;
    }
}