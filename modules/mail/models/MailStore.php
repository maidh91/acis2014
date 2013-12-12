<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Vi
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 */
require_once 'Nine/Model.php';
class Models_MailStore extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'mail_store_id';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array();
    
    /**
     * Constructor.
     *
     * Supported params for $config are:
     * - db              = user-supplied instance of database connector,
     *                     or key name of registry instance.
     * - name            = table name.
     * - primary         = string or array of primary key(s).
     * - rowClass        = row class name.
     * - rowsetClass     = rowset class name.
     * - referenceMap    = array structure to declare relationship
     *                     to parent tables.
     * - dependentTables = array of child tables.
     * - metadataCache   = cache for information from adapter describeTable().
     *
     * @param  mixed $config Array of user-specified config options, or just the Db Adapter.
     * @return void
     */
    public function __construct($config = array())
    {
        $this->_name = $this->_prefix . 'mail_store';
        return parent::__construct($config); 
    }
   
	public function getAllMails($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('m' => $this->_name))
                ->order($order)
                ->limit($count, $offset);
        /**
         * Conditions
         */
        if (null != @$condition['keyword']) {
            $select->where($this->getAdapter()->quoteInto('m.subject LIKE ?', "%{$condition['keyword']}%"))
                    ->group('m.mail_store_id');
        }
        
        return $this->fetchAll($select)->toArray();
    }
    
    public function sendHtmlMail($data = array(), $to = array(), $subject = null)
    {
        if (!is_array($to)) {
            $to = array($to);
        }
        $fromMail = Nine_Registry::getConfig('fromMail');
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        if (null != $fromMail) {
            $headers .= "From: {$fromMail}" . "\r\n" .
                "Reply-To: {$fromMail}" . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        }
        foreach ($to as $email) {
        	@mail($email, $subject , $data, $headers);
        }
    }
    
    
}