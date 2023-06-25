<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Ui\Component\Listing\Column;

use Gundo\Integration\Api\Data\AiGenerationsInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class to build edit and delete link for each item.
 */
class AiGenerationsBlockActions extends Column
{
    /**
     * Entity name.
     */
    private const ENTITY_NAME = 'AiGenerations';

    /**
     * Url paths.
     */
    private const EDIT_URL_PATH = 'ai_generations/aigenerations/edit';
    private const DELETE_URL_PATH = 'ai_generations/aigenerations/delete';

    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponent
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponent,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {
        parent::__construct(
            $context,
            $uiComponent,
            $components,
            $data
        );
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare data source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item[AiGenerationsInterface::AI_GENERATIONS_ID])) {
                    $entityName = static::ENTITY_NAME;
                    $urlData = [AiGenerationsInterface::AI_GENERATIONS_ID => $item[AiGenerationsInterface::AI_GENERATIONS_ID]];

                    $editUrl = $this->urlBuilder->getUrl(static::EDIT_URL_PATH, $urlData);
                    $deleteUrl = $this->urlBuilder->getUrl(static::DELETE_URL_PATH, $urlData);

                    $item[$this->getData('name')] = [
                        'edit' => $this->getActionData($editUrl, (string)__('Edit')),
                        'delete' => $this->getActionData(
                            $deleteUrl,
                            (string)__('Delete'),
                            (string)__('Delete %1', $entityName),
                            (string)__('Are you sure you want to delete a %1 record?', $entityName)
                        )
                    ];
                }
            }
        }

        return $dataSource;
    }

    /**
     * Get action link data array.
     *
     * @param string $url
     * @param string $label
     * @param string|null $dialogTitle
     * @param string|null $dialogMessage
     *
     * @return array
     */
    private function getActionData(
        string  $url,
        string  $label,
        ?string $dialogTitle = null,
        ?string $dialogMessage = null
    ): array
    {
        $data = [
            'href' => $url,
            'label' => $label,
            'post' => true,
            '__disableTmpl' => true
        ];

        if ($dialogTitle && $dialogMessage) {
            $data['confirm'] = [
                'title' => $dialogTitle,
                'message' => $dialogMessage
            ];
        }

        return $data;
    }
}
