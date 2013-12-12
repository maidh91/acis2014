<?php /* Smarty version 2.6.25, created on 2013-12-08 19:26:55
         compiled from stickers/main_menu/main_menu.tpl */ ?>
 
      	
      	 <ul class="sf-menu sf-js-enabled sf-shadow" id="navLinks">
      	 <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sub'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sub']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['sub']['iteration']++;
?>
                        <li id="menu_<?php echo $this->_tpl_vars['item']['id']; ?>
" class="<?php if ($this->_tpl_vars['item']['id'] == $this->_tpl_vars['menuId']): ?>current<?php endif; ?>">
                        <a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" ><?php echo $this->_tpl_vars['item']['name']; ?>
</a></li>
        <?php endforeach; endif; unset($_from); ?>
      </ul>
	