<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Model;

use Gundo\Integration\Model\ResourceModel\AiGenerationsResource;
use Magento\Framework\Model\AbstractModel;

class AiGenerationsModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ai_generations_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(AiGenerationsResource::class);
    }
}
