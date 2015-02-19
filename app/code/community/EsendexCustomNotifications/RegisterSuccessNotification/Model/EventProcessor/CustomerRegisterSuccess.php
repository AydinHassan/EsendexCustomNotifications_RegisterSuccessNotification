<?php

/**
 * Class EsendexCustomNotifications_RegisterSuccessNotification_Model_CustomerRegisterSuccess
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EsendexCustomNotifications_RegisterSuccessNotification_Model_EventProcessor_CustomerRegisterSuccess
    extends Esendex_Sms_Model_EventProcessor_Abstract
    implements Esendex_Sms_Model_EventProcessor_Interface
{
    /**
     * @var array
     */
    protected $variables = [
        'customer::firstname'   => 'firstname',
        'customer::lastname'    => 'lastname',
        'customer::email'       => 'email',
    ];

    /**
     * @param Esendex_Sms_Model_TriggerAbstract $trigger
     * @return bool
     */
    public function shouldSend(Esendex_Sms_Model_TriggerAbstract $trigger)
    {
        $addresses = $this->parameters
            ->getData('customer')
            ->getAddresses();

        if (!isset($addresses[0])) {
            return false;
        }

        $telephoneNumber = $addresses[0]->getTelephone();
        if ($telephoneNumber === null || $telephoneNumber === '') {
            return false;
        }

        //This extra check will only allow messages to be sent to customers
        //whose first name is the same as the one set when creating the notification
        $customerName = $this->parameters->getData('customer')->getFirstname();
        if ($customerName !== $trigger->getFirstName()) {
            return false;
        }

        return true;
    }

    /**
     * @param Esendex_Sms_Model_TriggerAbstract $trigger
     * @return string
     */
    public function getRecipient(Esendex_Sms_Model_TriggerAbstract $trigger)
    {
        $addresses = $this->parameters
            ->getData('customer')
            ->getAddresses();

        return $addresses[0]->getTelephone();
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->parameters->getData('customer')
            ->getStoredId();
    }

    /**
     * @param Esendex_Sms_Model_TriggerAbstract $trigger
     * @return Varien_Object
     */
    public function getVariableContainer(Esendex_Sms_Model_TriggerAbstract $trigger)
    {
        $this->parameters->setData(
            'store_name',
            Mage::getStoreConfig('general/store_information/name',
                $this->parameters->getData('customer')->getStoredId()
            )
        );
        return $this->parameters;
    }
}