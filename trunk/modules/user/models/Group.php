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
class Models_Group extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'group_id';
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
        $this->_name = $this->_prefix . 'group';
        return parent::__construct($config); 
    }
    /**
     * Get all groups with count
     * @return array 
     */
    public function getAllGroups() 
    {
    	$query = "
                 SELECT g.*, u.count
                 FROM ( SELECT * 
                        FROM {$this->_name} 
                        WHERE enabled = 1  
                       ) AS g
                 LEFT JOIN ( SELECT group_id, count(user_id) as count
                        FROM {$this->_prefix}user 
                        GROUP BY group_id
                       ) AS u
                 ON g.group_id = u.group_id
        ";
    	
    	return $this->_db->fetchAll($query);
    }
    
}