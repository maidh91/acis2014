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
//           
//                    ),
            1 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/3",
                    'name' => 'Call for Papers',
                    'id' => 'Paper'
                    ),
//             2 => array(
//                     'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/4",
//                     'name' => 'Invited Talks',
//                     'id' => 'Talks'
//                     ),
                    
            
//             3 => array(
//                     'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/11",
//                     'name' => 'Programme',
// 					'id' => 'Program'
//                     ),
				
// 			4 => array(
// 					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/12",
// 					'name' => 'Registration',
// 					'id' => 'Regis'
// 			),
// 			5 => array(
// 					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/13",
// 					'name' => 'Paper Submission',
// 					'id' => 'Submission'
// 			),
			3 => array(
					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/14",
					'name' => 'Committees',
					'id' => 'Committees'
			),
/*			
// 			7 => array(
// 					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/15",
// 					'name' => 'Venue',
// 					'id' => 'Venue'
// 			),
// 			8 => array(
// 					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/16",
// 					'name' => 'Acommodation',
// 					'id' => 'Acom'
// 			),
*/				
			4 => array(
					'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/17",
					'name' => 'Sightseeings',
					'id' => 'Photo'
			),
            
        );
// 		echo "<pre>";print_r($menus);die;
        $this->view->menus = $menus;
	}
}