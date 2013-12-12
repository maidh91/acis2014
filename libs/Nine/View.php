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
require_once 'Zend/View/Interface.php';
require_once 'Smarty/Smarty.class.php';
require_once 'Nine/View/RegisterBroker.php';
require_once 'Zend/View/Helper/HeadScript.php';
require_once 'Zend/View/Helper/HeadStyle.php';
require_once 'Zend/View/Helper/HeadLink.php';
require_once 'Zend/View/Helper/HeadTitle.php';
require_once 'Zend/View/Helper/HeadMeta.php';
class Nine_View implements Zend_View_Interface
{
    /**
     * Instance of Smarty
     * @var Smarty
     */
    public $smarty;
    /**
     * Instance of Nine_View_RegisterBroker
     * @var Nine_View_RegisterBroker
     */
    public $helper;
    /*
     * Head data for template: javascript, css file and javascript and css code
     * headScript and headStyle helper instance 
     * 
     * @var string
     */
    public $headScript = null;
    public $headStyle = null;
    public $headLink = null;
    public $headTitle = null;
    public $headMeta = null;
    /**
     * Using for creating cache file
     * 
     * @var string
     */
    public $cacheId = null;
    /**
     * Constructor
     *
     * @param string $tmplPath
     * @param array  $extraParams
     * @return void
     */
    public function __construct ($tmplPath = null, $extraParams = array())
    {
        $this->smarty = new Smarty();
        $this->helper = new Nine_View_RegisterBroker($this->smarty);
        if (null !== $tmplPath) {
            $this->setScriptPath($tmplPath);
        }
        foreach ($extraParams as $key => $value) {
            $this->smarty->$key = $value;
        }
        $this->headScript = new Zend_View_Helper_HeadScript();
        $this->headStyle = new Zend_View_Helper_HeadStyle();
        $this->headLink = new Zend_View_Helper_HeadLink();
        $this->headTitle = new Zend_View_Helper_HeadTitle();
        $this->headMeta = new Zend_View_Helper_HeadMeta();
        
        /**
         * Init default headTitle, headMeta
         */
        $this->headTitle->headTitle(@Nine_Registry::getConfig('websiteName'));
        $this->headMeta->headMeta(@Nine_Registry::getConfig('metaKeywords'),'keywords');
        $this->headMeta->headMeta(@Nine_Registry::getConfig('metaDescription'),'description');
    }
    /**
     * Return the template engine object
     *
     * @return Smarty
     */
    public function getEngine ()
    {
        return $this->smarty;
    }
	/**
     * Set new template engine object
     *
     * @return void
     */
    public function setEngine ($engine)
    {
        $this->smarty = $engine;
    }
    /**
     * Return the helper
     * 
     * @return Nine_View_RegisterBroker
     */
    public function getHelper ()
    {
        return $this->helper;
    }
    /**
     * Set the path to the templates
     *
     * @param string $path The directory to set as the path.
     * @return void
     */
    public function setScriptPath ($path)
    {
        if (is_readable($path)) {
            $this->smarty->template_dir = $path;
            return;
        }
        throw new Exception('Invalid path provided');
    }
    /**
     * Retrieve the current template directory
     *
     * @return string
     */
    public function getScriptPaths ()
    {
        return array($this->smarty->template_dir);
    }
    /*
     * get Nine_View instance
     */
	public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**
     * Retrieve the current compile directory
     * 
     * @return string
     */
	
    public function getCompilePath ()
    {
        return $this->smarty->compile_dir;
    }
    /**
     * Set the current compile directory
     * 
     * @param string $path
     * @return void
     */
    public function setCompilePath ($path)
    {
        $this->smarty->compile_dir = $path;
    }
    /**
     * Retrieve the current cache directory
     * 
     * @return string
     */
    public function getCachePath ()
    {
        return $this->smarty->cache_dir;
    }
    /**
     * Set the current cache directory
     * 
     * @param string $path
     * @return void
     */
    public function setCachePath ($path)
    {
        $this->smarty->cache_dir = $path;
    }
    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function setBasePath ($path, $prefix = 'Nine_View')
    {
        return $this->setScriptPath($path);
    }
    /**
     * Alias for setScriptPath
     *
     * @param string $path
     * @param string $prefix Unused
     * @return void
     */
    public function addBasePath ($path, $prefix = 'Zend_View')
    {
        return $this->setScriptPath($path);
    }
    /**
     * Assign a variable to the template
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set ($key, $val)
    {
        $this->smarty->assign($key, $val);
    }
    /**
     * Get a variable assigned for the template
     *
     * @param string $key The variable name.
     * @return mix The value of variable
     */
    public function __get ($key)
    {
        return $this->smarty->get_template_vars($key);
    }
    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset ($key)
    {
        return (null !== $this->smarty->get_template_vars($key));
    }
    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset ($key)
    {
        $this->smarty->clear_assign($key);
    }
    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @see __set()
     * @param string|array $spec The assignment strategy to use (key or
     * array of key => value pairs)
     * @param mixed $value (Optional) If assigning a named variable,
     * use this as the value.
     * @return void
     */
    public function assign ($spec, $value = null)
    {
        if (is_array($spec)) {
            $this->smarty->assign($spec);
            return;
        }
        $this->smarty->assign($spec, $value);
    }
    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via
     * {@link assign()} or property overloading
     * ({@link __get()}/{@link __set()}).
     *
     * @return void
     */
    public function clearVars ()
    {
        $this->smarty->clear_all_assign();
    }
    /**
     * Processes a template and returns the output.
     *
     * @param string $name The template to process.
     * @return string The output.
     */
    public function render ($name, $cacheId = null)
    {
        /**
         * Create temporary folder for Smarty's compilation and caching if they didn't exist
         */
        /**
         * Compilation folder
         */
        if (! is_dir($this->getCompilePath())) {
            if (ini_get('safe_mode')) {
                throw new Exception('PHP SAFE MODE is ON. System can not create compile folder "'
                                    . $this->getCompilePath() . '". Please create it with 777 mode.');
            } else {
                mkdir($this->getCompilePath(), 0777, true);
            }
        } elseif (! is_writable($this->getCompilePath())) {
            throw new Exception('Compile folder "' . $this->getCompilePath()
                                . '" is not writable. Please change it to 777 mode.');
        }
        /**
         * Caching folder
         */
        if (! is_dir($this->getCachePath())) {
            if (ini_get('safe_mode')) {
                throw new Exception('PHP SAFE MODE is ON. System can not create compile folder: '
                                    . $this->getCachePath() . '". Please create it with 777 mode.');
            } else {
                mkdir($this->getCachePath(), 0777, true);
            }
        } elseif (! is_writable($this->getCachePath())) {
            throw new Exception('Compile folder "' . $this->getCachePath()
                                . '" is not writable. Please change it to 777 mode.');
        }
        
        if (null == $cacheId) {
            $cacheId = $this->cacheId;
        }
        
        return $this->smarty->fetch($name, $cacheId);
    }
	/*
	 * add head script file for client script 
	 * @return void
	 */
	public function addHeadScriptFile($filePath)
	{
		$this->headScript->appendFile($filePath);
	}
	/*
	 * add head script for client javascript 
	 * @return void
	 */
	public function addHeadScript($script)
	{
		$this->headScript->appendScript($script);
	}
	/* 
	 * add head css file
	 * return void
	 */
	public function addHeadStyleFile($filePath)
	{
		$this->headLink->appendStylesheet($filePath);
	}
	/*
	 * add head css
	 * return void
	 */
	public function addHeadStyle($style)
	{
		$this->$this->headStyle->appendStyle($style);
	}
	/*
	 * synchronize data from view
	 * @return void
	 */
	public function synchronize()
	{
		$this->assign('headStyle', $this->headStyle->toString());
		$this->assign('headLink', $this->headLink->toString());
		$this->assign('headScript', $this->headScript->toString());	
		$this->assign('headTitle', $this->headTitle->toString());
		$this->assign('headMeta', $this->headMeta->toString());	
	}
	/**
	 * Set title
	 * 
	 * @param string $string title of page
	 * @return void
	 */
	public function headTitle($string)
	{
	    $websiteName = Nine_Registry::getConfig('websiteName');
	    if (null != $websiteName) {
	        $websiteName .= " - ";
	    }
		$this->headTitle->headTitle( $websiteName . "$string", Zend_View_Helper_Placeholder_Container_Abstract::SET);
	}
	/**
	 * Set metadata keywords
	 * 
	 * @param string $string content of metadata
	 * @return void
	 */
	public function headMetaKeywords($string)
	{
		$this->headMeta->headMeta($string,'keywords','name',array(),Zend_View_Helper_Placeholder_Container_Abstract::SET);
	}
	/**
	 * Set metadata description
	 * 
	 * @param string $string content of metadata
	 * @return void
	 */
	public function headMetaDescription($string)
	{
		$this->headMeta->headMeta($string,'description','name',array(),Zend_View_Helper_Placeholder_Container_Abstract::SET);
	}
	
	/**
	 * Set metadata property
	 * 
	 * @param string $name
	 * @param string $content
	 * @return void
	 */
	public function headMetaProperty($name, $content) 
	{
		$this->headMeta->headMeta($content,$name,'property',array(),Zend_View_Helper_Placeholder_Container_Abstract::APPEND);
	}
	
}