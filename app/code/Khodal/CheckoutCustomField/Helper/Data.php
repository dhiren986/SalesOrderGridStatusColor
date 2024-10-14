<?php
/**
 * @author Khodal
 * @copyright Copyright (c) khodal
 * @package CheckoutCustomField for Magento 2
 */
namespace Khodal\CheckoutCustomField\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Module\ModuleListInterface;

class Data extends AbstractHelper
{
    public const MODULE_NAME = 'Checkout Fields';

    /**
     * @var ModuleListInterface;
     */
    protected $moduleList;

    /**
     * @param Context $context
     * @param ModuleListInterface $moduleList
     */
    public function __construct(
        Context $context,
        ModuleListInterface $moduleList
    ) {
        $this->moduleList = $moduleList;
        parent::__construct($context);
    }

    /**
     * Returns extension version.
     *
     * @return string
     */
    public function getExtensionVersion()
    {
        $moduleInfo = $this->moduleList->getOne($this->getModuleName());
        return $moduleInfo['setup_version'];
    }

    /**
     * Returns module's name
     *
     * @return string
     */
    public function getModuleName()
    {
        $classArray = explode('\\', get_class($this));

        return count($classArray) > 2 ? "{$classArray[0]}_{$classArray[1]}" : '';
    }

    /**
     * Returns extension name.
     *
     * @return string
     */
    public function getExtensionName()
    {
        return self::MODULE_NAME;
    }
}
