<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Block\Form\AiGenerations;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getAiGenerationsId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this aigenerations?'),
                $this->getUrl(
                    '*/*/delete',
                    [AiGenerationsInterface::AI_GENERATIONS_ID => $this->getAiGenerationsId()]
                )
            ),
            [],
            20
        );
    }
}
