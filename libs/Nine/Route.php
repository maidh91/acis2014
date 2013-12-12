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
require_once 'Nine/Registry.php';
class Nine_Route
{
    /**
     * Build friendly link of module
     * 
     * @param string $link The link
     * @return string
     */
    public static function _($link, $params = array(), $prefixUrl = null)
    {
    	/**
    	 * Active friendly URL?
    	 */
    	$fUrlConfig = Nine_Registry::getConfig('seachEngineFriendly');
    	
    	if (false == $fUrlConfig['active']) {
    		return $link;
    	}
    	
        $link = rtrim($link, '/') . '/';
        if (false !== stripos($link, 'http://') || false !== stripos($link, 'https://')) {
            /**
             * Link contain http/https
             */
            return $link;
        } else {
            if ('/' == @$link{0}) {
                /**
                 * Link from root folder
                 * Type: /<aplicationBaseUrl>/<module>/<controller>/<action>/<param1>/<value1>/...
                 */
                return $link;
            } else {
            	
            	if (null == $prefixUrl) {
            		$prefixUrl = Nine_Registry::getAppBaseUrl();
            	}
            	
                /**
                 * Quick call link of module
                 * Type: <module>/<controller>/<action>/<param1>/<value1>/...
                 */
                $linkArr = explode('/', trim($link, '/'));
                $moduleName = @$linkArr[0];
                $routePath = "modules/{$moduleName}/Route.php";
                
                if (null != $moduleName && is_file($routePath) && is_readable($routePath)) {
                     /**
                      * Call rout calculating from moudle
                      */
                     require_once "{$routePath}";
                     $className = 'Route_' . ucfirst($moduleName);
                     $objRoute = new $className;
                     
                     /**
                      * Using custom alias?
                      */
                     $config = @Nine_Registry::getConfig('seachEngineFriendly');
                     if (true == @$config['customAlias']  
                     && is_file('modules/alias/models/Alias.php') 
                     && is_readable('modules/alias/models/Alias.php')) 
                     {
                     	require_once 'modules/alias/models/Alias.php';
                     	$objAlias = new Models_Alias();
                     	
                     	$aliasUrl = $objAlias->getAliasPath($objRoute->build($linkArr, $params) . '.' . $fUrlConfig['suffix']);
                     	return $prefixUrl . ltrim($aliasUrl, '/');
                     }
                     return $prefixUrl . $objRoute->build($linkArr, $params) . '.' . $fUrlConfig['suffix'];
                 }
                return $prefixUrl . $link;
            }
        }
        
    }
}