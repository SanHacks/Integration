<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Model;

use Gundo\Integration\Api\Data\AiGenerationsSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * AiGenerations entity search results implementation.
 */
class AiGenerationsSearchResults extends SearchResults implements AiGenerationsSearchResultsInterface
{
    /**
     * Set items list.
     *
     * @param array $items
     *
     * @return AiGenerationsSearchResultsInterface
     */
    public function setItems(array $items): AiGenerationsSearchResultsInterface
    {
        return parent::setItems($items);
    }

    /**
     * Get items list.
     *
     * @return array
     */
    public function getItems(): array
    {
        return parent::getItems();
    }
}
