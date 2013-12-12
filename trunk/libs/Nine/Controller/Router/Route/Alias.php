<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */

/** Zend_Controller_Router_Route_Abstract */
require_once 'Zend/Controller/Router/Route/Module.php';

/**
 * Module Route
 *
 * Default route for module functionality
 *
 * @package    Zend_Controller
 * @subpackage Router
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @see        http://manuals.rubyonrails.com/read/chapter/65
 */
class Nine_Controller_Router_Route_Alias extends Zend_Controller_Router_Route_Module
{
	
    /**
     * Constructor
     *
     * @param array $defaults Defaults for map variables with keys as variable names
     * @param Zend_Controller_Dispatcher_Interface $dispatcher Dispatcher object
     * @param Zend_Controller_Request_Abstract $request Request object
     */
    public function __construct(array $defaults = array(),
                Zend_Controller_Dispatcher_Interface $dispatcher = null,
                Zend_Controller_Request_Abstract $request = null)
    {
    	if(null === $dispatcher) {
    	 	$dispatcher = Nine_Controller_Front::getInstance()->getDispatcher();
    	}
    	if (null === $request) {
    		$request =  Nine_Controller_Front::getInstance()->getRequest();
    	}
    	
        parent::__construct($defaults,$dispatcher,$request);
    }
    /**
     * Matches a user submitted path. Assigns and returns an array of variables
     * on a successful match.
     *
     * If a request object is registered, it uses its setModuleName(),
     * setControllerName(), and setActionName() accessors to set those values.
     * Always returns the values as an array.
     *
     * @param string $path Path used to match against this routing map
     * @return array An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
    	/**
         * Using custom alias?
         */
        $config = @Nine_Registry::getConfig('seachEngineFriendly');
        
        if (true == @$config['customAlias']  
        && (! Nine_Registry::isRegistered('isRoutedAlias') || false == Nine_Registry::get('isRoutedAlias'))
        && is_file('modules/alias/models/Alias.php') 
        && is_readable('modules/alias/models/Alias.php')) 
        {
    		require_once 'modules/alias/models/Alias.php';
    	} else {
    		return false;
    	}
    	Nine_Registry::set('isRoutedAlias', true);
    	/**
    	 * Get real path
    	 */
    	$objAlias = new Models_Alias();
    	$realPath = @$objAlias->getRealPath($path);
    	if(false == $realPath) {
    		return false;
    	}
    	
    	/**
    	 * Get controller front
    	 */
    	$frontController = Nine_Controller_Front::getInstance();
    	/**
    	 * Get router
    	 */
		$router = $frontController->getRouter();
		$router->removeRoute('default');
		/**
		 * Get and modify Request
		 */
		$request = $frontController->getRequest();
		$request->setPathInfo('/'. trim($realPath, '/'));
		$request->setRequestUri(Nine_Registry::getAppBaseUrl() . trim($realPath, '/'));
		/**
		 * Call route again
		 */
		$router->route($request);
		return array ('___isRoutedAlias' => true);
    	
    }
}
