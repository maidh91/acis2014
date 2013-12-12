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
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Transport/Smtp.php';
require_once 'Nine/Model.php';
require_once 'modules/mail/models/MailStore.php';
class Models_Mail extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'mail_id';
    
    /**
     * The field name what we use to group all language rows together
     * 
     * @var string
     */
    protected $_groupField = 'mail_gid';
    
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array('subject','content','enabled');
    
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
        $this->_name = $this->_prefix . 'mail';
        return parent::__construct($config); 
    }

    /**
     * Get all mails with conditions
     * 
     * @param $condition
     * @param $order
     * @param $count
     * @param $offset
     */
    public function getAllSystemMails($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('m' => $this->_name))
                ->join(array('l' => $this->_prefix . 'lang'), 'm.lang_id = l.lang_id', array('lname' => 'name', 'lang_image'))
                ->order($order)
                ->limit($count, $offset);
        /**
         * Conditions
         */
       	if (null != @$condition['keyword']) {
            $select->where($this->getAdapter()->quoteInto('m.subject LIKE ?', "%{$condition['keyword']}%"));
        }
        
        return $this->fetchAll($select)->toArray();
    }
    

    /**
     * Send HTML mail from DB mail template
     * 
     * @param string $mailTemplateName
     * @param array $data
     * @param string|array $to 
     * @param string $subject If null, subject from DB will be chosen
     */
    public function sendHtmlMail($mailTemplateName, $data = array(), $to = array(), $subject = null, $replyTo = null, $from = null, $attachments = array())
    {
    	if (!is_array($to)) {
            $to = array($to);
        }
        
     	if (!is_array($attachments)) {
        	$attachments = array($attachments);
        }
        
        /**
         * Get mail template
         */
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('m' => $this->_name))
                ->where('m.name=?', $mailTemplateName)
                ->where('m.lang_id=?', Nine_Language::getCurrentLangId());
        
        $mail = @$this->fetchRow($select)->toArray(); 
		
        if (null == $mail) {
            return true;
        }
        /**
         * Change key
         */
        $newKey = array();
        foreach ($data as $index => $item) {
            $newKey['['. strtoupper($index) . ']'] = $item;
        }
        $data = $newKey;
        
        /**
         * Insert data file for the first time call
         */
        if (null == $mail['data']) {
        	if (! empty($data)) {
            	$mail['data'] = array_keys($data);
            	$this->update(array('data' => implode('<br/>', $mail['data'])), array('mail_gid=?' => $mail['mail_gid']));
        	}
        }
        else {
        	$mail['data'] = explode('<br/>', trim($mail['data']));
        }
        
        /**
         * Replace subject
         */
        if (null == $subject) {
            /**
             * Replace subject with DATA
             */
            $mail['subject'] = str_replace($mail['data'], $data, $mail['subject']);
        } else {
            $mail['subject'] = $subject;
        }
        /**
         * Replace content
         */
        $mail['content'] = str_replace($mail['data'], $data, $mail['content']);
        
        $fromMail = Nine_Registry::getConfig('fromMail');
        
    	if (null != $from) {
        	$fromMail = $from;
        }
        
        /**
         * Send via SMTP
         */
        
        $config = Nine_Registry::getConfig();
        
        $transport = new Zend_Mail_Transport_Smtp($config['smtpMailServer'],$config['smtpMail']);
    	Zend_Mail::setDefaultTransport($transport);
        
    	$objMailStore = new Models_MailStore();
    	
        foreach ($to as $email) {
        	
        	/**
        	 * Create Zend Mail Object and send
        	 */					
        	$zmail = new Zend_Mail('utf-8');
        	$zmail->setFrom($fromMail);
        	$zmail->addTo($email);
        	if (null != $replyTo) {
        		$zmail->setReplyTo($replyTo);				
        	}
        	else {
        		$zmail->setReplyTo($fromMail);
        	}			
        	$zmail->setSubject($mail['subject']);
        	$zmail->setBodyHtml($mail['content']);
        	
        	if (!empty($attachments)) {
        		$finfo = finfo_open(FILEINFO_MIME_TYPE);
        		foreach ($attachments as $attachment) {
        			if (null != @$attachment) {
	        			$tmp = @explode("/", trim($attachment,"/ "));
	        			$filename = @end($tmp);
	        			$zmail->createAttachment(file_get_contents($attachment),
	        									finfo_file($finfo,realpath($attachment)),
	        									Zend_Mime::DISPOSITION_INLINE,
	                        					Zend_Mime::ENCODING_BASE64,
	                        					$filename
	                        					);
        			}
        		}
        	}
        	
        	$zmail->send();
        	/**
        	 * Store send mail
        	 */
        	$mail_store = array (
        			'type'    => 1,
        			'mail_gid'	=> $mail['mail_gid'],
        			'from'    => $fromMail,
        			'to'      => $email,
                    'subject' => $mail['subject'],
        			'content' => $mail['content'],
        			'date'    => time() //20110709
        					);
            $objMailStore->insert($mail_store);
        }
        
        
        // To send HTML mail, the Content-type header must be set
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//        if (null != $fromMail) {
//			if (null != $replyTo) {
//				$headers .= "From: {$fromMail}" . "\r\n" .
//                "Reply-To: {$replyTo}" . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//			}        	
//            else {
//            	$headers .= "From: {$fromMail}" . "\r\n" .
//                "Reply-To: {$fromMail}" . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//            }
//        }
//        
//        /**
//         * Send mail
//         */
//        $objMailStore = new Models_MailStore();
//        foreach ($to as $email) {
//        	$mail_store = array (
//        			'type'    => 1,
//        			'mail_gid'	=> $mail['mail_gid'],
//        			'from'    => $fromMail,
//        			'to'      => $email,
//                    'subject' => $mail['subject'],
//        			'content' => $mail['content'],
//        			'date'    => time() //20110709
//        					);
//            @mail($email, $mail['subject'], $mail['content'], $headers);
//            $objMailStore->insert($mail_store);
//        }
    }
}