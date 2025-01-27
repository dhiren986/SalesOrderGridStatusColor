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

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;

class Header extends Template implements RendererInterface
{
    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        return sprintf(
            '<tr id="row_%s"><td colspan="5"><div class="section-config">
                            <div class="entry-edit-head admin__collapsible-block">%s</div></div></td></tr>',
            $element->getHtmlId(),
            $element->getLabel()
        );
    }
}
