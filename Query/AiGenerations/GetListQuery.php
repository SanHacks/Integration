<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Query\AiGenerations;

use Gundo\Integration\Api\Data\AiGenerationsSearchResultsInterface;
use Gundo\Integration\Api\GetAiGenerationsListInterface;
use Gundo\Integration\Mapper\AiGenerationsDataMapper;
use Gundo\Integration\Model\ResourceModel\AiGenerationsModel\AiGenerationsCollection;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Get AiGenerations list by search criteria query.
 */
class GetListQuery implements GetAiGenerationsListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var AiGenerationsCollection
     */
    private AiGenerationsCollection $entityCollection;

    /**
     * @var AiGenerationsDataMapper
     */
    private AiGenerationsDataMapper $entityDataMapper;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var AiGenerationsSearchResultsInterface
     */
    private AiGenerationsSearchResultsInterface $searchResult;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param AiGenerationsCollection $entityCollection
     * @param AiGenerationsDataMapper $entityDataMapper
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param AiGenerationsSearchResultsInterface $searchResult
     */
    public function __construct(
        CollectionProcessorInterface               $collectionProcessor,
        AiGenerationsCollection             $entityCollection,
        AiGenerationsDataMapper                    $entityDataMapper,
        SearchCriteriaBuilder                      $searchCriteriaBuilder,
        AiGenerationsSearchResultsInterface $searchResult
    )
    {
        $this->collectionProcessor = $collectionProcessor;
        $this->entityCollection = $entityCollection;
        $this->entityDataMapper = $entityDataMapper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResult = $searchResult;
    }

    /**
     * @inheritDoc
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): AiGenerationsSearchResultsInterface
    {
//        $collection = $this->entityCollection->create();
        $collection = $this->entityCollection;

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $entityDataObjects = $this->entityDataMapper->map($collection);

        /** @var AiGenerationsSearchResultsInterface $searchResult */
//        $searchResult = $this->searchResult->create();
        $searchResult = $this->searchResult;
        $searchResult->setItems($entityDataObjects);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
