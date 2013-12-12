<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @package    Nine_View
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */
require_once 'Nine/View/Register/Abstract.php';
class Nine_View_Register_Holder extends Nine_View_Register_Abstract {
	/**
	 * Override Nine_View_Register_Abstract::register
	 * This function will be called automatically when Nine_View_RegisterBroker registers it
	 */
	public function register() {
		//        $this->registerBlock('l', array('Nine_View_Register_Translation', 'translate'));
		$this->registerFunction ( 'holder', array ('Nine_View_Register_Holder', 'executeHolder' ) );
	}
	
	/**
	 * Override Nine_View_Register_Abstract::unregister
	 * This function will be called automatically when Nine_View_RegisterBroker unregisters it
	 */
	public function unregister() {
		$this->unregisterFunction ( 'holder' );
	}
	
	/**
	 * Translatation function
	 * 
	 * @example {{holder name='header' param="option"}}
	 * 
	 */
	public static function executeHolder($params, &$smarty) {
		if (! isset ( $params ['name'] )) {
			throw new Exception ( Nine_Language::translate ( "Holder must has param <b>name</b>" ) );
		}
		$data = "No data from Holder <b>" . $params ['name'] . "</b>";		
		$holder = new Nine_Holder($params);			
		$dataHolder = $holder->getData ();
		if (!($dataHolder == "")){
			$data = $dataHolder;
		}
		return $data;
	}
}