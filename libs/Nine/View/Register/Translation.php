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
class Nine_View_Register_Translation extends Nine_View_Register_Abstract 
{
    /**
     * Override Nine_View_Register_Abstract::register
     * This function will be called automatically when Nine_View_RegisterBroker registers it
     */
    public function register()
    {
        $this->registerBlock('l', array('Nine_View_Register_Translation', 'translate'));
    }
    
    /**
     * Override Nine_View_Register_Abstract::unregister
     * This function will be called automatically when Nine_View_RegisterBroker unregisters it
     */
    public function unregister()
    {
        $this->unregisterBlock('l');
    }
    
    /**
     * Translatation function
     * 
     * @example {{l langCode='en'}}These words will be translated...{{/l}}
     */
    public static function translate($params, $content, &$smarty, &$repeat)
    {
//        echo "<pre>";print_r($params);//die;

        /**
         * Skip the first, will translate in second running
         */
        if (null == $content) {
            return '';
        }
        $langCode = null;
        if (array_key_exists('langCode', $params)) {
            $langCode = $params['langCode'];
        }
        return Nine_Language::translate($content, $params, $langCode); 
    }
}