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

/*
 * Display a area in layout and in holder
 * {{sticker name="header" params=""}}
 */
class Nine_Holder {
	private $_name = "";
	private $_data = "";
	private $_db = null;
	private $_params = array ();
	private $_stickers = array ();
	public $preStickerContent = "<div id='sticker_{name}' class='sticker sticker-{name}'>";
	public $postStickerContent = "</div>";
	public $preHolderContent = "<div id='holder_{name}' class='holder holder-{name} {class}'>";
	public $postHolderContent = "</div>";
	
	/*
     * Constructor set some some data for sticker
     */
	public function __construct($params) {
	    $this->_db = Nine_Registry::getDB();
		$this->_name = $params ['name'];
		$this->_params = $params;
		
		/* get and set stickers in holder */
	    if($this->_name == "allstickers"){
		    $this->_stickers = $this->getAllStickerRoot();
		} elseif (! isset ( $params ['include'] )) {
			$this->_stickers = $this->getStickers ($this->_name);
		} else {
			$stickerArr = explode ( ',', $params ['include'] );
			foreach ( $stickerArr as $st ) {
				$st = trim ( $st );
				if ($st != "") {
					$this->_stickers [] = $st;
				}
			}
		}
//		die(print_r($this->_stickers));
		/* get and set content pre and post for holder and every sticker */
		if (isset($params['preSticker'])) {
			$this->preStickerContent = $params['preSticker'];
		}
		
		if (isset($params['postSticker'])) {
			$this->postStickerContent = $params['postSticker'];
		}
		
		if (isset($params['preHolder'])) {
			$this->preHolderContent = $params['preHolder'];
		}
		
		if (isset($params['postHolder'])) {
			$this->postHolderContent = $params['postHolder'];
		}
		
		foreach ($this->_stickers as $sticker) {
		    
			/* Get data from sticker */
		    $stickerName = $sticker;
		    if (is_array($sticker)) {
		        $stickerName = $sticker['name'];		        
		    }
			$className = $stickerName . "Sticker";
			$fileName = $className . ".php";
			$filePath = "stickers/{$stickerName}/{$fileName}";
			
			if (is_file ( $filePath )) {
				require_once $filePath;
			} else {
				throw new Exception ( "Sticker <b>{$stickerName}</b> " . Nine_Language::translate ( 'was not found' ) );
			}
			
			if (! class_exists ( $className )) {
				throw new Exception ( "Class <b>" . $className . "</b>" . Nine_Language::translate ( 'was not found' ) );
			}
			
			$stParams = array('name' => $stickerName);
		    
			if (is_array($sticker)) {
		        $stParams = $sticker;
		    }
			
		    $st = new $className ( $stParams );
			
			if (is_array($sticker)) {
			    $st->setParams($sticker['params']);
			}
			
			if ($st->isAutoRender ()) {
				$st->render ();
			}
			$data = $st->getData();
			if ($data != "") {
				$preSticker = "";	
				$headerSticker = "";		
				$postSticker = "";
				$editLayoutMode = false;
    			if (Nine_Registry::isRegistered('EDIT_LAYOUT_MODE')) {
        	        $editLayoutMode = Nine_Registry::get('EDIT_LAYOUT_MODE');
        	    }
//        	    $parentLevel = 2;
//        	    if ($this->_name == "allstickers") {
//        	    	$parentLevel = 3;
//        	    }
        	    if ($editLayoutMode) {
        	       $headerSticker .= '<div class="sticker-header">({name}) [<a href="javascript:void(0);" onclick="layout.removeSticker(this,2,\'{name}\');">X</a>]</div>';
        	    }
				if ((! isset ( $this->_params ['include'] )) && ($this->_name != 'allstickers') && $editLayoutMode){
				    $preSticker = str_replace('{name}',$sticker['sticker_id'],$this->preStickerContent . $headerSticker);			
				    $postSticker = str_replace('{name}',$sticker['sticker_id'],$this->postStickerContent);
				} else {
				    $preSticker = str_replace('{name}',$stickerName,$this->preStickerContent . $headerSticker);			
				    $postSticker = str_replace('{name}',$stickerName,$this->postStickerContent);
				}
				$this->_data .= $preSticker . $data . $postSticker;
			}
			/* End get data from sticker */
		}
		
	
	}
	/* get sticker in this holder
	 * @return array of sticker
	 */
	private function getStickers($holderName, $pageName = "") {
		$result = array ();
		$prefix = Nine_Registry::getDBPrefix();
		$stmt = $this->_db->query(
            "SELECT s.* FROM {$prefix}sticker s, {$prefix}holder h
			WHERE s.holder_id = h.holder_id AND h.name = ? AND s.enabled = ? order by priority asc",
            array($holderName, '1')
        );
		$rows = $stmt->fetchAll();
		foreach ($rows as $r) {
		    $r['params'] = json_decode($r['params']);
            $result[] = $r;		    
		}
		return $result;
	}
	
	private function getAllStickerRoot()
	{
	    $folders = Nine_Folder::getFolders('stickers');
	    $results = array();
	    
	    foreach ($folders as $key => $val) {
	        
	        $configFile = "stickers/{$val}/config.php";
	        $sticker = array(
        	        'name' => $val,
        	        'title' => 'no title',
        	        'params' => array()
        	    );
	        if (is_file($configFile)) {	                       
        	    
	            $config = include $configFile;
	            if (is_array($config)) {
	                if (isset($config['params'])) {
	                    $paramsList = $config['params'];
	                    $params = array();
	                    foreach ($paramsList as $item) {
                            $params[$item['name']] = $item['default'];
	                    }

	                    if (isset($config['defaultTitle'])) {
	                        $sticker['title'] = $config['defaultTitle'];
	                    }
	                    
	                    $sticker['params'] = $params;
	                }
	                if (isset($config['dragAndDroppable']) && $config['dragAndDroppable']) {
	                    $results[] = $sticker;
	                }
	            }
	        }
	        
	    }
	    return $results;
	}
	/*
	 * get template data
	 */
	public function getData() {
		if ($this->_data != "") {
			$this->preHolderContent = str_replace('{name}',$this->_name,$this->preHolderContent);
			if (isset($this->_params['customClass'])){
				$this->preHolderContent = str_replace('{class}',$this->_params['customClass'],$this->preHolderContent);
			} else {
				$this->preHolderContent = str_replace('{class}', "",$this->preHolderContent);
			}
			$this->postHolderContent = str_replace('{name}',$this->_name,$this->postHolderContent);
			$this->_data = $this->preHolderContent . $this->_data . $this->postHolderContent;
		}
	    $editLayoutMode = false;
		if (Nine_Registry::isRegistered('EDIT_LAYOUT_MODE')) {
	        $editLayoutMode = Nine_Registry::get('EDIT_LAYOUT_MODE');
	    }
	    if ($editLayoutMode && $this->_name != "allstickers") {
	        $this->preHolderContent = str_replace('{name}',$this->_name,$this->preHolderContent);
			$this->postHolderContent = str_replace('{name}',$this->_name,$this->postHolderContent);
			$this->_data = $this->preHolderContent . $this->_data . $this->postHolderContent;
	    }
		return $this->_data;
	}
}