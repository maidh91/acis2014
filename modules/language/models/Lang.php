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
class Models_Lang extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'lang_id';
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
        $this->_name = $this->_prefix . 'lang';
        return parent::__construct($config); 
    }
     /**
     * Get all langs's datas with langs's information
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array                      $order    OPTIONAL An SQL ORDER clause.
     * @param int                               $count    OPTIONAL An SQL LIMIT count.
     * @param int                               $offset   OPTIONAL An SQL LIMIT offset.
     * @return array The row results per the Zend_Db_Adapter fetch mode.
     * 
     * @example $this->getAllBorrowWithGroup(array(),'borrow_id ASC', 10, 0);
     */
    public function getAllLangs($condition = array(), $order = null, $count = null, $offset = null)
    {
    	$select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('l' => $this->_name))               
                ->order($order)                
                ->limit($count, $offset);
                 return $this->fetchAll($select)->toArray();
    
    }
    
}