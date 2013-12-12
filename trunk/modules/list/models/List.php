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
class Models_List extends Nine_Model
{ 
    protected $_primary = 'list_id';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array();
    
    
    public function __construct($config = array())
    {
        $this->_name = $this->_prefix . 'list';
        return parent::__construct($config); 
    }    
    public function getAllLists($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->order($order)
                ->limit($count, $offset);
               
        /**
         * Conditions
         */
        if (null != @$condition['name']) {
            $select->where($this->getAdapter()->quoteInto('name LIKE ?', "%{$condition['name']}%"));
        }
        
        return $this->fetchAll($select)->toArray();
    }
    
    public function getAllListsByParent($condition = array(), $order = null, $count = null, $offset = null, $parentId = null)
    {
        if	($parentId == null ) $parentId = '';
        $select = $this->select()
                ->order($order)
                ->where("parent_id = {$parentId}")
                ->limit($count, $offset);
               
        /**
         * Conditions
         */
        if (null != @$condition['name']) {
            $select->where($this->getAdapter()->quoteInto('name LIKE ?', "%{$condition['name']}%"));
        }
        
        return $this->fetchAll($select)->toArray();
    }
    

    public function getLists($parentId, $depth = 1)
    {
        $select = $this->select()
                ->order(array('sorting ASC', 'name ASC'))
                ->where("parent_id = ?", $parentId);
               
        
        $result = $this->fetchAll($select)->toArray();
        
        /**
         * Finish?
         */
        $depth--;
        if (0 == $depth) {
        	return $result;
        } else {
        	/**
        	 * Call recursive
        	 */
        	foreach ($result as &$item) {
        		$item['child'] = $this->getLists($item['list_id'], $depth); 
        	}
        	unset($item);
        	
        	return $result;
        }
    }
    
    
    public function getListById( $listId ) {
    	$select = $this->select()
                ->where("list_id = {$listId}");
        return @reset($this->fetchAll($select)->toArray());
    }
    
    public function getListWithParent( $listId) {
    	$select = $this->select()
                ->where("list_id = {$listId}");
        $result = @reset($this->fetchAll($select)->toArray());
        
        if (null != @$result['parent_id']) {
        	$result['parent'] = $this->getListById($result['parent_id']);
        }
        return $result;
    }
    
    public function getListByIdString ($stringId) {
    	$stringId = addslashes($stringId);
    	$stringId = ',' . trim($stringId, ',') . ',';
    	
    	$select = $this->select()
                ->where('list_id IN (0'.$stringId.'0)');
    	
    	return $this->fetchAll($select)->toArray();
    }
    
    public function getListByIdStringWithValue($stringId) {
    	
    	$select = $this->select()
                ->where('0 != locate(concat(",",list_id,":"),?)', $stringId);
		
        $result = $this->fetchAll($select)->toArray();
        /**
         * Get Value
         */
        $t = explode(',', trim($stringId,','));
        foreach ($t as $index => $v_item) {
        	$tmp = array();
        	list($key,$val) = explode(':', $v_item);
        	unset($t[$index]);
        	$t[$key] = $val; 
        }
		/**
		 * Assign custom value
		 */
        foreach ($result as &$r_item) {
			foreach ($t as $t_index => $t_item ) {
				if ($r_item['list_id'] == $t_index) {
					$r_item['value'] = $t_item;
				}
			}
		}
		unset($r_item);
		/**
		 * Return result
		 */ 
//		echo "<pre>";print_r($result);die; 
       	return $result;
    }
    
    public function getParentListByIdString ($stringId ){
    	$child = $this->getListByIdStringWithValue($stringId);
    	
    	$select = $this->select()
    			->order(array('sorting ASC', 'name ASC'));
    			
    	$parentIds = '0';
    	foreach ($child as $item) {
    		$parentIds .= " OR list_id = {$item['parent_id']}";
    	}
    	$parentIds = addslashes($parentIds);
    	$select->where($parentIds);
    	
    	return $this->fetchAll($select)->toArray();
    }
    
    
    public function getListNameById( $listId ) {
    	$list = $this->getListById($listId);
    	return $list['name'];
    }
    
    
    public function getOrderStringIds ($parentId, $startListId = 0)
    {
    	$lists = $this->getLists($parentId);
    	
    	$tmp = array();
    	foreach ($lists as $l) {
    		if ($startListId <= $l['list_id']) {
    			$tmp[] = $l['list_id'];
    		}
    	}
    	
    	return implode(',', $tmp);
    }
    
    public function getAllRootLists($condition = array(), $order = null, $count = null, $offset = null)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('c' => $this->_name))
                ->order($order)
                ->where('parent_id IS NULL')
                ->limit($count, $offset);
        /**
         * Conditions
         */
        if (null != @$condition['name']) {
            $select->where($this->getAdapter()->quoteInto('c.name LIKE ?', "%{$condition['name']}%"));
        }
        
        return $this->fetchAll($select)->toArray();
    }
}