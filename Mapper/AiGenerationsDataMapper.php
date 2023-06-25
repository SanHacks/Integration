<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Mapper;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Gundo\Integration\Model\AiGenerationsModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of AiGenerations entities to an array of data transfer objects.
 */
class AiGenerationsDataMapper
{
    /**
     * @var AiGenerationsInterface
     */
    private AiGenerationsInterface $entityDto;

    /**
     * @param AiGenerationsInterface $entityDto
     */
    public function __construct(AiGenerationsInterface $entityDto)
    {
        $this->entityDto = $entityDto;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|AiGenerationsInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var AiGenerationsModel $item */
        foreach ($collection->getItems() as $item) {
            $entityDto = clone $this->entityDto;

            $results[] = $entityDto;
        }

        return $results;
    }
}
