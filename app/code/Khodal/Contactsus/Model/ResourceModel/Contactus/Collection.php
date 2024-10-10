<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Model\ResourceModel\Contactus;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'contactus_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Khodal\Contactsus\Model\Contactus::class,
            \Khodal\Contactsus\Model\ResourceModel\Contactus::class
        );
    }
}

