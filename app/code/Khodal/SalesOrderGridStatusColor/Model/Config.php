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
namespace Khodal\SalesOrderGridStatusColor\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    public const DEFAULT_AMOUNT_DISPLAY_TEXT = '| Total amount {{amount}}';

    public const XML_PATH_ENABLED = 'khodal_salesordergridstatuscolor/general/enabled';
    public const XML_PATH_DEBUG = 'khodal_salesordergridstatuscolor/general/debug';

    public const XML_PATH_GRID_AMOUNT_DISPLAY_TEXT       = 'khodal_salesordergridstatuscolor/grid/amount_display_text';
    public const XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING   = 'khodal_salesordergridstatuscolor/grid/amount_display_rounding';
    private const XML_PATH_GRID_STATUS_COLOR = 'khodal_salesordergridstatuscolor/grid/status_color';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getConfigFlag($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_ENABLED, $storeId);
    }

    public function isActive($storeId = null)
    {
        return $this->isEnabled($storeId);
    }

    public function isDebugEnabled($storeId = null)
    {
        return $this->getConfigFlag(self::XML_PATH_DEBUG, $storeId);
    }

    public function getAmountDisplayText($storeId = null)
    {
        $text = $this->getConfigValue(self::XML_PATH_GRID_AMOUNT_DISPLAY_TEXT, $storeId);
        if (empty($text) || strpos($text, '{{amount}}') === false) {
            return self::DEFAULT_AMOUNT_DISPLAY_TEXT;
        }
        return $text;
    }

    public function getAmountDisplayRounding($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_GRID_AMOUNT_DISPLAY_ROUNDING, $storeId);
    }

    public function getGridStatusColor($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_GRID_STATUS_COLOR, $storeId);
    }
}
