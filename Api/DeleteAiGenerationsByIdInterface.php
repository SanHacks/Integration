<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Api;

use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Delete AiGenerations by id Command.
 *
 * @api
 */
interface DeleteAiGenerationsByIdInterface
{
    /**
     * Delete AiGenerations.
     * @param int $entityId
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void;
}
