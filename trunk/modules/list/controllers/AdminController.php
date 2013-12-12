<?php
/**
 * Author: Nguyen Hoai Tan (nguoiao007@gmail.com)
 * 
 * @list   default 
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 * 
 */
require_once 'modules/list/models/List.php';

class list_AdminController extends Nine_Controller_Action_Admin 
{
    public function init() 
    {
        parent::init();
        
////        if (2 < $this->loggedGroupId) {
//            $this->_forwardToNoPermissionPage();
//        }
    }

    public function editListAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_list')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $id   = $this->_getParam('id', false);
        $data = $this->_getParam('data', false);
        $images = $this->_getParam('image', false);
        $imageTypes = $this->_getParam('image_type', false);
        $imageMains = $this->_getParam('image_main', false);
        $videos = $this->_getParam('video', false);
    
        if (false == $id) {
            $this->_redirect('list/admin/manage-list');
        }
        
        $objList = new Models_List();
        $error = false;
        /**
         * Get old list
         */
        $oldList = $objList->find($id)->toArray();
        $oldList = @reset($oldList);
    
        if (empty($oldList)) {
            /**
             * List doesn't exsit
             */
            
            $this->session->listMessage = array(
                                           'success' => false,
                                           'message' => Nine_Language::translate('List does NOT exist')
                                       );
            $this->_redirect('list/admin/manage-list#listoflist');
        }
        
        if (false !== $data) {
            /**
             * Update new list
             */
            $newList = $data;
                        
            if (false === $error) {
                try {
                    $objList->update($newList, array('list_id=?' => $id));
                    $this->session->listMessage = array(
                        'success' => true,
                        'message' => 'List is edited successfully'
                    );
                    /**
                     * Reload current login list
                     */
                    $this->_redirect('list/admin/manage-list');
                } catch (Exception $e) {
                    $error = array('main' => Nine_Language::translate('Can not update list now'));
                }
            }
        } else {
            /**
             * Get current list
             */
            $data = $oldList;
        }
        $objList = new Models_List();
        $list = $objList->getAllLists();
       
        /**
         * Prepare for template
         */
        $this->view->error = $error;
         $this->view->list = $list;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit list'));
        $this->view->menu = array('list', 'editlist');
    }
    public function newListAction()
    {
        $data = $this->_getParam('data', false);
        $this->view->menu = array('list', 'newlist');
        $errors = false;
     if (false == $this->checkPermission('new_list')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        if (false !== $data) {
        
            /**
             * Insert new user
             */
            $objList = new Models_List();
            $newValue = array(
                            'name'        => $data['name'],
                            'custom_value'        => $data['custom_value'],
                            'parent_id'           => $data['parent_id'],
                        );
            try {
                $objList->insert($newValue);
                $this->session->listMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Add new value successfully')
                                           );
                 $this->_redirect('list/admin/manage-list');
                 
            } catch (Exception $e) {
                $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
            }
        } else {
            $data['sorting'] = 1;
        }
        /**
         * Get current list
         */
        $objList = new Models_List();
        $list = $objList->getAllLists();
        /**
         * Prepare for template
         */
        $this->view->data = $data;
        $this->view->list = $list;
        $this->view->headTitle(Nine_Language::translate('New List'));
    }
	
    public function manageListAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_list')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage List'));
        $this->view->menu = array('list', 'managelist');
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        /**
         * Get number of lists per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->listDisplayNum;
        } else {
            $this->session->listDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->listCondition;
        } else {
            $this->session->listCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        /**
         * get param id
         */
        $parentId = $this->_getParam('id');
        /**
         * Load all lists
         */
        $objList = new Models_List();
        $this->view->parentId = $parentId;
        if($parentId == null ){
            $allLists = $objList->getAllRootLists($condition, 'name ASC',
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                 );
        }
        else{
        	$allLists = $objList->getAllListsByParent($condition, 'name ASC',
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                 ,$parentId );
        	
        }
        /**
         * Count all lists
         */
        $count = count($objList->getAllRootLists($condition));
        /**
         * Set values for tempalte
         */
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allLists = $allLists;
        $this->view->listMessage = $this->session->listMessage;
        $this->session->listMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
    }
    

    
    
    public function deleteListAction()
    {
        
        $id = $this->_getParam('id', false);
        
        if (false == $id ) {
            $this->_redirect('list/admin/manage-list');
        }
        $ids = explode('_', trim($id, '_'));
        /**
         * 
         * check if item is parent of the other
         */
        
        
        $objList = new Models_List();
        	try {
        	 foreach ($ids as $id) {
               $objList->delete( array('list_id=?' => $id));
             }
             $this->session->listMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Delete value successfully')
                                           );
	        } catch (Exception $e) {
	            $this->session->listMessage = array(
	                                               'success' => false,
	                                               'message' => Nine_Language::translate('Can NOT delete this value. Please try again')
	                                           );
	        }
	        $this->_redirect('list/admin/manage-list');
        	
        
        
    }
    
    


    
   
   
}