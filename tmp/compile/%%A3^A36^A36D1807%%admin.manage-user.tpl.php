<?php /* Smarty version 2.6.25, created on 2013-12-05 18:57:22
         compiled from user/views/admin.manage-user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'l', 'user/views/admin.manage-user.tpl', 1, false),array('modifier', 'count', 'user/views/admin.manage-user.tpl', 39, false),)), $this); ?>
            <h2><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div style="float:left;">
                        <a name="listofcontent"><h3><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List of Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3></a>
                   </div>     
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-user">
                            <input class="text-input small-input" type="text" name="condition[username]" id="username" value="<?php echo $this->_tpl_vars['condition']['username']; ?>
"/>
                            
                            <select name="condition[group_id]">
                                <option value=""><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                            <?php $_from = $this->_tpl_vars['allGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['item']['group_id']; ?>
" <?php if ($this->_tpl_vars['condition']['group_id'] == $this->_tpl_vars['item']['group_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                            </select> 
                            <input class="button" type="submit" value="Search" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        <?php if (count($this->_tpl_vars['allUsers']) <= 0): ?>
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No user with above conditions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['userMessage']) > 0 && $this->_tpl_vars['userMessage']['success'] == true): ?>
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['userMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['userMessage']) > 0 && $this->_tpl_vars['userMessage']['success'] == false): ?>
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['userMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        
                        <?php if (count($this->_tpl_vars['allUsers']) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>ID</th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Created Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Lastest Login<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Action<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            <?php $_from = $this->_tpl_vars['allUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['item']['user_id']; ?>
" name="allUsers"/></td>
                                    <td><?php echo $this->_tpl_vars['item']['user_id']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['username']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['full_name']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['email']; ?>
</td>
                                    <td><span style="
                                                        <?php if ($this->_tpl_vars['item']['gcolor']): ?> color: <?php echo $this->_tpl_vars['item']['gcolor']; ?>
; <?php endif; ?>
                                                        <?php if ($this->_tpl_vars['item']['genabled'] == '0'): ?> text-decoration: line-through;  <?php endif; ?>
                                                "><?php echo $this->_tpl_vars['item']['gname']; ?>
</span></td>
                                    <td><?php echo $this->_tpl_vars['item']['created_date']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['last_login_date']; ?>
</td>
                                    <td class="center">
                                        <?php if ($this->_tpl_vars['item']['enabled'] == '1'): ?>
                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/disable-user/id/<?php echo $this->_tpl_vars['item']['user_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png"></a>
                                        <?php else: ?>
                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/enable-user/id/<?php echo $this->_tpl_vars['item']['user_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png"></a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">
                                        <!-- Icons -->
                                         <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/edit-user/id/<?php echo $this->_tpl_vars['item']['user_id']; ?>
" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/pencil.png"  alt="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a>
                                         <a href="javascript:deleteAUser(<?php echo $this->_tpl_vars['item']['user_id']; ?>
);" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross.png"  alt="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a> 
                                       <!--   
                                         <a href="#" title="Send Mail"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/mail_send_16.png"  alt="Send Mail" /></a>
                                        -->
                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>    
                                
                            
                            </tbody>
                        </table>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose an action...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                <option value="deleteUser();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                <option value="enableUser();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                <option value="disableUser();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                            </select>
                            <a class="button" href="javascript:applySelected();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Apply to selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                        </div>
                        
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-user">
                                <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Display<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> #
                                <select name="displayNum" onchange="this.parentNode.submit();" style="clear: both;">
                                    <option value="5" <?php if ($this->_tpl_vars['displayNum'] == 5): ?> selected="selected" <?php endif; ?>>5</option>
                                    <option value="10" <?php if ($this->_tpl_vars['displayNum'] == 10): ?> selected="selected" <?php endif; ?>>10</option>
                                    <option value="20" <?php if ($this->_tpl_vars['displayNum'] == 20): ?> selected="selected" <?php endif; ?>>20</option>
                                    <option value="50" <?php if ($this->_tpl_vars['displayNum'] == 50): ?> selected="selected" <?php endif; ?>>50</option>
                                    <option value="100" <?php if ($this->_tpl_vars['displayNum'] == 100): ?> selected="selected" <?php endif; ?>>100</option>
                                    <option value="1000000000" <?php if ($this->_tpl_vars['displayNum'] >= 1000000000): ?> selected="selected" <?php endif; ?>><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                </select>
                            </form>
                        </div>
                        
                        <!-- PAGINATION -->
                        <?php if ($this->_tpl_vars['countAllPages'] > 1): ?>
                        <div class="pagination" style="float: right;">
                            <?php if ($this->_tpl_vars['first']): ?>
                            <a href="?page=1" class="number" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">&laquo; <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['prevPage']): ?>
                            <a href="?page=<?php echo $this->_tpl_vars['prevPage']; ?>
" class="number" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">&laquo;</a>
                            <?php endif; ?>
                            
                            <?php $_from = $this->_tpl_vars['prevPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                            <a href="?page=<?php echo $this->_tpl_vars['item']; ?>
" class="number" title="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</a>
                            <?php endforeach; endif; unset($_from); ?>
                            
                            <a href="#" class="number current" title="<?php echo $this->_tpl_vars['currentPage']; ?>
"><?php echo $this->_tpl_vars['currentPage']; ?>
</a>
                            
                            <?php $_from = $this->_tpl_vars['nextPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                            <a href="?page=<?php echo $this->_tpl_vars['item']; ?>
" class="number" title="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</a>
                            <?php endforeach; endif; unset($_from); ?>
                            
                            <?php if ($this->_tpl_vars['nextPage']): ?>
                            <a href="?page=<?php echo $this->_tpl_vars['nextPage']; ?>
" class="number" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">&raquo;</a>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['last']): ?>
                            <a href="?page=<?php echo $this->_tpl_vars['countAllPages']; ?>
" class="number" title="<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &raquo;</a>
                            <?php endif; ?>
                        </div> <!-- End .pagination -->
                        <?php endif; ?>
                    <?php endif; ?>    
                        
                        <div class="clear"></div>
                    </div> <!-- End #tab1 -->
                    
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>
            
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    document.getElementById('username').select();
    document.getElementById('username').focus();
});

function applySelected()
{
	var task = document.getElementById('action').value;
	eval(task);
}
function enableUser()
{
    var all = document.getElementsByName('allUsers');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose an user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/enable-user/id/' + tmp;
}

function disableUser()
{
    var all = document.getElementsByName('allUsers');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose an user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/disable-user/id/' + tmp;
}

function deleteUser()
{
    var all = document.getElementsByName('allUsers');
    var tmp = '';
    var count = 0;
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
             count++;
        }
    }
    if ('' == tmp) {
        alert('<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please choose an user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>');
        return;
    } else {
    	result = confirm('<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure you want to delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> ' + count + ' <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>user(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?');
        if (false == result) {
            return;
        }
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/delete-user/id/' + tmp;
}


function deleteAUser(id)
{
    result = confirm('<?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure you want to delete this user<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?');
    if (false == result) {
        return;
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/delete-user/id/' + id;
}
</script>