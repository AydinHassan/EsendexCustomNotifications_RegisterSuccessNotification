<?php

/**
 * Class EsendexCustomNotifications_RegisterSuccessNotification_Model_Resource_RegisterSuccess
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EsendexCustomNotifications_RegisterSuccessNotification_Model_Resource_RegisterSuccess
    extends Esendex_Sms_Model_Resource_TriggerAbstract
{

    /**
     * Constructor
     */
    public function _construct()
    {
        $this->_init('esendex_sms/trigger', 'entity_id');
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return self
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId()) {
            $adapter = $this->_getReadAdapter();
            $select = $adapter->select()
                ->from($this->getTable('esendexCustomNotifications_registerSuccessNotification/customer_register_details'), array('first_name'))
                ->where('trigger_id = ?', (int) $object->getId());

            $firstName = $adapter->fetchOne($select);
            $object->setData('first_name', $firstName);
        }
        return parent::_afterLoad($object);
    }

    /**
     * Assign trigger to store views
     *
     * @param Mage_Core_Model_Abstract $object
     * @return self
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $firstName  = $object->getData('first_name');
        $table      = $this->getTable('esendexCustomNotifications_registerSuccessNotification/customer_register_details');

        $where = [
            'trigger_id = ?' => (int) $object->getId(),
        ];
        $this->_getWriteAdapter()->delete($table, $where);

        $data = [
            'trigger_id'    => (int) $object->getId(),
            'first_name'    => $firstName
        ];
        $this->_getWriteAdapter()->insert($table, $data);
        return parent::_afterSave($object);
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    public function _beforeDelete(Mage_Core_Model_Abstract $object)
    {
        $table = $this->getTable('esendexCustomNotifications_registerSuccessNotification/customer_register_details');

        $where = [
            'trigger_id = ?' => (int) $object->getId(),
        ];
        $this->_getWriteAdapter()->delete($table, $where);

        return parent::_beforeDelete($object);
    }
}
