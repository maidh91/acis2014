<?php
/**
 * Fix IIS environment in Window
 */
if (! isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
}
if (get_magic_quotes_gpc()) {    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);    while (list($key, $val) = each($process)) {        foreach ($val as $k => $v) {            unset($process[$key][$k]);            if (is_array($v)) {                $process[$key][stripslashes($k)] = $v;                $process[] = &$process[$key][stripslashes($k)];            } else {                $process[$key][stripslashes($k)] = stripslashes($v);            }        }    }    unset($process);}
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @package    Nine
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 * 
 */
//try {

//    date_default_timezone_set('America/Toronto');
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    set_include_path('.' . 
    				 PATH_SEPARATOR . 'libs' . 
    				 PATH_SEPARATOR . get_include_path());       
    require_once 'Zend/Loader.php'; 
    require_once 'Nine/Constant.php';		     
    require_once 'Nine/Function.php';   
    require_once 'Nine/Registry.php';
    require_once 'Nine/Db.php';
    require_once 'Nine/Layout.php';
    require_once 'Nine/Initializer.php';
    
    // Set up autoload.
    //Zend_Loader::registerAutoload(); 
    /**  
     * TODO TEST LINUX FILE
     */
//    $time = time();
    umask(0);
    //ini_set('magic_quotes_gpc', 'Off');
    // Change 'currentMode' in config.php to Nine_Constant::PRODUCT_MODE under production environment
    $initializer = new Nine_Initializer();    
    $initializer->run();
    
    // Prepare the front controller. 
    $frontController = Nine_Controller_Front::getInstance();
    
    // Dispatch the request using the front controller. 
    $frontController->dispatch();
    
//    ob_clean();
//    echo time() - $time;
    
//} catch (Exception $e) {
//    /**
//     * TODO Redirect to error page
//     */
//    include_once 'error.php';
//}