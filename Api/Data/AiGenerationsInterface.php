<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Api\Data;

interface AiGenerationsInterface
{
    /**
     * String constants for property names
     */
    public const AI_GENERATIONS_ID = "ai_generations_id";
    public const PRODUCT_ID = "product_id";
    public const CATEGORY = "category";

    /**
     * Getter for AiGenerationsId.
     *
     * @return int|null
     */
    public function getAiGenerationsId(): ?int;

    /**
     * Setter for AiGenerationsId.
     *
     * @param int|null $aiGenerationsId
     *
     * @return void
     */
    public function setAiGenerationsId(?int $aiGenerationsId): void;

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int;

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void;

    /**
     * Getter for Category.
     *
     * @return int|null
     */
    public function getCategory(): ?int;

    /**
     * Setter for Category.
     *
     * @param int|null $category
     *
     * @return void
     */
    public function setCategory(?int $category): void;

    public function create(): void;
}
