<?php

require_once  'modules/mail/models/Mail.php';
require_once  'modules/user/models/User.php';
require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';
class contact_IndexController extends Nine_Controller_Action
{
	public function indexAction()
	{
		/**
		 * Display tempalte
		 */
	    $this->view->headTitle(Nine_Language::translate('CONTACT'));
	    $this->view->menuId = 'contact';
	    $objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		$condition = array(
						'exclude_content_gids'	=>	1
						);
	
//		$allStatic = $objContent->getAllEnabledContentByCategory(array('content_category_gid=?' => 5),$condition,array('sorting ASC','content_id ASC'));
		$allStatic = array();
		$allStatic[] = ($objContent->getContentByGid(85)->toArray());
		$allStatic[] = ($objContent->getContentByGid(81)->toArray());
		$allStatic[] = ($objContent->getContentByGid(83)->toArray());
		$allStatic[] = ($objContent->getContentByGid(137)->toArray());
//	    echo "<pre>";print_r($allStatic);die;
	    /**
	     * Get post data
	     */
	    $data = $this->_getParam('data', false);
	    $error = array(); 
//	    echo "<pre>";print_r($data);die;   
			
		if (false != $data) {
			
			if (null != $_SESSION['captcha'] && $_SESSION['captcha'] == strtoupper(@$data['captcha'])) {
				try {
						
						/**
				         * Get admin
				         */
				        $objUser = new Models_User();
				        $admin = $objUser->getByUserName('admin');
				        /**
				         * Send message
				         */
				        
				        $objMail = new Models_Mail();
				        $objMail->sendHtmlMail('contact', $data, $admin['email']);
				        $this->session->contactMessage = array(
		                                               'success' => true,
		                                               'message' => Nine_Language::translate('Message is send successfully')
		                                           );
		                $this->_redirect($this->_getCallBackUrl());
					}
				catch (Exception $e) {
					 $this->session->contactMessage = array(
		                                               'success' => false,
		                                               'message' => Nine_Language::translate('Can NOT send this message. Please try again')
		                                           );
				}
				
			}
			else {
				$this->session->contactMessage = array(
		                                               'success' => false,
		                                               'message' => Nine_Language::translate('Code is not match. Please type again')
		                                           );
			}
		}
		   	
	       	$this->view->contactMessage = $this->session->contactMessage;
        	$this->session->contactMessage = null;
        	$this->view->allStatic = $allStatic;
        
        /**
         * random number
         */
        $this->view->randomNumber = rand(0, 1000000);
         
	    $this->view->data = $data;
	    
	}
}