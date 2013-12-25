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
require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';
require_once 'modules/language/models/Lang.php';
class content_AdminController extends Nine_Controller_Action_Admin 
{
    
    public function manageContentAction()
    {
        $objContent = new Models_Content();
        $objLang    = new Models_Lang();
        $objCat     = new Models_ContentCategory();
        
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_content', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('manage Content '));
        $this->view->menu = array('content', 'managecontent');
        
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        /**
         * Update sorting
         */
        $data = $this->_getParam('data', array());
        foreach ($data as $id=>$value) {
            $value = intval($value);
            if (1 > $value) {
                continue;
            }
            $objContent->update(array('sorting' => $value), array('content_gid=?' => $id));
            $this->session->contentMessage = array(
                                       'success' => true,
                                       'message' => Nine_Language::translate("Content Order is edited successfully")
                                   );
        }
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->contentDisplayNum;
        } else {
            $this->session->contentDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->contentCondition;
        } else {
            $this->session->contentCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        
        /**
         * Get all categories
         */
        $this->view->allCats = $objCat->buildTree($objCat->getAll(array('sorting ASC'))->toArray());
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $index => $lang) {
            if (false == $this->checkPermission('see_content', null, $lang['lang_id'])) {
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
            }
        }
  
        
        /**
         * Get all contents
         */
        
        
        $allContent = $objContent->setAllLanguages(true)->getAllContent($condition, array('sorting ASC', 'content_gid DESC', 'content_id ASC'),
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                  );
//                                                  echo "<pre>";print_r($allContent);die;
//        echo '<pre>';print_r($allContent);die;
//$g = array('83');
//$x= $objContent->setAllLanguages(true)->getAllEnabledContentBygId($g,null);
//echo "<pre>";print_r($x);die;
        /**
         * Count all contents
         */
        $count = count($objContent->setAllLanguages(true)->getallContent($condition));
        /**
         * Format
         */
        $tmp    = array();
        $tmp2   = false;
        $tmpGid = @$allContent[0]['content_gid'];
        foreach ($allContent as $index=>$content) {
            /**
             * Change date
             */
            if (0 != $content['created_date']) {
                $content['created_date'] = date($config['dateFormat'], $content['created_date']);
            } else {
                $content['created_date'] = '';
            }
            if (0 != $content['update_date']) {
            	$content['update_date'] = date($config['dateFormat'], $content['update_date']);
            } else {
            	$content['update_date'] = '';
            }
            if (0 != $content['publish_up_date']) {
                $content['publish_up_date'] = date($config['dateFormat'], $content['publish_up_date']);
            } else {
                $content['publish_up_date'] = '';
            }
            if (0 != $content['publish_down_date']) {
                $content['publish_down_date'] = date($config['dateFormat'], $content['publish_down_date']);
            } else {
                $content['publish_down_date'] = '';
            }
            if ($tmpGid != $content['content_gid']) {
                $tmp[]  = $tmp2;
                $tmp2   = false;
                $tmpGid = $content['content_gid'];
            }
            if (false === $tmp2) {
                $tmp2        = $content;
                $tmp2['hit'] = 0;
            }
            $tmp2['hit']    += $content['hit'];
            $tmp2['langs'][]  = $content;
            /**
             * Final element
             */
            if ($index == count($allContent) - 1) {
                $tmp[] = $tmp2;
            }
        }
        $allContent = $tmp;
        /**
         * Set values for tempalte
         */
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allContent = $allContent;
        $this->view->contentMessage = $this->session->contentMessage;
        $this->session->contentMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
        $this->view->fullPermisison = $this->checkPermission('see_content');
        $this->view->allLangs = $allLangs;
//    echo "<pre>";print_r($allContent);die;
    }
    
    public function newContentAction()
    {
        $objCat = new Models_ContentCategory();
        $objLang = new Models_Lang();
        $objContent = new Models_Content();
        /**
         * Check permission
         */
        if (false == $this->checkPermission('new_content', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data = $this->_getParam('data', false);
//         echo "<pre>";print_r($data);die;
        /**
         * Get all categories
         */
        $allCats = $objCat->buildTree($objCat->getAll(array('sorting ASC'))->toArray());
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $index => $lang) {
            if (false == $this->checkPermission('new_content', null, $lang['lang_id'])) {
                /**
                 * Clear data
                 */
                unset($data[$lang['lang_id']]);
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
            }
        }
        
        $errors = array();
        if (false !== $data) {
            /**
             * Insert new content
             */
            $newContent = $data;
            $newContent['created_date'] = time();
            $newContent['update_date'] = time();
            /**
             * Change format date
             */
//             if (null == $newContent['publish_up_date']) {
//                 unset($newContent['publish_up_date']);
//             } else {
//                 $tmp = explode('/', $newContent['publish_up_date']);
//                 $newContent['publish_up_date'] = mktime(0, 0, 0, $tmp[0], $tmp[1], $tmp[2]);
//             }
//             if (null == $newContent['publish_down_date']) {
//                 unset($newContent['publish_down_date']);
//             } else {
//                 $tmp = explode('/', $newContent['publish_down_date']);
//                 $newContent['publish_down_date'] = mktime(0, 0, 0, $tmp[0], $tmp[1], $tmp[2]);
//             }
            /**
             * Sorting
             */
//             if (null == $newContent['sorting']) {
//                 unset($newContent['sorting']);
//             }
//             if (false == $this->checkPermission('new_content', null, '*')) {
//                 $newContent['genabled']          = 0;
//                 $newContent['publish_up_date']   = null;
//                 $newContent['publish_down_date'] = null;
//                 $newContent['sorting']           = 1;
//             }
        
            /**
             * Slipt intro_text & full_text
             */
            foreach ($allLangs as $index => $lang) {
                 list($newContent[$lang['lang_id']]['intro_text'], $newContent[$lang['lang_id']]['full_text'])= Nine_Function::splitTextWithReadmore($newContent[$lang['lang_id']]['full_text']);
            }
            /**
             * Remove empty images
             */
            if (is_array($newContent['images'])) {
                foreach ($newContent['images'] as $index => $image) {
                    if (null == $image) {
                        unset($newContent['images'][$index]);
                    } else {
                        $newContent['images'][$index] = Nine_Function::getImagePath($image);
                    }
                }
            }
            $newContent['images'] = implode('||', $newContent['images']);
//             try {
                /**
                 * Increase all current sortings
                 */
//                 if (1 > $newContent['sorting']) {
//                     $newContent['sorting'] = 1;
//                 }
                $newContent['sorting'] = 1;
                $objContent->increaseSorting($newContent['sorting'], 1);
//                 echo "<pre>";print_r($newContent);die;
                $objContent->insert($newContent);
                /**
                 * Message
                 */
                $this->session->contentMessage =  array(
                           'success' => true,
                           'message' => Nine_Language::translate('Content is created successfully.')
                        );
//                echo "<pre>HERE";die;
                $this->_redirect('content/admin/manage-content');
//             } catch (Exception $e) {
//                 $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
//             }
        } else {
            $data = array('sorting' => 1);
        }
        /**
         * Prepare for template
         */
        $this->view->allCats = $allCats;
        $this->view->allLangs = $allLangs;
        $this->view->errors = $errors;
        $this->view->datepickerFormat = Nine_Registry::getConfig('datepickerFormat');
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('New Content'));
        $this->view->menu = array('content', 'newcontent');
        $this->view->fullPermisison = $this->checkPermission('new_content', null, '*'); 
    }
    

    
    public function editContentAction()
    {
        $objContent = new Models_Content();
        $objCat     = new Models_ContentCategory();
        $objLang    = new Models_Lang();
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_content', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $gid     = $this->_getParam('gid', false);
        $lid    = $this->_getParam('lid', false); 
        if (false == $gid) {
            $this->_redirect('content/admin/manage-content');
        }
        /**
         * Check permission
         */
        if ((false == $lid && false == $this->checkPermission('edit_content', null, '*'))
        ||  (false != $lid && false == $this->checkPermission('edit_content', null, $lid))) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data   = $this->_getParam('data', false);
        
        /**
         * Get all categories
         */
        $allCats = $objCat->buildTree($objCat->getAll(array('sorting ASC'))->toArray());
        /**
         * Get all content languages
         */
        
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
//        echo "<pre>";print_r($allLangs);die;
        $allContentLangs = $objContent->setAllLanguages(true)->getByColumns(array('content_gid=?' => $gid))->toArray();
//        echo "<pre>";print_r($allContentLangs);die;
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $lang) {
            if (false == $this->checkPermission('edit_content', null, $lang['lang_id'])) {
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
                unset($allContentLangs[$lang['lang_id']]);
                unset($data[$lang['lang_id']]);
            }
        }
        
        $errors = array();
        if (false !== $data) {
            /**
             * Insert new content
             */
            $newContent = $data;
//            echo "<pre>";print_r($newContent);die;
            /**
             * Change format date
             */
            if (null != $newContent['publish_up_date']) {
                $tmp = explode('/', $newContent['publish_up_date']);
                $newContent['publish_up_date'] = mktime(0, 0, 0, $tmp[0], $tmp[1], $tmp[2]);
            }
            if (null != $newContent['publish_down_date']) {
                $tmp = explode('/', $newContent['publish_down_date']);
                $newContent['publish_down_date'] = mktime(0, 0, 0, $tmp[0], $tmp[1], $tmp[2]);
            }
            $newContent['update_date'] = time();
           
            /**
             * Sorting
             */
         	if (null == $newContent['sorting']){
                unset($newContent['sorting']);
            }
            if (false == $this->checkPermission('new_content', null, '*')) {
                unset($newContent['genabled']);
                unset($newContent['publish_up_date']);
                unset($newContent['publish_down_date']);
                unset($newContent['sorting']);
            }
        
            /**
             * Slipt intro_text & full_text
             */
            foreach ($allLangs as $index => $lang) {
                 list($newContent[$lang['lang_id']]['intro_text'], $newContent[$lang['lang_id']]['full_text'])= Nine_Function::splitTextWithReadmore($newContent[$lang['lang_id']]['full_text']);
            }
            /**
             * Remove empty images
             */
            if (is_array($newContent['images'])) {
                foreach ($newContent['images'] as $index => $image) {
                    if (null == $image) {
                        unset($newContent['images'][$index]);
                    } else {
                        $newContent['images'][$index] = Nine_Function::getImagePath($image);
                    }
                }
            }
            $newContent['images'] = implode('||', $newContent['images']);
//            echo "<pre>";print_r($newContent);die;
//            try {
                /**                
                 * Update
                 */
                
                $objContent->update($newContent, array('content_gid=?' => $gid));
                /**
                 * Message
                 */
                $this->session->contentMessage =  array(
                           'success' => true,
                           'message' => Nine_Language::translate('Content is updated successfully.')
                        );
                
                $this->_redirect('content/admin/manage-content');
//            } catch (Exception $e) {
//                $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
//            }
        } else {
            /**
             * Get old data
             */
            $data = @reset($allContentLangs);
            
            if (false == $data) {
                $this->session->contentMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate("Content doesn't exist.")
                                           );
                $this->_redirect('content/admin/manage-content');
            }
            /**
             * Change date
             */
            if (0 != $data['publish_up_date']) {
                 $data['publish_up_date'] = date('m/d/Y', $data['publish_up_date']);
            } else {
                $data['publish_up_date'] = '';
            }
            if (0 != $data['publish_down_date']) {
                 $data['publish_down_date'] = date('m/d/Y', $data['publish_down_date']);
            } 
        	else {
                $data['publish_down_date'] = '';
            }
            /**
             * Format image
             */
            $data['images'] = explode('||', $data['images']);
            if (! is_array($data['images'])) {
                $data['images'] = array();
            }
            $data['images'] = array_pad($data['images'], 50, null);
            /**
             * Get all lang contents
             */
            foreach ($allContentLangs as $content) {
                /**
                 * Rebuild readmore DIV
                 */
                $content['full_text'] = Nine_Function::combineTextWithReadmore($content['intro_text'], $content['full_text']);
                $data[$content['lang_id']] = $content;
            }
            
            /**
             * Add deleteable field
             */
            if (null != @$data['content_category_gid']) {
            	$cat = @reset($objCat->getByColumns(array('content_category_gid' => $data['content_category_gid']))->toArray());
            	$data['content_deleteable'] = @$cat['content_deleteable'];
            }
        }
        /**
         * Prepare for template
         */
        $this->view->allCats = $allCats;
        $this->view->allLangs = $allLangs;
        $this->view->datepickerFormat = Nine_Registry::getConfig('datepickerFormat');
        $this->view->lid = $lid;
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit Content'));
       	$this->view->menu = array('content','');
        $this->view->fullPermisison = $this->checkPermission('edit_content', null, '*');
    }

    public function enableContentAction()
    {
        $objContent = new Models_Content();
        $gid = $this->_getParam('gid', false);
        $lid = $this->_getParam('lid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-content');
        }
        
        $gids = explode('_', trim($gid, '_'));
        if (false == $lid) {
            /**
             * Change general status
             * Check full permission
             */
            if (false == $this->checkPermission('edit_content', null, '*')) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objContent->update(array('genabled' => 1), array('content_gid=?' => $gid));
                }
                $this->session->contentMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Content is enable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->contentMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT activate this content. Please try again')
                                               );
            }
        
        } else {
            /**
             * Check permission on each language
             */
            if (false == $this->checkPermission('edit_content', null, $lid)) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objContent->update(array('enabled' => 1), array('content_gid=?' => $gid, 'lang_id=?' => $lid));
                }
                $this->session->contentMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Content is enable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->contentMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT activate this content. Please try again')
                                               );
            }
        }
        
        
        $this->_redirect('content/admin/manage-content');
    }

    
    public function disableContentAction()
    {
        $objContent = new Models_Content();
        $gid = $this->_getParam('gid', false);
        $lid = $this->_getParam('lid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-content');
        }
        
        $gids = explode('_', trim($gid, '_'));
        if (false == $lid) {
            /**
             * Change general status
             * Check full permission
             */
            if (false == $this->checkPermission('edit_content', null, '*')) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objContent->update(array('genabled' => 0), array('content_gid=?' => $gid));
                }
                $this->session->contentMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Content is disable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->contentMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT deactive this content. Please try again')
                                               );
            }
        
        } else {
            /**
             * Check permission on each language
             */
            if (false == $this->checkPermission('edit_content', null, $lid)) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objContent->update(array('enabled' => 0), array('content_gid=?' => $gid, 'lang_id=?' => $lid));
                }
                $this->session->contentMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Content is disable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->contentMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT deactive this content. Please try again')
                                               );
            }
        }
        
        
        $this->_redirect('content/admin/manage-content');
    }
    
    public function deleteContentAction()
    {
        $objContent = new Models_Content();
        $objCat = new Models_ContentCategory();
        /**
         * Check permission
         */
        if (false == $this->checkPermission('delete_content')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $gid = $this->_getParam('gid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-content');
        }
        
        $gids = explode('_', trim($gid, '_'));
        
        try {
            foreach ($gids as $gid) {
//             	echo "<pre>";print_r($gids);die;
            	
            	$content = @reset($objContent->getByColumns(array('content_gid=?'=>$gid))->toArray());
            	$cat = @reset($objCat->getByColumns(array('content_category_gid=?'=>$content['content_category_gid']))->toArray());
//             	echo "<pre>";print_r($cat);die;
//             	if ( 0 == $cat['content_deleteable']){
//             		$this->session->contentMessage = array(
//                                                'success' => false,
//                                                'message' => Nine_Language::translate('Can NOT delete content ('. $gid .'). Please try again')
//                                            );
//                     $this->_redirect('content/admin/manage-content');
//             	}
//             	else {
            		$objContent->delete(array('content_gid=?' => $gid));
//             	}
              
            }
            $this->session->contentMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Content is deleted successfully')
                                           );
        } catch (Exception $e) {
            $this->session->contentMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete this content. Please try again')
                                           );
        }
        $this->_redirect('content/admin/manage-content');
    }
    
    
    /**************************************************************************************************
     *                                         CATEGORY's FUNCTIONS
     **************************************************************************************************/
    public function manageCategoryAction()
    {
        $objLang    = new Models_Lang();
        $objCategory     = new Models_ContentCategory();
        
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_category', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('manage Category '));
        $this->view->menu = array('content', 'managecontentcategory');
        
        
        $config = Nine_Registry::getConfig();
        $numRowPerPage = Nine_Registry::getConfig("defaultNumberRowPerPage");
        $currentPage = $this->_getParam("page",1);
        $displayNum = $this->_getParam('displayNum', false);
        
        /**
         * Update sorting
         */
        $data = $this->_getParam('data', array());
        foreach ($data as $id=>$value) {
            $value = intval($value);
            if (1 > $value) {
                continue;
            }
            $objCategory->update(array('sorting' => $value), array('content_category_id=?' => $id));
            $this->session->categoryMessage = array(
                                       'success' => true,
                                       'message' => Nine_Language::translate("Edit sort numbers successfully")
                                   );
        }
        
        /**
         * Get number of items per page
         */
        if (false === $displayNum) {
            $displayNum = $this->session->categoryDisplayNum;
        } else {
            $this->session->categoryDisplayNum = $displayNum;
        }
        if (null != $displayNum) {
            $numRowPerPage = $displayNum;
        }
        /**
         * Get condition
         */
        $condition = $this->_getParam('condition', false);
        if (false === $condition) {
            $condition = $this->session->categoryCondition;
        } else {
            $this->session->categoryCondition = $condition;
            $currentPage = 1;
        }
        if (false == $condition) {
            $condition = array();
        }
        
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
//        echo "<pre>";print_r($allLangs);die;
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $index => $lang) {
            if (false == $this->checkPermission('see_category', null, $lang['lang_id'])) {
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
            }
        }
        $addLang =  Nine_Registry::getConfig("addNewLang");
        if(true == $addLang){
        	$defaultLang = Nine_Registry::getConfig("defaultLang");
        	$newLang = Nine_Registry::getConfig("newLang");
        	$objCategory->setAllLanguages(true)->synLang($defaultLang, $newLang);
        }
        
        
        /**
         * Get all categorys
         */
        
        $allCategories  = $objCategory->setAllLanguages(true)->getallCategories($condition, array('sorting ASC', 'content_category_gid DESC', 'content_category_id ASC'),
                                                   $numRowPerPage,
                                                   ($currentPage - 1) * $numRowPerPage
                                                  );
//        echo '<pre>';print_r($allCategories);die;
        /**
         * Count all categorys
         */
        $count = count($objCategory->setAllLanguages(true)->getallCategories($condition));
        /**
         * Format
         */
        $tmp    = array();
        $tmp2   = false;
        $tmpGid = @$allCategories[0]['content_category_gid'];
        foreach ($allCategories as $index=>$category) {
            /**
             * Change date
             */
            if (0 != $category['created_date']) {
                $category['created_date'] = date($config['dateFormat'], $category['created_date']);
            } else {
                $category['created_date'] = '';
            }
            if ($tmpGid != $category['content_category_gid']) {
                $tmp[]  = $tmp2;
                $tmp2   = false;
                $tmpGid = $category['content_category_gid'];
            }
            if (false === $tmp2) {
                $tmp2        = $category;
            }
            $tmp2['langs'][]  = $category;
            /**
             * Final element
             */
            if ($index == count($allCategories) - 1) {
                $tmp[] = $tmp2;
            }
        }
        $allCategories = $tmp;
//        echo '<pre>';print_r($allCategories);die;
        /**
         * Set values for tempalte
         */
        $this->setPagination($numRowPerPage, $currentPage, $count);
        $this->view->allCategories = $allCategories;
        $this->view->categoryMessage = $this->session->categoryMessage;
        $this->session->categoryMessage = null;
        $this->view->condition = $condition;
        $this->view->displayNum = $numRowPerPage;
        $this->view->fullPermisison = $this->checkPermission('see_category');
        $this->view->allLangs = $allLangs;
    }
    
    public function newCategoryAction()
    {
        $objLang = new Models_Lang();
        $objCategory = new Models_ContentCategory;
        /**
         * Check permission
         */
        if (false == $this->checkPermission('new_category', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data = $this->_getParam('data', false);
        /**
         * Get all categories
         */
        $allCats = $objCategory->buildTree($objCategory->getAll(array('sorting ASC'))->toArray());
//        echo "<pre>";print_r($allCats);die; 
        /**
         * Get all display languages
         */
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $index => $lang) {
            if (false == $this->checkPermission('new_category', null, $lang['lang_id'])) {
                /**
                 * Clear data
                 */
                unset($data[$lang['lang_id']]);
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
            }
        }
        
        $errors = array();
        if (false !== $data) {
            /**
             * Insert new category
             */
            $newCategory = $data;
            $newCategory['created_date'] = time();
            /**
             * Sorting
             */
            if (null == $newCategory['sorting']) {
                unset($newCategory['sorting']);
            }
            if (false == $this->checkPermission('new_category', null, '*')) {
                $newCategory['genabled']          = 0;
                $newCategory['sorting']           = 1;
            }
        
            /**
             * Remove empty images
             */
            if (is_array($newCategory['images'])) {
                foreach ($newCategory['images'] as $index => $image) {
                    if (null == $image) {
                        unset($newCategory['images'][$index]);
                    } else {
                        $newCategory['images'][$index] = Nine_Function::getImagePath($image);
                    }
                }
            }
            $newCategory['images'] = implode('||', $newCategory['images']);
            try {
                /**
                 * Increase all current sortings
                 */
                if (1 > @$newCategory['sorting']) {
                    $newCategory['sorting'] = 1;
                }
                if (null == $newCategory['parent_id']) {
                	$newCategory['parent_id'] = NULL;
                }
                $objCategory->increaseSorting($newCategory['sorting'], 1);

                $gid = $objCategory->insert($newCategory);
                
                /**
                 * Update id string
                 */
                $objCategory->update(array('gid_string'	=>	$gid), array('content_category_gid = ?' => $gid));
                $category = @reset($objCategory->getByColumns(array('content_category_gid = ?' => $gid))->toArray());
                $objCategory->updateGidString($category['parent_id'], $category['gid_string']);
                /**
                 * Message
                 */
                $this->session->categoryMessage =  array(
                           'success' => true,
                           'message' => Nine_Language::translate('Category is created successfully.')
                        );
                
                $this->_redirect('content/admin/manage-category');
            } catch (Exception $e) {
                $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
            }
        } else {
            $data = array('sorting' => 1);
        }
        /**
         * Prepare for template
         */
        $this->view->allCats = $allCats;
        $this->view->allLangs = $allLangs;
        $this->view->errors = $errors;
        $this->view->datepickerFormat = Nine_Registry::getConfig('datepickerFormat');
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('New Category'));
        $this->view->menu = array('content', 'newcontentcategory');
        $this->view->fullPermisison = $this->checkPermission('new_category', null, '*'); 
    }
    

    
    public function editCategoryAction()
    {
        $objCategory     = new Models_ContentCategory();
        $objLang    = new Models_Lang();
        /**
         * Check permission
         */
        if (false == $this->checkPermission('edit_category', null, '?')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $gid     = $this->_getParam('gid', false);
        $lid    = $this->_getParam('lid', false); 
        if (false == $gid) {
            $this->_redirect('content/admin/manage-category');
        }
        /**
         * Check permission
         */
        if ((false == $lid && false == $this->checkPermission('edit_category', null, '*'))
        ||  (false != $lid && false == $this->checkPermission('edit_category', null, $lid))) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $data   = $this->_getParam('data', false);
        
        /**
         * Get all categories
         */
        $allCats = $objCategory->buildTree($objCategory->getAll(array('sorting ASC'))->toArray());
        
        /**
         * Get all category languages
         */
        
        $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
        $allCategoryLangs = $objCategory->setAllLanguages(true)->getByColumns(array('content_category_gid=?' => $gid))->toArray();
//        echo "<pre>";print_r($allCategoryLangs);die; 
        /**
         * Check permisison for each language
         */
        foreach ($allLangs as $lang) {
            if (false == $this->checkPermission('edit_category', null, $lang['lang_id'])) {
                /**
                 * Disappear this language
                 */
                unset($allLangs[$index]);
                unset($allCategoryLangs[$lang['lang_id']]);
                unset($data[$lang['lang_id']]);
            }
        }
        
        $errors = array();
        if (false !== $data) {
            /**
             * Insert new category
             */
            $newCategory = $data;
            /**
             * Sorting
             */
            if (null == $newCategory['sorting']) {
                unset($newCategory['sorting']);
            }
            if (false == $this->checkPermission('new_category', null, '*')) {
                unset($newCategory['genabled']);
                unset($newCategory['sorting']);
            }
        
            /**
             * Remove empty images
             */
            if (is_array($newCategory['images'])) {
                foreach ($newCategory['images'] as $index => $image) {
                    if (null == $image) {
                        unset($newCategory['images'][$index]);
                    } else {
                        $newCategory['images'][$index] = Nine_Function::getImagePath($image);
                    }
                }
            }
            $newCategory['images'] = implode('||', $newCategory['images']);
            try {
                /**                
                 * Update
                 */
              	if (null == $newCategory['parent_id']) {
                	$newCategory['parent_id'] = NULL;
                }
                /**
                 * Delete gid in parent
                 */
                $oldCategory = @reset($allCategoryLangs);
//                echo "<pre>";print_r($oldCategory);die; 
                $objCategory->deleteGidString($oldCategory['parent_id'], $oldCategory['gid_string']);
                
                /**
                 * Update new data
                 */
                $objCategory->update($newCategory, array('content_category_gid=?' => $gid));
                
                /**
                 * Update new id string
                 */
                $category = @reset($objCategory->getByColumns(array('content_category_gid = ?' => $gid))->toArray());
                $objCategory->updateGidString($category['parent_id'], $category['gid_string']);
                
                /**
                 * Message
                 */
                $this->session->categoryMessage =  array(
                           'success' => true,
                           'message' => Nine_Language::translate('Category is updated successfully.')
                        );
                
                $this->_redirect('content/admin/manage-category');
            } catch (Exception $e) {
                $errors = array('main' => Nine_Language::translate('Can not insert into database now'));
            }
        } else {
            /**
             * Get old data
             */
            $data = @reset($allCategoryLangs);
            if (false == $data) {
                $this->session->categoryMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate("Category doesn't exist.")
                                           );
                $this->_redirect('content/admin/manage-category');
            }
            /**
             * Format image
             */
            $data['images'] = explode('||', $data['images']);
            if (! is_array($data['images'])) {
                $data['images'] = array();
            }
            $data['images'] = array_pad($data['images'], 50, null);
            /**
             * Get all lang categorys
             */
            foreach ($allCategoryLangs as $category) {
                $data[$category['lang_id']] = $category;
            }
            
             /**
             * Get all child category
             */
            $allChildCats = explode(',',trim($data['gid_string'],','));
            unset($allChildCats[0]);
           	foreach($allCats as $key =>	$item) {
           		if (false != in_array($item, $allChildCats)) {
           			unset($allCats[$key]);
           		}
           	}
        }
        /**
         * Prepare for template
         */
        $this->view->allCats = $allCats;
        $this->view->allLangs = $allLangs;
        $this->view->datepickerFormat = Nine_Registry::getConfig('datepickerFormat');
        $this->view->lid = $lid;
        $this->view->errors = $errors;
        $this->view->data = $data;
        $this->view->headTitle(Nine_Language::translate('Edit Category'));
        $this->view->menu = array('content','');
        $this->view->fullPermisison = $this->checkPermission('edit_category', null, '*');
    }

    public function enableCategoryAction()
    {
        $objCategory = new Models_ContentCategory;
        $gid = $this->_getParam('gid', false);
        $lid = $this->_getParam('lid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-category');
        }
        
        $gids = explode('_', trim($gid, '_'));
        if (false == $lid) {
            /**
             * Change general status
             * Check full permission
             */
            if (false == $this->checkPermission('edit_category', null, '*')) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objCategory->update(array('genabled' => 1), array('content_category_gid=?' => $gid));
                }
                $this->session->categoryMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Category is enable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->categoryMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT activate this category. Please try again')
                                               );
            }
        
        } else {
            /**
             * Check permission on each language
             */
            if (false == $this->checkPermission('edit_category', null, $lid)) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objCategory->update(array('enabled' => 1), array('content_category_gid=?' => $gid, 'lang_id=?' => $lid));
                }
                $this->session->categoryMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Category is enable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->categoryMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT activate this category. Please try again')
                                               );
            }
        }
        
        
        $this->_redirect('content/admin/manage-category');
    }

    
    public function disableCategoryAction()
    {
        $objCategory = new Models_ContentCategory;
        $gid = $this->_getParam('gid', false);
        $lid = $this->_getParam('lid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-category');
        }
        
        $gids = explode('_', trim($gid, '_'));
        if (false == $lid) {
            /**
             * Change general status
             * Check full permission
             */
            if (false == $this->checkPermission('edit_category', null, '*')) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objCategory->update(array('genabled' => 0), array('content_category_gid=?' => $gid));
                }
                $this->session->categoryMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Category is disable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->categoryMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT deactive this category. Please try again')
                                               );
            }
        
        } else {
            /**
             * Check permission on each language
             */
            if (false == $this->checkPermission('edit_category', null, $lid)) {
                $this->_forwardToNoPermissionPage();
                return;
            }
            try {
                foreach ($gids as $gid) {
                   $objCategory->update(array('enabled' => 0), array('content_category_gid=?' => $gid, 'lang_id=?' => $lid));
                }
                $this->session->categoryMessage = array(
                                                   'success' => true,
                                                   'message' => Nine_Language::translate('Category is disable successfully')
                                               );
            } catch (Exception $e) {
                $this->session->categoryMessage = array(
                                                   'success' => false,
                                                   'message' => Nine_Language::translate('Can NOT deactive this category. Please try again')
                                               );
            }
        }
        
        
        $this->_redirect('content/admin/manage-category');
    }
    
    public function deleteCategoryAction()
    {
        $objCategory = new Models_ContentCategory;
        /**
         * Check permission
         */
        if (false == $this->checkPermission('delete_category')) {
            $this->_forwardToNoPermissionPage();
            return;
        }
        
        $gid = $this->_getParam('gid', false);
        
        if (false == $gid) {
            $this->_redirect('content/admin/manage-category');
        }
        
        $gids = explode('_', trim($gid, '_'));
        
        try {
            foreach ($gids as $gid) {
            	
            	$cat = @reset($objCategory->getByColumns(array('content_category_gid=?'=>$gid))->toArray());
            	if ( 0 == $cat['content_deleteable']){
            		$this->session->categoryMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete category ('. $gid .'). Please try again')
                                           );
                    $this->_redirect('content/admin/manage-category');
            	}
            	else {
            		$objCategory->delete(array('content_category_gid=?' => $gid));
            	}
            }
            $this->session->categoryMessage = array(
                                               'success' => true,
                                               'message' => Nine_Language::translate('Category is deleted successfully')
                                           );
        } catch (Exception $e) {
            $this->session->categoryMessage = array(
                                               'success' => false,
                                               'message' => Nine_Language::translate('Can NOT delete this category. Please try again')
                                           );
        }
        $this->_redirect('content/admin/manage-category');
    }
}