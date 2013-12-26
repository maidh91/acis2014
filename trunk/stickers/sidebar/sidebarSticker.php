<?php
class sidebarSticker extends Nine_Sticker
{
	public function run()
	{
		
		
		$menus = array(
				0 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/25",
						'name' => 'What`s News',
						'id' => 'news'
				),
				//
		//                    ),
				1 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/3",
						'name' => 'Call for Papers',
						'id' => '3'
				),
				2 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/18",
						'name' => 'Conference Committee',
						'id' => '18'
				),
				3 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/19",
						'name' => 'Important Dates',
						'id' => 'dates'
				),
				4 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/4",
						'name' => 'Invited Talks',
						'id' => 'Talks'
				),
				5 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/20",
						'name' => 'Workshops',
						'id' => 'workshop'
				),
				6 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/21",
						'name' => 'Special Sessions',
						'id' => 'session'
				),
				7 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/22",
						'name' => 'Tutorials',
						'id' => 'tut'
				),
				8 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/23",
						'name' => 'List of Accepted Papers',
						'id' => 'paper'
				),
				9 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/15",
						'name' => 'Venue',
						'id' => 'Venue'
				),
				10 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/24",
						'name' => 'Useful Information',
						'id' => 'info'
				),
				11 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/16",
						'name' => 'Acommodation',
						'id' => 'Acom'
				),
				
				12 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/15",
						'name' => 'Tours',
						'id' => 'tour'
				),
				13 => array(
						'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/15",
						'name' => 'Local Information',
						'id' => 'local'
				),
				
		
		);
		// 		echo "<pre>";print_r($menus);die;
				$this->view->menus = $menus;
		}
}