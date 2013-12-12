<?php
class footerSticker extends Nine_Sticker
{
	public function run()
	{
		$langCode = Nine_Registry::get('langCode');

		$menus = array(
            0 => array(
                    'url' => Nine_Registry::getBaseUrl(),
                    'name' => Nine_Language::translate('HOME'),
                    'id' => 'home'
                    ),
            1 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/detail/id/1",
                    'name' => Nine_Language::translate('ABOUT US'),
                    'id' => 'aboutus'
                    ),
            2 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/index/cid/1",
                    'name' => Nine_Language::translate('SERVICES'),
                    'id' => 'content_category_1'
                    ),
            4 => array(
                    'url' => Nine_Registry::getBaseUrl()."document",
                    'name' => Nine_Language::translate('DOCUMENTS'),
                    'id' => 'document'
                    ),
            5 => array(
                    'url' => Nine_Registry::getBaseUrl()."content/index/index/cid/3",
                    'name' => Nine_Language::translate('NEWS'),
                    'id' => 'content_category_3'
                    ),
            6 => array(
                    'url' => Nine_Registry::getBaseUrl()."download",
                    'name' => Nine_Language::translate('DOWNLOAD'),
                    'id' => 'download'
                    ),
            7 => array(
                    'url' => Nine_Registry::getBaseUrl()."recruitment",
                    'name' => Nine_Language::translate('RECRUITMENT'),
                    'id' => 'recruitment'
                    ),
           	8 => array(
                    'url' => Nine_Registry::getBaseUrl() ."contact",
                    'name' => Nine_Language::translate('CONTACT'),
                    'id' => 'contact'
                    ),
        );
        $this->view->menus = $menus;
        $this->view->text = Nine_Registry::getContentByGid(87)->full_text;
		
	}
}