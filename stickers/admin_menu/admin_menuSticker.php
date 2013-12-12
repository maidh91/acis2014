<?php

require_once 'modules/user/models/User.php';
require_once 'modules/user/models/Group.php';
class admin_menuSticker extends Nine_Sticker
{
	public function run()
	{
	    $this->view->loggedUser = Nine_Registry::getLoggedInUser()->toArray();
	    $uploader = Nine_Registry::getLoggedInUserId();
	    $objUser = new Models_User();
    	$userGroup = $objUser->getByUserId($uploader)->toArray();
    	$this->view->userGroup = $userGroup;
    	
//    	echo "<pre>";print_r($userGroup);die;
	    
	}
}