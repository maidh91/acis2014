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
require_once 'Nine/Acl.php';
class Nine_View_Register_Permission extends Nine_View_Register_Abstract 
{
    private static $_alc = null;
    
    /**
     * Override Nine_View_Register_Abstract::register
     * This function will be called automatically when Nine_View_RegisterBroker registers it
     */
    public function register()
    {
        $this->registerBlock('p', array('Nine_View_Register_Permission', 'checkPermisison'));
        $this->registerBlock('np', array('Nine_View_Register_Permission', 'checkNotPermisison'));
    }
    
    /**
     * Override Nine_View_Register_Abstract::unregister
     * This function will be called automatically when Nine_View_RegisterBroker unregisters it
     */
    public function unregister()
    {
        $this->unregisterBlock('p');
        $this->unregisterBlock('np');
    }
    
    /**
     * Check permission function
     * 
     * @example {{p name='see_user' module='user'}}These words will be checked permission to apper...{{/p}}
     */
    public static function checkPermisison($params, $content, &$smarty, &$repeat)
    {
        if (null == self::$_alc) {
            /**
             * Init alc
             */
            $auth = Nine_Auth::getInstance();
            self::$_alc = new Nine_Acl($auth->getIdentity());
        }
//        echo "<pre>";print_r($params);die;
        /**
         * Skip the first, will translate in second running
         */
        if (null == $content) {
            return '';
        }
        if (null == @$params['expandId']) {
            $params['expandId'] = '*';
        }
        if (true == self::$_alc->checkPermission(@$params['name'], @$params['module'], $params['expandId'])) {
            /**
             * Print data
             */
            return $content;
        } else {
            return '';
        }
    }
    
    /**
     * Check not permission function
     * 
     * @example {{p name='see_user' module='user'}}These words will be checked permission to apper...{{/p}}
     */
    public static function checkNotPermisison($params, $content, &$smarty, &$repeat)
    {
        if (null == self::$_alc) {
            /**
             * Init alc
             */
            $auth = Nine_Auth::getInstance();
            self::$_alc = new Nine_Acl($auth->getIdentity());
        }
//        echo "<pre>";print_r($params);die;
        /**
         * Skip the first, will translate in second running
         */
        if (null == $content) {
            return '';
        }
        if (null == @$params['expandId']) {
            $params['expandId'] = '*';
        }
        if (true == self::$_alc->checkPermission(@$params['name'], @$params['module'], $params['expandId'])) {
            /**
             * Print data
             */
            return '';
        } else {
            return $content;
        }
    }
}