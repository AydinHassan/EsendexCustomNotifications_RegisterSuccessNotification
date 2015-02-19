<?php

/** @var $this Esendex_Sms_Model_Resource_Setup */
$this->startSetup();

// Create New Table for Extra Customer Register Success Data
$tableName = $this->getTable('esendexCustomNotifications_registerSuccessNotification/customer_register_details');
if (!$this->getConnection()->isTableExists($tableName)) {
    $table = $this->getConnection()
        ->newTable($this->getTable($tableName))
        ->addColumn(
            'trigger_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            [
                'nullable' => false,
            ],
            'Trigger Id'
        )
        ->addColumn(
            'first_name',
            Varien_Db_Ddl_Table::TYPE_VARCHAR,
            255,
            [
                'nullable' => false,
            ],
            'First Name'
        )
        ->addForeignKey(
            $this->getFkName('esendexCustomNotifications_registerSuccessNotification/customer_register_details', 'trigger_id', 'esendex_sms/trigger', 'entity_id'),
            'trigger_id',
            $this->getTable('esendex_sms/trigger'),
            'entity_id'
        )
        ->setComment('Trigger to Admin Sales Detail Table');

    $this->getConnection()->createTable($table);
}

$this->endSetup();