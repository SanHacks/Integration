<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Model\ResourceModel\AiGenerationsModel;

use Gundo\Integration\Model\AiGenerationsModel;
use Gundo\Integration\Model\ResourceModel\AiGenerationsResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class AiGenerationsCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ai_generations_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct(): void
    {
        $this->_init(AiGenerationsModel::class, AiGenerationsResource::class);
    }
}
