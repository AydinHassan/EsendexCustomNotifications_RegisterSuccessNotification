<?php

/**
 * Class EsendexCustomNotifications_RegisterSuccessNotification_Model_Resource_RegisterSuccess_Collection
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class EsendexCustomNotifications_RegisterSuccessNotification_Model_Resource_RegisterSuccess_Collection
    extends Esendex_Sms_Model_Resource_Trigger_Collection
{

    /**
     * @var string ID Field Name
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Set Model Class
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('esendexCustomNotifications_registerSuccessNotification/registerSuccess');
    }

    /**
     * Join data from other tables
     */
    protected function _afterLoad()
    {
        parent::_afterLoad();

        $triggerIds = array_map(
            function (EsendexCustomNotifications_RegisterSuccessNotification_Model_RegisterSuccess $item) {
                return $item->getId();
            },
            $this->_items
        );

        $select = $this->getConnection()->select();
        $table = $this->getTable('esendexCustomNotifications_registerSuccessNotification/customer_register_details');
        $select->from($table, array('first_name', 'trigger_id'))
            ->where('trigger_id IN (?)', $triggerIds);

        $rows = $this->getConnection()->fetchAll($select);

        foreach ($rows as $row) {
            $triggerId  = $row['trigger_id'];
            $item       = $this->getItemByColumnValue($this->getIdFieldName(), $triggerId);
            $item->setData('first_name', $row['first_name']);
        }
    }
}
