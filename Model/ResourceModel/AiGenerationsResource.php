<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Model\ResourceModel;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AiGenerationsResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ai_generations_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('ai_generations', AiGenerationsInterface::AI_GENERATIONS_ID);
        $this->_useIsObjectNew = true;
    }
}
