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
namespace Khodal\SalesOrderGridStatusColor\Logger;

class Logger extends \Monolog\Logger
{
    public function customLog($message)
    {
        try {
            if ($message === null) {
                $message = "NULL";
            }
            if (is_array($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (is_object($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (!empty(json_last_error())) {
                $message = (string) json_last_error();
            }
            $message = (string) $message;
        } catch (\Exception $e) {
            $message = "INVALID MESSAGE::" . $e->getMessage();
        }
        $message .= PHP_EOL;
        $this->info($message);
    }
}
