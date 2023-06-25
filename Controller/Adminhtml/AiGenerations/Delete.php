<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Controller\Adminhtml\AiGenerations;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Gundo\Integration\Api\DeleteAiGenerationsByIdInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Delete AiGenerations controller.
 */
class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Integration::management';

    /**
     * @var DeleteAiGenerationsByIdInterface
     */
    private DeleteAiGenerationsByIdInterface $deleteByIdCommand;
    private $result;

    /**
     * @param Context $context
     * @param DeleteAiGenerationsByIdInterface $deleteByIdCommand
     */
    public function __construct(
        Context                          $context,
        DeleteAiGenerationsByIdInterface $deleteByIdCommand
    )
    {
        parent::__construct($context);
        $this->deleteByIdCommand = $deleteByIdCommand;
    }

    /**
     * Delete AiGenerations action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->result->create(Result::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $entityId = (int)$this->getRequest()->getParam(AiGenerationsInterface::AI_GENERATIONS_ID);

        try {
            $this->deleteByIdCommand->execute($entityId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted AiGenerations entity'));
        } catch (CouldNotDeleteException|NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
