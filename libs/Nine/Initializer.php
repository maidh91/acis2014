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
 */
require_once 'Nine/Constant.php';       
require_once 'Nine/Controller/Front.php';
require_once 'Nine/Controller/Action.php';
require_once 'Nine/Controller/Action/Admin.php';  
require_once 'Nine/Controller/Action/Helper/ViewRenderer.php';
require_once 'Nine/Db.php';   
require_once 'Nine/Folder.php';
require_once 'Nine/Function.php';  
require_once 'Nine/Holder.php'; 
require_once 'Nine/Language.php';
require_once 'Nine/Layout.php';
require_once 'Nine/Layout/Controller/Plugin/Layout.php';
require_once 'Nine/Layout/Controller/Action/Helper/Layout.php';
require_once 'Nine/Registry.php';
require_once 'Nine/Route.php';
require_once 'Nine/Sticker.php';
require_once 'Nine/View.php';
require_once 'Nine/View/Register/Translation.php';
require_once 'Nine/View/Register/Sticker.php';
require_once 'Nine/View/Register/Holder.php';
require_once 'Nine/View/Register/Permission.php';

require_once 'Zend/Controller/Router/Route/Regex.php';
require_once 'Zend/Cache/Backend/File.php';
require_once 'Zend/Locale.php'; 
require_once 'Zend/Loader.php'; 

require_once 'libs/Smarty/Smarty.class.php';
/**
 * 
 * Initializes configuration depndeing on the type of environment 
 * (test, development, production)
 *  
 * This can be used to configure environment variables, databases, 
 * layouts, routers, helpers and more
 *   
 */
class Nine_Initializer
{
    /**
     * @var array
     */
    protected static $_config;
    /**
     * @var string Current environment
     */
    protected $_env;
    /**
     * @var Nine_Controller_Front
     */
    protected $_front;
    /**
     * @var string Path to application root
     */
    protected $_root;
    /**
     * Constructor
     *
     * Initialize environment, root path, and configuration.
     * 
     * @param  string $env 
     * @param  string|null $root 
     * @return void
     */
    public function __construct ($root = null)
    {
        if (null === $root) {
            $root = realpath(dirname(__FILE__) . '/../../') . '/';
        }
        $this->_root = $root;
        Nine_Registry::set('BASE_DIR', $root);
        $this->_front = Nine_Controller_Front::getInstance();
        
        $config = $this->loadConfig();
        $env = $config['currentMode'];
        $this->_setEnv($env);
        $this->initPhpConfig();
        // set the test environment parameters
        if ($env != Nine_Constant::PRODUCT_MODE) {
            // Enable all errors so we'll know when something goes wrong. 
            error_reporting(E_ALL | E_STRICT);
            @ini_set('display_startup_errors', 1);
            @ini_set('display_errors', 1);
            /**
             * Throw exceptions without error handler
             */
            $this->_front->throwExceptions(true);
        }
    }
    /**
     * Load general config and modified by current application config and set it to Nine_Registry
     * 
     * @return array 
     */
    private function loadConfig ()
    {
        /**
         * Get BASE_URL, APP_BASE_URL, APP_NAME
         */
        $appName  = '';
        $langCode = '';
        $baseUrl  = dirname($_SERVER['SCRIPT_NAME']);
        /**
         * Fix error in Window if we use direct domain like domain.com
         * and point that domain to this source. It return "\" instead of "/"
         */
        if ('\\' == $baseUrl) {
            $baseUrl = '/'; 
        }
        /**
         * End fix
         */
        $uri = $_SERVER['REQUEST_URI'];
        $param = substr(rtrim($uri, '/'), strlen(rtrim($baseUrl, '/')) + 1);
        
        $arr = explode('/', $param);
        foreach ($arr as $item) {
            if ($item == '') {
                continue;
            }
            if (null == $appName) {
                /**
                 * Get appcation name
                 */
                $appName = $item;
            } else if (null == $langCode){
                /**
                 * Get langcode
                 */
                $langCode = $item;
            } else {
                break;
            }
        }
//        echo '<pre>';print_r($arr);die;
//        echo $appName;die;
       
//        echo '<pre>';print_r($_SERVER);die;
        /**
         * Get config from general config 
         */
        if (is_file('config.php')) {
            $generalConfig = include_once 'config.php';
        } else {
            throw new Exception("Config.php is missing!");
        }
        
        /**
         * Load special configuration for Smarty
         */
        $generalConfig['viewConfig']['left_delimiter']  = Nine_Constant::SMARTY_LEFT_DELIMITER;
        $generalConfig['viewConfig']['right_delimiter'] = Nine_Constant::SMARTY_RIGHT_DELIMITER;
        
        /**
         * Get config from current application
         */
        $withoutAppName = false;
        if ($appName == '') {
            $appName = $generalConfig['defaultApp'];
            $withoutAppName = true;
        }
        
        /**
         *  Will throw new exception or using default application if application name is not correct.
         *  When using default application. All params (as module/controller/action/param1/value1...)
         *  will recaculate: the incorrect application name will be module name, the old module name will
         *  be action... This solution is useful for default application when users are brownsing without
         *  application name, example: http://yourdomain/controller/action
         */
        if (! is_dir($this->_root . 'applications/' . $appName)) {
            if ($generalConfig['forwardToDefaultAppWhenNotFoundAppName']) {
                /**
                 * Application name will be used to load appliaction's config
                 */
                $langCode       = $appName;
                $appName        = $generalConfig['defaultApp'];
                $withoutAppName = true;
            } else {
                throw new Exception('Application name is not correct');
            }
        }
        $appConfigFile = 'applications/' . $appName . '/config.php';
        if (is_file($appConfigFile)) {
            $appConfig = include_once $appConfigFile;
        } else {
            $appConfig = array();
        }
        
        /**
         * Read config from general configuration and special application configuration.
         * The application configuration will have higher priority than general configuration,
         * and it can be skipped.
         */
        $config = array_merge($generalConfig, $appConfig);
        if (!is_array(@$config['module'])) {
            $config['module'] = array();
        }
        /**
         * Merge modules
         */
        $config['module'] = array_merge($config['requiredModule'], $config['module']);
        /**
         * In config file, compile and cache dir must have been started with 'tmp/'
         */
        $viewConfig = $config['viewConfig'];
//        if ('tmp/' !== substr($viewConfig['compile_dir'], 0, 4) || 'tmp/' !== substr($viewConfig['compile_dir'], 0, 4)) {
//            throw new Exception("In config file, compile and cache dir must have been started with 'tmp/'");
//        }
        $BASE_URL = $baseUrl;
        if($baseUrl != "/") {
            $BASE_URL .= "/";
        }
        Nine_Registry::set('APP_NAME', $appName);
        Nine_Registry::set('BASE_URL', $BASE_URL);
        
        /**
         * When using default application, the application name can be missed in URL
         */
        if (true == $withoutAppName) {
            Nine_Registry::set('APP_BASE_URL', $BASE_URL);
        } else {
            Nine_Registry::set('APP_BASE_URL', $BASE_URL . $appName . '/');
        }
        Nine_Registry::set('config', $config);
        Nine_Initializer::$_config = $config;
        
        /**
         * Set detected language
         */
        Nine_Registry::set('langCode', $langCode);
        
        return $config;
    }
    /**
     * Initialize environment
     * 
     * @param  string $env 
     * @return void
     */
    protected function _setEnv ($env)
    {
        $this->_env = $env;
    }
    /**
     * Initialize Data bases
     * 
     * @return void
     */
    public function initPhpConfig ()
    {
        Zend_Locale::disableCache(true);
//        Zend_Cache_Backend_File::setCacheDir('tmp');        
    }
    /**
     * Initializer run
     * 
     * @return void
     */
    public function run()
    {
        $this->initDb();
        $this->initLanguage();
        $this->initHelpers();
        $this->initView();
        $this->initPlugins();
        $this->initRoutes();
        $this->initControllers();
        $this->changeAliasToModuleName();
    }
    /**
     * Initialize data bases
     * 
     * @return void
     */
    public function initDb ()
    {
        $db = Nine_Db::factory(Nine_Initializer::$_config['database']['adapter'], Nine_Initializer::$_config['database']['params']);
        Nine_Registry::set('db', $db);
        include_once 'Zend/Db/Table/Abstract.php';
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }
    /**
     * Detect language code
     */
    public function initLanguage() 
    {
        require_once 'modules/language/models/Lang.php';
        $objLang         = new Models_Lang();
        $langCode        = Nine_Registry::getLangCode();
        /**
         * Is lang code?
         */
        if (null != $langCode && 0 == $objLang->count(array('lang_code=?' => $langCode))) {
        	/**
        	 * Invalid langcode, there is no langcode in URL
        	 * 
        	 * Reset langcode
        	 */
        	$langCode = null;
        }
        $withoutLangCode = false;
        /**
         * Can not detect lang code in URL (This is home page case)
         */
        if (null == $langCode) {
            $withoutLangCode = true;
            /**
             * Try to load lang code from COOKIE
             */
            $langCode = @$_COOKIE['lang_code_' . Nine_Registry::getAppName()];
        }
        /**
         * Use default lang code in other cases
         */
        if (null == $langCode && null == ($langCode = Nine_Registry::getConfig('defaultLangCode'))) {
            throw new Exception('Missing default language code in config file');
        }
        /**
         * Now, we always have correct langcode
         * 
         * Reset langcode in Registry before valid it 
         */
        Nine_Registry::set('langCode', strtolower($langCode));
        /**
         * Language with this langcode is enabled?
         */
        if ($objLang->count(array('enabled=?' => 1, 'lang_code=?' => $langCode)) >= 1) {
            /**
             * Valid language
             */
        	if(false == $withoutLangCode) {
            	Nine_Registry::set('APP_BASE_URL', Nine_Registry::getAppBaseUrl() . "{$langCode}/");
            }
            Nine_Registry::set('withoutLangCode', $withoutLangCode);
            /**
             * Remember chosen language for next time (in 1 year)
             */
            setcookie('lang_code_' . Nine_Registry::getAppName(), $langCode, time() + 31536000, Nine_Registry::getBaseUrl());
        } else {
            /**
             * Invalid lang code
             */
            if (Nine_Registry::getConfig('defaultLangCode') == $langCode) {
                /**
                 * Erorr: Admin deactived default language
                 */
                throw new Exception('Default language is disabled');
            } else {
                /**
                 * Go to home page with default language
                 */
                header('Location:' . Nine_Registry::getAppBaseUrl() . Nine_Registry::getConfig('defaultLangCode') . '/');
                exit;
            }
        }
    }
    /**
     * Initialize action helpers
     * 
     * @return void
     */
    public function initHelpers ()
    {}
    /**
     * Initialize view 
     * 
     * @return void
     */
    public function initView ()
    {        
        /**
         * Bootstrap views
         */
        $view = new Nine_View('modules/', Nine_Initializer::$_config['viewConfig']);
        /**
         * Register traslation register to translate language in template and layout
         */
        $view->helper->register(new Nine_View_Register_Translation());
        /**
         * Register sticker function to display sticker
         */
        $view->helper->register(new Nine_View_Register_Sticker());
        /**
         * Register holder function to display holder
         */
        $view->helper->register(new Nine_View_Register_Holder());
        /**
         * Register check permission function
         */
        $view->helper->register(new Nine_View_Register_Permission());
        /**
         * Register ViewRender helper
         */
//        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer = new Nine_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view)
                     ->setViewBasePathSpec($view->smarty->template_dir)
                     ->setViewScriptPathSpec(':module/views/:controller.:action.:suffix')
                     ->setViewScriptPathNoControllerSpec(':action.:suffix')
                     ->setViewSuffix(Nine_Constant::VIEW_SUFFIX);  
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);                             
        /**
         * Bootstrap layouts 
         */          
        $layout = Nine_Layout::startMvc(array(
        						'layoutPath'  => $this->_root . 'layouts/' . Nine_Initializer::$_config['layoutCollection'] , 
        						'layout'      => Nine_Initializer::$_config['defaultLayout'],
                                'view'        => $view,                    
								'contentKey'  => Nine_Constant::VIEW_CONTENT_KEY,
                                'helperClass' => 'Nine_Layout_Controller_Action_Helper_Layout',
                                'pluginClass' => 'Nine_Layout_Controller_Plugin_Layout',
                                'viewSuffix'  => Nine_Constant::VIEW_SUFFIX
                            ));    

    	/**
         * Check offline Site
         */
        $config = Nine_Registry::getConfig();                    
        if('1' == @$config['offline'] && 'front' == Nine_Registry::get('APP_NAME')){
        	$offlineMessage = @$config['offlineMessage'];
         	$metaKeywords = @$config['metaKeywords'];
         	$metaDescription = @$config['metaDescription'];
         	$content = include "offsite.php";
         	exit;
        }                   
                            
    }
    /**
     * Initialize plugins 
     * 
     * @return void
     */
    public function initPlugins ()
    {
    	if (isset(self::$_config['plugins']) && is_array(self::$_config['plugins']) ) {
	    	
    		$systemPlugin  = (@self::$_config['plugins']['system']);
	        $contentPlugin = (@self::$_config['plugins']['content']);
	    	
	    	if ( isset($systemPlugin) && is_array($systemPlugin)) {
	            foreach ($systemPlugin as $pluginName => $pluginConfig) {
	                if (is_string($pluginName)) {
	                    require_once 'plugins/system/' . $pluginName . '/' . $pluginName . '.php';
	                    $objPlugin = new $pluginName($pluginConfig);
	                } else {
	                    require_once 'plugins/system/' . $pluginConfig . '/' . $pluginConfig . '.php';
	                    $objPlugin = new $pluginConfig();
	                }
	                $this->_front->registerPlugin($objPlugin);
	            }
	        }
	        
	    	if ( isset($contentPlugin) && is_array($contentPlugin)) {
	    		/**
	             * Get smarty
	             */
				$smarty = Nine_Layout::getMvcInstance()->getView()->getEngine();
				
	            foreach ($contentPlugin as $pluginName => $pluginConfig) {
	                
					/**
					 * Register prefilter
					 */
	            	if (is_string($pluginName)) {
	                    require_once 'plugins/content/' . $pluginName . '/' . $pluginName . '.php';
	                    $smarty->register_outputfilter(lcfirst($pluginName));
	                } else {
	                    require_once 'plugins/content/' . $pluginConfig . '/' . $pluginConfig . '.php';
	                    $smarty->register_outputfilter(lcfirst($pluginConfig));
	                }
	           
	            }
	        }
    	}
    }
    /**
     * Initialize routes
     * 
     * @return void
     */
    public function initRoutes ()
    {
        /**
         * Load setup routes from module directories
         */
        $modules = Nine_Registry::getConfig('module');
        /**
         * Setup routes for content module.
         * Skip for admin application.
         */
        if (Nine_Registry::get('APP_NAME') == 'admin') {
            return;
        }
        
        /**
         * Load module router
         */
        foreach ($modules as $module) {
        	$routePath = "modules/{$module}/Route.php";
            if (null != $module && is_readable($routePath)) {
	            /**
	           	 * Call rout calculating from moudle
	           	 */
	            require_once "{$routePath}";
	            $className = 'Route_' . ucfirst($module);
	            $objRoute = new $className;
	            
	            $objRoute->parse();
            }
        }
    }
    /**
     * Initialize Controller paths 
     * 
     * @return void
     */
    public function initControllers ()
    {
        /**
         * Controller directory will be:
         * 
         *     'aliasName'  => 'moduleName'
         *     'moduleName' => 'moduleName'	
         * 
         * Alias-name will have higher priority than module-name	
         */
        $arrayModule    = Nine_Initializer::$_config['module'];
        $moduleAlisases = $arrayModule;
        foreach ($arrayModule as $key => $item) {
            $arrayModule[$key]  = 'modules/' . $item . '/controllers/';
            if (array_key_exists($item, $arrayModule)) {
                continue;
            }
            $arrayModule[$item]    = 'modules/' . $item . '/controllers/';
            $moduleAlisases[$item] = $item;
        }
//        echo Nine_Registry::get('APP_BASE_URL');die;
        Nine_Registry::set('moduleAliases', $moduleAlisases);
        $this->_front->setDefaultModule(Nine_Initializer::$_config['defaultModule']);
        $this->_front->setDefaultControllerName(Nine_Initializer::$_config['defaultController']);
        $this->_front->setDefaultAction(Nine_Initializer::$_config['defaultAction']);
        $this->_front->setControllerDirectory($arrayModule);
        $this->_front->setBaseUrl(Nine_Registry::get('APP_BASE_URL'));
        $this->_front->setParam('prefixDefaultModule', true);
        
    }
    
    /**
     * Change alias name to module name in URI
     * 
     * @return void
     * @throws Exception if module's alias point to empty module's name
     */
    public function changeAliasToModuleName ()
    {
        $appBaseUrl = Nine_Registry::get('APP_BASE_URL');
        $params = substr($_SERVER['REQUEST_URI'], strlen($appBaseUrl));
        $params = explode('/', trim($params, '/'));
        $alias = $params[0];
        if (null == $alias) {
            return null;
        } else {
            if (Nine_Registry::isRegistered('moduleAliases')) {
                $moduleAliases = @Nine_Registry::get('moduleAliases');
                if (! array_key_exists($alias, $moduleAliases)) {
                    return null;
                }
                $module = $moduleAliases[$alias];
                if (null == $module) {
                    throw new Exception("Module's alias ($alias) point to empty module's name");
                }
                $params[0] = $module;
                $params = implode('/', $params);
                $_SERVER['REDIRECT_URL'] = $appBaseUrl . $params;
                $_SERVER['REQUEST_URI']  = $appBaseUrl . $params;
            }
        }
//        /**
//         * Reset server params
//         */
//        echo '<pre>';print_r($_SERVER);
//        $params = implode('/', $params);
//        $_SERVER['REDIRECT_URL'] = $appBaseUrl . $params;
//        $_SERVER['REQUEST_URI']  = $appBaseUrl . $params;
//        echo '<pre>';print_r($_SERVER);die;
    }
}
