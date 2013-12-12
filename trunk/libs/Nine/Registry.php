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
require_once 'Zend/Registry.php';
class Nine_Registry extends Zend_Registry 
{
	private static $_session = null;
	/*
	 * get database instance
	 * @return instance of Nine_Db
	 */
	public static function getDB()
	{
		return Nine_Registry::get('db');
	}
	/*
	 * get instance of Nine_Layout
	 * @return layout instance
	 */
	public static function getLayout()
	{
		return Nine_Layout::getMvcInstance();
	}
	/*
	 * get view instance
	 * @return instance of view
	 */
	public static function getView()
	{
		return Nine_Layout::getMvcInstance()->getView();
	}
	
	/*
	 * get template engine of view 
	 * @return a template engine, the default is smarty 
	 */
	public static function getTemplateEngine()
	{
		return Nine_Registry::getView()->getEngine();
	}
	/*
	 * get base url 
	 * @return string of base url
	 */
	public static function getBaseUrl()
	{
		return Nine_Registry::get('BASE_URL');
	}
	/*
	 * get application name
	 * @return string of application
	 */
	public static function getAppName()
	{
		return Nine_Registry::get('APP_NAME');
	}
	/*
	 * get application url
	 * @return string of application url
	 */
	public static function getAppBaseUrl()
	{
		return Nine_Registry::get('APP_BASE_URL');
	}
	
	public static function getHelperUrl()
	{
	    $moduleName = Nine_Registry::getModuleName();
	    return Nine_Registry::get('BASE_URL') . "modules/{$moduleName}/views/helpers/";
	}
	
	public static function getViewPath()
	{
	    $moduleName = Nine_Registry::getModuleName();
	    return "modules/{$moduleName}/views/";
	}
	
	public static function getModulePath()
	{
	    $moduleName = Nine_Registry::getModuleName();
	    return "modules/{$moduleName}/";
	}
	/*
	 * get config
	 * 
	 * $name string
	 * @return array config
	 */
	public static function getConfig($name = false)
	{
	    if (false === $name) {
		  return Nine_Registry::get('config');
	    } else {
	        $config = Nine_Registry::get('config');
	        return @$config[$name];
	    }
	}
	/*
	 * get request object
	 * @return Zend_Controller_Request_Abstract
	 */
	public static function getRequest()
	{
		return Nine_Controller_Front::getInstance()->getRequest();
		
	}
	/**
	 * get response object
	 * @return Zend_Controller_Response_Abstract
	 */
	public static function getResponse()
	{
		return Nine_Controller_Front::getInstance()->getResponse();
	}
	/**
	 * get router object
	 * @return Zend_Controller_Router_Abstract
	 */
	public static function getRouter()
	{
		return Nine_Controller_Front::getInstance()->getRouter();
	}
	/**
	 * get module name
	 * @return string current module name
	 */
	public static function getModuleName()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
	}
	public static function getModuleKey()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getModuleKey();
	}
	
	public static function getControllerName()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
	}
	
	public static function getControllerKey()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getControllerKey();
	}
	
	public static function getActionName()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getActionName();
	}
	
	public static function getActionKey()
	{
		return Zend_Controller_Front::getInstance()->getRequest()->getActionKey();
	}
	/**
	 * get database prefix
	 * @return string prefix for database
	 */
	public static function getDBPrefix()
	{
		$config = Nine_Registry::getConfig();
		return $config['database']['params']['prefix'];
	}
	
	public static function getLangCode()
	{
		return Nine_Registry::get('langCode');
	}
	/**
	 * Get current session in current application
	 * 
	 * @return Zend_Session_Namespace
	 */
	public static function getSession()
	{
		if (null == self::$_session) {
			self::$_session = new Zend_Session_Namespace(Nine_Constant::SESSION_NAMESPACE . "_" . Nine_Registry::getAppName());
		}
	    return self::$_session;
	}
	
	public static function getAcl()
	{
	    if (Nine_Registry::isRegistered('acl')) {
	        return Nine_Registry::get('acl');    
	    } else {
	        return null;
	    }	
	}
	
	public static function getAclFront()
	{
	    if (Nine_Registry::isRegistered('aclFront')) {
	        return Nine_Registry::get('aclFront');    
	    } else {
	        return null;
	    }	
	}
	
	public static function getAclAdmin()
	{
	    if (Nine_Registry::isRegistered('aclAdmin')) {
	        return Nine_Registry::get('aclAdmin');    
	    } else {
	        return null;
	    }	    
	}
	
	public static function getAuth()
	{	    
	   require_once 'Nine/Auth.php';
       return Nine_Auth::getInstance();
	}
	
	/**
	 * Get logged in user
	 * 
	 * @return Zend_Db_Table_Row| false
	 */
	public static function getLoggedInUser()
	{
	    if (NULL == self::getAuth()->getUsername()) {
	        return false;
	    }
	    require_once 'modules/user/models/User.php';
	    $objUser = new Models_User();
	    return $objUser->getByUserName(self::getAuth()->getUsername());
	}

    /**
     * Get logged in user id
     * 
     * @return integer | null
     */
    public static function getLoggedInUserId()
    {
        return @self::getLoggedInUser()->user_id;
    }
    /**
     * Get logged in user group id
     * 
     * @return integer | null
     */
    public static function getLoggedInGroupId()
    {
        return @self::getLoggedInUser()->group_id;
    }
    /**
     * Get content by gid
     * 
     * @param int $gid
     * @return Zend_Db_Table_Row
     */
    public static function getContentByGid($gid)
    {
        require_once 'modules/content/models/Content.php';
        $objContent = new Models_Content();
        
        return $objContent->getContentByGid($gid);
    }
}