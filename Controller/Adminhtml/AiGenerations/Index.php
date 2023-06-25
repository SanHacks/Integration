<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Controller\Adminhtml\AiGenerations;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * AiGenerations backend index (list) controller.
 */

class Index extends \Magento\Framework\App\Action\Action
{
    public const ADMIN_RESOURCE = 'Gundo_Integration::management';
    public function execute()
    {

        $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Gundo_Integration::management');
        $resultPage->addBreadcrumb(__('AiGenerations'), __('AiGenerations'));
        $resultPage->addBreadcrumb(__('Manage AiGenerationss'), __('Manage AiGenerationss'));
        $resultPage->getConfig()->getTitle()->prepend(__('AiGenerations List'));

        return $resultPage;
    }

}


