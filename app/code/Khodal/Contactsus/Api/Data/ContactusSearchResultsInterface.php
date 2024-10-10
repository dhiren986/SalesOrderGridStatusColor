<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Api\Data;

interface ContactusSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Contactus list.
     * @return \Khodal\Contactsus\Api\Data\ContactusInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Khodal\Contactsus\Api\Data\ContactusInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

