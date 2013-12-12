<?php
require_once 'libs/Nine/Controller/Action.php';
require_once 'modules/user/models/User.php';

class access_IndexController extends Nine_Controller_Action {
	/**
	 * The default action - show the access page
	 */
	public function indexAction() {
	    $this->_redirect("access/index/login");
	}
	
	/**
	 * The default action - show the home page
	 */
	public function loginAction()
	{
		$this->view->headTitle('Login');
		
		$loginError = false;
		$submitHandler = Nine_Registry::getAppBaseUrl() . "access/index/login";
		
		$params = $this->_request->getParams ();
		if ($this->_request->isPost () && isset($params ['username']) && $params ['username'] != "") {			
			$authAdapter = new Nine_Auth_Adapter ( );
			$authAdapter->setUserInfo ( $params ['username'], $params ['password'] );
			$result = $this->auth->authenticate ( $authAdapter );
			if ($result->isValid ()) {
			    //TODO: update last login time
			    $objUser = new Models_User();
			    $objUser->updateLastLogin($params ['username']);
			    /**
			     * Remember this user
			     */
			    $this->session->frontUser =  $objUser->getByUserName($params ['username'])->toArray();
				if ($this->_getCallBackUrl ()) {
                    $this->_redirect ($this->_getCallBackUrl ());
				} else {
					$this->_redirect ("");
				}
			} else {
				$loginError = true;
			}
		}
		$this->view->submitHandler = $submitHandler;
		$this->view->loginError = $loginError;
		$this->view->accessMessage = $this->session->accessMessage;
		$this->session->accessMessage = null;
	}
	/**
	 * get and run with submited data
	 */
	public function logoutAction() {
		$this->auth->clearAuthInfo ();
		$this->session->frontUser = null;
        $this->session->unsetAll();
        
		$state = $this->_request->getParam ( 'state', false );
		
		$this->_redirect ("");
	}
}