<?php
return array (
  'database' => array(
            'adapter' => 'Pdo_Mysql',
            'params'  => array (
                        'host' => '127.0.0.1',
                        'username' => 'root',
                        'password' => '',
                        'dbname' => 'acomp',
                        'prefix' => '9_',
                        'profiler' => false //if false, system is quick
                      )
        ),
  'viewConfig'  => array(
					'compile_check' => true,
					'debugging' => false,
					'template_dir' => 'modules/',
					'compile_dir' => 'tmp/compile/',
					'cache_dir' => 'tmp/cache/',
					'plugins_dir' => 'libs/Smarty/plugins/',
					'cache_modified_check' => true,
					'caching' => false,
					'cache_lifetime' => 50//120					
			),
  'layoutConfig' => array(
			        
			),		
  'smtpMail' => array(
					'auth' => 'login',
                    'username' => 'no-reply@trithucviet.com.vn',
                    'password' => '@@123456',
                    'ssl' => 'ssl',
                    'port' => 465
            ),
  'smtpMailServer' => 'smtp.gmail.com',
  'fromMail' => 'no-reply@trithucviet.com.vn',
            
  'requiredModule' => array(
            'default' => 'default',
            'user'    => 'user',
            'access'    => 'access',
            'error' => 'error',
			'category' => 'category',
            'contact' => 'contact',
            'content' => 'content',
            'list' => 'list',
            'feedback'	=>	'feedback',
            'product'	=>	'product',
            'download' => 'download',
            'recruitment' => 'recruitment',
            'document'	=> 'document',
            'ads'	=>'ads',
            'lang'	=> 'lang'
        ),
        
  'log' => array(
            'active' => false
        ),
        
  'defaultLangCode' => 'en',
        
  'defaultApp' => 'front',
        
  'layoutCollection' => 'default',
        
  'defaultLayout' => 'front',
        
  'defaultModule' => 'default',
        
  'defaultController' => 'index',
        
  'defaultAction' => 'index',
        
  'usingMultiAuth' => true,
        
  'currentMode' => Nine_Constant:: DEVELOP_MODE,
//        DEVELOP_MODE,
//        PRODUCT_MODE,
        
  'forwardToDefaultAppWhenNotFoundAppName' => true, //or NULL when change to NOT FOUND page.
                                                    //If true, default application name can be missed

  'defaultNumberRowPerPage' => 12,
   
  'usingOneLanguage' => true,
        
  'dateFormat' => 'd/m/Y',
        
  'datepickerFormat' => array(
        'js'         => 'dd/mm/yy',  #Datepicker format
        'php'        => 'd/m/Y',     #Used for calculation to Unix time
        'display'    => 'dd/mm/yyyy' #Display for user
   ),
        
  'useAdminFullControlSystem' => true,
  
  'forgotPasswordExpiredTime' => 86400,
        
  'websiteName' => 'ACOMMP',
  'liveSite' => 'http://127.0.0.1:8080/acomp/'
);
