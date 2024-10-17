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
namespace Khodal\SalesOrderGridStatusColor\Model\Config;

/**
 * Module metadata
 *
 * @api
 */
interface ModuleMetadataInterface
{
    /**
     * Get Module version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get Module edition
     *
     * @return string
     */
    public function getEdition();

    /**
     * Get Module name
     *
     * @return string
     */
    public function getName();
}
