<?php

require_once 'modules/content/models/Content.php';
require_once 'modules/content/models/ContentCategory.php';

class content_IndexController extends Nine_Controller_Action
{
	public function indexAction()
	{
		$objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		
		/**
		 * Get category
		 */
		$categoryGid = $this->_getParam('cid',false);
		if (false == $categoryGid) {
			$this->_redirectToNotFoundPage();
		
		}
		$cat = $objContentCategory->getCategoryWithParent($categoryGid);
		/**
         * Get number row per page
         */
		
		if ('news' == $cat['template']) {
			/**
			 * Template news
			 */
			$numRowPerPage = Nine_Registry::getConfig("newsNumberRowPerPage");
		}
		else {
			/**
			 * Template services
			 */
			$numRowPerPage = Nine_Registry::getConfig("servicesNumberRowPerPage");
			
		}
		
		$currentPage = $this->_getParam("page",1);
		
		$condition = array();
		$gid = array();
		
		/**
		 * Get latest news
		 */
		if ('news' == $cat['template']){
			$latestNews = $objContent->getLatestContentByCategory( $categoryGid );
			if (null == $latestNews) {
				$this->_redirectToNotFoundPage();
			}
			
			$cat = @reset($objContentCategory->getByColumns(array('content_category_gid=?' => $latestNews['content_category_gid']))->toArray());
			if (null == $cat) {
				$this->_redirectToNotFoundPage();
			}
			
			$latestNews['category_name'] = $cat['name'];
			$latestNews['title'] = Nine_Function::subStringAtBlank(trim(strip_tags($latestNews['title'])),40);
			$latestNews['intro_text'] = Nine_Function::subStringAtBlank(trim(strip_tags($latestNews['intro_text'])), 400);
			
	        $latestNews['full_text'] = Nine_Function::subStringAtBlank(trim(strip_tags($latestNews['full_text'])), 145);
	        $latestNews['url'] = Nine_Route::_("content/index/detail/id/{$latestNews['content_gid']}");
			$tmp = explode('||', $latestNews['images']);
			$latestNews['images'] = Nine_Function::getThumbImage(@$tmp[0], 167,125);
			
			/**
			 * Get all contents
			 */
			$condition = array(
						'exclude_content_gids'	=>	$latestNews['content_gid']
						);
						$gid[] = $latestNews['content_gid'];
			$this->view->latestNews = $latestNews;
		}
		$allContents = $objContent->getAllEnabledContentByCategory($categoryGid, $condition, array('sorting ASC','content_id DESC'),
                                                   $numRowPerPage,($currentPage - 1) * $numRowPerPage
                                                   );
//                                                   echo "<pre>";print_r($allContents);die;
		/**
		 * Modified all contents
		 */
		foreach($allContents as &$content){
			$content['title'] = Nine_Function::subStringAtBlank(trim(strip_tags($content['title'])),40);
        	$content['intro_text'] = Nine_Function::subStringAtBlank(trim(strip_tags($content['intro_text'])), 145);
        	$content['url'] = Nine_Route::_("content/index/detail/id/{$content['content_gid']}");
        	$tmp = explode('||', $content['images']);
        	if(3!=$content['content_category_gid']){
        		$content['images'] = Nine_Function::getThumbImage(@$tmp[0], 263, 99);
        	}
        	
		}
        unset($content);  
         $i = 0;
         $threeContent = array();
         foreach ($allContents as $item) {
         	$item['title'] = Nine_Function::subStringAtBlank(trim(strip_tags($item['title'])),36);
         	$item['text'] = Nine_Function::subStringAtBlank(trim(strip_tags($item['intro_text'])),78);
         	$tmp = explode('||', $item['images']);
         	$item['images'] = Nine_Function::getThumbImage(@$tmp[0], 90, 63);
         	if(3!= $i){
         		$i++;
         		$threeContent[] = $item;
         		$gid[] = $item['content_gid'];
         	
         	}
         	
         } 
//         echo "<pre>";print_r($gid);die;
         
         
         $allNews = $objContent->getAllEnabledContentBygId($categoryGid, $gid, array('sorting ASC','content_id DESC'),
                                                   $numRowPerPage,($currentPage - 1) * $numRowPerPage
                                                   );
         foreach ($allNews as &$content) {
         	$content['title'] = Nine_Function::subStringAtBlank(trim(strip_tags($content['title'])),37);
        	$content['intro_text'] = Nine_Function::subStringAtBlank(trim(strip_tags($content['intro_text'])), 145);
        	$content['url'] = Nine_Route::_("content/index/detail/id/{$content['content_gid']}");
        	$tmp = explode('||', $content['images']);
			$content['images'] = Nine_Function::getThumbImage(@$tmp[0], 90, 63);
			$content['text'] = Nine_Function::subStringAtBlank(trim(strip_tags($content['intro_text'])),90);
         }
         unset($content); 
                                                 
		 $allNews = array_chunk($allNews, 2);
        $allContents = array_chunk($allContents, 2);
		/**
         * Count all contents
         */
        $count = count($objContent->getAllEnabledContentByCategory($categoryGid,$condition));
        
         $templatePath  = Nine_Registry::getModuleName() . '/views/templates/' . ((@$cat['template'])?$cat['template']:'default');
		$templatePath .= '/index.' . Nine_Constant::VIEW_SUFFIX;
		
        
        /**
         * Assign to view
         */
       
		$this->setPagination($numRowPerPage, $currentPage, $count);
//		echo "<pre>";print_r($allNews);die;
        $this->view->allContents = $allContents;
        $this->view->threeContent = $threeContent;
        $this->view->allNews = $allNews;
         $rootCatParent = $objContentCategory->getRootParent($categoryGid);
        $this->view->menuId = "content_category_{$rootCatParent['content_category_gid']}";
        
        $this->view->headTitle($cat['name']);
        $this->view->name = $cat['name'];
        /**
		 * Render this template
		 */
		$this->view->html = $this->view->render( $templatePath );
	}
	
	public function detailAction()
	{
		$objContent = new Models_Content();
		$objContentCategory = new Models_ContentCategory();
		
		$gid = $this->_getParam('id',false);
		if ( false == $gid) {
			$this->_redirectToNotFoundPage();
		}
		
		$news = $objContent->getContentById($gid);
		if (null == $news) {
			$this->_redirectToNotFoundPage();
		}
		
		
		
		
		$tmp = explode("||", $news['images']);
		$news['main_image'] = Nine_Function::getThumbImage(@$tmp[0], 239);
		
	
// 		echo "<pre>";print_r($news);die;
		
        $this->view->news = $news;
	}
	
	
	private function _redirectToNotFoundPage()
	{
	    $this->_redirect("");
	}
}