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
class Models_ContentCategory extends Nine_Model
{ 
    /**
     * The primary key column or columns.
     * A compound key should be declared as an array.
     * You may declare a single-column primary key
     * as a string.
     *
     * @var mixed
     */
    protected $_primary = 'content_category_id';
     /**
     * The field name what we use to group all language rows together
     * 
     * @var string
     */
    protected $_groupField = 'content_category_gid';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array('name', 'enable', 'alias', 'description');
    
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
        $this->_name = $this->_prefix . 'content_category';
        return parent::__construct($config); 
    }

    /**
     * Get all categories with conditions
     * 
     * @param $condition
     * @param $order
     * @param $count
     * @param $offset
     */
    public function getAllCategories($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('cc' => $this->_name))
                ->join(array('l' => $this->_prefix . 'lang'), 'cc.lang_id = l.lang_id', array('lname' => 'name', 'lang_image'))
                ->joinLeft(array('cc2' => $this->_name), 'cc.parent_id = cc.content_category_gid AND cc2.lang_id='. Nine_Language::getCurrentLangId(), array('parent' => 'name'))
                ->order($order)
                ->limit($count, $offset);
        /**
         * Conditions
         */
        if (null != @$condition['keyword']) {
            $sql = "SELECT content_category_gid FROM {$this->_name} WHERE " . $this->getAdapter()->quoteInto('name LIKE ?', "%{$condition['keyword']}%");
            $ids = $this->_db->fetchAll($sql);
            if (empty($ids)) {
                return array();
            }
            $idString = '';
            foreach ($ids as $row) {
                $idString .= $row['content_category_gid'] . ',';
            }
            /**
             * Add to select object
             */
            $select->where('cc.content_category_gid IN (' . trim($idString, ',') .')');
        }
        
        return $this->fetchAll($select)->toArray();
    }
    
    public function getAllEnabledCategory()
    {
    	$select = $this->select()
                ->where('enabled = 1 AND genabled = 1 AND parent_genabled = 1');
                    
        
		return $this->fetchAll($select)->toArray();       
    }
    
    
    
	public function increaseSorting($startPos = 1, $num = 1)
    {
        $sql = "UPDATE {$this->_name} SET sorting = sorting + " . intval($num) . " WHERE sorting >= " . intval($startPos);
        
        $this->_db->query($sql);
    }
    
    
    public function updateGidString($gid, $gidString) 
    {
    	/**
    	 * Get current update node
    	 */
    	if (null == $gid) {
    		return;
    	}
    	else {
    		$category = @reset($this->getByColumns(array('content_category_gid = ?'	=>	$gid))->toArray());
    		$this->update(array('gid_string'	=> $this->concatGidString($category['gid_string'],$gidString)),array('content_category_gid = ?' => $gid));
    		return $this->updateGidString($category['parent_id'],$gidString);
    	}
    }
    
    public function deleteGidString($gid, $gidString)
    {
    	/**
    	 * Get current update node
    	 */
    	if (null == $gid){
    		return;
    	}
    	else {
    		$category = @reset($this->getByColumns(array('content_category_gid = ?'	=>	$gid))->toArray());
    		$this->update(array('gid_string' => $this->removeGidString($category['gid_string'],$gidString)), array('content_category_gid = ?' => $gid));
    		return $this->deleteGidString($category['parent_id'], $gidString);
    	}
    }
    
 public function getCategoryWithParent( $catGid ) 
    {
    	$cat = @reset($this->getByColumns(array('content_category_gid=?' => $catGid))->toArray());
    	if (null != @$cat['parent_id']){
    		$cat['parent'] = @reset($this->getByColumns(array('content_category_gid=?' => $cat['parent_id']))->toArray());
    	}
    	else {
    		$cat['parent'] = array();
    	}
    	return $cat;
    }
    
 public function getRootParent( $catGid )
    {
    	$select = $this->select()
    			->where("parent_id IS NULL AND 0 != LOCATE(?, CONCAT(',', gid_string, ','))", ",{$catGid},");
    			
    	return @reset($this->fetchAll($select)->toArray());
    }
    
    public function concatGidString($oldGidStr, $concatGidStr) 
    {
    	if(null == $oldGidStr){
    		return $concatGidStr;
    	}
    	
    	$oldGidString = explode(',', trim($oldGidStr,','));
    	$concatGidString = explode(',', trim($concatGidStr,','));
    	
    	foreach($concatGidString as $item){
    		if (false == in_array($item, $oldGidString)){
    			$oldGidString[] = $item;
    		}
    	}
    	return implode(',', $oldGidString);
    }
    
    private function removeGidString($oldGidStr, $removedGidStr)
    {
    	if(null == $oldGidStr){
    		return null;
    	}
    	
    	$oldGidString = explode(',', trim($oldGidStr,','));
    	$removedGidString = explode(',', trim($removedGidStr,','));
    	
//    	echo "<pre>";print_r($removedGidString);die; 
    	foreach($oldGidString as $key => $item){
    		if (false != in_array($item, $removedGidString)){
    			unset($oldGidString[$key]);
    		}
    	}
    	return implode(',', $oldGidString);
    }
    // TODO
  public  function synLang($defaultLang, $newLang)
    {	
    	$oldLang = array();
    	$gidStr = '';
    	$gidStr .= $defaultLang . ','.$newLang;
    	$addLang = 0;
		if($defaultLang< $newLang){
			$addLang = $newLang;
			$sortGroup = array('content_category_gid ASC','lang_id ASC');
		}
		elseif ($defaultLang>$newLang){
			$addLang = $defaultLang;
			$sortGroup = array('content_category_gid ASC','lang_id DESC');
			
		}	
			$select = $this->select()
		                ->setIntegrityCheck(false)
		                ->from(array('cc' => $this->_name))
		                ->where('lang_id IN (' . $gidStr .')' )
		                ->order($sortGroup);
		
                $result =  $this->fetchAll($select)->toArray();
                $sum = count($result);
                $i = 0;
//                echo "<pre>";print_r($result);die;
                foreach ($result as &$item) {
                	$i++;
                	if(1==$i){
                		$oldLang = $item;
                	}
                	else{                		
						if($oldLang['lang_id'] == $item['lang_id']){
							
	                			$newLangRow = $oldLang;
	                			unset($newLangRow['content_category_id']);
	                			$newLangRow['lang_id'] = $newLang;
	                			$newLangRow['enabled'] = 0;	                			
								Zend_Db_Table::insert($newLangRow);
							         			
	                		
						}
						$oldLang = $item;
									
                	}
                	if($i==$sum && $oldLang['lang_id'] !=$addLang){
	                				$oldLang = $item;
	                				$newLangRow = $oldLang;
		                			unset($newLangRow['content_category_id']);
		                			$newLangRow['lang_id'] = $newLang;
		                			$newLangRow['enabled'] = 0;	                			
									Zend_Db_Table::insert($newLangRow);		
									break;
	                		}	  
                	         	
                }
                unset($item);
    }
    
}