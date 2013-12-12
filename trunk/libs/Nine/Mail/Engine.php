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
require_once 'Smarty/Smarty.class.php';
require_once 'Shared/Objects/Mail.php';
class Nine_Mail_Engine extends Smarty
{
    /**
     * Override Smarty::__construct
     * 
     * @return void
     */
    public function __construct()
    {
        parent::Smarty();
        /**
         * Config some params
         */
        $viewConfig = Nine_Registry::getConfig('viewConfig');
        $viewConfig['template_dir'] = '';
        foreach ($viewConfig as $key=>$value) {
            $this->{$key} = $value;
        }
    }
    /**
     * Override Smarty::_read_file
     * Read template email from database
     *
     * @param string $filename
     * @return string|bool Return false if not found
     */
    function _read_file($filename)
    {
//        if ( file_exists($filename) && is_readable($filename) && ($fd = @fopen($filename, 'rb')) ) {
//            $contents = '';
//            while (!feof($fd)) {
//                $contents .= fread($fd, 8192);
//            }
//            fclose($fd);
//            return $contents;
//        } else {
//            return false;
//        }
//        echo $filename . "<hr/>HERE";die;
        $objMail = new Objects_Mail();
        if (Nine_Registry::isRegistered('emailLangCode')) {
            $langCode = Nine_Registry::get('emailLangCode');
        } else {
            $langCode = Nine_Registry::getLangCode();
        }
        $template = $objMail->getMailTemplate($filename, $langCode);
        if (null == $template) {
            return false;
        } else {
            return $template['content'];
        }
    }
    function _parse_resource_name(&$params)
    {

        // split tpl_path by the first colon
        $_resource_name_parts = explode(':', $params['resource_name'], 2);

        if (count($_resource_name_parts) == 1) {
            // no resource type given
            $params['resource_type'] = $this->default_resource_type;
            $params['resource_name'] = $_resource_name_parts[0];
        } else {
            if(strlen($_resource_name_parts[0]) == 1) {
                // 1 char is not resource type, but part of filepath
                $params['resource_type'] = $this->default_resource_type;
                $params['resource_name'] = $params['resource_name'];
            } else {
                $params['resource_type'] = $_resource_name_parts[0];
                $params['resource_name'] = $_resource_name_parts[1];
            }
        }
        /**
         * Modified here (2009_10_14)
         */
        return true;
//        if ($params['resource_type'] == 'file') {
//            if (!preg_match('/^([\/\\\\]|[a-zA-Z]:[\/\\\\])/', $params['resource_name'])) {
//                // relative pathname to $params['resource_base_path']
//                // use the first directory where the file is found
//                foreach ((array)$params['resource_base_path'] as $_curr_path) {
//                    $_fullpath = $_curr_path . DIRECTORY_SEPARATOR . $params['resource_name'];
//                    if (file_exists($_fullpath) && is_file($_fullpath)) {
//                        $params['resource_name'] = $_fullpath;
//                        return true;
//                    }
//                    // didn't find the file, try include_path
//                    $_params = array('file_path' => $_fullpath);
//                    require_once(SMARTY_CORE_DIR . 'core.get_include_path.php');
//                    if(smarty_core_get_include_path($_params, $this)) {
//                        $params['resource_name'] = $_params['new_file_path'];
//                        return true;
//                    }
//                }
//                return false;
//            } else {
//                /* absolute path */
//                return file_exists($params['resource_name']);
//            }
//        } elseif (empty($this->_plugins['resource'][$params['resource_type']])) {
//            $_params = array('type' => $params['resource_type']);
//            require_once(SMARTY_CORE_DIR . 'core.load_resource_plugin.php');
//            smarty_core_load_resource_plugin($_params, $this);
//        }
//
//        return true;
    }

    /**
     * fetch the template info. Gets timestamp, and source
     * if get_source is true
     *
     * sets $source_content to the source of the template, and
     * $resource_timestamp to its time stamp
     * @param string $resource_name
     * @param string $source_content
     * @param integer $resource_timestamp
     * @param boolean $get_source
     * @param boolean $quiet
     * @return boolean
     */

    function _fetch_resource_info(&$params)
    {
        if(!isset($params['get_source'])) { $params['get_source'] = true; }
        if(!isset($params['quiet'])) { $params['quiet'] = false; }

        $_return = false;
        $_params = array('resource_name' => $params['resource_name']) ;
        if (isset($params['resource_base_path']))
            $_params['resource_base_path'] = $params['resource_base_path'];
        else
            $_params['resource_base_path'] = $this->template_dir;

        if ($this->_parse_resource_name($_params)) {
            $_resource_type = $_params['resource_type'];
            $_resource_name = $_params['resource_name'];
            switch ($_resource_type) {
                case 'file':
                    if ($params['get_source']) {
                        $params['source_content'] = $this->_read_file($_resource_name);
                    }
//                    var_dump($params['source_content']);die;
//                    $params['resource_timestamp'] = filemtime($_resource_name);
                    $params['resource_timestamp'] = time();
//                    $_return = is_file($_resource_name) && is_readable($_resource_name);
                    $_return = true;
                    break;

                default:
                    // call resource functions to fetch the template source and timestamp
                    if ($params['get_source']) {
                        $_source_return = isset($this->_plugins['resource'][$_resource_type]) &&
                            call_user_func_array($this->_plugins['resource'][$_resource_type][0][0],
                                                 array($_resource_name, &$params['source_content'], &$this));
                    } else {
                        $_source_return = true;
                    }

                    $_timestamp_return = isset($this->_plugins['resource'][$_resource_type]) &&
                        call_user_func_array($this->_plugins['resource'][$_resource_type][0][1],
                                             array($_resource_name, &$params['resource_timestamp'], &$this));

                    $_return = $_source_return && $_timestamp_return;
                    break;
            }
        }

        if (!$_return) {
            // see if we can get a template with the default template handler
            if (!empty($this->default_template_handler_func)) {
                if (!is_callable($this->default_template_handler_func)) {
                    $this->trigger_error("default template handler function \"$this->default_template_handler_func\" doesn't exist.");
                } else {
                    $_return = call_user_func_array(
                        $this->default_template_handler_func,
                        array($_params['resource_type'], $_params['resource_name'], &$params['source_content'], &$params['resource_timestamp'], &$this));
                }
            }
        }

        if (!$_return) {
            if (!$params['quiet']) {
                $this->trigger_error('unable to read resource: "' . $params['resource_name'] . '"');
            }
        } else if ($_return && $this->security) {
            require_once(SMARTY_CORE_DIR . 'core.is_secure.php');
            if (!smarty_core_is_secure($_params, $this)) {
                if (!$params['quiet'])
                    $this->trigger_error('(secure mode) accessing "' . $params['resource_name'] . '" is not allowed');
                $params['source_content'] = null;
                $params['resource_timestamp'] = null;
                return false;
            }
        }
        return $_return;
    }
}