<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   plugins 
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 */
require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'modules/mit/Objects/Statistic.php';
class MitStatistic extends Zend_Controller_Plugin_Abstract
{

    /**
     * Called before Zend_Controller_Front begins evaluating the
     * request against its routes.
     *
     * @param Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $objStatistic = new Objects_Statistic();
//        echo "<pre/>";print_r($_COOKIE);die;
//        echo "<pre/>";print_r($_SERVER);die;
        /**
         * Insert into database new request
         */
        $data = array();
        if (isset($_COOKIE['PHPSESSID'])) {
            $data['user_phpsessid'] = $_COOKIE['PHPSESSID'];
        }
        if (isset($_SERVER['SERVER_ADDR'])) {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $data['link'] = $_SERVER['REQUEST_URI'];
        }
        $data['time'] = time();
        
        $objStatistic->insert($data);
    }
}