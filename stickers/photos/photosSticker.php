<?php
require_once  'modules/user/models/User.php';
require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';
class photosSticker extends Nine_Sticker
{
	public function run()
	{
	    
		
		$objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		
		
		
		$newContent = $objContent->getContentById(10);
		
		
		
		
		
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
		
//         echo "<pre>";print_r($newContent);die;
        $this->view->images = $newContent;
		
		
	
	
		
		 
		
		
	}
}