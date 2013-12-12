<?php

require_once 'modules/content/models/Content.php';

class featuredSticker extends Nine_Sticker
{
	public function run()
    {
  		$objContent = new Models_Content();
  		/**
  		 * Intro 1
  		 */
    	$intro1 = @$objContent->getContentByGid(137)->toArray();
    	if (null != @$intro1['images']) {
    		$tmp = explode("||", $intro1['images']);
    		$intro1['main_image'] = Nine_Function::getThumbImage(@$tmp[0],950,233);
    	}
    	if (null != @$intro1['intro_text']) {
    		$intro1['summary_intro_text'] = Nine_Function::subStringAtBlank(strip_tags($intro1['intro_text']),120);
    	}
    	$intro1['url'] = Nine_Route::_(Nine_Registry::getAppBaseUrl()."content/index/detail/id/{$intro1['content_gid']}");
    	/**
  		 * Intro 2
  		 */
    	$intro2 = $objContent->getContentByGid(139)->toArray();
    	if (null != @$intro2['images']) {
    		$tmp = explode("||", $intro2['images']);
    		$intro2['main_image'] = Nine_Function::getThumbImage(@$tmp[0],950,233);
    	}
    	if (null != @$intro2['intro_text']) {
    		$intro2['summary_intro_text'] = Nine_Function::subStringAtBlank(strip_tags($intro2['intro_text']),120);
    	}
    	$intro2['url'] = Nine_Route::_(Nine_Registry::getAppBaseUrl()."content/index/detail/id/{$intro2['content_gid']}");
    	/**
  		 * Intro 3
  		 */
    	$intro3 = $objContent->getContentByGid(141)->toArray();
    	if (null != @$intro3['images']) {
    		$tmp = explode("||", $intro3['images']);
    		$intro3['main_image'] = Nine_Function::getThumbImage(@$tmp[0],950,233);
    	}
    	if (null != @$intro3['intro_text']) {
    		$intro3['summary_intro_text'] = Nine_Function::subStringAtBlank(strip_tags($intro3['intro_text']),120);
    	}
    	$intro3['url'] = Nine_Route::_(Nine_Registry::getAppBaseUrl()."content/index/detail/id/{$intro3['content_gid']}");
    	/**
  		 * Intro 4
  		 */
    	$intro4 = $objContent->getContentByGid(143)->toArray();
    	if (null != @$intro4['images']) {
    		$tmp = explode("||", $intro4['images']);
    		$intro4['main_image'] = Nine_Function::getThumbImage(@$tmp[0],950,233);
    	}
    	if (null != @$intro4['intro_text']) {
    		$intro4['summary_intro_text'] = Nine_Function::subStringAtBlank(strip_tags($intro4['intro_text']),120);
    	}
    	$intro4['url'] = Nine_Route::_(Nine_Registry::getAppBaseUrl()."content/index/detail/id/{$intro4['content_gid']}");
    	/**
    	 * Assing to view
    	 */
    	$this->view->intro1 = $intro1;
    	$this->view->intro2 = $intro2;
    	$this->view->intro3 = $intro3;
    	$this->view->intro4 = $intro4;
    	
    }
}