<?php
class admin_userSticker extends Nine_Sticker
{
	public function run()
	{
	    $langCode = Nine_Registry::get('langCode');
	    
	    $this->view->user = Nine_Registry::getLoggedInUser()->toArray();
	}
}