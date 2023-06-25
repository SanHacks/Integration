<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Model\Data;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Magento\Framework\DataObject;

class AiGenerationsData extends DataObject implements AiGenerationsInterface
{
    /**
     * Getter for AiGenerationsId.
     *
     * @return int|null
     */
    public function getAiGenerationsId(): ?int
    {
        return $this->getData(self::AI_GENERATIONS_ID) === null ? null
            : (int)$this->getData(self::AI_GENERATIONS_ID);
    }

    /**
     * Setter for AiGenerationsId.
     *
     * @param int|null $aiGenerationsId
     *
     * @return void
     */
    public function setAiGenerationsId(?int $aiGenerationsId): void
    {
        $this->setData(self::AI_GENERATIONS_ID, $aiGenerationsId);
    }

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID) === null ? null
            : (int)$this->getData(self::PRODUCT_ID);
    }

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Getter for Category.
     *
     * @return int|null
     */
    public function getCategory(): ?int
    {
        return $this->getData(self::CATEGORY) === null ? null
            : (int)$this->getData(self::CATEGORY);
    }

    /**
     * Setter for Category.
     *
     * @param int|null $category
     *
     * @return void
     */
    public function setCategory(?int $category): void
    {
        $this->setData(self::CATEGORY, $category);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->setData(self::AI_GENERATIONS_ID, null);
        $this->setData(self::PRODUCT_ID, null);
        $this->setData(self::CATEGORY, null);
    }
}
