<?php

/**
 * Class EsendexCustomNotifications_RegisterSuccessNotification_Model_RegisterSuccess
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EsendexCustomNotifications_RegisterSuccessNotification_Model_RegisterSuccess
    extends Esendex_Sms_Model_TriggerAbstract
{

    const ENTITY    = 'esendex_sms_trigger_register_success';
    const CACHE_TAG = 'esendex_sms_trigger_register_success';

    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('esendexCustomNotifications_registerSuccessNotification/registerSuccess');
    }

    /**
     * Filter & validate recipients
     */
    public function validate()
    {
        parent::validate();

        if (strlen($this->getData('first_name')) < 4) {
            $this->addError('first_name must be longer than 3 characters');
        }

        return !$this->hasErrors();
    }
}
