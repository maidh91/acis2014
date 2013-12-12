<?php
require_once 'modules/language/models/Lang.php';
class lang_buttonSticker extends Nine_Sticker
{
	public function run()
	{
	    $objLang  = new Models_Lang();
		$allLangs = $objLang->getByColumns(array('enabled = ?' => 1), array('sorting ASC'))->toArray();
        $this->view->allLangs = $allLangs;
//        
	}
}