<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @package    Nine_View
 * @copyright  Copyright (c) 2011 9fw.org
 * @license    http://license.9fw.org
 * @version    v 1.0 2009-04-15
 * 
 */
require_once 'Nine/View/Register/Abstract.php';
class Nine_View_RegisterBroker
{
    /**
     * Instance of Smarty
     * @var Smarty
     */
    protected $_smarty;
    
    /**
     * Constructor
     * 
     * Instantiate the smarty
     * 
     * @param Smarty $engine Default null
     * @return void
     */
    public function __construct(Smarty $engine = null)
    {
        if (null !== $engine) {
            $this->_smarty = $engine;
        }
    }
    
    /**
     * Set the engine of RegisterBroker.
     * 
     * @param Smarty $engine The instance of Smarty
     * @return void
     */
    public function setEngine(Smarty $engine)
    {
        $this->_smarty = $engine;
    }
    
    /**
     * Get the engine of RegisterBroker
     * 
     * @return Smarty
     */
    public function getEngine()
    {
        return $this->_smarty;
    }
    
    /**
     * Register new register
     * 
     * @param Nine_View_Register_Abstract $register
     * @return Nine_View_RegisterBroker
     * @throws Exception if register is not instance of Nine_View_Register_Abstract
     */
    public function register(Nine_View_Register_Abstract $register)
    {
        if ($register instanceof Nine_View_Register_Abstract) {
            $register->registerToEngine($this->_smarty);
        } else {
            throw new Exception('Register is not instance of Nine_View_Register_Abstract');
        }
        
        return $this;
    }    
    
    /**
     * Unregister the register
     * 
     * @param Nine_View_Register_Abstract $register
     * @return Nine_View_RegisterBroker
     * @throws Exception if register is not instance of Nine_View_Register_Abstract
     */
    public function unregister(Nine_View_Register_Abstract $register)
    {
        if ($register instanceof Nine_View_Register_Abstract) {
            $register->unregisterToEngine($this->_smarty);
        } else {
            throw new Exception('Register is not instance of Nine_View_Register_Abstract');
        }
        
        return $this;
    }
}