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
require_once 'Nine/Folder.php';
require_once 'Nine/Language.php';
require_once 'modules/language/models/Lang.php';

class language_TranslationController extends Nine_Controller_Action_Admin 
{
    
	
    public function manageAction()
    {
        /**
         * Check translation
         */
        if (false == $this->checkPermission('see_translation')) {
            $this->_forwardToNoTranslationPage();
            return;
        }
        
        $this->view->headTitle(Nine_Language::translate('Manage Translations'));
      
        $this->view->menu = array('others', 'manage-translation');
        
        $config = Nine_Registry::getConfig();
        
        
     /* 
         * get all language
         * 
         * @var unknown_type
         */
        
        $list = Nine_Folder::readdir('languages');
        $allLayouts = array();
        $allModules = array();
        $allStickers = array();
        foreach ($list as $index=>$langs) {
             if (is_file('languages'.'/'.$langs)){
            	$item = explode('.', $list[$index]);
            	$file[] = array(
            		'atype' 	=> 	$item[0],
            		'access'	=>	$item[1],
            		'language'	=>	$item[2],
            		'content'	=>	include 'languages/'.$langs
            	);
            	
            }
        }
        
        $a1 = 0;
        $b1 =0;
        $c1=0;
        foreach ($file as $item) {
        		if($item['atype']== 'layout'){
        			if(0 == $b1){
            			$allLayouts [] = $item['access'];
            			$b1 = 1;
            		}
            		else{
		            	$b2 = 0;
		        		foreach ($allLayouts as $module) {
		        			if($item['access']== $module){
		        				$b2 = 1;
		        				break;
		        			}        			
		        		}
		        		if (0 == $b2){
		        			$allLayouts [] = $item['access'];
		        		}
            		}
            	}
            	elseif ($item['atype'] == 'module'){
            		if(0 == $a1){
            			$allModules [] = $item['access'];
            			$a1 = 1;
            		}
            		else{
		            	$a2 = 0;
		        		foreach ($allModules as $module) {
		        			if($item['access']== $module){
		        				$a2 = 1;
		        				break;
		        			}        			
		        		}
		        		if (0 == $a2){
		        			$allModules [] = $item['access'];
		        		}
            		}
            		
            	}
            	elseif($item['atype'] == 'sticker') {
            		if(0 == $c1){
            			$allStickers [] = $item['access'];
            			$c1 = 1;
            		}
            		else{
            			 
		            	$c2 = 0;
		        		foreach ($allStickers as $module) {
		        			if($item['access']== $module){
		        				$c2 = 1;
		        				break;
		        			}        			
		        		}
		        		if (0 == $c2){
		        			$allStickers [] = $item['access'];
		        			
		        		}
            		}
            	}
        }
        
        /**
         * Get all layouts
         */
        $this->view->allLayouts = $allLayouts;
        
        /**
         * Get all modules
         */
        $this->view->allModules = $allModules;
        /**
         * Get all sticker
         */
        $this->view->allStickers = $allStickers;
        
        
        $this->view->translationMessage = $this->session->translationMessage;
        $this->session->translationMessage = null;
    }
    
    public function translateAction()
    {
        /**
         * Check permission
         */
        if (false == $this->checkPermission('see_translation')) {
            die ("You don't have translation to do this action.");
        }
        /*
         * counting language of system
         */
        $objLangs = new Models_Lang();
        $allLangs = $objLangs->getAllLangs( 'sorting DESC'  );                                               
        $langCode = array();
        foreach ($allLangs as $item) {
        	$langCode[] = $item['lang_code'];
        }
        
        /**
         * Ajax data
         */
        $this->setLayout('default');
        
        $aType = $this->_getParam('atype', false);
        $access  = $this->_getParam('access', false);
        if (false == $access || false == $aType) {
            die ("'access' or 'type' is required");
        }
        $aType  = strtolower($aType);
        $access = strtolower($access);
    	/**
    	 * Write transation to file
    	 */
     	$data = $this->_getParam('data', false);
     	$translationSucess = false;
     	if (false !== $data) {
     		parse_str($data);
     		/**
     		 * Save translaton to file
     		 */
     		foreach ($allLangs as $lang) {
     			/**
     			 * Filter data for this language
     			 */
				$filePath = 'languages/'.$aType.'.'.$access.'.'.$lang['lang_code'].'.php';
     			$newData = array();
     			foreach ($data as $item) {
     				$newData[$item['key']] = @$item[$lang['lang_code']];
     			}
     			     			
     			/**
     			 * Save to file
     			 */
     			
     			Nine_Language::writeTranslatedFile($filePath, $newData);
     			$translationSucess = true;
     		}
     	}

        $data2 = array();
		 foreach ($langCode as $item) { 	 
		 	 	$filename = 'languages/'.$aType.'.'.$access.'.'.$item.'.php';
		 	 	if(file_exists($filename)){
		 	 		$list = include $filename;
		 	 		$key = array_keys($list);
					foreach($key as $text){
						$data2[$text][$item] = $list[$text];
					}
		 	 	}
		 }
		 	$keys = array_keys($data2);
		 	foreach ($langCode as $lang) {
		 		foreach ($keys as $key) {
		 			if(!isset($data2[$key][$lang])){
		 				$data2[$key][$lang] = '';
		 			}
		 		}
		 	}
		$this->view->allTrans = $data2;
		$this->view->translationSucess = $translationSucess;
    }
    public function addLangAction(){
    	$defaultLang = $this->_getParam('default',false);
		if (false == $defaultLang) {
			$this->_redirectToNotFoundPage();
		
		}
		$newLang = $this->_getParam('new',false);
			if (false == $new) {
				$this->_redirectToNotFoundPage();
			
			}
		echo "<pre>";print_r($defaultLang);die;
    }
}