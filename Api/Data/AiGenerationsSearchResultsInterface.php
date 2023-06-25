<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * AiGenerations entity search result.
 */
interface AiGenerationsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Gundo\Integration\Api\Data\AiGenerationsInterface[] $items
     *
     * @return AiGenerationsSearchResultsInterface
     */
    public function setItems(array $items): AiGenerationsSearchResultsInterface;

    /**
     * Get items.
     *
     * @return \Gundo\Integration\Api\Data\AiGenerationsInterface[]
     */
    public function getItems(): array;
}
