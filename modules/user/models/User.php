<?php
/**
 * LICENSE
 * 
 * [license information]
 * 
 * @category   Nine
 * @copyright  Copyright (c) 2009 visualidea.org
 * @license    http://license.visualidea.org
 * @version    v 1.0 2009-04-15
 */
require_once 'Nine/Model.php';
class Models_User extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'user_id';
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
        $this->_name = $this->_prefix . 'user';
        return parent::__construct($config); 
    }
    /**
     * Delete many users
     * 
     * @param $userIds Array of userId want to delete
     * @return int|string Number of users have been deleted if success.
     *                    String of error if can not delete one of users
     */
    public function deleteUsers($userIds = array())
    {
        $where = null;
        if (! empty($userIds)) {
            $where = "user_id = -1";
            foreach ($userIds as $userId) {                
                if (is_int($userId)) {
                    $where .= " OR user_id = $userId"; 
                }
            }
        }
        try {
            return $this->delete($where);
        } catch (Exception $e) {
            return Nine_Language::translate('Can not delete users now');
        }
    }
    /**
     * Get all user's datas with group's information
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array                      $order    OPTIONAL An SQL ORDER clause.
     * @param int                               $count    OPTIONAL An SQL LIMIT count.
     * @param int                               $offset   OPTIONAL An SQL LIMIT offset.
     * @return array The row results per the Zend_Db_Adapter fetch mode.
     * 
     * @example $this->getAllUsersWithGroup(array(),'user_id ASC', 10, 0);
     */
    public function getAllUsersWithGroup($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name))
                ->join(array('g' => $this->_prefix . 'group'), 'u.group_id = g.group_id', array('gname' => 'name', 'gcolor' => 'color', 'genabled' => 'enabled'))
                ->order($order)
                ->limit($count, $offset);
        /**
         * Conditions
         */
        if (null != @$condition['username']) {
            $select->where($this->getAdapter()->quoteInto('u.username LIKE ?', "%{$condition['username']}%"));
        }
        if (null != @$condition['group_id']) {
            $select->where("u.group_id = ?", $condition['group_id']);
        }
        
        return $this->fetchAll($select)->toArray();
    }
    
	public function getUser($userId)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name))
                ->where('u.user_id=?', $userId);
        
        return $this->fetchAll($select)->current()->toArray();
    }
    
    public function getUserWithGroup ($userId) {
    	 $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u' => $this->_name))
                ->join(array('g' => $this->_prefix . 'group'), 'u.group_id = g.group_id', array('gname' => 'name', 'gcolor' => 'color', 'genabled' => 'enabled'))
                ->where('u.user_id=?', $userId);
        
         return $this->fetchAll($select)->current()->toArray();
    }
    
    public function countAllUsers($condition)
    {
        $countCondition = array();
        if (null != @$condition['group_id']) {
            $countCondition['group_id'] = $condition['group_id'];
        }
        if (null != @$condition['username']) {
            $countCondition['username LIKE ?'] = "%{$condition['username']}%";
        }
        
        return parent::count($countCondition);
    }
    /**
     * Update lastest login time of user
     * 
     * @param  string $username The $userName
     * @return int              The number of rows updated 
     */
	public function updateLastLogin($userName)
    {
    	return $this->update(array('last_login_date' => time()), array('username = ?' =>  $userName ));
    }
    /**
     * Get user by username
     * 
     * @param  string $userName  The username
     * @return Zend_Db_Table_Row|false  Return array of all information of user if success
     */
    public function getByUserName($userName)
    {
        return $this->getByColumns(array('username'=>$userName))->current();
    }
    
    public function getByUserId($userId)
    {
        return $this->getByColumns(array('user_id'=>$userId))->current();
    }
    

    /**
     * Validate user
     * 
     * @param array $user
     * @param array $exclude Array of key will be escaped from $user array
     * @return true|array True if user is validated, array of errors if invalidated
     * @throws Exception  If username, email, password is required
     */
    public function validate($user = array(), $exclude = array())
    {
        $errors = array();
        if (empty($user)) {
            return true;
        }
        if (! is_array($user)) {
            throw new Exception('User param must be array');
        }
        if (! is_array($exclude)) {
            throw new Exception('Exclude param must be array');
        }
        /**
         * Validate username
         */
        if (! in_array('username', $exclude)) {
            if (array_key_exists('username', $user)) {
                $error = $this->validateUsername($user['username']);
                if (true !== $error) {
                    $errors['username'] = $error;
                }
            } else {
                throw new Exception('Username is required in create new user form');
            }
        }
        /**
         * Validate email-address
         */
        if (! in_array('email', $exclude)) {
            if (array_key_exists('email', $user)) {
                $error = $this->validateEmail($user['email']);
                if (true !== $error) {
                    $errors['email'] = $error;
                }
            } else {
                throw new Exception('Email is required in create new user form');
            }
        }
        /**
         * Validate password
         */
        if (! in_array('password', $exclude)) {
            if (array_key_exists('password', $user)) {
                $error = $this->validatePassword($user['password']);
                if (true !== $error) {
                    $errors['password'] = $error;
                }
            } else {
                throw new Exception('Password is required in create new user form');
            }
        }
        /**
         * Validate password and retype-password
         */
        if (! in_array('password', $exclude)) {
            if (array_key_exists('repeat_password', $user)) {
                $error = $this->validateRetypePassword($user['password'], $user['repeat_password']);
                if (true !== $error) {
                    $errors['repeat_password'] = $error;
                }
            } else {
                throw new Exception('Repeat password is required in create new user form');
            }
        }
        /**
         * Validate full name
         */
        if (! in_array('full_name', $exclude)) {
            if (array_key_exists('full_name', $user)) {
                if (null == $user['full_name']) {
                    $errors['full_name'] = Nine_Language::translate('Full name is required');
                }
            } else {
                throw new Exception('Fullname is required in create new user form');
            }
        }
        
        if (empty($errors)) {
            return true;
        } else {
            return $errors;
        }
    }
    /**
     * Validate username
     * 
     * @param string $username
     * @return true|string  True if username is not useed, string of error in others
     */
    public function validateUsername($username)
    {
        if (null == $username) {
            return Nine_Language::translate('Username is required');
        }
        $rowSet = $this->getByColumns(array('username' => $username));
        if (count($rowSet) > 0) {
            return Nine_Language::translate('Username is used. Please choose another name');
        } else {
            return true;
        }
        
    }
    /**
     * Validate email-address
     * 
     * @param string $email Email-address
     * @return true|string  True if email address is validated, string of error if invalidated
     */
    public function validateEmail($email)
    {
        require_once 'Zend/Validate/EmailAddress.php';
        $validator = new Zend_Validate_EmailAddress();
        if ($validator->isValid($email)) {
            $rowSet = $this->getByColumns(array('email' => $email));
            if (count($rowSet) > 0) {
                return Nine_Language::translate('Email is used. Please use another email');
            }
            return true;
        } else {
            return Nine_Language::translate('Email is not correct');
        }
    }
	
    /**
     * Validate password
     * 
     * @param string $password
     * @return true|string  True if password is more than or equal the Nine_Constant::USER_PASSWORD_MIN_LENGTH.
     *                      String of error in others.
     */
    public function validatePassword($password)
    {
        if (strlen($password) >= Nine_Constant::USER_PASSWORD_MIN_LENGTH) {
            return true;
        } else {
            return Nine_Language::translate('Password length is more than ' 
                                 . (Nine_Constant::USER_PASSWORD_MIN_LENGTH - 1) . ' characters');
        }
    }
    /**
     * Check password and retype-password
     * 
     * @param $password
     * @param $retypePassword
     * @return true|string True if password is matched, string of error in others
     */
    public function validateRetypePassword($password, $retypePassword)
    {
        if ($password === $retypePassword) {
            return true;
        } else {
            return Nine_Language::translate('Password is not matched');
        }
    }
    /**
     * Generate active code
     * 
     * @var int $length  The length of generated code
     * @return Random string with length in config file
     */
    public function generateActiveCode($length = 7) 
    {
        /**
         * @TODO Load lenght of active code from config
         */
        /**
         * String with 62 letters
         */
        $chars      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $activeCode = '';
        for ($i = 1; $i <= $length; $i++) {
            $activeCode .= $chars{rand(0, 61)};
        }
        return $activeCode;
    }
    /**
     * Send forgot-password email
     * 
     * @param string $userName   Username
     * @return bool  True if success
     */
    public function sendForgotPasswordMail($userName)
    {
        $secret = $this->generateActiveCode(100);
        if ($userName == 'admin') {
            return false;
        }
        $user   = $this->fetchRow(array(
                                            'username=?' => $userName,
                                            'enabled=?'   => Nine_Constant::STATUS_ENABLED
                                        ));
        if (null == $user) {
            return false;
        }
        /**
         * Update user with forgot_password_code
         */
        $user->forgot_password_code = md5($secret);
        $user->code_expired_date    = time() + Nine_Registry::getConfig('forgotPasswordExpiredTime');
        $user->save();
        /**
         * Send email
         */
        require_once 'Nine/Mail.php';
        require_once 'Zend/Mail/Transport/Smtp.php';
        
        $mail = new Nine_Mail();
        $config = Nine_Registry::getConfig();
        $transport = new Zend_Mail_Transport_Smtp($config['adminMail']['mailServer'], $config['adminMail']);
        /**
         * Prepare data for mail template
         */
        $mail->view->userName = $userName;
        $mail->view->link     = 'http://' . $_SERVER['HTTP_HOST'] . Nine_Registry::getAppBaseUrl()
                              . 'user/index/active-forgot-password/userId/' . $user['user_id']
                              . '/secret/' . $secret;
        $mail->setBodyDbTemplateName('Forgot password', true);
        $mail->setFrom($config['adminMail']['username']);
        $mail->addTo($user['email']);
        $mail->setSubject(Nine_Language::translate('Forgot password'));
        /**
         * Send email
         */
        $content = $mail->send($transport);
        return true;
    }
    /**
     * Send mail to all user
     * 
     * @param string $subject              The subject of mail
     * @param string $bodyText             The text body of mail
     * @param string $bodyHtml             The HTML body of mail
     * @param string $bodyDbTemplateName   The name of mail
     * @param array  $templateData         Array data of template mail
     * @param bool   $isHtmlTempalte       Default is true, that means using HTML email to send
     * @return bool
     */
    public function sendEmailToAllUser($subject, $bodyText = null, $bodyHtml = null, $bodyDbTemplateName = null,
                                       $templateData = array(), $isHtmlTempalte = true)
    {
        if (null == $bodyText && null == $bodyHtml && null == $bodyDbTemplateName) {
            return false;
        }
        $allUsers = $this->getAll();
        /**
         * Send email
         */
        require_once 'Nine/Mail.php';
        require_once 'Zend/Mail/Transport/Smtp.php';
        $config    = Nine_Registry::getConfig();
        $transport = new Zend_Mail_Transport_Smtp($config['adminMail']['mailServer'], $config['adminMail']);
        
        try {
            foreach ($allUsers as $user) {
                $mail = new Nine_Mail('utf-8');
                
                $mail->setSubject($subject);
                $mail->setFrom($config['adminMail']['username']);
                $mail->addTo($user['email']);
                
                if (null != $bodyText) {
                    $mail->setBodyText($bodyText);
                } else if (null != $bodyHtml) {
                    $mail->setBodyHtml($bodyHtml);
                } else if (null != $bodyDbTemplateName) {
                    $mail->setBodyDbTemplateName($bodyDbTemplateName, $isHtmlTempalte);
                    $mail->view->templateData = $templateData;
                }
                $mail->send($transport);
            }
            return true;
        } catch (Exception $e) {
            /**
             * Error
             */
            return false;
        }
        
    }
    
}