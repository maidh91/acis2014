<?php

//require_once 'modules/list/models/List.php';
require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';

require_once 'modules/list/models/List.php';
require_once 'modules/mail/models/Mail.php';
require_once 'modules/user/models/User.php';
class default_IndexController extends Nine_Controller_Action
{
	public function indexAction()
	{
		$objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		
		$gid = 2;
		
		$news = $objContent->getContentById($gid);
		
		$newContent = $objContent->getContentById(10);
		if (null == $news) {
			$this->_redirectToNotFoundPage();
		}
		
		
		
		
		$tmp = explode("||", $news['images']);
		$news['main_image'] = Nine_Function::getThumbImage(@$tmp[0], 239);
		
// 		echo "<pre>";print_r($newContent);die;
		if (is_array($newContent['images'])) {
			foreach ($newContent['images'] as $index => $image) {
				if (null == $image) {
					unset($newContent['images'][$index]);
				} else {
					$newContent['images'][$index] = Nine_Function::getImagePath($image);
				}
			}
		}
		$newContent['images'] = explode('||', $newContent['images']);
		
        $this->view->news = $news;
//         echo "<pre>";print_r($newContent);die;
        $this->view->images = $newContent;
       
        

 
         
		
	}
}