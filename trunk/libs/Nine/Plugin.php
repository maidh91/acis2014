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
require_once 'Zend/Controller/Plugin/Abstract.php';
class Nine_Plugin extends Zend_Controller_Plugin_Abstract
{	
    /**
     * Plugin's config. This cofig will autoload from 'config.php'
     * in this plugin directory by Nine_Plugin::__construct()
     * 
     * @var array
     */
    protected $_config = array();
	/*
     * Constructor
     */
	public function __construct($config = array())
	{		
	    $this->_config = $config;
	    
	    $this->init();
	}
	/**
	 * Init plugin
	 * 
	 * @return void
	 */
	public function init()
	{}
}