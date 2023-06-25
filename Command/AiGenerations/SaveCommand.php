<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Command\AiGenerations;

use Exception;
use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Gundo\Integration\Api\SaveAiGenerationsInterface;
use Gundo\Integration\Model\AiGenerationsModel;
use Gundo\Integration\Model\AiGenerationsModel;
use Gundo\Integration\Model\ResourceModel\AiGenerationsResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save AiGenerations Command.
 */
class SaveCommand implements SaveAiGenerationsInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var AiGenerationsModel
     */
    private AiGenerationsModel $model;

    /**
     * @var AiGenerationsResource
     */
    private AiGenerationsResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param AiGenerationsModel $model
     * @param AiGenerationsResource $resource
     */
    public function __construct(
        LoggerInterface           $logger,
        AiGenerationsModel $model,
        AiGenerationsResource     $resource
    )
    {
        $this->logger = $logger;
        $this->model = $model;
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function execute(AiGenerationsInterface $aiGenerations): int
    {
        try {
            /** @var AiGenerationsModel $model */
            $model = $this->model->create();
            $model->addData($aiGenerations->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(AiGenerationsInterface::AI_GENERATIONS_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save AiGenerations. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save AiGenerations.'));
        }

        return (int)$model->getData(AiGenerationsInterface::AI_GENERATIONS_ID);
    }
}
