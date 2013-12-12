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
class Nine_Constant
{
	/**
	 * DEVELOP_MODE used for coding, TEST_MODE used for testing and PRODUCT_MODE used for published product
	 */
	const DEVELOP_MODE = 0;
	const TEST_MODE    = 1;
	const PRODUCT_MODE = 2;	
	
	/**
	 * Smarty's delimiter 
	 */
	const SMARTY_LEFT_DELIMITER  = '{{';
	const SMARTY_RIGHT_DELIMITER = '}}';
	
	/**
	 * View's contants
	 */
	const VIEW_SUFFIX      = 'tpl';
	const VIEW_CONTENT_KEY = 'content';
	
	/**
	 * Database's contants
	 */
	const DB_MYSQL_ADAPTER      = 'Pdo_Mysql';
	const DB_MYSQL_EXTENSION    = 'mysqli';
	const DB_ORACLE_ADAPTER     = 'Pdo_Oci';
	const DB_ORACLE_EXTENSION   = 'oci8';
	const DB_DB2_ADAPTER        = 'Pdo_Ibm';
	const DB_DB2_EXTENSION      = 'ibm_db2';
	const DB_SQLSERVER_ADAPTER  = 'Pdo_Mssql';
	const DB_POSTGRESQL_ADAPTER = 'Pdo_Pgsql';
	const DB_SQLITE_ADAPTER     = 'Pdo_Sqlite';
	
	/**
	 * Config's constants
	 */
	const CONFIG_AS_DEFAULT = '';
	
	/**
	 * Status's constants
	 */
	const STATUS_DRAFT     = 1;
	const STATUS_AVAILABLE = 2;
	const STATUS_PUBLIC    = 3;
	const STATUS_ARCHIVE   = 4;
	
	const STATUS_INVISIBLE = 0;
	const STATUS_VISIBLE   = 1;
	
	const STATUS_DISABLED  = 0;
	const STATUS_ENABLED   = 1;
	
	/**
	 * User's constants
	 */
	const USER_PASSWORD_MIN_LENGTH = 6;
	/**
	 * Session 's constants
	 */
	const SESSION_NAMESPACE = "nine";
	
	/**
	 * Mail's constants 
	 */
	const MAIL_SYSTEM = 1;
	const MAIL_NEWSLETTER = 2;
}