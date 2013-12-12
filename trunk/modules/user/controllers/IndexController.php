<?php
/**
 * Author: Nguyen Hoai Tan (nguoiao007@gmail.com)
 * 
 * @category   default 
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 * 
 */
require_once 'modules/user/models/User.php';

class user_IndexController extends Nine_Controller_Action
{
    private function _login( $username, $pass)
    {
    	$authAdapter = new Nine_Auth_Adapter ( );
		$authAdapter->setUserInfo ($username, $pass );
		$result = $this->auth->authenticate ( $authAdapter );
		if ($result->isValid ()) {
		    //TODO: update last login time
		    $objUser = new Models_User();
		    $objUser->updateLastLogin($username);
		    /**
		     * Remember this user
		     */
		    $this->session->frontUser =  $objUser->getByUserName($username)->toArray();
		} else {
			$loginError = true;
		}
    }
}