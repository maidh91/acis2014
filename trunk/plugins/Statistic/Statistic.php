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
require_once 'Nine/Plugin.php';
require_once 'Shared/Objects/Statistic.php';
class Statistic extends Nine_Plugin
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
        Nine_Registry::set('statistic', $objStatistic);
    }  
    /**
     * Called before Zend_Controller_Front exits its dispatch loop.
     *
     * @return void
     */
    public function dispatchLoopShutdown()
    {
        $objStatistic = Nine_Registry::getStatistic();
        $objStatistic->storeStatistic();
    }
}