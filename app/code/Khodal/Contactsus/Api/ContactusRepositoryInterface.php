<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ContactusRepositoryInterface
{

    /**
     * Save Contactus
     * @param \Khodal\Contactsus\Api\Data\ContactusInterface $contactus
     * @return \Khodal\Contactsus\Api\Data\ContactusInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Khodal\Contactsus\Api\Data\ContactusInterface $contactus
    );

    /**
     * Retrieve Contactus
     * @param string $contactusId
     * @return \Khodal\Contactsus\Api\Data\ContactusInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($contactusId);

    /**
     * Retrieve Contactus matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Khodal\Contactsus\Api\Data\ContactusSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Contactus
     * @param \Khodal\Contactsus\Api\Data\ContactusInterface $contactus
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Khodal\Contactsus\Api\Data\ContactusInterface $contactus
    );

    /**
     * Delete Contactus by ID
     * @param string $contactusId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($contactusId);
}

