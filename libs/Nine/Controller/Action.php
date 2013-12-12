<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @package    Nine_Controller
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 */
require_once 'Zend/Controller/Action.php';
require_once 'Nine/Auth.php';
class Nine_Controller_Action extends Zend_Controller_Action {
	/**
	 * Store system configurarion
	 */
	protected $_config = array ();
	/**
	 * store session object
	 * 
	 * @var Zend_Session_Namespace $session
	 */
	protected $session = null;
	/**
	 * Authencate object
	 * 
     * @var Nine_Auth $acl
	 */
	protected $auth;
	/**
	 * access control list
	 * 
	 */
	protected $acl = null;
	/**
	 * access control list for front end
	 */
	protected $aclFront = null;
    /**
     * Store Nine_Language::$currentName before changing it
     * 
     * @var string
     */
	protected $_currentName;
    /**
     * Store Nine_Language::$currentType before changing it
     * 
     * @var int
     */
	protected $_currentType;
	/**
	 * Init configuration
	 */
	public function init()
	{
	    /**
	     * Notify module type to translator
	     */
	    $this->_currentType       = Nine_Language::$currentType;
	    $this->_currentName       = Nine_Language::$currentName;
	    Nine_Language::$currentType = Nine_Language::TYPE_MODULE;
	    Nine_Language::$currentName = $this->_request->getModuleName();
		/**
		 * Add include path for controller
		 */
		set_include_path(get_include_path() . PATH_SEPARATOR . 'modules/' . Nine_Registry::getModuleName());
		/**
		 * start session for system
		 */
        $this->session = Nine_Registry::getSession();
		/**
		 * Load module config
		 */
		$this->_config = Nine_Registry::get ( 'config' );
		$configFile = 'modules/' . $this->_request->getModuleName () . '/config.php';
		if (is_file ( $configFile )) {
			$moduleConfig = include $configFile;
			/**
			 * Unset config item have values as default system
			 */
			$this->_unsetConfig ( $moduleConfig );
			/**
			 * Merge with system config
			 */
			$this->_config = array_merge ( $this->_config, $moduleConfig );
			Nine_Registry::set ( 'config', $this->_config );
		}
		/**
		 * Load module constant
		 */
		$constantFile = 'modules/' . $this->_request->getModuleName () . '/Constant.php';
		if (is_file ( $constantFile )) {
			include_once $constantFile;
		}
		/**
		 * Start up the auth
		 */
		$this->auth = Nine_Auth::getInstance();
		/**
		 * Set call back URL for "access" module
		 */
		if ('access' != $this->getRequest()->getModuleName()) {
			$url = $this->getRequest()->getRequestUri();
			$url = substr($url, strlen(Nine_Registry::getAppBaseUrl()) - 1);
		    $this->_setCallBackUrl($url);
		}
	}
	
	/**
	 * Set layout for action
	 * 
	 * @var string $layoutName name of layout
	 * @var string $layoutCollection name of layout collection
	 * @example $this->setLayout('layoutName', 'collectionName');
	 */
	public function setLayout($layoutName, $layoutCollection = false) {
		$layout = Nine_Layout::getMvcInstance ();
		$layout->setLayout ( $layoutName );
		if ($layoutCollection) {
			$layout->setLayoutPath ( Nine_Registry::get ( 'BASE_DIR' ) . 'layouts/' . $layoutCollection );
		}
	}
	/**
	 * Modify preDispatch() function of Zend_Controller_Action.
	 * This function will set variable for the View after Action executed
	 */
	public function preDispatch()
	{
        /**
         * Prearing data
         */
        $this->_assignCommonData();
	}
	/**
	 * Modify postDispatch() function of Zend_Controller_Action.
	 * This function will set variable for the View after Action executed
	 */
	public function postDispatch()
	{
	    /**
	     * Prearing data
	     */
	    $this->_assignCommonData();
		
		$this->view->synchronize();
		/**
		 * Registry two variables for using in Nine_Controller_Action_Helper_ViewRenderer::postDispatch()
		 */
        Nine_Registry::set('controllerCurrentType', $this->_currentType);
        Nine_Registry::set('controllerCurrentName', $this->_currentName);
	}
	/**
	 * Add backslash (\) for quote ('), double quote ("), backslash (\) when using in javascript
	 * 
	 * @param mixed $data Can be string, array, or object
	 * @param array $keys Default is empty array. With default, all element of $data will be added backslash.
	 *                    If $keys is array, all elements (or public properties if $data is object) of $data
	 *                    which $keys has will be added backslash.
	 * @return mixed      Return type of $data
	 * 
	 * @example Using as:
	 *                     $this->addSlashesForJs("O'Reilly");
	 *                     $this->addSlashesForJs(array('name' =>"O'Reilly", 'street'=> "O'Reilly Town, 123 New York"),
	 *                                            array('name')); //only 'name' will be added backslashes
	 */
	public function addSlashesForJs($data, $keys = array()) {
		if (is_array ( $data )) {
			if (empty ( $keys )) {
				/**
				 * Add slashes for all keys
				 */
				foreach ( $data as &$item ) {
					$item = $this->addSlashesForJs ( $item );
				}
				
				return $data;
			} else {
				/**
				 * Add slashes for the keys specified
				 */
				foreach ( $keys as $key ) {
					if (array_key_exists ( $key, $data )) {
						$data [$key] = $this->addSlashesForJs ( $data [$key] );
					}
				}
				
				return $data;
			}
		} else if (is_object ( $data )) {
			$newData = clone $data;
			$properties = get_object_vars ( $data );
			if (! empty ( $keys )) {
				foreach ( $properties as $property => $value ) {
					if (! array_key_exists ( $property, $keys )) {
						unset ( $properties [$property] );
					}
				}
			}
			foreach ( $properties as $property => $value ) {
				$newData->{$property} = $this->addSlashesForJs ( $value );
			}
			
			return $newData;
		} else {
			/**
			 * Is string or others
			 */
			return str_replace ( array ('\\', "'", '"' ), array ('\\\\', "\\'", '\\"' ), $data );
//			return str_replace("'", "\\'", json_encode($data));
		}
	}
	/**
	 * Unset default config item for merging configs
	 * 
	 * @param $array Array config
	 * @return void
	 */
	private function _unsetConfig($array) {
		if (! is_array ( $array )) {
			return;
		}
		foreach ( $array as $key => $item ) {
			if (is_array ( $item )) {
				$this->_unsetConfig ( $item );
			} else {
				if (Nine_Constant::CONFIG_AS_DEFAULT == $item) {
					unset ( $array [$key] );
				}
			}
		}
	}
	/**
	 * init access control list
	 * @return void
	 */
	protected function _initAcl()
	{
        require_once 'Nine/Acl.php';
        
		if ($this->auth->hasIdentity()) {
			$username       = $this->auth->getUsername();			
			$this->acl      = new Nine_Acl($username);
			Nine_Registry::set('acl', $this->acl);
			
			return true;
		}
		
		return false;
	}
	
    /**
     * Check permisison
     * 
     * @param string $permission
     * @param string $module
     * @param string|integer $expandId  Note: $expandId == '*": Check to have all expandable permisisnon
     *                                        $expandId == '?': Check to have one or more permisison
     *                                        $expandId is interger: Check for special expand value
     */
	public function checkPermission($permission, $module = null, $expandId = '*')
	{
	    if (null === $module) {
	        $module = Nine_Registry::getModuleName();
	    }
	    
	    if (null == $this->acl && (false === $this->_initAcl())) {
	        return false;
	    }

	    return $this->acl->checkPermission($permission, $module, $expandId);
	}
	
	protected function _forwardToNoPermissionPage()
	{
//	    echo '<pre>';print_r(get_included_files());die;
//	    echo $this->_request->getControllerName();die;
//	    $this->_forward('no-permission', $this->_request->getControllerName(), 'error');
        $this->_redirect('error/admin/no-permission');
	}
	/**
	 * set return url after login
	 * @return void
	 */
	protected function _setCallBackUrl($url)
	{
		$this->session->callBackUrl = $url;	
	}
	
	protected function _getCallBackUrl()
	{
		return $this->session->callBackUrl;
	}
	
	public function setPagination($numPerPage, $currentPage, $count)
	{
	    
        $countAllPage = ceil(@($count/$numPerPage));
        $numPrevPages = 5;
        $numNextPages = 5;
        $prevPagesArr = array();
        for ($i = $currentPage - $numPrevPages; $i < $currentPage; $i++) {
            if ($i >= 1) {
                $prevPagesArr[] = $i;
            }
        }
        $nextPagesArr = array();
        for ($i = $currentPage + 1; $i < $currentPage + $numNextPages; $i++) {
            if ($i <= $countAllPage) {
                $nextPagesArr[] = $i;
            }
        }

        /**
         * Register values for pagination
         */
        $this->view->currentPage   = $currentPage;
        $this->view->countAllPages = $countAllPage;
        $this->view->first         = (false === array_search(1, $prevPagesArr) && 1 != $currentPage)? 1:'';
        $this->view->prevPage      = (count($prevPagesArr))?end($prevPagesArr):'';
        $this->view->prevPages     = $prevPagesArr;
        $this->view->nextPages     = $nextPagesArr;
        $this->view->nextPage      = ($nextPagesArr)?reset($nextPagesArr):'';
        $this->view->last          = (false === array_search($countAllPage, $nextPagesArr)
                                      && $countAllPage != $currentPage)? $countAllPage:'';
        $this->view->numPerPage = $numPerPage;
        $this->view->countAllPages = $countAllPage;                                      
	}
	
    
	/**
	 * Get relative image path
	 * @param string $path
	 * 
	 * @return string
	 * @example: media/userfiles/images/restaurant/img.jpg
	 */
    public function getImagePath($path)
    {
        return substr($path, strlen(Nine_Registry::getBaseUrl()));
    }
    

    public function getThumbnailImagePath($path)
    {
        if (false !== strpos($path, 'media/userfiles/images/')) {
            /**
             * From backend
             */
            return 'media/userfiles/_thumbs/Images/' . substr($path, strlen('media/userfiles/images/'));
        } else {
            /**
             * From frontend USER
             */
            $matches = '';
            preg_match('$media/userfiles/restaurant_images/([^/]*)/(.*)$i', $path, $matches);
            return 'media/userfiles/restaurant_images/' . @$matches[1] . '/_thumbs/Images/' . substr($path, strlen('media/userfiles/restaurant_images/' . @$matches[1] . '/images/'));
        }
    }
	
    /**
     * Make safe URL for friendly URL from title or another string
     * 
     * @param string $string
     * @return string
     * 
     * @example 'This is title' => 'this-is-title'
     */
    public function makeURLSafeString($string)
    {
        $string = strtolower($string); // Makes everything lowercase (just looks tidier).
        $string = preg_replace('$[^a-z0-9/]+$', '-', $string); // Replaces all non-alphanumeric characters with a hyphen.
        $string = preg_replace(array('/[-]{2,}/', '$[/]{2,}$'), '/', $string); // Replaces one or more occurrences of a hyphen, with a single one.
        $string = trim($string, '-'); // This ensures that our string doesn't start or end with a hyphen.
        
        return $string;
    }
    /*
     * Assign some common data for view before and after dispatching
     */
    private function _assignCommonData()
    {
        $this->view->BASE_URL     = Nine_Registry::get ( 'BASE_URL' );
        $this->view->APP_NAME     = Nine_Registry::get ( 'APP_NAME' );
        $this->view->APP_BASE_URL = Nine_Registry::get ( 'APP_BASE_URL' );
        $this->view->LANG_CODE    = Nine_Registry::getLangCode();
        $this->view->HELPER_URL   = $this->view->BASE_URL . 'modules/' . $this->getRequest ()->getModuleName () . '/views/helpers/';
        $this->view->LAYOUT_NAME  = Nine_Layout::getMvcInstance ()->getLayout ();
        
        $layoutCollectionDir = Nine_Layout::getMvcInstance ()->getLayoutPath ();
        $layoutCollectionUrl = substr ( $layoutCollectionDir, strlen ( Nine_Registry::get ( 'BASE_DIR' ) ) );
        $this->view->LAYOUT_URL = $this->view->BASE_URL . $layoutCollectionUrl . '/';
        $this->view->LAYOUT_HELPER_URL = $this->view->LAYOUT_URL . 'helpers/';
        if (Nine_Constant::PRODUCT_MODE != $this->_config ['currentMode']) {
            $this->view->isProductMode = false;
        } else {
            $this->view->isProductMode = true;
        }
        /**
         * User
         */
        $this->view->LOGGED_GROUP_ID = @Nine_Registry::getLoggedInGroupId();
    }
    
    /**
     * Redirect to another URL
     *
     * Proxies to {@link Zend_Controller_Action_Helper_Redirector::gotoUrl()}.
     *
     * @param string $url
     * @param array $options Options to be used when redirecting
     * @return void
     */
    protected function _redirect($url, array $options = array())
    {
    	/**
    	 * If $url starts with "/", this means absolute link
    	 */
    	if ('/' == @$url{0}) {
//    		$url = rtrim(Nine_Registry::getConfig('liveSite'), '/') . $url;
    	}
        parent::_redirect($url, $options);
    }
}