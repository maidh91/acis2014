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

require_once 'Zend/Auth.php';
require_once 'Nine/Auth/Adapter.php';
require_once 'Nine/Auth/Storage.php';
class Nine_Auth extends Zend_Auth
{
    /**
     * Returns an instance of Nine_Auth
     *
     * Singleton pattern implementation
     *
     * @return Nine_Auth Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
            
            $authStorage = new Nine_Auth_Storage();
            self::$_instance->setStorage($authStorage);  
        }

        return self::$_instance;
    }
	/**
     * Returns the identity from storage or null if no identity is available
     *
     * @return mixed|null
     */
    public function getUsername()
    {
        return $this->getIdentity();
    }
    /**
     * check for login or not
     * @return boolean
     */
    public function isLogin()
    {
    	return $this->hasIdentity(); 
    }
    public function clearAuthInfo()
    {
    	$this->clearIdentity();
    }
    /**
     * Login user
     * 
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $authAdapter = new Nine_Auth_Adapter( );
        $authAdapter->setUserInfo( $username, $password );
        $result = self::getInstance()->authenticate( $authAdapter );
        
        if ($result->isValid ()) {
            /**
             * Set logged groupId
             */
            Nine_Registry::getSession()->loggedGroupId = Nine_Registry::getLoggedInUser()->group_id;
            return true;
        } else {
            return false;
        }
    }
    /**
     * Login user automatically
     * 
     * @param string $username
     * @return void
     */
    public function loginAuto($username)
    {
        self::getInstance()->getStorage()->write($username);
        Nine_Registry::getSession()->unsetAll();
    }
    /**
     * Logout current logged user
     * @return void
     */
    public function logout()
    {
        self::getInstance()->clearAuthInfo ();
    }
}