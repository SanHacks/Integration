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
use Gundo\Integration\Api\DeleteAiGenerationsByIdInterface;
use Gundo\Integration\Model\AiGenerationsModel;
use Gundo\Integration\Model\AiGenerationsModel;
use Gundo\Integration\Model\ResourceModel\AiGenerationsResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete AiGenerations by id Command.
 */
class DeleteByIdCommand implements DeleteAiGenerationsByIdInterface
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
    public function execute(int $entityId): void
    {
        try {
            /** @var AiGenerationsModel $model */
            $model = $this->model->create();
            $this->resource->load($model, $entityId, AiGenerationsInterface::AI_GENERATIONS_ID);

            if (!$model->getData(AiGenerationsInterface::AI_GENERATIONS_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find AiGenerations with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete AiGenerations. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete AiGenerations.'));
        }
    }
}
