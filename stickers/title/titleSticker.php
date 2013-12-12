<?php
require_once  'modules/user/models/User.php';
require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';
class titleSticker extends Nine_Sticker
{
	public function run()
	{
	    
		
		$objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		
		$gid = 1;
		
		$news = $objContent->getContentById($gid);
		if (null == $news) {
			$this->_redirectToNotFoundPage();
		}
		
		
		
		
		$tmp = explode("||", $news['images']);
		$news['main_image'] = Nine_Function::getThumbImage(@$tmp[0], 239);
		
	
// 		echo "<pre>";print_r($news);die;
		
        $this->view->news = $news;
		
		
	
	
		
		 
		
		
	}
}