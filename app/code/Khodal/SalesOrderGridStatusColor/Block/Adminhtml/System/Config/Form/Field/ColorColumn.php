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

use Magento\Framework\View\Element\AbstractBlock;

class ColorColumn extends AbstractBlock
{
    protected function _toHtml()
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '">';
        $html .= '<script type="text/javascript">
require(["jquery","domReady!", "jquery/colorpicker/js/colorpicker"], function ($) {
    var $colorElement = $("#'.$this->getInputId().'");
    $colorElement.css("background", $colorElement.val());
    $colorElement.ColorPicker({
        onChange: function (hsb, hex, rgb) {
            $colorElement.css("backgroundColor", "#" + hex).val("#" + hex);
        }
    });
});
</script>';
        return $html;
    }
}
