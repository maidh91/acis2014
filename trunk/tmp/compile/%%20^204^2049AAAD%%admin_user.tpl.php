<?php /* Smarty version 2.6.25, created on 2013-12-05 18:35:04
         compiled from stickers/admin_user/admin_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'l', 'stickers/admin_user/admin_user.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Hello<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/edit-user/id/<?php echo $this->_tpl_vars['user']['user_id']; ?>
" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit your profile<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php echo $this->_tpl_vars['user']['full_name']; ?>
</a>, 