<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */
require_once 'Nine/Registry.php';
class Nine_Acl 
{
	protected $_moduleName = "";
	protected $_groupId = 1;
	protected $_permissions = array();
	protected $_auth = null;
	/**
	 * constructor init all data
	 */
	public function __construct($username)
	{
		$this->_auth = Nine_Auth::getInstance();
		$dbPrefix = Nine_Registry::getDBPrefix();
		$db = Nine_Registry::getDB();
		$sqlSelectPermission = "
				SELECT p.name as pkey, r.enabled as penabled, r.expand_table_id, p.module as module_name FROM
					(SELECT * FROM {$dbPrefix}user WHERE username = {$db->quote($username)}) u,
					{$dbPrefix}group_permission r,
					{$dbPrefix}permission p
				WHERE r.permission_id = p.permission_id AND u.group_id = r.group_id;";
		$db = Nine_Registry::getDB();
		$permissions = $db->fetchAll($sqlSelectPermission);
		$results = array();	
		foreach ($permissions as $per) {
		    if (null == $per['expand_table_id']) {
			 $results[$per['module_name']][$per['pkey']] = ($per['penabled'] == '1')?true:false;
		    } else {
		        $results[$per['module_name']][$per['pkey']][$per['expand_table_id']] = ($per['penabled'] == '1')?true:false;
		    }
		}
		$this->_permissions = $results;
	}
	/**
	 * Check permisison
	 * 
	 * @param string $permission
	 * @param string $module
	 * @param string|integer $expandId  Note: $expandId == '*": Check to have all expandable permisisnon
	 *                                        $expandId == '?': Check to have one or more permisison
	 *                                        $expandId is interger: Check for special expand value
	 */
	public function checkPermission($permission, $module, $expandId = '*') 
	{
		$config = Nine_Registry::getConfig();
		if ('ADMIN' == strtoupper($this->_auth->getIdentity()) && @$config['useAdminFullControlSystem']) {
			return true;
		}
		
		if ('*' == $expandId) {
    		if (true === @$this->_permissions[$module][$permission]){
    			return true;
    		} elseif (is_array($pers = @$this->_permissions[$module][$permission])) {
    		    /**
    		     * Check all expandable permissions
    		     */
    		    foreach ($pers as $per) {
    		        if (false == $per) {
    		            return false;
    		        }
    		    }
    		    return true;
    		}
		}else if ('?' == $expandId) {
		    /**
		     * Match one of all permission
		     */		
            if (true === @$this->_permissions[$module][$permission]){
                return true;
            } elseif (is_array($pers = @$this->_permissions[$module][$permission])) {
                /**
                 * Check all expandable permissions
                 */
                foreach ($pers as $per) {
                    if (true == $per) {
                        return true;
                    }
                }
                return false;
            }
		} else {
		    /**
		     * Check expandable permission
		     */
            if (true == @$this->_permissions[$module][$permission][$expandId]){
                return true;
            }
		}
		return false;
	}	
}