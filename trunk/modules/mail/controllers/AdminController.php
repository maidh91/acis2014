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
require_once 'modules/mail/models/Mail.php';
require_once 'modules/mail/models/MailStore.php';
require_once 'modules/mail/models/NewsletterMail.php';
require_once 'modules/language/models/Lang.php';
require_once 'modules/user/models/Group.php';
require_once 'modules/user/models/User.php';
require_once 'modules/subcriber/models/Subcriber.php';

class mail_AdminController extends Nine_Controller_Action_Admin 
{
    /*-----------------------------------------------------------------------------------------------------------
	***********************************************NEWSLETTER****************************************************	
	-----------------------------------------------------------------------------------------------------------*/
	
	public function newNewsletterAction()
	{
		$objNewsletterMail = new Models_NewsletterMail();
		/**
         * Check permission
         */
        if (false == $this->checkPermission('new_newsletter_mail',null,'?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        
        $this->view->headTitle(Nine_Language::translate('New NewsLetter Mails'));
        $this->view->menu = array('mail', 'newnewsletter');
        
        /**
         * Get all group
         */
        $objGroup = new Models_Group();
        $objUser = new Models_User();
        $objMailStore = new Models_MailStore();
        
		$allGroups = $objGroup->getAllGroups();
		foreach($allGroups as &$item) {
			if (null == @$item['count']){
				$item['count'] = 0;
			}
		}
		unset($item);
		
        $countAllGroups = count($allGroups);
        $this->view->allGroups = $allGroups;
        $this->view->countAllGroups = $countAllGroups;
		
        /**
         * Get all user
         */
        $allUsers = $objUser->getAll()->toArray();
        $this->view->allUsers = $allUsers;
        
        /**
         * Get all language
         */
        $objLang = new Models_Lang();
        $allLangs = $objLang->getAll()->toArray();
        $this->view->allLangs = $allLangs;
        $data = $this->_getParam('data', false);

        /**
         * Mail alias
         */
		$this->view->mailAlias = array(
								'value' => '[FULL_NAME]<br/>[EMAIL]<br/>'
								);
		
        if (false !== $data) {
        	/**
        	 * Get group user
        	 */
        	$toUsers = array();
        	if (!empty($data['groups'])){
        		foreach($data['groups'] as $item){
        			$userGroups[] = $objUser->getAllUsersWithGroup(array('group_id' => $item));
        		}
        		unset($item);
        		/**
        		 * Modified toUsers
        		 */
        		foreach($userGroups as $item){
        			foreach($item as $item1){
        				$toUsers[] = array(
        							'full_name' =>	$item1['full_name'],
        							'email'     =>	$item1['email']
        							);
        			}
        			unset($item1);
        		}
        		unset($item);
        	}
        	$specialUsers = array();
        	if (null != $data['to_user']) {
				$specialUsers = explode(';', trim($data['to_user'],';'));

				foreach($specialUsers as &$specialUser){
					if (false != strpos($specialUser,'<')) {
						$tmp1 = explode('<', $specialUser);
						foreach($tmp1 as &$item){
							$item = trim($item,"\>\"");
						}
						unset($item);
						$specialUser = array(
								'full_name'	=>	$tmp1[0],
								'email'		=>	$tmp1[1]
								);
					}	
					else {
						$tmp2 = explode('@', $specialUser);
						$specialUser = array(
									'full_name'	=>	$tmp2[0],
									'email'		=>	$specialUser
									);
					}
				}
				unset($specialUser);
				
				/**
				 * Assign to toUsers
				 */
				$tmp3 = $specialUsers;
				
				foreach($toUsers as $toUser){
					$flag = false;
					foreach($tmp3 as $item) {
						if (trim($item['email']) == trim($toUser['email'])) {
							$flag = true;
							break;
						}
					}
					if (false == $flag) {
						$tmp3[] = $toUser;
					}
				}
				$toUsers = $tmp3;
        	}
        	
        	/**
			 * Send email
			 */
        	$objMail = new Models_Mail();
        	
        	$newKeys = array();
        	foreach($toUsers as $toUser){
        		$tmp = array();
        		foreach($toUser as $index=>$item) {
        			$tmp['['. strtoupper($index) . ']'] = $item;
        		}
        		$newKeys[] = $tmp;
        	}
        	
        	foreach ($newKeys as $user) {
        		$mailContent = array(
        			'body'	=>	str_replace(array_keys($user), $user , $data['content'])
        			);
        		$objMail->sendHtmlMail('newsletter',$mailContent,$user['[EMAIL]'],$data['subject']);
        	}

        	try {
				/**
				 * Save newsletter form
				 */
				$groupIds = ';';
				if (!empty($data['groups'])){
					foreach($data['groups'] as $group) {
						$groupIds = $groupIds . $group . ";" ;
					}
				}
				$specialEmails = ';';
				if (null != $data['to_user']) {
					foreach($specialUsers as $user) {
						$specialEmails  = $specialEmails . $user['full_name'] . ":" .$user['email'] . ";";
					}
				}
				
				$newsLetterData = array(
									'group_ids'	=>	$groupIds,
									'special_emails'	=> 	$specialEmails,
									'subject'	=>	$data['subject'],
									'content'	=>	$data['content']
									);
				$objNewsletterMail->insert($newsLetterData);
				$this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Create new newsletter mail successfully')
                                           );
        	}
        	catch (Exception $e){
        		$this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can not create new newsletter now. Please try later!')
                                           );
        	}
			
			
			$this->_redirect('mail/admin/manage-newsletter');
		}
	}
	
	public function editNewsletterAction()
	{
		
		$this->view->headTitle(Nine_Language::translate('Edit NewsLetter Mails'));
        $this->view->menu = array('mail', '');
        
		
		/**
         * Check permission
         */
        if (false == $this->checkPermission('edit_newsletter_mail')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        $objGroup = new Models_Group();
        $objUser = new Models_User();
        $objMailStore = new Models_MailStore();
        
        $allGroups = $objGroup->getAll()->toArray();
        $countAllGroups = count($allGroups);
        $this->view->allGroups = $allGroups;
        $this->view->countAllGroups = $countAllGroups;
        
        $allUsers = $objUser->getAll()->toArray();
        $this->view->allUsers = $allUsers;
        
        $objLang = new Models_Lang();
        $allLangs = $objLang->getAll()->toArray();
        $this->view->allLangs = $allLangs;
        
        $id    = $this->_getParam('id', false);
        $data    = $this->_getParam('data', false);
        
		$objNewsletterMail = new Models_NewsletterMail();
		$newsLetterData = $objNewsletterMail->find($id)->toArray();
        $newsLetterData = @reset($newsLetterData);
        
		if (null != @$newsLetterData['group_ids']) {
			$newsLetterData['groups'] = explode(';', trim($newsLetterData['group_ids'],';'));
		} 
        if (null != @$newsLetterData['special_emails']) {
        	$users = explode(';', trim($newsLetterData['special_emails'],';'));
        	foreach ($users as &$user) {
        		$tmp = explode(':', trim($user));
        		$user = array (
        				'full_name'	=>	$tmp[0],
        				'email'		=>	$tmp[1]
        				);
        	}
        	unset($user);
        	
        	$newsLetterData['to_user'] = '';
        	foreach($users as $user){
        		$newsLetterData['to_user'] = $newsLetterData['to_user']. ';"' . $user['full_name'] . '"<' . $user['email'] .'>';
        	}
        	$newsLetterData['to_user'] = trim($newsLetterData['to_user'],';'). ';';
        }
		$this->view->data = $newsLetterData;
		
		 /**
         * Mail alias
         */
		$this->view->mailAlias = array(
								'value' => '[FULL_NAME]<br/>[EMAIL]<br/>'
								);
		
		
        if (false !== $data) {
        	/**
        	 * Get group user
        	 */
        	$toUsers = array();
        	if (!empty($data['groups'])){
        		foreach($data['groups'] as $item){
        			$userGroups[] = $objUser->getAllUsersWithGroup(array('group_id' => $item));
        		}
        		unset($item);
        		/**
        		 * Modified toUsers
        		 */
        		foreach($userGroups as $item){
        			foreach($item as $item1){
        				$toUsers[] = array(
        							'full_name' =>	$item1['full_name'],
        							'email'     =>	$item1['email']
        							);
        			}
        			unset($item1);
        		}
        		unset($item);
        	}
        	$specialUsers = array();
        	if (null != $data['to_user']) {
				$specialUsers = explode(';', trim($data['to_user'],';'));

				foreach($specialUsers as &$specialUser){
					if (false != strpos($specialUser,'<')) {
						$tmp1 = explode('<', $specialUser);
						foreach($tmp1 as &$item){
							$item = trim($item,"\>\"");
						}
						unset($item);
						$specialUser = array(
								'full_name'	=>	$tmp1[0],
								'email'		=>	$tmp1[1]
								);
					}	
					else {
						$tmp2 = explode('@', $specialUser);
						$specialUser = array(
									'full_name'	=>	$tmp2[0],
									'email'		=>	$specialUser
									);
					}
				}
				unset($specialUser);
				
				/**
				 * Assign to toUsers
				 */
				$tmp3 = $specialUsers;
				
				foreach($toUsers as $toUser){
					$flag = false;
					foreach($tmp3 as $item) {
						if (trim($item['email']) == trim($toUser['email'])) {
							$flag = true;
							break;
						}
					}
					if (false == $flag) {
						$tmp3[] = $toUser;
					}
				}
				$toUsers = $tmp3;
        	}

        	if ($_REQUEST['action'] == "Send") {
//	        	/**
//				 * Send email
//				 */
//	        	$objMail = new Models_Mail();
//				foreach ($toUsers as $toUser) {
//			        $mailValues = array(
//			        	'full_name' => $toUser['full_name'],
//			            'email'     => $toUser['email'],
//			        	'content'	=>	$data['content']
//			        );
//			        
////			        echo "<pre>";print_r($mailValues);die; 
//			        
//			        
//					$objMail->sendHtmlMail('newsletter',$mailValues,$toUser['email'],$data['subject']);
//				}
	        	/**
				 * Send email
				 */
	        	$objMail = new Models_Mail();
	        	
	        	$newKeys = array();
	        	foreach($toUsers as $toUser){
	        		$tmp = array();
	        		foreach($toUser as $index=>$item) {
	        			$tmp['['. strtoupper($index) . ']'] = $item;
	        		}
	        		$newKeys[] = $tmp;
	        	}
	        	
	        	foreach ($newKeys as $user) {
	        		$mailContent = array(
	        			'body'	=>	str_replace(array_keys($user), $user , $data['content'])
	        			);
	        		$objMail->sendHtmlMail('newsletter',$mailContent,$user['[EMAIL]'],$data['subject']);
	        	}
				
        	}
        	
        	try {
				/**
				 * Save newsletter form
				 */
				$groupIds = ';';
				if (!empty($data['groups'])){
					foreach($data['groups'] as $group) {
						$groupIds = $groupIds . $group . ";" ;
					}
				}
				$specialEmails = ';';
				if (null != $data['to_user']) {
					foreach($specialUsers as $user) {
						$specialEmails  = $specialEmails . $user['full_name'] . ":" .$user['email'] . ";";
					}
				}
				
				$newsLetterData = array(
									'group_ids'	=>	$groupIds,
									'special_emails'	=> 	$specialEmails,
									'subject'	=>	$data['subject'],
									'content'	=>	$data['content']
									);
				$objNewsletterMail->update($newsLetterData,array('newsletter_mail_id=?' => $id));
				$this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Update newsletter mail successfully')
                                           );
        	}
        	catch (Exception $e){
        		$this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can not update newsletter now. Please try later!')
                                           );
        	}
        		
			$this->_redirect('mail/admin/manage-newsletter');
			
		}
	}
	
	
	public function manageNewsletterAction()
	{
		/**
         * Check permission
         */
        if (false == $this->checkPermission('see_newsletter_mail',null,'?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage NewsLetter Mails'));
        $this->view->menu = array('mail', 'managenewsletter');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        $objMail = new Models_NewsletterMail();
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->mailDisplayNum;
        } else {
            $this->session->mailDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->mailCondition;
        } else {
            $this->session->mailCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * Get all mails
         */
        $allMails = $objMail->getAllNewsLetterMails($condition, 'newsletter_mail_id DESC',
                                                   $numRowPerPage,($currentPage - 1) * $numRowPerPage
                                                  );
        /**
         * Count all contents
         */
        $count = count($objMail->getAllNewsLetterMails($condition));
        /**
         * Set values for tempalte
         */
        foreach ($allMails as &$item) {
        	$item['content'] = strip_tags($item['content'],'&nbsp;');
        	if(strlen($item['content']) > 40) {
        		$item['content'] = substr($item['content'],0,40) . "...";
        	}
        }
        unset($item);
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allMails = $allMails;
        $this->view->mailMessage = $this->session->mailMessage;
        $this->session->mailMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
	
	}
	/*
	 * manage subcriber
	 */
	

		/**
         * Check permission
         */
	public function manageSubcriberMailsAction(){
		
        if (false == $this->checkPermission('see_newsletter_mail',null,'?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage Subcriber Mails'));
        $this->view->menu = array('mail', 'managesubcriber');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        $objSub = new Models_Subcriber();
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->mailDisplayNum;
        } else {
            $this->session->mailDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->mailCondition;
        } else {
            $this->session->mailCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * Get all mails
         */
         
          $allSub = $objSub->getAllSubcriber($condition,'sub_id DESC',
                                        $numRowPerPage,($currentPage - 1) * $numRowPerPage
                                                  );
           
        /**
         * Count all contents
         */
        $count = count($objSub->getAllSubcriber($condition));
        /**
         * Set values for tempalte
         */
//        echo "<pre>";print_r($allSub);die;
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allSub = $allSub;
        $this->view->mailMessage = $this->session->mailMessage;
        $this->session->mailMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
	
	}
	
	
public function deleteSubAction()
	{
		 $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('mail/admin/manage-subcriber-mails');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objSub = new Models_Subcriber();
        try {
            foreach ($ids as $id) {
               $objSub->delete( array('sub_id=?'=>$id));
            }
            $this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Mail is deleted successfully')
                                           );
        } catch (Exception $e) {
            $this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete this mail. Please try again')
                                           );
        }
        $this->_redirect('mail/admin/manage-subcriber-mails');
		
	}
	
	public function enableSubAction()
    {
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('admin/admin/manage-subcriber-mails');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objSub = new Models_subcriber();
        try {
            foreach ($ids as $id) {
               $objSub->update(array('enabled' => 1), array('sub_id=?' => $id));
            }
            $this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('mail is activated successfully')
                                           );
        } catch (Exception $e) {
            $this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT enable this mail. Please try again')
                                           );
        }
        $this->_redirect('mail/admin/manage-subcriber-mails#listofmails');
    }

    
    
    public function disableSubAction()
    {
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('mail/admin/manage-subcriber-mails');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objSub = new Models_Subcriber();
        try {
            foreach ($ids as $id) {
               $objSub->update(array('enabled' => 0), array('sub_id=?' => $id ));
            }
            $this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('mail is deactived successfully')
                                           );
        } catch (Exception $e) {
            $this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT disable this mail. Please try again')
                                           );
        }
        $this->_redirect('mail/admin/manage-subcriber-mails#listofmails');
    }
    
	
	
		
	/*-----------------------------------------------------------------------------------------------------------
	***********************************************MAIL STORE***************************************************	
	-----------------------------------------------------------------------------------------------------------*/
	
	
	
	public function manageAllMailsAction()
	{
		/**
         * Check permission
         */
        if (false == $this->checkPermission('see_all_mails',null,'?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('All Mails Manager'));
        $this->view->menu = array('mail', 'manageallmails');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        $objMailStore = new Models_MailStore();
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->mailDisplayNum;
        } else {
            $this->session->mailDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->mailCondition;
        } else {
            $this->session->mailCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * Get all mails
         */
        $allMailStores = $objMailStore->getAllMails($condition, array('m.mail_store_id DESC'),
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                  );
        /**
         * Count all contents
         */
        $count = count($objMailStore->getAllMails($condition));
        /**
         * Set values for tempalte
         */
        foreach ($allMailStores as &$item) {
        	$item['content'] = strip_tags($item['content'],'&nbsp;');
        	if(strlen($item['content']) > 40) {
        		$cut = substr($item['content'],0,40);
				$item['content'] = substr($cut, 0, strrpos($cut, ' ')). "..."; 
        	}
        	$item['date'] = date('Y/m/d', $item['date']);
        }
        unset($item);
        
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allMails = $allMailStores;
        $this->view->mailMessage = $this->session->mailMessage;
        $this->session->mailMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
	}
	
	
	public function viewMailDetailAction()
	{	
		$this->view->headTitle(Nine_Language::translate('View Mail Detail'));
        $this->view->menu = array('mail', '');
		
		/**
		* Get id
		 */
		$id    = $this->_getParam('id', false);
		
		$objMailStore = new Models_MailStore();
		$mail = @reset($objMailStore->find($id)->toArray());
		
		/**
		 * Format date
		 */
		$mail['date'] = date('Y/m/d', $mail['date']);
		
		
		$this->view->mail = $mail;
		
	}
	
	public function deleteMailAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('delete_mail')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('mail/admin/manage-newsletter');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objStore = new Models_MailStore();
        try {
            foreach ($ids as $id) {
               $objStore->delete(array('mail_store_id=?' => $id));
            }
            $this->session->mailMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Delete selection mail successfully')
                                           );
        } catch (Exception $e) {
            $this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete mail. Please try again')
                                           );
        }
        $this->_redirect('mail/admin/manage-all-mails');
    }
	
	
	
	/*-----------------------------------------------------------------------------------------------------------
	***********************************************SYSTEM MAIL***************************************************	
	-----------------------------------------------------------------------------------------------------------*/
	
	
	/**
	 * Manage system email
	 */
    public function manageSystemMailAction()
    {
        $objMail     = new Models_Mail();
        $objLang     = new Models_Lang();
        
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_system_mail')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage System Mail'));
        $this->view->menu = array('mail', 'managesystemmail');
        
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
      
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->mailDisplayNum;
        } else {
            $this->session->mailDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->mailCondition;
        } else {
            $this->session->mailCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();

        /**
         * Check permission for each language
         */
    	foreach ($allLangs as $index => $lang) {
            if (false == $this->checkPermission('see_mail', null, $lang['lang_id'])) {
                /**
                 * Disappaer this language
                 */
                unset($allLangs[$index]);
            }
        }
        
        
        
        /**
         * Get all mails
         */
        $allMails = $objMail->setAllLanguages(true)->getAllSystemMails($condition, array('m.mail_id ASC'),
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                  );
        /**
         * Count all mails
         */
        $count = count($objMail->setAllLanguages(true)->getAllSystemMails($condition));
        
        /**
         * Format
         */
        $tmp    = array();
        $tmp2   = false;
        $tmpGid = @$allMails[0]['mail_gid'];
        foreach ($allMails as $index=>$mail) {

        	if ($tmpGid != $mail['mail_gid']) {
                $tmp[]  = $tmp2;
                $tmp2   = false;
                $tmpGid = $mail['mail_gid'];
            }
            if (false === $tmp2) {
                $tmp2 = $mail;
            }

            $tmp2['langs'][]  = $mail;
            
            /**
             * Final element
             */
            if ($index == count($allMails) - 1) {
                $tmp[] = $tmp2;
            }
        }
        $allMails = $tmp;
        
      /**
         * Set values for tempalte
         */
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allMails = $allMails;
        $this->view->mailMessage = $this->session->mailMessage;
        $this->session->mailMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
        $this->view->fullPermisison = $this->checkPermission('see_system_mail');
        $this->view->allLangs = $allLangs;
    }
    
    
    public function editSystemMailAction()
    {
        $objMail = new Models_Mail();
        $objLang = new Models_Lang();
        
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_system_mail')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $gid     = $this->_getParam('gid', false);
        $lid    = $this->_getParam('lid', false); 
        if (false == $gid) {
            $this->_redirect('mail/admin/manage-system-mail');
        }
        
    	/**
         * Check permission
         */
        if ((false == $lid && false == $this->checkPermission('edit_system_mail', null, '*'))
        ||  (false != $lid && false == $this->checkPermission('edit_system_mail', null, $lid))) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data   = $this->_getParam('data', false);
        
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
        $allMailLangs = $objMail->setAllLanguages(true)->getByColumns(array('mail_gid=?' => $gid))->toArray();
        
     	/**
         * Check permisison for each language
         */
        foreach ($allLangs as $index=>$lang) {
            if (false == $this->checkPermission('edit_system_mail', null, $lang['lang_id'])) {
                /**
                 * Disappaer this language
                 */
                unset($allLangs[$index]);
                unset($allMailLangs[$lang['lang_id']]);
                unset($data[$lang['lang_id']]);
            }
            
        }
        
        $errors = array();
        if (false !== $data) {
        
            /**
             * Update mail
             */
            $newMail = $data;
            try {
                $objMail->update($newMail, array('mail_gid=?' => $gid));
                
                /**
                 * Redirect with message
                 */
                $this->session->mailMessage = array(
                                           'success' => true,
                                           'message' => Nine_Language::translate("Edit mail successfully")
                                       );
                $this->_redirect('mail/admin/manage-system-mail');
            } catch (Exception $e) {
                $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
            }
        } else {
            /**
             * Get old data
             */
        	$data = @reset($allMailLangs);
        	
            if (false == $data) {
                $this->session->mailMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate("Mail doesn't exist.")
                                           );
                $this->_redirect('mail/admin/manage-system-mail');
            }
            /**
             * Change format data
             */
            $data['data'] = str_replace(array("\r\n", "\n", "\r"), '<br/>', $data['data']);
            /**
             * Get all lang mails
             */
       		 /**
             * Get all lang contents
             */
            foreach ($allMailLangs as $mail) {
                $data[$mail['lang_id']] = $mail;
            }
        }
        /**
         * Prepare for template
         */
        $this->view->allLangs = $allLangs;
        $this->view->lid = $lid;
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit Mail System'));
        $this->view->menu = array('mail','');
        $this->view->fullPermisison = $this->checkPermission('edit_system_mail', null, '*');
    }
}