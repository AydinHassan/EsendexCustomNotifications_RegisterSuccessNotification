<?php

/** @var $this Esendex_Sms_Model_Resource_Setup */
$this->startSetup();

//remove old event
$this->deleteTableRow('esendex_sms/event', 'name', 'Customer Register Success');

//add again with custom save model
$this->addEvent(
    'Customer Register Success',
    'event',
    'customer_register_success',
    20,
    'esendexCustomNotifications_registerSuccessNotification/eventProcessor_customerRegisterSuccess',
    'esendexCustomNotifications_registerSuccessNotification/registerSuccess'
);

$this->endSetup();