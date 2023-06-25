<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Controller\Adminhtml\AiGenerations;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result;
use Magento\Framework\Controller\ResultInterface;

/**
 * New action AiGenerations controller.
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Integration::management';

    /**
     * Create new AiGenerations action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->result->create(Result::TYPE_PAGE);
        $resultPage->setActiveMenu('Gundo_Integration::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New AiGenerations'));

        return $resultPage;
    }
}
