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
require_once 'Zend/Controller/Action/Helper/ViewRenderer.php';

class Nine_Controller_Action_Helper_ViewRenderer extends Zend_Controller_Action_Helper_ViewRenderer
{

    /**
     * postDispatch - auto render a view
     *
     * Override Zend_Controller_Action_Helper_ViewRenderer::postDispatch()
     * @return void
     */
    public function postDispatch()
    {
        /**
         * Get module name, controller name, action name
         */
        $request = $this->getRequest();
        $module  = $request->getModuleName();
        if (null === $module) {
            $module = $this->getFrontController()->getDispatcher()->getDefaultModule();
        }
        $controller = $request->getControllerName();
        if (null === $controller) {
            $controller = $this->getFrontController()->getDispatcher()->getDefaultControllerName();
        }
        $action  = $request->getActionName();
        if (null == $action) {
            $action = $this->getFrontController()->getDispatcher()->getDefaultAction();
        }
        /**
         * Set cacheId for Smarty's caching
         */
        $langCode = Nine_Registry::get('langCode');
        $this->view->cacheId = Nine_Registry::getAppName() . '|' . $langCode . '|module|'
                             . $module . '_' . $controller . '_' . $action
                             . (($this->view->cacheId)?('_' . $this->view->cacheId):'');
        /**
         * Call parent's postDispatch() function
         */
        $result = parent::postDispatch();
        /**
         * Revive Nine_Language::$currentType and Nine_Language::$currentName
         */
        Nine_Language::$currentType = Nine_Registry::get('controllerCurrentType');
        Nine_Language::$currentName = Nine_Registry::get('controllerCurrentName');
        
        return $result;
    }
}