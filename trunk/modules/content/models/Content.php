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
require_once 'modules/content/models/ContentCategory.php';

class Models_Content extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'content_id';
    /**
     * The field name what we use to group all language rows together
     * 
     * @var string
     */
    protected $_groupField = 'content_gid';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array('title', 'alias', 'intro_text', 'full_text', 'hit', 
                                           'last_view_date', 'param', 'meta_data', 'enabled');
    
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
        $this->_name = $this->_prefix . 'content';
        return parent::__construct($config); 
    }

    /**
     * Get all content with conditions
     * 
     * @param $condition
     * @param $order
     * @param $count
     * @param $offset
     */
//    public function getAllContentsWithDefaultLang($condition = array(), $order = null, $count = null, $offset = null)
//    {
//        $select = $this->select()
//                ->setIntegrityCheck(false)
//                ->from(array('s' => $this->_name), array('content_id', 'senabled' => 'enabled', 'publish_up_date' => 'publish_up_date', 'publish_down_date' => 'publish_down_date' , 'ssorting' => 'sorting', 'created_date' => 'created_date'))
//                ->join(array('sl' => $this->_prefix . 'content_lang'), 's.content_id = sl.content_id')
//                ->join(array('sc' => $this->_prefix . 'content_category'), 's.content_category_gid = sc.content_category_gid', array('cname' => 'name'))
//                ->order($order)
//                ->limit($count, $offset);
//        /**
//         * Conditions
//         */
//        if (null != @$condition['keyword']) {
//            $select->where($this->getAdapter()->quoteInto('sl.title LIKE ?', "%{$condition['keyword']}%"));
//        }
//        if (null != @$condition['content_category_gid']) {
//            $select->where("s.content_category_gid = ?", $condition['content_category_gid']);
//        }
//        if (null != @$condition['lang_id']) {
//            $select->where("sl.lang_id = ?", $condition['lang_id']);
//        }
//        
//        return $this->fetchAll($select)->toArray();
//    }

    /**
     * Get all content with conditions
     * 
     * @param $condition
     * @param $order
     * @param $count
     * @param $offset
     */
    public function getAllContent($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('c' => $this->_name))
                ->join(array('cc' => $this->_prefix . 'content_category'), 'c.content_category_gid = cc.content_category_gid', array('cname' => 'name','content_deleteable' => 'content_deleteable'))
                ->join(array('l' => $this->_prefix . 'lang'), 'c.lang_id = l.lang_id', array('lname' => 'name', 'lang_image'))
                ->where('cc.lang_id=?', Nine_Language::getCurrentLangId())
                ->order($order)
                ->limit($count, $offset);
        /**
         * Conditions
         */
        if (null != @$condition['keyword']) {
            $sql = "SELECT content_gid FROM {$this->_name} WHERE " . $this->getAdapter()->quoteInto('title LIKE ?', "%{$condition['keyword']}%");
            $ids = $this->_db->fetchAll($sql);
            if (empty($ids)) {
                return array();
            }
            $idString = '';
            foreach ($ids as $row) {
                $idString .= $row['content_gid'] . ',';
            }
            /**
             * Add to select object
             */
            $select->where('c.content_gid IN (' . trim($idString, ',') .')');
        }
        if (null != @$condition['content_category_gid']) {
            $select->where("c.content_category_gid = ?", $condition['content_category_gid']);
        }
        
        return $this->fetchAll($select)->toArray();
    }
    
	public function getAllEnabledContentByCategory( $catGid, $condition = array(), $order = null, $count = null, $offset = null)
    {
//    	echo "<pre>";print_r($catGid);die;
    	$objCat = new Models_ContentCategory();
    	
    	$cat = @reset($objCat->getByColumns(array('content_category_gid=?' => $catGid))->toArray());
    	
    	$gidStr = @trim($cat['gid_string'].',0',','); 
    	/**
    	 * Get all enabled categories
    	 */
    	$select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('cc' => $this->_prefix . 'content_category'), array('content_category_gid'))
                ->where('cc.enabled = 1 AND cc.genabled = 1 AND cc.parent_genabled = 1')
                ->where('cc.content_category_gid IN (' . $gidStr .')');
                
        $cats   = $this->fetchAll($select)->toArray();
        $gidStr = '';
        foreach ($cats as $cat) {
        	$gidStr .= $cat['content_category_gid'] . ',';
        }
        $gidStr = @trim($gidStr.'0',',');
    	
        /**
         * Get all enabled contents in enabled categories
         */
    	$select = $this->select()
                ->where('enabled = 1 AND genabled = 1')
                ->where('content_category_gid IN (' . $gidStr .')')
                ->order($order)
                ->limit($count, $offset);

         /**
          * Condition
          */       
         if (null != @$condition['exclude_content_gids']) {
         	$gidStr = trim($condition['exclude_content_gids'].',0',',');
         	$select->where('content_gid NOT IN (' . $gidStr .')');
         }
               
    	return $this->fetchAll($select)->toArray();
    }
    
    public function getAllEnabledContentBygId( $catGid, $condition = array(), $order = null, $count = null, $offset = null)
    {
//    	echo "<pre>";print_r($catGid);die;
    	$objCat = new Models_ContentCategory();
    	
    	$cat = @reset($objCat->getByColumns(array('content_category_gid=?' => $catGid))->toArray());
    	
    	$gidStr = @trim($cat['gid_string'].',0',','); 
    	/**
    	 * Get all enabled categories
    	 */
    	$select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('cc' => $this->_prefix . 'content_category'), array('content_category_gid'))
                ->where('cc.enabled = 1 AND cc.genabled = 1 AND cc.parent_genabled = 1')
                ->where('cc.content_category_gid IN (' . $gidStr .')');
                
        $cats   = $this->fetchAll($select)->toArray();
        $gidStr = '';
        foreach ($cats as $cat) {
        	$gidStr .= $cat['content_category_gid'] . ',';
        }
        $gidStr = @trim($gidStr.'0',',');
    	
        /**
         * Get all enabled contents in enabled categories
         */
    	$select = $this->select()
                ->where('enabled = 1 AND genabled = 1')
                ->where('content_category_gid IN (' . $gidStr .')')
                ->order($order)
                ->limit($count, $offset);

         /**
          * Condition
          */ 
           foreach ($condition as $item) {
           	if(null!=$item){
           		$gidStr .=$item .',';
           	}
           } 
            $gidStr = @trim($gidStr.'0',',');     
        
         	$select->where('content_gid NOT IN (' . $gidStr .')');
         
               
    	return $this->fetchAll($select)->toArray();
    }
    
    
    public function getLatestContentByCategory( $catGid )
    {
    	$allContent = $this->getAllEnabledContentByCategory($catGid, array(), array('sorting ASC','content_gid DESC','content_id DESC'),1,0);
    	return @reset($allContent);
    }
    
    public function getContentById( $gid ) 
    {
    	$select = $this->select()
    			->where('content_gid=?',$gid);
    	
    	return @reset($this->fetchAll($select)->toArray());
    }
    
    
    public function increaseSorting($startPos = 1, $num = 1)
    {
        $sql = "UPDATE {$this->_name} SET sorting = sorting + " . intval($num) . " WHERE sorting >= " . intval($startPos);
        
        $this->_db->query($sql);
    }
    
    
    /**
     * Get content by gid
     * 
     * @param int $gid
     * @return Zend_Db_Table_Row
     */
    public function getContentByGid($gid)
    {
        $this->setAllLanguages(false);
        $select = $this->select()
                ->where('content_gid=?', $gid);
                
        return $this->fetchRow($select);
    }
	public  function synLang($defaultLang, $newLang)
    {	
    	$oldLang = array();
    	$gidStr = '';
    	$gidStr .= $defaultLang . ','.$newLang;
    	$addLang = 0;
		if($defaultLang< $newLang){
			$addLang = $newLang;
			$sortGroup = array('content_gid ASC','lang_id ASC');
		}
		elseif ($defaultLang>$newLang){
			$addLang = $defaultLang;
			$sortGroup = array('content_gid ASC','lang_id DESC');
			
		}	
			$select = $this->select()
		                ->setIntegrityCheck(false)
		                ->from(array('cc' => $this->_name))
		                ->where('lang_id IN (' . $gidStr .')' )
		                ->order($sortGroup);
		
                $result =  $this->fetchAll($select)->toArray();
                $sum = count($result);
                $i = 0;
                
                foreach ($result as &$item) {
                	$i++;
                	if(1==$i){
                		$oldLang = $item;
                	}
                	else{                		
						if($oldLang['lang_id'] == $item['lang_id']){
							
	                			$newLangRow = $oldLang;
	                			unset($newLangRow['content_id']);
	                			$newLangRow['lang_id'] = $newLang;
	                			$newLangRow['enabled'] = 0;	                			
								Zend_Db_Table::insert($newLangRow);
							        			
	                		
						}
						$oldLang = $item;
									
                	}
                	if($i==$sum && $oldLang['lang_id'] !=$addLang){
	                				$oldLang = $item;
	                				$newLangRow = $oldLang;
		                			unset($newLangRow['content_id']);
		                			$newLangRow['lang_id'] = $newLang;
		                			$newLangRow['enabled'] = 0;	                			
									Zend_Db_Table::insert($newLangRow);		
									break;
	                		}	   
                	         	
                }
                unset($item);
    }
    
}