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
class default_AdminController extends Nine_Controller_Action_Admin 
{
    
	public function indexAction()
	{
//        echo '<pre>';print_r($_SESSION);die;
        $this->view->headTitle(Nine_Language::translate('Welcome to Administrator'));
        $this->view->menu = array('controlpanel');
        
        $this->view->userId = Nine_Registry::getLoggedInUserId();
	}
	
	public function settingsAction()
	{
	    
        $this->view->headTitle('Settings');
        $this->view->menu = array('settings');
        
        $obj = new Models_Settings();
        $data = $this->_getParam('data', false);
        
        if (false !== $data) {
            $obj->update($data, array('id=?'=> 1));
            
            $this->view->message = array(
                                               'success' => true,
                                               'message' => 'Edit settings successfully'
                                           );
        }
        /**
         * Get current crush
         */
        $this->view->data = $obj->find(1)->current()->toArray();
	}
}