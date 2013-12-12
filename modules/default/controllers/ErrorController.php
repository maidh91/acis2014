<?php
/**
 * Author: Nguyen Hoai Tan (nguoiao007@gmail.com)
 * 
 * @category   default 
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
<!--// * -->
 */
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Stream.php';
class default_ErrorController extends Nine_Controller_Action 
{
    
	public function errorAction()
	{
        $errors = $this->_getParam('error_handler');
        $exception = $errors->exception;
        $log = new Zend_Log(
            new Zend_Log_Writer_Stream(
                'tmp/error.log'
            )
        );
        $log->debug($exception->getMessage() . "\n" .
                    $exception->getTraceAsString(). "\n" .
                    "Request URL: {$_SERVER['REQUEST_URI']}");
       /**
        * Display default error page
        */
       $this->setLayout('default');
       $this->view->url = $_SERVER['REQUEST_URI'];
    }
}