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
namespace Khodal\SalesOrderGridStatusColor\Block\Adminhtml\Sales\Order;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Khodal\SalesOrderGridStatusColor\Helper\Data as SalesOrderGridHelper;

class Js extends Template
{
    /**
     * @var string
     */
    protected $_template = 'Khodal_SalesOrderGridStatusColor::sales/order/js.phtml';

    /**
     * @var SalesOrderGridHelper
     */
    private $salesOrderGridHelper;

    public function __construct(
        Context $context,
        SalesOrderGridHelper $salesOrderGridHelper,
        array $data = []
    ) {
        $this->salesOrderGridHelper = $salesOrderGridHelper;
        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        if (!$this->isActive()) {
            return '';
        }

        return parent::_toHtml();
    }

    public function isActive()
    {
        return $this->salesOrderGridHelper->isActive();
    }

    public function getBaseCurrencySymbol()
    {
        return $this->_storeManager->getStore()->getBaseCurrency()->getCurrencySymbol();
    }

    public function getAmountDisplayText()
    {
        return $this->salesOrderGridHelper->getConfig()->getAmountDisplayText();
    }

    public function getAmountDisplayRounding()
    {
        return $this->salesOrderGridHelper->getConfig()->getAmountDisplayRounding();
    }

    public function getGridConfig()
    {
        return [
            'is_active'                 => $this->isActive(),
            'base_currency_symbol'      => $this->getBaseCurrencySymbol(),
            'amount_display_text'       => $this->getAmountDisplayText(),
            'amount_display_rounding'   => $this->getAmountDisplayRounding()
        ];
    }
}
