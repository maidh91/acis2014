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
class LogModel extends Nine_Model
{
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'log_id';
    
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
        $this->_name = $this->_prefix . 'log';
        return parent::__construct($config); 
    }
    /**
     * Update 9_log table
     * 
     * @return bool True if new event has been saved
     */
    public function updateLog()
    {
        $data = array();
        if (isset($_COOKIE['PHPSESSID'])) {
            $data['user_phpsessid'] = $_COOKIE['PHPSESSID'];
        } else {
            return false;
        }
        if (isset($_SERVER['SERVER_ADDR'])) {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        } else {
            return false;
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $data['link'] = $_SERVER['REQUEST_URI'];
        } else {
            return false;
        }
        $data['time'] = time();
        /**
         * Insert into 9_log table
         */
        $this->insert($data);
        return true;
    }
    /**
     * Clear log table
     * 
     * @param  int $logTime The range time will be logged
     * @return void
     */
    public function clearLog($logTime)
    {
        $this->delete(array('time <?'=>(time() - $logTime)));
    }
    
    public function getNumOfOnlineUsers($time)
    {
        $select = $this->select()
                ->where('time>?', time() - $time)
                ->group('user_phpsessid');
                
        return count($this->fetchAll($select));
        
    }
}