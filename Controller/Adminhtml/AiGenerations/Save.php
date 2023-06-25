<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Controller\Adminhtml\AiGenerations;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Gundo\Integration\Api\SaveAiGenerationsInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save AiGenerations controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Integration::management';

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var SaveAiGenerationsInterface
     */
    private SaveAiGenerationsInterface $saveCommand;

    /**
     * @var AiGenerationsInterface
     */
    private AiGenerationsInterface $entityData;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveAiGenerationsInterface $saveCommand
     * @param AiGenerationsInterface $entityData
     */
    public function __construct(
        Context                       $context,
        DataPersistorInterface        $dataPersistor,
        SaveAiGenerationsInterface    $saveCommand,
        AiGenerationsInterface $entityData
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityData = $entityData;
    }

    /**
     * Save AiGenerations Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirect->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var AiGenerationsInterface|DataObject $entityModel */
            $entityModel = $this->entityData->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The AiGenerations data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                AiGenerationsInterface::AI_GENERATIONS_ID => $this->getRequest()->getParam(AiGenerationsInterface::AI_GENERATIONS_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
