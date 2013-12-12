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
 
require_once 'Nine/Controller/Action.php';
class Nine_Controller_Action_Admin extends Nine_Controller_Action 
{
    /**
     * access control list for back end
     */
    protected $aclAdmin = null;
    /**
     * (non-PHPdoc)
     * @see libs/Nine/Controller/Nine_Controller_Action#init()
     */
    public function init()
    {
        parent::init();
        if(!$this->auth->isLogin()){
             $this->_redirect("access/admin/login");
        }
        /**
         * Check permission to access this application
         */
        $this->_initAcl();
    }
    /**
     * Json encode & backslash before quote (')
     * 
     * Using when send json-encode response to client with javascript execution
     * 
     * @param mixed $data
     * @return string
     */
    public function jsonEncode($data)
    {
        return str_replace("'", "\\'", json_encode($data));
    }
    
	protected function _initAcl(){		
	    $isRedirect = false;
		if (!parent::_initAcl()) {
			$isRedirect = true;
		} else {
		    $username = $this->auth->getUsername();	
		    $this->aclAdmin = new Nine_Acl($username);
		    Nine_Registry::set('aclAdmin', $this->aclAdmin);
//		    echo '<pre>';print_r($this->aclAdmin);die;

		    $isRedirect = !$this->aclAdmin->checkPermission('access', 'application::' . Nine_Registry::getAppName());		   
		}
		if ($isRedirect  && Nine_Registry::getModuleName() != 'access') {
		    $url = "";
			$module = Nine_Registry::getModuleName();
			$controller = Nine_Registry::getControllerName();
			$action = Nine_Registry::getActionName();
			$params = $this->_request->getParams();
			
			$url .= $module . '/' . $controller . '/' . $action . '/';
			unset($params[Nine_Registry::getModuleKey()]);
			unset($params[Nine_Registry::getControllerKey()]);
			unset($params[Nine_Registry::getActionKey()]);
			
//			echo "<pre>";print_r($params);die;
			
			foreach($params as $key => $param) {
				$url .= @urlencode($key) . '/' . @urlencode($param);
			}
			$this->_setCallBackUrl($url);    
			if (null != $this->auth->getUsername()) {
			    $this->session->accessMessage = Nine_Language::translate("You don't have permission to access this application");
			}
				
			$this->_redirect("access/admin/login");
		}
		
		return true;
	}

    
    protected function _getSpotPrices() 
    {
        $content = file_get_contents('http://www.kitco.com/market/');
        $pos = stripos($content, 'GOLD</a>');
        $content = substr($content, $pos);
        
        $pos = stripos($content, 'PLATINUM</a>');
        $content = substr($content, 0, $pos);
        
        $content = explode('<p>', $content);
//        echo $content;die;
//        echo '<pre>';print_r($content);die;
        $spotGold = @floatval($content['3']);
        $spotSilver = @floatval($content['10']);
        
        $this->session->spotPrice = array(
            'gold' => ($spotGold)?$spotGold:0,
            'silver' => ($spotSilver)?$spotSilver:0,
            'time' => time()
        );
        
        
//        echo '<pre>';print_r($this->session->spotPrice);die;
    }
}