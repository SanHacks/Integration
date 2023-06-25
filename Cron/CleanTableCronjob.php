<?php
/*
 * *
 *  * Copyright © Vaimo Group. All rights reserved.
 *  * See LICENSE_VAIMO.txt for license details.
 *
 */

namespace Gundo\Integration\Cron;


class CleanTableCronjob
{
    /**
     * Cronjob Description
     *
     * @return void
     */
    public function execute(): void
    {
        // todo: implement cronjob logic here
        //Clear IB_History table
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('ib_history');
        $sql = "DELETE FROM " . $tableName;
        $connection->query($sql);

        //Clear IB_Inventory table
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('ib_inventory');
        $sql = "DELETE FROM " . $tableName;
        $connection->query($sql);

        if ($connection->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $connection->error;
        }
    }
}
