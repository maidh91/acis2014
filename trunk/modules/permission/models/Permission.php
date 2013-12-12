<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 */
require_once 'Nine/Model.php';
class Models_Permission extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'permission_id';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array();
    
    /**
     * Constructor.
     *
     * Supported params for $config are:
     * - db              = user-supplied instance of database connector,
     *                     or key name of registry instance.
     * - name            = table name.
     * - primary         = string or array of primary key(s).
     * - rowClass        = row class name.
     * - rowsetClass     = rowset class name.
     * - referenceMap    = array structure to declare relationship
     *                     to parent tables.
     * - dependentTables = array of child tables.
     * - metadataCache   = cache for information from adapter describeTable().
     *
     * @param  mixed $config Array of user-specified config options, or just the Db Adapter.
     * @return void
     */
    public function __construct($config = array())
    {
        $this->_name = $this->_prefix . 'permission';
        return parent::__construct($config); 
    }
    
    public function getExpandPermission($groupId, $access, $per)
    {
        $groupId = intval($groupId);
        $select = " SELECT  `ep`.{$per['expand_table_id']} AS expand_table_id_value, `ep`.{$per['expand_display_name']} AS expand_display_name_value,  `p` . * , gp.*
                    FROM `{$per['expand_table_name']}` AS  `ep`
                    JOIN (SELECT * FROM `{$this->_prefix}permission` WHERE name = " . $this->getAdapter()->quote($per['name']) . " AND module = " . $this->getAdapter()->quote($per['module']) . ") AS  `p`
                    ON true
                    LEFT JOIN `{$this->_prefix}group_permission` AS  `gp`  
                    ON ep.{$per['expand_table_id']} = gp.expand_table_id AND gp.permission_id = p.permission_id AND gp.group_id = {$groupId}";
//        echo $select . '<br/><br/>';
        
        return $this->_db->fetchAll($select);
    }
    
    public function getAllExpandValues($expandTable, $expandFieldName)
    {
        $select = " SELECT {$expandFieldName} as expand_value FROM $expandTable";
        
        return $this->_db->fetchAll($select);
    }
    
}