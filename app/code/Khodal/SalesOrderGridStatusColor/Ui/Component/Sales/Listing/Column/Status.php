<?php
/**
 * This file is part of the Khodal_SalesOrderGridStatusColor package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this package
 * to newer versions in the future.
*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Khodal\SalesOrderGridStatusColor\Ui\Component\Sales\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Khodal\SalesOrderGridStatusColor\Model\StatusColor;

class Status extends Column
{
    /** @var StatusColor */
    protected StatusColor $statusColor;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StatusColor $statusColor,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->statusColor = $statusColor;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['status_color'] = $this->statusColor->getColorByStatus($item[$this->getData('name')]);
            }
        }
        return $dataSource;
    }
}
