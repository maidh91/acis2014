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
require_once 'Zend/Auth/Storage/Session.php';
require_once 'Nine/Registry.php';

class Nine_Auth_Storage extends Zend_Auth_Storage_Session
{
	public function __construct()
	{
	    if (true == @Nine_Registry::getConfig('usingMultiAuth'))
	    {
	        /**
	         * User only need to login 1 time between different applications
	         */
	        parent::__construct(Nine_Constant::SESSION_NAMESPACE, 'user');
	    } else {
	        /**
	         * User must login many times between different applications
	         */
	        parent::__construct(Nine_Constant::SESSION_NAMESPACE . "_" . Nine_Registry::getAppName(), 'user');
	    }
	}
}