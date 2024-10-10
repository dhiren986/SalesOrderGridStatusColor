<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Khodal\Contactsus\Model;

use Khodal\Contactsus\Api\ContactusRepositoryInterface;
use Khodal\Contactsus\Api\Data\ContactusInterface;
use Khodal\Contactsus\Api\Data\ContactusInterfaceFactory;
use Khodal\Contactsus\Api\Data\ContactusSearchResultsInterfaceFactory;
use Khodal\Contactsus\Model\ResourceModel\Contactus as ResourceContactus;
use Khodal\Contactsus\Model\ResourceModel\Contactus\CollectionFactory as ContactusCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ContactusRepository implements ContactusRepositoryInterface
{

    /**
     * @var ResourceContactus
     */
    protected $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ContactusInterfaceFactory
     */
    protected $contactusFactory;

    /**
     * @var ContactusCollectionFactory
     */
    protected $contactusCollectionFactory;

    /**
     * @var Contactus
     */
    protected $searchResultsFactory;


    /**
     * @param ResourceContactus $resource
     * @param ContactusInterfaceFactory $contactusFactory
     * @param ContactusCollectionFactory $contactusCollectionFactory
     * @param ContactusSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceContactus $resource,
        ContactusInterfaceFactory $contactusFactory,
        ContactusCollectionFactory $contactusCollectionFactory,
        ContactusSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->contactusFactory = $contactusFactory;
        $this->contactusCollectionFactory = $contactusCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(ContactusInterface $contactus)
    {
        try {
            $this->resource->save($contactus);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the contactus: %1',
                $exception->getMessage()
            ));
        }
        return $contactus;
    }

    /**
     * @inheritDoc
     */
    public function get($contactusId)
    {
        $contactus = $this->contactusFactory->create();
        $this->resource->load($contactus, $contactusId);
        if (!$contactus->getId()) {
            throw new NoSuchEntityException(__('Contactus with id "%1" does not exist.', $contactusId));
        }
        return $contactus;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->contactusCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(ContactusInterface $contactus)
    {
        try {
            $contactusModel = $this->contactusFactory->create();
            $this->resource->load($contactusModel, $contactus->getContactusId());
            $this->resource->delete($contactusModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Contactus: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($contactusId)
    {
        return $this->delete($this->get($contactusId));
    }
}

