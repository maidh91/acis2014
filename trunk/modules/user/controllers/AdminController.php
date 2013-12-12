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
require_once 'modules/user/models/Group.php';
require_once 'modules/user/models/User.php';
class user_AdminController extends Nine_Controller_Action_Admin 
{
    
    public function newUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('new_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data = $this->_getParam('data', false);
        $errors = array();
        if (false !== $data) {
        
            /**
             * Insert new user
             */
            $objUser = new Models_User();
            $newUser = array(
                            'group_id'        => $data['group_id'],
                            'username'        => $data['username'],
                            'email'           => $data['email'],
                            'first_name'      => $data['first_name'],
            				'last_name'       => $data['last_name'],
            				'full_name' 	  => trim($data['first_name']." ".$data['last_name']),
                            'password'        => $data['password'],
                            'repeat_password' => $data['repeat_password'],
                            'created_date'    => time(),
                            'enabled'         => $data['enabled'],
            				'admin_note' 	  => $data['admin_note']
                        );

            
            $errors = $objUser->validate($newUser);
            if (true === $errors) {
                $newUser['password'] = md5($newUser['password']);
                /**
                 * TODO Read date format from language table
                 */
                unset($newUser['repeat_password']);
                try {
                    $objUser->insert($newUser);
                    $this->session->userMessage =  array(
		                       'success' => true,
		                       'message' => Nine_Language::translate('User is created successfully.')
                    		);
                    $this->_redirect('user/admin/manage-user');
                } catch (Exception $e) {
                    $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
                }
            }
        }
        /**
         * Prepare for template
         */
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('New user'));
        $this->view->menu = array('usergroup', 'newuser');
        /**
        * Get all groups
        */
        $objGroup = new Models_Group();
        $this->view->allGroups = $objGroup->getAll(array('sorting ASC', 'group_id ASC'))->toArray();
    }
    

    public function editUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id   = $this->_getParam('id', false);
        $data = $this->_getParam('data', false);
    
        if (false == $id) {
            $this->_redirect('user/admin/manage-user');
        }
    
        $objUser = new Models_User();
        $errors = array();
        
        /**
         * Get old user
         */
        $oldUser = $objUser->getUser($id);
    
        if (empty($oldUser)) {
            /**
             * User doesn't exsit
             */
            
            $this->session->userMessage = array(
                                           'success' => false,
                                           'message' => Nine_Language::translate('User does NOT exist')
                                       );
            $this->_redirect('user/admin/manage-user#listofuser');
        }
        
        if (false !== $data) {
            /**
             * Update new user
             */
            $newUser = array(
                            'group_id'               => @$data['group_id'],
                            'username'               => @$data['username'],
                            'email'                  => $data['email'],
                            'first_name'      		 => $data['first_name'],
            				'last_name'      		 => $data['last_name'],
            				'full_name' 	  		 => trim($data['first_name']." ".$data['last_name']),
                            'password'               => $data['password'],
                            'repeat_password'        => $data['repeat_password'],
                            'enabled'                => $data['enabled'],
            				'admin_note' 			 => $data['admin_note']
                        );
            /**
             * Check permission
             */
            if ($oldUser['group_id'] !=  $newUser['group_id'] && false == $this->checkPermission('change_group')) {
                $newUser['group_id'] = $oldUser['group_id'];
            }
            $exclude = array();
            
            if (null == @$newUser['password'] && null == @$newUser['repeat_password']) {
                $exclude[] = 'password';
                unset($newUser['password']);
                unset($newUser['repeat_password']);
                
            }
            if ($newUser['email'] == $oldUser['email']) {
                $exclude[] = 'email';
                unset($newUser['email']);
            }
            if ($newUser['username'] == $oldUser['username']) {
                $exclude[] = 'username';
                unset($newUser['username']);
            }
            /**
             * Don't have permisison to change group?
             */
            if (false == $this->checkPermission('change_group')) {
                unset($newUser['group_id']);
            }
            
            $errors = $objUser->validate($newUser, $exclude);
            
            if (true === $errors) {
                if (null != @$newUser['password']) {
                    $newUser['password'] = md5($newUser['password']);
                    unset($newUser['repeat_password']);
                }
                /**
                 * TODO Read date format from language table
                 */
                try {
                	$objUser->update ( $newUser, array ('user_id=?' => $id ) );
					/**
					 * Reload current login user
					 */
					$loggedUser = $this->session->backendUser;
					if ($oldUser ['user_id'] == @$loggedUser ['user_id']) {
						$this->session->backendUser = $objUser->getByUserId ( $oldUser ['user_id'] )->toArray ();
					}
                    
                    $this->session->userMessage = array(
                                           'success' => true,
                                           'message' => Nine_Language::translate('User is updated successfully')
                                   );
                                   
                    if (2 != Nine_Registry::getLoggedInGroupId()) {
                    	$this->_redirect('user/admin/manage-user');
                    }
                    
                } catch (Exception $e) {
                    $errors = array('main' => Nine_Language::translate('Can not update user now'));
                    
                }
            }
        } else {
            /**
             * Get current user
             */
            $data = $oldUser;
        }
        /**
         * Prepare for template
         */
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit user'));
        $this->view->menu = array('usergroup', 'edituser');
        
        $this->view->userMessage = $this->session->userMessage;
        $this->session->userMessage = null;

        /**
        * Get all groups
        */
        $objGroup = new Models_Group();
        $this->view->allGroups = $objGroup->getAll(array('sorting ASC', 'group_id ASC'))->toArray();
        
    }
    
    public function manageUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage Users'));
        $this->view->menu = array('usergroup', 'manageuser');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        /**
         * Get number of users per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->userDisplayNum;
        } else {
            $this->session->userDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->userCondition;
        } else {
            $this->session->userCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * Load all users
         */
        $objUser = new Models_User();
        $allUsers = $objUser->getAllUsersWithGroup($condition, 'user_id DESC',
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                  );
        /**
         * Count all users
         */
        $count = count($objUser->getAllUsersWithGroup($condition));
        $this->view->condition = $condition;
        /**
         * Modify all users
         */
        foreach ($allUsers as &$user) {
            if (null != $user['created_date']) {
                $user['created_date'] = date($config['dateFormat'], $user['created_date']);
            }
            if (null != $user['last_login_date']) {
                $user['last_login_date'] = date($config['dateFormat'], $user['last_login_date']);
            }
        }
        unset($user);
        /**
         * Load all groups
         */
        $objGroup = new Models_Group();
        /**
         * Set values for tempalte
         */
        $this->view->allGroups = $objGroup->getAll(array('sorting ASC', 'group_id ASC'))->toArray();
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allUsers = $allUsers;
        $this->view->userMessage = $this->session->userMessage;
        $this->session->userMessage = null;
        $this->view->displayNum = $numRowPerPage;
    }
    
    public function enableUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('user/admin/manage-user');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objUser = new Models_User();
        try {
            foreach ($ids as $id) {
               $objUser->update(array('enabled' => 1), array('user_id=?' => $id));
            }
            $this->session->userMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('User is activated successfully')
                                           );
        } catch (Exception $e) {
            $this->session->userMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT enable this user. Please try again')
                                           );
        }
        $this->_redirect('user/admin/manage-user#listofuser');
    }

    
    
    public function disableUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('user/admin/manage-user');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objUser = new Models_User();
        try {
            foreach ($ids as $id) {
               $objUser->update(array('enabled' => 0), array('user_id=?' => $id, 'username !=?' => 'admin' ));
            }
            $this->session->userMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('User is deactived successfully')
                                           );
        } catch (Exception $e) {
            $this->session->userMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT disable this user. Please try again')
                                           );
        }
        $this->_redirect('user/admin/manage-user#listofuser');
    }

    public function deleteUserAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('delete_user')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('user/admin/manage-user');
        }
        
        $ids = explode('_', trim($id, '_'));
        
        $objUser = new Models_User();
        try {
            foreach ($ids as $id) {
               $objUser->delete( array('user_id=?' => $id, 'username !=?' => 'admin' ));
            }
            $this->session->userMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('User is deleted successfully')
                                           );
        } catch (Exception $e) {
            $this->session->userMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete this user. Please try again')
                                           );
        }
        $this->_redirect('user/admin/manage-user#listofuser');
    }
    
    
    
    /**
     * ######################################  GROUP FUNCTIONS ############################################## 
     */
    
    public function manageGroupAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_group')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage Groups'));
        $this->view->menu = array('usergroup', 'managegroup');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        /**
         * Get number of groups per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->groupDisplayNum;
        } else {
            $this->session->groupDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Load all groups
         */
        $objGroup = new Models_Group();
        $allGroups = $objGroup->getAll('sorting ASC')->toArray();
        /**
         * Count all groups
         */
        $count = count($allGroups);
        /**
         * Load all groups
         */
        /**
         * Set values for tempalte
         */
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allGroups = $allGroups;
        $this->view->groupMessage = $this->session->groupMessage;
        $this->session->groupMessage = null;
        $this->view->displayNum = $numRowPerPage;
    }

    
    public function enableGroupAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_group')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('user/admin/manage-group');
        }
        
        $ids = explode('_', trim($id, '_'));
        $objGroup = new Models_Group();
        try {
            foreach ($ids as $id) {
               $objGroup->update(array('enabled' => 1), array('group_id=?' => $id));
            }
            $this->session->groupMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Enable group successfully')
                                           );
        } catch (Exception $e) {
            $this->session->groupMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT enable this group. Please try again')
                                           );
        }
        $this->_redirect('user/admin/manage-group#listofgroup');
    }

    
    
    public function disableGroupAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_group')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id = $this->_getParam('id', false);
        
        if (false == $id) {
            $this->_redirect('user/admin/manage-group');
        }
        
        $ids = explode('_', trim($id, '_'));
        $objGroup = new Models_Group();
        try {
            foreach ($ids as $id) {
               $objGroup->update(array('enabled' => 0), array('group_id=?' => $id));
            }
            $this->session->groupMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Disable group successfully')
                                           );
        } catch (Exception $e) {
            $this->session->groupMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT disable this group. Please try again')
                                           );
        }
        $this->_redirect('user/admin/manage-group#listofgroup');
    }
    
    
    public function editGroupAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_group')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id   = $this->_getParam('id', false);
        $data = $this->_getParam('data', false);
    
        if (false == $id) {
            $this->_redirect('user/admin/manage-group');
        }
        
        $objGroup = new Models_Group();
        $errors = array();
        /**
         * Get old group
         */
        $oldGroup = $objGroup->find($id)->current()->toArray();
    
        if (empty($oldGroup)) {
            /**
             * Group doesn't exsit
             */
            
            $this->session->groupMessage = array(
                                           'success' => false,
                                           'message' => Nine_Language::translate('Group does NOT exist')
                                       );
            $this->_redirect('user/admin/manage-group#listofgroup');
        }
        
        if (false !== $data) {
            /**
             * Update new group
             */
            $newGroup = array(
                            'name'        => $data['name'],
                            'default'     => $data['default'],
                            'description' => $data['description'],
                            'color'       => $data['color'],
                            'enabled'     => $data['enabled'],
                            'sorting'     => $data['sorting']
                        );
        
            if (null == $newGroup['name']) {
                $errors['name'] = Nine_Language::translate('Name is required');
            }
            if (null == $newGroup['color']) {
                $errors['color'] = Nine_Language::translate('Color is required');
            }
            if (null == $newGroup['sorting']) {
                $errors['sorting'] = Nine_Language::translate('Sorting is required');
            }
            
            if (empty($errors)) {
                try {
                    $objGroup->update($newGroup, array('group_id=?' => $id));
                    /**
                     * Reload current login group
                     */
                    $this->_redirect('user/admin/manage-group');
                } catch (Exception $e) {
                    $errors = array('main' => Nine_Language::translate('Can not update group now'));
                }
            }
        } else {
            /**
             * Get current group
             */
            $data = $oldGroup;
        }
        /**
         * Prepare for template
         */
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit group'));
        $this->view->menu = array('usergroup', 'editgroup');
    }
    
}