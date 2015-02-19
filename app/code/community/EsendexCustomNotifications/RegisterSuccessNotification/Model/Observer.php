<?php

/**
 * Class EsendexCustomNotifications_RegisterSuccessNotification_Model_Observer
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EsendexCustomNotifications_RegisterSuccessNotification_Model_Observer
{
    /**
     * @param Varien_Event_Observer $e
     */
    public function addFields(Varien_Event_Observer $e)
    {
        $fieldset = $e->getFieldset();
        $fieldset->addField('first_name', 'text', [
            'label'              => Mage::helper('esendex_sms')->__('First Name'),
            'name'               => 'first_name',
            'required'           => true,
        ]);
    }
}