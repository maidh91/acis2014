<?php

class lang_AdminController extends Nine_Controller_Action_Admin
{
	public function synLangAction()
	{
		$defaultLang = $this->_getParam('default',false);
		
		if (false == $defaultLang) {
			$this->_redirectToNotFoundPage();
		
		}
		$newLang = $this->_getParam('new',false);
			if (false == $newLang) {
			}
		$synLang = Nine_Registry::getConfig("synLang");
		
		 foreach ($synLang['linkModels'] as &$item) {
		 	require_once "$item";
		 }
		 unset($item);
		 foreach ($synLang['nameModels'] as &$item1) {
		 	$model = "Models_"."$item1";
		 	$obj =    new $model();
		 	$obj->setAllLanguages(true)->synLang($defaultLang,$newLang);
		 }
		  unset($item1);
        
		
	}
	private function _redirectToNotFoundPage()
	{
	    $this->_redirect("");
	}
}