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
namespace Khodal\SalesOrderGridStatusColor\Block\Adminhtml\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Khodal\SalesOrderGridStatusColor\Model\Config\ModuleMetadata;
use Khodal\SalesOrderGridStatusColor\Helper\Data as SalesOrderGridHelper;

class Version extends Field
{
    /**
     * @var SalesOrderGridHelper
     */
    protected $goToCatalogHelper;

    /**
     * @var ModuleMetadata
     */
    private $moduleMetadata;

    public function __construct(
        Context $context,
        SalesOrderGridHelper $goToCatalogHelper,
        ModuleMetadata $moduleMetadata
    ) {
        $this->goToCatalogHelper = $goToCatalogHelper;
        $this->moduleMetadata = $moduleMetadata;
        parent::__construct($context);
    }

    protected function _getElementHtml(AbstractElement $element)
    {        
        $versionLabel = sprintf(
            '<span title="%s">%s</span>',
            $this->moduleMetadata->getName(),
            $this->moduleMetadata->getVersion()
        );
        $element->setValue($versionLabel);

        return $element->getValue();
    }
}
