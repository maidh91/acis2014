<?php /* Smarty version 2.6.25, created on 2013-12-05 18:40:58
         compiled from stickers/admin_menu/admin_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'p', 'stickers/admin_menu/admin_menu.tpl', 7, false),)), $this); ?>
<ul id="main-nav">  
    <li>
        <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
" class="nav-top-item no-submenu <?php if ($this->_tpl_vars['menu'][0] == 'controlpanel'): ?>current<?php endif; ?>">
            Control Panel
        </a>       
    </li>
    <?php $this->_tag_stack[] = array('p', array('name' => 'see_user','module' => 'user')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <li> 
        <a href="#" class="nav-top-item <?php if ($this->_tpl_vars['menu'][0] == 'usergroup'): ?>current<?php endif; ?>">
        Users & Groups
        </a>
        <ul>
            <?php $this->_tag_stack[] = array('p', array('name' => 'new_user','module' => 'user')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/new-user" class="<?php if ($this->_tpl_vars['menu'][1] == 'newuser'): ?>current<?php endif; ?>">New User</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php $this->_tag_stack[] = array('p', array('name' => 'see_user','module' => 'user')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-user" class="<?php if ($this->_tpl_vars['menu'][1] == 'manageuser'): ?>current<?php endif; ?>">Manage Users </a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php $this->_tag_stack[] = array('p', array('name' => 'see_group','module' => 'user')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-group" class="<?php if ($this->_tpl_vars['menu'][1] == 'managegroup'): ?>current<?php endif; ?>"> Manage Groups</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            
            <?php $this->_tag_stack[] = array('p', array('name' => 'see_permission','module' => 'permission')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/manager" class="<?php if ($this->_tpl_vars['menu'][1] == 'managepermission'): ?>current<?php endif; ?>"> Manage Permissions</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
     
        </ul>
    </li>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    
    <?php if ($this->_tpl_vars['userGroup']['group_id'] == 2): ?>
    <li>
        <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/edit-user/id/<?php echo $this->_tpl_vars['userGroup']['user_id']; ?>
" class="nav-top-item no-submenu <?php if ($this->_tpl_vars['menu'][0] == 'usergroup'): ?>current<?php endif; ?>">
            My Account
        </a>       
    </li>
    <?php endif; ?>

    <?php $this->_tag_stack[] = array('p', array('name' => 'new_content','module' => 'content','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <li> 
        <a href="#" class="nav-top-item <?php if ($this->_tpl_vars['menu'][0] == 'content'): ?>current<?php endif; ?>">
        Content
        </a>
        <ul>
            <?php $this->_tag_stack[] = array('p', array('name' => 'new_content','module' => 'content','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/new-content" class="<?php if ($this->_tpl_vars['menu'][1] == 'newcontent'): ?>current<?php endif; ?>">New Content</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php $this->_tag_stack[] = array('p', array('name' => 'see_content','module' => 'content','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/manage-content" class="<?php if ($this->_tpl_vars['menu'][1] == 'managecontent'): ?>current<?php endif; ?>"> Manage Content</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            
<!--             <?php $this->_tag_stack[] = array('p', array('name' => 'new_category','module' => 'content','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/new-category" class="<?php if ($this->_tpl_vars['menu'][1] == 'newcategory'): ?>current<?php endif; ?>">New Category</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> -->
<!--             <?php $this->_tag_stack[] = array('p', array('name' => 'see_category','module' => 'content','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/manage-category" class="<?php if ($this->_tpl_vars['menu'][1] == 'managecategory'): ?>current<?php endif; ?>"> Manage Categories</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> -->
        </ul>
    </li>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    
	
  

<!--     <?php $this->_tag_stack[] = array('p', array('name' => 'see_translation','module' => 'language')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> -->
<!--     <li>  -->
<!--         <a href="#" class="nav-top-item <?php if ($this->_tpl_vars['menu'][0] == 'others'): ?>current<?php endif; ?>"> -->
<!--         Others -->
<!--         </a> -->
<!--         <ul> -->
<!--             <?php $this->_tag_stack[] = array('p', array('name' => 'see_translation','module' => 'language','expandId' => '?')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><li><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
language/translation/manage" class="<?php if ($this->_tpl_vars['menu'][1] == 'manage-translation'): ?>current<?php endif; ?>">Manage Translations</a></li><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> -->
<!--         </ul> -->
<!--     </li> -->
<!--     <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> -->
    
</ul> 