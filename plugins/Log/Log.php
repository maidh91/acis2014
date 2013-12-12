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
require_once 'plugins/Log/LogModel.php';
class Log extends Nine_Plugin
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
        $objLog = new LogModel();
        $objLog->updateLog();
        /**
         * Clear log
         */
        if (isset($this->_config['logTime'])) {
            $objLog->clearLog($this->_config['logTime']);
        }
    }
}