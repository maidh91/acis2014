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
abstract class Nine_View_Register_Abstract
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
     * @param Smarty $smarty Default null
     * @return void
     */
    public function __construct(Smarty $smarty = null)
    {
        if (null !== $smarty) {
            $this->_smarty = $smarty;
        }
    }
    
    /**
     * Register this register to smarty engine
     * 
     * This function will call all registered function in self::register()
     * 
     * @param Smarty $smarty Instance of Smarty, default is null
     * @return void
     */
    public function registerToEngine(Smarty $smarty = null)
    {
        if (null !== $smarty) {
            $this->_smarty = $smarty;
        }
        $this->register();
    }    
     
    /**
     * Unregister this register to smarty engine
     * 
     * This function will call all registered function in self::unregister()
     * 
     * @param Smarty $smarty Instance of Smarty, default is null
     * @return void
     */
    public function unregisterToEngine(Smarty $smarty = null)
    {
        if (null !== $smarty) {
            $this->_smarty = $smarty;
        }
        $this->unregister();
    } 
    
    /**
     * Registers block function to be used in templates
     *
     * @param string $block Name of template block
     * @param string|array $blockImpl PHP function to register
     * @param boll $cacheable Default is true. When registering a plugin with $cacheable=false the plugin is 
     *                        called everytime the page is displayed, even if the page comes from the cache
     * @param array $cacheAttrs Default is null. An array of attribute-names that should be cached     * 
     * @return void
     * 
     * @example 
     *        - register in register() function:
     *             $this->registerBlock('blockName', array('NameofRegisterClass', 'functionOfRegisterClass'));
     *        - using in template:
     *              {{* template with Smarty engine *}}
     *              {{blockName}}This is content...{{/blockName}}
     */
    public  function registerBlock($block, $blockImpl, $cacheable = true, $cacheAttrs = null)
    {
        $this->_smarty->register_block($block, $blockImpl, $cacheable, $cacheAttrs);
    }
    

    /**
     * Unregisters block function
     *
     * @param string $block Name of template function
     * @return void
     */
    public function unregisterBlock($block)
    {
        $this->_smarty->unregister_block($block);
    }
    
    /**
     * Register compiler function
     *
     * @param string $function Name of template function
     * @param string $functionImpl Name of PHP function to register
     * @param boll $cacheable Default is true. When registering a plugin with $cacheable=false the plugin is 
     *                        called everytime the page is displayed, even if the page comes from the cache
     * @return void
     * 
     * @example 
     *        - register in register() function:
     *             $this->registerCompilerFunction('funcName', array('NameofRegisterClass', 'functionOfRegisterClass'));
     *        - using in template:
     *              {{* template with Smarty engine *}}
     *              {{funcName param1='This is param1' param2='This is param2'}}
     */
    public function registerCompilerFunction($function, $functionImpl, $cacheable = true)
    {
        $this->_smarty->register_compiler_function($function, $functionImpl, $cacheable);
    }
    
    /**
     * Unregister compiler function
     *
     * @param string $function name of template function
     * @return void
     */
    function unregisterCompilerFunction($function)
    {
        $this->_smarty->unregister_compiler_function($function);
    }
    
    /**
     * Register custom function to be used in templates
     *
     * @param string $function The name of the template function
     * @param string $functionImpl The name of the PHP function to register
     * @param boll $cacheable Default is true. When registering a plugin with $cacheable=false the plugin is 
     *                        called everytime the page is displayed, even if the page comes from the cache
     * @param array $cacheAttrs Default is null. An array of attribute-names that should be cached
     * @return void
     * 
     * @example 
     *        - register in register() function:
     *             $this->registerFunction('funcName', array('NameofRegisterClass', 'functionOfRegisterClass'));
     *        - using in template:
     *              {{* template with Smarty engine *}}
     *              {{funcName param1='This is param1' param2='This is param2'}}
     */
    function registerFunction($function, $functionImpl, $cacheable = true, $cacheAttrs = null)
    {
        $this->_smarty->register_function($function, $functionImpl, $cacheable, $cacheAttrs);
    }

    /**
     * Unregister custom function
     *
     * @param string $function Name of template function
     * @return void
     */
    function unregisterFunction($function)
    {
        $this->_smarty->unregister_function($function);
    }

    /**
     * Register modifier to be used in templates
     *
     * @param string $modifier Name of template modifier
     * @param string $modifierImpl Name of PHP function to register
     * @return void
     * 
     * @example 
     *        - register in register() function:
     *             $this->registerModifier('modifierName', array('NameofRegisterClass', 'functionOfRegisterClass'));
     *        - using in template:
     *              {{* template with Smarty engine *}}
     *              {{$var|modifierName}}
     */
    function registerModifier($modifier, $modifierImpl)
    {
        $this->_smarty->register_modifier($modifier, $modifierImpl);
    }
    
    /**
     * Unregister modifier
     *
     * @param string $modifier Name of template modifier
     * @return void
     */
    function unregisterModifier($modifier)
    {
        $this->_smarty->unregister_modifier($modifier);
    }

    /**
     * Register object to be used in templates
     *
     * @param string $object Name of template object
     * @param object &$objectImpl The referenced PHP object to register
     * @param null|array $allowed List of allowed methods (empty = all)
     * @param boolean $smartyArgs Smarty argument format, else traditional
     * @param null|array $blockMethods List of methods that are block format
     * @return void
     * 
     * @example Please see the object section of the Smarty's manual for examples. 
     */
    function registerObject($object, &$objectImpl, $allowed = array(), $smartyArgs = true, $blockMethods = array())
    {
        $this->_smarty->register_object($object, $objectImpl, $allowed, $smartyArgs, $blockMethods);
    }

    /**
     * Unregister object
     *
     * @param string $object Name of template object
     * @return void
     */
    function unregisterObject($object)
    {
        $this->_smarty->unregister_object($object);
    }

    /**
     * Register an output filter function to apply
     * to a template output
     *
     * When the template is invoked via display() or fetch(), its output can be sent through one or more
     * output filters. This differs from postfilters because postfilters operate on compiled templates before
     * they are saved to the disk, and output filters operate on the template output when it is executed.
     *  
     * @param callback $function
     * @return void
     */
    function registerOutputfilter($function)
    {
        $this->_smarty->register_outputfilter($function);
    }

    /**
     * Unregister an outputfilter function
     *
     * @param callback $function
     * @return void
     */
    function unregisterOutputfilter($function)
    {
        $this->_smarty->unregister_outputfilter($function);
    }

    /**
     * Register a postfilter function to apply
     * to a compiled template after compilation
     *
     * @param callback $function
     * @return void
     */
    function registerPostfilter($function)
    {
        $this->_smarty->register_postfilter($function);
    }

    /**
     * Unregister a postfilter function
     *
     * @param callback $function
     * @return void
     */
    function unregister_postfilter($function)
    {
        $this->_smarty->unregister_postfilter($function);
    }

    /**
     * Register a prefilter function to apply
     * to a template before compiling
     *
     * @param callback $function
     * @return void
     */
    function registerPrefilter($function)
    {
        $this->_smarty->register_prefilter($function);
    }

    /**
     * Unregister a prefilter function
     *
     * @param callback $function
     * @return void
     */
    function unregisterPrefilter($function)
    {
        $this->_smarty->unregister_prefilter($function);
    }

    /**
     * Register a resource to fetch a template
     *
     * @param string $type Name of resource
     * @param array $functions Array of functions to handle resource
     * @return void
     */
    function registerResource($type, $functions)
    {
        $this->_smarty->register_resource($type, $functions);
    }

    /**
     * Unregister a resource
     *
     * @param string $type name of resource
     * @return void
     */
    function unregisterResource($type)
    {
        $this->_smarty->unregister_resource($type);
    }
    
    /**
     * Register all function want to be registered
     * 
     * Type of function can be registered as:
     *     - registerBlock
     *     - registerCompilerFunction
     *     - registerFunction
     *     - registerModifier
     *     - registerObject
     *     - registerOutputfilter
     *     - registerPostfilter
     *     - registerPrefilter
     *     - registerResource
     * This function will call automatically from sefl::registerToEngine() function
     * 
     * @return void
     */
    public function register()
    {}
    
    /**
     * Unregister all function want to be unregistered
     * 
     * Type of function can be unregistered as:
     *     - unregisterBlock
     *     - unregisterCompilerFunction
     *     - unregisterFunction
     *     - unregisterModifier
     *     - unregisterObject
     *     - unregisterOutputfilter
     *     - unregisterPostfilter
     *     - unregisterPrefilter
     *     - unregisterResource
     * This function will call automatically from sefl::unregisterToEngine() function
     * 
     * @return void
     */
    public function unregister()
    {}
}