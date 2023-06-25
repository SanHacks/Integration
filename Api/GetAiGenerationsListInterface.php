<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Api;

use Gundo\Integration\Api\Data\AiGenerationsSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Get AiGenerations list by search criteria query.
 *
 * @api
 */
interface GetAiGenerationsListInterface
{
    /**
     * Get AiGenerations list by search criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Gundo\Integration\Api\Data\AiGenerationsSearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): AiGenerationsSearchResultsInterface;
}
