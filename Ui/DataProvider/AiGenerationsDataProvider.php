<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Ui\DataProvider;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Gundo\Integration\Api\GetAiGenerationsListInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResult;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use mysql_xdevapi\Result;
use OpenSearch\Helper\Iterators\SearchHitIterator;

/**
 * DataProvider component.
 */
class AiGenerationsDataProvider extends DataProvider
{
    /**
     * @var GetAiGenerationsListInterface
     */
    private GetAiGenerationsListInterface $getListQuery;

    /**
     * @var SearchResult
     */
    private SearchResult $searchResult;

    /**
     * @var array
     */
    private array $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param GetAiGenerationsListInterface $getListQuery
     * @param SearchResult $searchResult
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        GetAiGenerationsListInterface $getListQuery,
        SearchResult $searchResult,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->getListQuery = $getListQuery;
        $this->searchResult = $searchResult;
    }

    /**
     * Returns searching result.
     *
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        $results = $this->getListQuery->execute();
        $this->searchResult->setSearchCriteria($this->getSearchCriteria());
        return $this->searchResult;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData(): array
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }
        $this->loadedData = parent::getData();
        $itemsById = [];

        foreach ($this->loadedData['items'] as $item) {
            $itemsById[(int)$item[AiGenerationsInterface::AI_GENERATIONS_ID]] = $item;
        }

        if ($id = $this->request->getParam(AiGenerationsInterface::AI_GENERATIONS_ID)) {
            $this->loadedData['entity'] = $itemsById[(int)$id];
        }

        return $this->loadedData;
    }
}
