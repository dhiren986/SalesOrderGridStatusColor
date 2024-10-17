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
namespace Khodal\SalesOrderGridStatusColor\Block\Adminhtml\System\Config\Form\Field\FieldArray;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Khodal\SalesOrderGridStatusColor\Block\Adminhtml\System\Config\Form\Field\OrderStatusColumn;
use Khodal\SalesOrderGridStatusColor\Block\Adminhtml\System\Config\Form\Field\ColorColumn;

class OrderStatusColor extends AbstractFieldArray
{
    /**
     * @var OrderStatusColumn
     */
    private $orderStatusRenderer;

    /**
     * @var ColorColumn
     */
    private $colorRenderer;

    protected function _prepareToRender()
    {
        $this->addColumn(
            'order_status',
            [
                'label' => __('Order Status'),
                'renderer' => $this->getOrderStatusRenderer()
            ]
        );
        $this->addColumn(
            'color',
            [
                'label' => __('Color'),
                'renderer' => $this->getColorRenderer()
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $orderStatus = $row->getOrderStatus();
        if ($orderStatus !== null) {
            $options['option_' . $this->getOrderStatusRenderer()->calcOptionHash($orderStatus)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return OrderStatusColumn
     * @throws LocalizedException
     */
    private function getOrderStatusRenderer()
    {
        if (!$this->orderStatusRenderer) {
            $this->orderStatusRenderer = $this->getLayout()->createBlock(
                OrderStatusColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }

        return $this->orderStatusRenderer;
    }

    /**
     * @return ColorColumn
     * @throws LocalizedException
     */
    private function getColorRenderer()
    {
        if (!$this->colorRenderer) {
            $this->colorRenderer = $this->getLayout()->createBlock(
                ColorColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }

        return $this->colorRenderer;
    }
}
