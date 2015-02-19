<?php

/** @var $this Esendex_Sms_Model_Resource_Setup */
$this->startSetup();


$this->addEvent(
    'Customer Register Success',
    'event',
    'customer_register_success',
    20,
    'esendexCustomNotifications_registerSuccessNotification/eventProcessor_customerRegisterSuccess'
);

$this->endSetup();
