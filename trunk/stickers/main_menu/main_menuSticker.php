<?php
class main_menuSticker extends Nine_Sticker
{
	public function run()
	{
		$langCode = Nine_Registry::get('langCode');

		$menus = array(
            0 => array(
                    'url' => Nine_Registry::getBaseUrl(),
                    'name' => 'HOME',
                    'id' => 'home'
                    ),
            1 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/3",
                    'name' => 'SUBMISSON',
                    'id' => 'SUBMISSON'
                    ),
            2 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/4",
                    'name' => 'SPONSOR & HOST',
                    'id' => 'Sponsor'
                    ),
                    
            
            3 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/5",
                    'name' => 'COMMITEES',
                    'id' => 'Committees'
                    ),
        );
// 		echo "<pre>";print_r($menus);die;
        $this->view->menus = $menus;
	}
}