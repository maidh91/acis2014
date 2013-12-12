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
require_once 'modules/permission/models/Permission.php';
require_once 'modules/permission/models/GroupPermission.php';
class permission_AdminController extends Nine_Controller_Action_Admin 
{
    
	
    public function managerAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_permission')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage Permissions'));
        $this->view->menu = array('usergroup', 'managepermission');
        
        $config = Nine_Registry::getConfig();
        /**
         * Load all groups
         */
        $objGroup = new Models_Group();
        /**
         * Set values for tempalte
         */
        $this->view->allGroups = $objGroup->getAll(array('sorting ASC', 'group_id ASC'))->toArray();
        /**
         * Get all applications
         */
        $allApps = Nine_Folder::getFolders('applications');
        foreach ($allApps as $index=>$app) {
            if (!is_dir("applications/{$app}")) {
                unset($allApps[$index]);
            }
        }
        $this->view->allApps = $allApps;
        
        /**
         * Get all modules
         */
        $allModules = Nine_Folder::getFolders('modules');
        foreach ($allModules as $index=>$module) {
            if (!is_dir("modules/{$module}")) {
                unset($allModules[$index]);
            }
        }
        $this->view->allModules = $allModules;
        
        $this->view->permissionMessage = $this->session->permissionMessage;
        $this->session->permissionMessage = null;
    }
    
    public function getPermissionAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_permission')) {
            die ("You don't have permission to do this action.");
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $groupId = $this->_getParam('groupId', false);
        $access  = $this->_getParam('access', false);
        
        if (false == $groupId || false == $access) {
            die ("'groupId' and 'access' is required");
        }
        $objGroupPer = new Models_GroupPermission();
        $objPer      = new Models_Permission();
        /**
         * Get all permissions
         */
        $allPers = $objGroupPer->getGroupPermission($groupId, $access);
//        echo '<pre>';print_r($allPers);die;
        /**
         * Check expand permisison
         */
        $checkedIds = array();
        foreach ($allPers as $index=>$per) {
            if (in_array($per['permission_id'], $checkedIds)) {
                unset($allPers[$index]);
                continue;
            } else {
                $checkedIds[] = $per['permission_id'];
            }
            if (null != @$per['expand_table_name']) {
                try {
                    $allPers[$index]['expand'] = $objPer->getExpandPermission($groupId, $access, $per);
                } catch (Exception $e) {
                    throw new Exception("Wrong expandable permission params. Check check again.");
                }
            } else {
                $allPers[$index]['expand'] = array();
            }
        }
//        echo '<pre>';print_r($allPers);die;
        $this->view->allPers = $allPers;
        $this->view->groupId = $groupId;
        $this->view->access  = $access;
    }
    
    public function rescanAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('rescan_permission')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        /**
         * Get all current permissions
         */
        $objPer = new Models_Permission();
        $allPers = $objPer->getAll();
        /**
         * Get all applications
         */
        $allApps = Nine_Folder::getFolders('applications');
        foreach ($allApps as $index=>$app) {
            if (is_dir("applications/{$app}")) {
                /**
                 * Check to all current application permissions
                 */
                $flag = false;
                foreach ($allPers as $per) {
                    if ($per['name'] == 'access' && $per['module'] == "application::{$app}") {
                        $flag = true;
                        break;
                    }
                }
                if (false == $flag) {
                    /**
                     * New application is found
                     */
                    $objPer->insert(array(
                                    'name' => 'access',
                                    'module' => "application::{$app}",
                                    'description' => "Access to '{$app}' application"
                                    ));
                }
            }
        }
    
        /**
         * Get all modules
         */
        $allModules = Nine_Folder::getFolders('modules');
        foreach ($allModules as $index=>$module) {
            if (is_dir("modules/{$module}")) {
                /**
                 * Get permission file
                 */
                $configPers = @include "modules/{$module}/config.php";
                $configPers = @$configPers['permissionRules'];
                if (! is_array($configPers) || empty($configPers)) {
                    /**
                     * Clear all permissions of this module
                     */
                    $objPer->delete(array('module=?' => $module));
                    continue;
                }
                /**
                 * Check to match permisison
                 */
                $existIds = array();
                foreach ($configPers as $key=>$desc) {
                    if (is_array($desc)) {
                        /**
                         * Expandable permission
                         * $per is array with 3 elements
                         */
                        $flag = false;
                        foreach ($allPers as $per) {
                            if (null == @$desc[0] || null == @$desc[1] || null == @$desc[2] || null == @$desc[3]) {
                                throw new Exception("Module '{$module}' has config with wrong expanded permission rules. 
                                                     It has to be array with 4 elements: Permisison string, expand_table_name, expand_table_id, expand_display_name");
                            }
                            if ($per['name'] == $key && $per['module'] == $module) {
                                $existIds[] = $per['permission_id'];
                                $flag = true;
                                if ($desc[0] != $per['description'] || $desc[1] != $per['expand_table_name']
                                    || $desc[2] != $per['expand_table_id'] || $desc[3] != $per['expand_display_name']) {
                                    $per->description         = $desc[0];
                                    $per->expand_table_name   = $desc[1];
                                    $per->expand_table_id     = $desc[2];
                                    $per->expand_display_name = $desc[3];
                                    
                                    $per->save();
                                }
                                break;
                            }
                        }
                        if (false == $flag) {
                            /**
                             * New permisison rule
                             */
                            $objPer->insert(array(
                                                'name'                => $key,
                                                'module'              => $module,
                                                'description'         => $desc[0],
                                                'expand_table_name'   => $desc[1],
                                                'expand_table_id'     => $desc[2],
                                                'expand_display_name' => $desc[3]
                                                ));
                        }
                    } else {
                        /**
                         * Nomarl permission
                         * 
                         * $per is string
                         */
                        $flag = false;
                        foreach ($allPers as $per) {
                            if ($per['name'] == $key && $per['module'] == $module) {
                                $existIds[] = $per['permission_id'];
                                $flag = true;
                                
                                if ($per['description'] != $desc || NULL != $per['expand_table_name']
                                    || NULL != $per['expand_table_id'] || NULL != $per['expand_display_name']) {
                                    $per->description = $desc;
                                    $per->expand_table_name = NULL;
                                    $per->expand_table_id = NULL;
                                    $per->expand_display_name = NULL;
                                    $per->save();
                                }
                                
                                break;
                            }
                        }
                        if (false == $flag) {
                            /**
                             * New permisison rule
                             */
                            $objPer->insert(array(
                                                'name'        => $key,
                                                'module'      => $module,
                                                'description' => $desc
                                                ));
                        }
                    }
                }
                /**
                 * Clear all un-used permission
                 */
                foreach ($allPers as $per) {
                    if ($per['module'] == $module && ! in_array($per['permission_id'], $existIds)) {
                        $objPer->delete(array('permission_id=?' => $per['permission_id']));
                    }
                }
            }
        }
        $this->session->permissionMessage = array(
                                           'success' => true,
                                           'message' => Nine_Language::translate('Rescan all permission rules successfully')
                                       );
        $this->_redirect('permission/admin/manager');
    }
    

    public function enablePermissionAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_permission')) {
            die ("You don't have permission to do this action.");
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $groupId = $this->_getParam('gid', false);
        $permissionId  = $this->_getParam('pid', false);
        $expandId = $this->_getParam('expandid', '*');
        
        if (false == $groupId || false == $permissionId) {
            die ("'gid' and 'pid' is required");
        }
        $objGroupPer = new Models_GroupPermission();
        if ('*' == $expandId) {
            /**
             * Normal permission
             */
            $groupper = $objGroupPer->getByColumns(array(
                                                            'group_id=?' => $groupId,
                                                            'permission_id=?' => $permissionId
                                                            ))->current();
            if (false == $groupper) {
                /**
                 * New group permisison
                 */
                $objGroupPer->insert(array(
                                        'group_id' => $groupId,
                                        'permission_id' => $permissionId,
                                        'enabled' => 1
                                        ));
            } else {
                /**
                 * Update existing item
                 */
                $groupper->enabled = 1;
                $groupper->save();
            }
        } else {
            /**
             * Is expandable permission
             */
            $groupper = $objGroupPer->getByColumns(array(
                                                            'group_id=?' => $groupId,
                                                            'permission_id=?' => $permissionId,
                                                            'expand_table_id=?' => $expandId
                                                            ))->current();
            if (false == $groupper) {
                /**
                 * New group permisison
                 */
                $objGroupPer->insert(array(
                                        'group_id' => $groupId,
                                        'permission_id' => $permissionId,
                                        'expand_table_id' => $expandId,
                                        'enabled' => 1
                                        ));
            } else {
                /**
                 * Update existing item
                 */
                $groupper->enabled = 1;
                $groupper->save();
            }
        }
        
        /**
         * Get current permisison
         */
        $objPer = new Models_Permission();
        $per    = $objPer->find($permissionId)->current(); 
        $this->_forward('get-permission', 'admin', 'permission', array('groupId' => $groupId, 'access' => $per['module']));
    }

    public function enableAllPermissionsAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_permission')) {
            die ("You don't have permission to do this action.");
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $groupId = $this->_getParam('gid', false);
        $permissionId  = $this->_getParam('pid', false);
        
        if (false == $groupId || false == $permissionId) {
            die ("'gid' and 'pid' is required");
        }
        $objGroupPer = new Models_GroupPermission();
        $objPer      = new Models_Permission();
        $per = $objPer->find($permissionId)->toArray();
        $per = @reset($per);
        if (null == @$per['expand_table_name']) {
            /**
             * Normal permission
             */
            $groupper = $objGroupPer->getByColumns(array(
                                                            'group_id=?' => $groupId,
                                                            'permission_id=?' => $permissionId
                                                            ))->current();
            if (false == $groupper) {
                /**
                 * New group permisison
                 */
                $objGroupPer->insert(array(
                                        'group_id' => $groupId,
                                        'permission_id' => $permissionId,
                                        'enabled' => 1
                                        ));
            } else {
                /**
                 * Update existing item
                 */
                $groupper->enabled = 1;
                $groupper->save();
            }
        } else {
            /**
             * Is expandable permission
             */
            $allExpandValues = $objPer->getAllExpandValues($per['expand_table_name'], $per['expand_table_id']);
            foreach ($allExpandValues as $value) {
                $groupper = $objGroupPer->getByColumns(array(
                                                                'group_id=?' => $groupId,
                                                                'permission_id=?' => $permissionId,
                                                                'expand_table_id=?' => $value['expand_value']
                                                                ))->current();
                if (false == $groupper) {
                    /**
                     * New group permisison
                     */
                    $objGroupPer->insert(array(
                                            'group_id' => $groupId,
                                            'permission_id' => $permissionId,
                                            'expand_table_id' => $value['expand_value'],
                                            'enabled' => 1
                                            ));
                } else {
                    /**
                     * Update existing item
                     */
                    $groupper->enabled = 1;
                    $groupper->save();
                }
            }
        }
               
        /**
         * Get current permisison
         */
        $objPer = new Models_Permission();
        $per    = $objPer->find($permissionId)->current(); 
        $this->_forward('get-permission', 'admin', 'permission', array('groupId' => $groupId, 'access' => $per['module']));
    }

    public function disablePermissionAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_permission')) {
            die ("You don't have permission to do this action.");
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $groupId = $this->_getParam('gid', false);
        $permissionId  = $this->_getParam('pid', false);
        $expandId = $this->_getParam('expandid', '*');
        
        if (false == $groupId || false == $permissionId) {
            die ("'gid' and 'pid' is required");
        }
        $objGroupPer = new Models_GroupPermission();
        if ('*' == $expandId) {
            /**
             * Normal permission
             */
            $objGroupPer->update(array('enabled' => 0), array(
                                                            'group_id=?' => $groupId,
                                                            'permission_id=?' => $permissionId
                                                            ));
        } else {
            /**
             * Is expandable permission
             */
            $objGroupPer->update(array('enabled' => 0), array(
                                                            'group_id=?' => $groupId,
                                                            'permission_id=?' => $permissionId,
                                                            'expand_table_id=?' => $expandId
                                                            ));
        }
        
        /**
         * Get current permisison
         */
        $objPer = new Models_Permission();
        $per    = $objPer->find($permissionId)->current(); 
        $this->_forward('get-permission', 'admin', 'permission', array('groupId' => $groupId, 'access' => $per['module']));
    }
    public function disableAllPermissionsAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_permission')) {
            die ("You don't have permission to do this action.");
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $groupId = $this->_getParam('gid', false);
        $permissionId  = $this->_getParam('pid', false);
        
        if (false == $groupId || false == $permissionId) {
            die ("'gid' and 'pid' is required");
        }
        $objGroupPer = new Models_GroupPermission();
        /**
         * Update all current permissions
         */
        $objGroupPer->update(array('enabled' => 0), array(
                                                        'group_id=?' => $groupId,
                                                        'permission_id=?' => $permissionId
                                                        ));
        
        /**
         * Get current permisison
         */
        $objPer = new Models_Permission();
        $per    = $objPer->find($permissionId)->current(); 
        $this->_forward('get-permission', 'admin', 'permission', array('groupId' => $groupId, 'access' => $per['module']));
    }
}