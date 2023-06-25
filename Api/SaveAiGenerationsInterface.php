<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Api;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save AiGenerations Command.
 *
 * @api
 */
interface SaveAiGenerationsInterface
{
    /**
     * Save AiGenerations.
     * @param \Gundo\Integration\Api\Data\AiGenerationsInterface $aiGenerations
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(AiGenerationsInterface $aiGenerations): int;
}
