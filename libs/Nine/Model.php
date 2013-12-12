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
 */
require_once 'Zend/Db/Table.php';
class Nine_Model extends Zend_Db_Table 
{
    /**
     * Prefix of table in database. Default is '9_'
     * 
     * @var string
     */
    protected $_prefix = '9_';
    /**
     * String primary key. If primary key is array, it is the first element of this array
     * Its value will be caculated automatically by Nine_Model::init() only once time. It doesn't
     * need to be set value simular $this->_primary when inheriting Nine_Model class
     * 
     * @var string
     */
    protected $_sPrimary;
    /**
     * The field name what we use to group all language rows together
     * 
     * @var string
     */
    protected $_groupField = 'gid';
    /**
     * Let system know this is miltilingual table or not.
     * If this table has multilingual fields, Zend_Db_Table_Select object
     * will be inserted language condition automatically.
     * 
     * @var array
     */
    protected $_multilingualFields = array();
    /**
     * Language field name
     * 
     * @var string
     */
    protected $_langField = 'lang_id';
    /**
     * Set to load all languages instead of single language in multilingual table
     * 
     * @var bool
     */
    protected $_getAllLanguages = false;
    /**
     * Init Model
     */
    public function init()
    {
        parent::init();
        /**
         * Init string primary key
         */
        if (is_array($this->_primary)) {
            $this->_sPrimary = @reset($this->_primary);
        } else {
            $this->_sPrimary = $this->_primary;
        }
        /**
         * Init database prefix
         */
        $config = Nine_Registry::get('config');
        if (isset($config['database']['params']['prefix']) && null != $config['database']['params']['prefix']) {
            $this->_prefix = $config['database']['params']['prefix'];
        }
    }

    /**
     * Check Zend_Db_Table_Select for multilingual table.
     *
     * @param  Zend_Db_Table_Select $select  query options.
     * @return array An array containing the row results in FETCH_ASSOC mode.
     */
    protected function _fetch(Zend_Db_Table_Select $select)
    {
        if (!empty($this->_multilingualFields) && false == $this->_getAllLanguages && ($select instanceof Zend_Db_Table_Select))
        {
            $tableAlias = @$select->getPart(Zend_Db_Select::COLUMNS);
            $tableAlias = @$tableAlias[0][0];
            if (null != $tableAlias) {
                $tableAlias = $this->getAdapter()->quoteIdentifier($tableAlias) . '.';
            }
            
            $select->where("{$tableAlias}{$this->_langField}=?", Nine_Language::getCurrentLangId());
        }
//        try {
//            return parent::_fetch($select);
//        } catch (Exception $e) {
//            echo $select;die;
//        }
        return parent::_fetch($select);
    }
    /**
     * Inserts a new row.
     *
     * @param  array  $data                    Column-value pairs.
     * @return mixed                           The primary key of the row inserted.
     */
    public function insert(array $data)
    {
        if (!empty($this->_multilingualFields)) {
            /**
             * Multilinguage table
             */
            require_once 'modules/language/models/Lang.php';
            $objLang = new Models_Lang();
            $allLangs = $objLang->getAll(array('sorting ASC'))->toArray();
            
            $commonData = array();
            foreach ($data as $key => $value) {
                if (! is_array($value)) {
                    $commonData[$key] = $value;
                }
            }
            $gid = null;
            foreach ($allLangs as $lang) {
                $newData = $commonData;
                $newData[$this->_langField] = $lang['lang_id'];
                /**
                 * Check gid
                 */
                if (null != $gid) {
                    $newData[$this->_groupField] = $gid;
                }
                
                $langData = @$data[$lang['lang_id']];
                if (is_array($langData)) {
                    foreach ($langData as $field => $value) {
                        if (! in_array($field, $this->_multilingualFields)) {
                            unset($langData[$field]);
                        }
                    }
                } else {
                    $langData = array();
                }
                $newData = array_merge($newData, $langData);
//                echo '<pre>';print_r($newData);die;
                /**
                 * Insert new row
                 */
                $id = parent::insert($newData);
                /**
                 * Update gip
                 */
                if (null == $gid) {
                    $gid = $id;
                    parent::update(array("{$this->_groupField}" => $gid), array("{$this->_sPrimary}=?" => $id));
                }
            }
            /**
             * Return gid instead of table ID
             */
            return $gid;
        } else {
            return parent::insert($data);
        }
    }

    /**
     * Updates existing rows.
     *
     * @param  array        $data  Column-value pairs.
     * @param  array|string $where An SQL WHERE clause, or an array of SQL WHERE clauses.
     * @return int          The number of rows updated.
     */
    public function update(array $data, $where)
    {
        if (!empty($this->_multilingualFields)) {
            /**
             * Multilinguage table
             */
            $commonData = array();
            foreach ($data as $key => $value) {
                if (! is_array($value)) {
                    $commonData[$key] = $value;
                } else {
                    /**
                     * Upldate each multilingual data
                     */
                    foreach($value as $col => $value2) {
                        /**
                         * Remove unuseful data
                         */
                        if (! in_array($col, $this->_multilingualFields)) {
                            unset($value[$col]);
                        }
                    }
                    if (is_array($where)) {
                        $where2 = $where;
                        $where2["{$this->_langField}=?"] = $key;
                    } else {
                        $where2 = trim($where);
                        if (null == $where2) {
                            $where2 = "{$this->_langField}=" . $this->getAdapter()->quote($key);
                        } else {
                        $where2 = "({$where2}) AND {$this->_langField}=" . $this->getAdapter()->quote($key);    
                        }
                    }
                    /**
                     * Update
                     */
                    if (! empty($where2)) {
                        parent::update($value, $where2);
                    }
                }
            }
            /**
             * Update common data
             */
            if (empty($commonData)) {
                return 0;
            } else {
                return parent::update($commonData, $where);
            }
        } else {
            return parent::update($data, $where);
        }
    }
    /**
     * Set multilingual table to get all languages or only a language as defaul
     * 
     * @param bool $value
     * 
     * @return Nine_Model This
     */
    function setAllLanguages($value = false)
    {
        $this->_getAllLanguages = (true == $value);
        return $this;
    }
	/**
     * Fetches all rows with column's conditions
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array|Zend_Db_Table_Select $columns  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * 													  If $columns is array, $columns has type as:
     *                                                                               array('column1' => 'value1',
     *                                                                                     'column2' => 123     ,
     *                                                                                     ......................
     *                                                                                     )
     *                                                                           or:
     *                                                                                array('column1 =?' => 'value1',
     *                                                                                      'column2 > ?'  => 123   ,
     *                                                                                     ......................
     *                                                                                     )
     *                                                     This means SQL is "column1 = 'value1' AND column2 = 123".
     * @param string|array                      $order    OPTIONAL An SQL ORDER clause.
     * @param int                               $count    OPTIONAL An SQL LIMIT count.
     * @param int                               $offset   OPTIONAL An SQL LIMIT offset.
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode.
     * 
     * @example 
     *     + Column-value
     *         $this->getByColumns(array('id' => 1, 'lang_code' => 'en'));
     *     + Column condition - value
     *         $this->getByColumns(array('id = ?' => 1, 'lang_code = ?' => 'en'));
     */
    public function getByColumns($columns, $order = null, $count = null, $offset = null)
    {
        if (is_string($columns)) {
            $select = $this->select()
                           ->where($columns); 
        } elseif (is_array($columns)) {
            $select = array();
            foreach ($columns as $columnName => $value) {
                if (false === strpos($columnName, '?')) {
                    $columnName = $this->getAdapter()->quoteIdentifier($columnName);
                    $select["$columnName=?"] = $value;
                } else {
                    $select[$columnName] = $value;
                }
            }
        } elseif ($columns instanceof Zend_Db_Table_Select) {
            $select = $columns;
        } else {
            throw new Exception('Columns have to be string, array or Zend_Db_Table_Select');
        }
//        echo '<pre>';print_r($select);//die;
        return $this->fetchAll($select, $order, $count, $offset);
       
    }   
    /**
     * Fetches all rows
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array                      $order    OPTIONAL An SQL ORDER clause.
     * @param int                               $count    OPTIONAL An SQL LIMIT count.
     * @param int                               $offset   OPTIONAL An SQL LIMIT offset.
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode.
     * 
     * @example $this->getByColumns(array('id' => 1, 'lang_code' => 'en'));
     */
    public function getAll($order = null, $count = null, $offset = null)
    {
        return $this->fetchAll(null, $order, $count, $offset);
    }
    /**
     * Count number of rows in table
     * 
     * @param string|array $condition   This condition.
     *                                  If $condition is string, remember quote it before.
     *                                  If $condition is array, it consists of all conditions which will be
     *                                  concatenate by 'AND'. They are will be quoted automatically.
     * @return integer                  The number of all rows in table with this condition
     * 
     * @example:
     *      + string with quote:
     *          $this->count($this->getAdapter()->quoteInto('id = ?', 123));
     *          
     *      + array of conditions:
     *          $this->count(array(
     *                          'id >?'   => 123,
     *                          'enabled' => 1
     *                        ));
     */
    public function count($condition = null)
    {
        $select = $this->select()
                       ->from($this->_name, array('count(*)'));
		if (is_array($condition)) {
		    foreach ($condition as $index => $item) {
    		    if (false === strpos($index, '?')) {
                        $index      = $this->getAdapter()->quoteIdentifier($index);
                        $select     = $select->where("$index=?", $item);
                    } else {
                        $select     = $select->where($this->getAdapter()->quoteInto($index, $item));
                    }
			}
		} elseif (null !== $condition) {
            $select = $select->where($condition);
        }
        
        return $this->_db->fetchOne($select);
    }
    /**
     * Build tree data of categories
     * 
     * @param array $tree
     * @param string $parentIdField
     * @param bool $changeDisplayName True: Make the name of node (category) with visual view
     * 
     * @return array
     */
    public function buildTree(array $tree, $parentIdField = 'parent_id', $changeDisplayName = true, $displayField = 'name')
    {
        if (! empty($this->_multilingualFields)) {
            $idField  = $this->_groupField;
        } else { 
            $idField  = $this->_primary;
            if (is_array($idField)) {
                $idField = @reset($idField);
            }
        }
        
        $result   = array();
        $match    = 0;
        $level    = 0;
        $idStack  = array();
        $logCount = 0;
        $total    = count($tree);
        $maxCount = $total * $total * 2;
        while ($match != $total && $level <= $total) {
//            echo "Level: {$level}, Match: {$match}, Stack: " . implode('|', $idStack) . '<br/>';
            $currentPid = end($idStack);
            $flagMatch  = false;
            foreach ($tree as $index => $node) {
                if ($currentPid == @$node[$parentIdField]) {
                    /**
                     * Match
                     */
                    if (true == $changeDisplayName) {
                        $node[$displayField] = str_pad("", $level * 6, ". . . ", STR_PAD_LEFT) . $node[$displayField];
                    }
                    $flagMatch = true;
                    break;
                }
            }
            if (true == $flagMatch) {
                /**
                 * Match
                 */
//                echo "+++Added: $node[$idField]. <br/>";
                $result[] = $node;
                unset($tree[$index]);
                $match++;
                $level++;
                array_push($idStack, $node[$idField]);
            } else {
                /**
                 * Don't match
                 */
                array_pop($idStack);
                $level--;
            }
            $logCount++;
            /**
             * Non-stop loop?
             */
            if ($logCount > $maxCount) {
                /**
                 * Error
                 */
                die;
                throw new Exception('Non-stop loop with buildTree() function, please check the struture of your tree/category');
            }
        }
    	// Have not done anything yet
    	return $result;
    }
    
//    /**
//     * Update left and right of tree before inserting new item
//     * This function must be called before inserting new item.
//     * 
//     * @param  int    $leftOfDeletedItem    The left of new item what will be inserted
//     * @param  int    $numOfItems            Number of new items
//     * @return void
//     */
//    public function updateTreeBeforeInsertingNewItems($leftOfInsertedItem, $numOfItems = 1)
//    {
//        if (! is_int($numOfItems)) {
//            $numOfItems = intval($numOfItems);
//        }
//        /**
//         * Update left
//         */
//        $sql = ' UPDATE ' . $this->_name .
//               ' SET lft = lft+' . (2 * $numOfItems) .
//               ' WHERE lft >= ' . $this->getAdapter()->quote($leftOfInsertedItem);
//        $this->_db->query($sql);
//        /**
//         * Update right
//         */
//        $sql = ' UPDATE ' . $this->_name .
//               ' SET rgt = rgt+' . (2 * $numOfItems) .
//               ' WHERE rgt >= ' . $this->getAdapter()->quote($leftOfInsertedItem);
//        $this->_db->query($sql);
//    }
//    /**
//     * Update left and right of tree when deleting one item of tree
//     * This function can be called before or after deleting the item.
//     * 
//     * @param  int    $leftOfDeletedItem    The left of item what will be deleted.
//     * @param  int    $numOfItems           Number of deleted items
//     * @return void
//     */
//    public function updateTreeWhenDeletingItems($leftOfDeletedItem, $numOfItems = 1)
//    {
//        /**
//         * Update left
//         */
//        $sql = ' UPDATE ' . $this->_name .
//               ' SET lft = lft-' . (2 * $numOfItems) .
//               ' WHERE lft >= ' . $this->getAdapter()->quote($leftOfDeletedItem);
//        $this->_db->query($sql);
//        /**
//         * Update right
//         */
//        $sql = ' UPDATE ' . $this->_name .
//               ' SET rgt = rgt-' . (2 * $numOfItems) .
//               ' WHERE rgt >= ' . $this->getAdapter()->quote($leftOfDeletedItem);
//        $this->_db->query($sql);
//    }
//    /**
//     * Move an item of tree
//     * 
//     * @param  int  $currentItemId     The left of current item
//     * @param  int  $destinedParentId  The left of destination
//     * @param  int  $offset            The position of destined node: negative or positive. Default is false: this item
//     *                                 will be move to destined node as lastest of destined parent node.
//     * @return bool False if no item has been moved, true if item was moved
//     * 
//     * @example:
//     *          $this->moveItemOfTree(10);       //Move item has id is 10 and its children to lastest node of root
//     *          $this->moveItemOfTree(10, 2, -1);// Move item has id is 10 and its children to the node that
//     *                                           // is previous of lastest child of item has id is 2
//     */
//    public function moveItemOfTree($currentItemId, $destinedParentId = false, $offset = false)
//    {
////        $directChildrenOfDestinedParent = $this->getDirectChildrenOfItemInTree();
////        echo "<pre/>";print_r($directChildrenOfDestinedParent);die;
//        /**
//         * @todo Error when move tree 2 as the first child of root.
//         */
//        if ($currentItemId == $destinedParentId) {
//            return false;
//        }
//        /**
//         * Get current item
//         */
//        $currentItem = $this->getByColumns(array($this->_sPrimary => $currentItemId));
//        $currentItem = $currentItem->current();
//        if (null == $currentItem) {
//            return false;
//        }
//        /**
//         * Sum of this item and its children will be moved
//         */
//        $sumMovedItems = ($currentItem->rgt - $currentItem->lft + 1) / 2;
//        /**
//         * Get this item and its children
//         */
//        $allMovedItems = $this->getByColumns(array(
//                                                    'lft>=?' => $currentItem->lft,
//                                                    'rgt<=?' => $currentItem->rgt
//                                                ));
//        $tmpArr = array();
//        foreach ($allMovedItems as $item) {
//            $tmpArr[] = $item[$this->_sPrimary];
//            if ($destinedParentId == $item[$this->_sPrimary]) {
//                /**
//                 * Move parent node to child node
//                 */
//                return false;
//            }
//        }
//        $sqlInClause = '(' . implode(', ', $tmpArr) . ')';
//        /**
//         * Get all children of destined parent
//         */
//        $directChildrenOfDestinedParent = $this->getDirectChildrenOfItemInTree($destinedParentId);
////        var_dump($destinedParentId);
////        echo "<pre/>";print_r($directChildrenOfDestinedParent);//die;
//        /**
//         * Remove current item from destined parent's children
//         */
//        $tmpArr = array();
//        foreach ($directChildrenOfDestinedParent as $item) {
//            if ($currentItem->category_id != $item['category_id']) {
//                $tmpArr[] = $item;
//            }
//        }
//        $directChildrenOfDestinedParent = $tmpArr;
////        echo "<pre/>";print_r($directChildrenOfDestinedParent);//die;
//        /**
//         * Update tree when removing item and its children
//         */
//        $this->updateTreeWhenDeletingItems($currentItem->lft, $sumMovedItems);
////        echo "<pre>";print_r($this->getAll()->toArray());//die;
//        /**
//         * Caculate the left of destined node
//         */
//        $maxxOffset = count($directChildrenOfDestinedParent) - 1;
//        if ($maxxOffset < 0) {
//            /**
//             * Destined parent have no child
//             */
//            if (false === $destinedParentId) {
//                /**
//                 * Empty tree
//                 */
//                $left = 1;
//            } else {
//                $parent = $this->find($destinedParentId);
//                $parent = $parent->current();
//                if (null == $parent) {
//                    return false;
//                }
//                
//                $left   = $parent['rgt'];
//            }
//        } elseif (false === $offset || $offset == ($maxxOffset + 1)) {
//            /**
//             * Update node at offset position
//             */
//            $offsetItem = $this->find($directChildrenOfDestinedParent[$maxxOffset][$this->_sPrimary]);
//            $offsetItem = $offsetItem->current();
//            if (null == $offsetItem) {
//                return false;
//            }
//            /**
//             * Current item will be added as the lastest child of destined parent
//             */
//            $left = $offsetItem['rgt'] + 1;
//        } else {
//            /**
//             * Position of item will be decided by offset.
//             */
//            if (abs($offset) > $maxxOffset) {
//                return false;
//            }
//            if ($offset < 0) {
//                $offset = $maxxOffset + $offset;
//            }
//            /**
//             * Update node at offset position
//             */
//            $offsetItem = $this->find($directChildrenOfDestinedParent[$offset][$this->_sPrimary]);
//            $offsetItem = $offsetItem->current();
//            if (null == $offsetItem) {
//                return false;
//            }
//            /**
//             * Get left of destined node
//             */
//            $left = $offsetItem['lft'];
////            echo "HERE";
////            echo "<pre/>";print_r($offsetItem);//die;
//        }
//        /**
//         * Update tree before inserting item and its children
//         */
////        echo count($allItems) . '|';
//        $this->updateTreeBeforeInsertingNewItems($left, $sumMovedItems);
////        echo "<pre>";print_r($this->getAll()->toArray());//die;
//        /**
//         * Get current item again after updating tree second times
//         */
//        $currentItem->refresh();
//        /**
//         * lft, rgt >= $left. Make all left and right of this item and its childrent
//         * to be correct
//         */
//        $distance = $currentItem->rgt - ($sumMovedItems * 2 - 1 + $currentItem->lft);
////        echo $left . '|';
////        echo $currentItem->lft . '|';
////        echo $distance . '|';
//        if ($distance != 0) {
//            $sql = ' UPDATE ' . $this->_name .
//                   ' SET lft = lft-(' . $distance . ')' .
//                   ' WHERE lft >= ' . $left . ' AND lft <= ' . $currentItem->rgt . 
//                   ' AND ' . $this->_sPrimary . ' IN ' . $sqlInClause;   
//            $this->_db->query($sql);   
//            
//            $sql = ' UPDATE ' . $this->_name .
//                   ' SET rgt = rgt-(' . $distance . ')' .
//                   ' WHERE rgt >= ' . $left . ' AND rgt <= ' . $currentItem->rgt . 
//                   ' AND ' . $this->_sPrimary . ' IN ' . $sqlInClause;     
//            $this->_db->query($sql);   
//        }
//        /**
//         * Update current item and its children
//         */
//        $distance = $left - $currentItem->lft;
////        echo $left . '|';
////        echo $currentItem->lft . '|';
////        echo $distance . '|';
//        
//        $sql = ' UPDATE ' . $this->_name .
//               ' SET lft = lft+(' . $distance . '), rgt = rgt+(' . $distance . ')' .
//               ' WHERE lft >= ' . $currentItem->lft . ' AND rgt <= ' . $currentItem->rgt . 
//               ' AND ' . $this->_sPrimary . ' IN ' . $sqlInClause;   
//        $this->_db->query($sql);   
//        
//        unset($currentItem);
//        
//        return true;
//    }
//    /**
//     * Move item of current tree to another tree
//     * 
//     * @param  int    $currentLeft        The current left of item
//     * @param  object $anotherTreeObject  Another tree object
//     * @param  int    $destinedLeft       The left of destination
//     * @return int|false   The id of new item. False if no item is been moved
//     */
////    public function moveItemOfTreeToAnotherTree($currentLeft, $anotherTreeObject, $destinedLeft)
////    {
////        /**
////         * Get current item
////         */
////        $item = $this->getByColumns(array('lft' => $currentLeft));
////        $item = $item->current();
////        if (null == $item) {
////            return false;
////        }
////        /**
////         * Update current tree
////         */
////        $this->updateTreeWhenDeletingOneItem($item->lft);
////        /**
////         * Delete current item
////         */
////        $this->delete($this->getAdapter()->quoteInto("$this->_sPrimary = ?", $item->{$this->_sPrimary}));
////        /**
////         * Insert current item in another tree
////         */
////        $anotherTreeObject->updateTreeBeforeInsertingNewItem($destinedLeft);
////        $item        = $item->toArray();
////        $item['lft'] = $destinedLeft;
////        $item['rgt'] = $destinedLeft + 1;
////        unset($item[$this->_sPrimary]);
////        
////        return $anotherTreeObject->insert($item);
////    }
////    public function deleteItemOfTree($left)
////    {
////        /**
////         * Get item will be deleted
////         */
////        $item = $this->getByColumns(array('lft' => $left));
////        $item = $item->current();
////        if (null == $item) {
////            return true;
////        }
////        /**
////         * Delete this item and its children
////         */
////        $num = $this->delete(array(
////                                'lft>=?' => $item->lft,
////                                'rgt<=?' => $item->rgt
////                            ));
////        /**
////         * Update tree
////         */
////        
////    }
//    /**
//     * Get direct children of item in tree with depth that starts as 1,2,3...
//     * 
//     * @param  int $parentId  The item's id you want get all children. Default is false and will
//     * 	                      return all direct children of root node			
//     * @return array          Empty array if item is not found or item's children are not found
//     * 	                      Otherwise, nested array will be return
//     */
//    public function getDirectChildrenOfItemInTree($parentId = false)
//    {
//        if (false === $parentId) {
//            /**
//             * Get root's direct children
//             */
//            $depth  = 0;
//            $query1 = ' SELECT tree1.* ' .
//                      ' FROM ' . $this->_name . ' as tree1 ';
//        } else {
//            /**
//             * Get parent item
//             */
//            $parent = $this->getByColumns(array($this->_sPrimary => $parentId));
//            $parent = $parent->current();
//            if (null == $parent) {
//                return array();
//            }
//            /**
//             * Get parent's depth
//             */
//            $grandParent = $this->getByColumns(array(
//                                                      'lft<?' => intval($parent->lft),
//                                                      'rgt>?' => intval($parent->rgt)
//                                                    ));
//            $depth = count($grandParent) + 1;
//           
//            $query1 = ' SELECT tree1.* ' .
//                      ' FROM ' . $this->_name . ' as tree1 ' .
//                      ' WHERE tree1.lft > ' . $parent->lft . ' AND tree1.rgt < ' . $parent->rgt;
//        }
//        /**
//         * Get all children
//         */
//        $query  = ' SELECT child.*, count(parent.lft) as depth ' .
//                  ' FROM (' . $query1 . ') as child ' .
//                  ' JOIN ' . $this->_name . ' as parent ' .
//                  ' ON parent.lft <= child.lft AND parent.rgt >= child.rgt ' .
//                  ' GROUP BY child.lft' .
//                  ' HAVING count(parent.lft) = ' . ($depth + 1) .
//                  ' ORDER BY child.lft ASC';
//
//        return $this->_db->fetchAll($query);
//    }
//    public function error()
//    {
//        $directChildrenOfDestinedParent = $this->getDirectChildrenOfItemInTree();
//        echo "<pre/>";print_r($directChildrenOfDestinedParent);//die;
//        echo "<hr>";
//        $directChildrenOfDestinedParent = $this->getDirectChildrenOfItemInTree();
//        echo "<pre/>";print_r($directChildrenOfDestinedParent);//die;
//
//    }
    
    
}