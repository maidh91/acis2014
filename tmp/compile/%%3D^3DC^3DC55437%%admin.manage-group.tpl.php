<?php /* Smarty version 2.6.25, created on 2013-12-05 18:56:36
         compiled from user/views/admin.manage-group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'l', 'user/views/admin.manage-group.tpl', 1, false),array('modifier', 'count', 'user/views/admin.manage-group.tpl', 18, false),)), $this); ?>
            <h2><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            <div class="content-box"><!-- Start Content Box -->
                
                
                <div class="content-box-content" style="border-top: none;">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        <?php if (count($this->_tpl_vars['allGroups']) <= 0): ?>
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No group in system now.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['groupMessage']) > 0 && $this->_tpl_vars['groupMessage']['success'] == true): ?>
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['groupMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['groupMessage']) > 0 && $this->_tpl_vars['groupMessage']['success'] == false): ?>
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['groupMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        
                        <?php if (count($this->_tpl_vars['allGroups']) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>ID</th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th class="center"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sorting<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th class="center"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                   <th class="center"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Action<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            <?php $_from = $this->_tpl_vars['allGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="checkbox" value="<?php echo $this->_tpl_vars['item']['group_id']; ?>
" name="allGroups"/></td>
                                    <td><?php echo $this->_tpl_vars['item']['group_id']; ?>
</td>
                                    <td><span style="
                                                        <?php if ($this->_tpl_vars['item']['color']): ?> color: <?php echo $this->_tpl_vars['item']['color']; ?>
; <?php endif; ?>
                                                "><?php echo $this->_tpl_vars['item']['name']; ?>
</span></td>
                                    <td><?php echo $this->_tpl_vars['item']['description']; ?>
</td>
                                    <td class="center"><?php echo $this->_tpl_vars['item']['sorting']; ?>
</td>
                                    <td class="center">
                                        <?php if ($this->_tpl_vars['item']['enabled'] == '1'): ?>
                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/disable-group/id/<?php echo $this->_tpl_vars['item']['group_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png"></a>
                                        <?php else: ?>
                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/enable-group/id/<?php echo $this->_tpl_vars['item']['group_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png"></a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">
                                        <!-- Icons -->
                                         <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/edit-group/id/<?php echo $this->_tpl_vars['item']['group_id']; ?>
" title="Edit"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/pencil.png"  alt="Edit" /></a>
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
                                <option value="enableGroup();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                                <option value="disableGroup();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Disable<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
                            </select>
                            <a class="button" href="javascript:applySelected();"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Apply to selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                        </div>
                        
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/manage-group">
                                <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Display <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>#
                                <select name="displayNum" onchange="this.parentNode.submit();" style="clear: both;">
                                    <option value="5" <?php if ($this->_tpl_vars['displayNum'] == 5): ?> selected="selected" <?php endif; ?>>5</option>
                                    <option value="10" <?php if ($this->_tpl_vars['displayNum'] == 10): ?> selected="selected" <?php endif; ?>>10</option>
                                    <option value="20" <?php if ($this->_tpl_vars['displayNum'] == 20): ?> selected="selected" <?php endif; ?>>20</option>
                                    <option value="50" <?php if ($this->_tpl_vars['displayNum'] == 50): ?> selected="selected" <?php endif; ?>>50</option>
                                    <option value="100" <?php if ($this->_tpl_vars['displayNum'] == 100): ?> selected="selected" <?php endif; ?>>100</option>
                                    <option value="1000000000" <?php if ($this->_tpl_vars['displayNum'] >= 1000000000): ?> selected="selected" <?php endif; ?>>All</option>
                                </select>
                            </form>
                        </div>
                        
                        <!-- PAGINATION -->
                        <?php if ($this->_tpl_vars['countAllPages'] > 1): ?>
                        <div class="pagination" style="float: right;">
                            <?php if ($this->_tpl_vars['first']): ?>
                            <a href="?page=1" class="number" title="First Page">&laquo; First</a>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['prevPage']): ?>
                            <a href="?page=<?php echo $this->_tpl_vars['prevPage']; ?>
" class="number" title="Previous Page">&laquo;</a>
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
" class="number" title="Next Page">&raquo;</a>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['last']): ?>
                            <a href="?page=<?php echo $this->_tpl_vars['countAllPages']; ?>
" class="number" title="Last Page">Last &raquo;</a>
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

function applySelected()
{
	var task = document.getElementById('action').value;
	eval(task);
}
function enableGroup()
{
    var all = document.getElementsByName('allGroups');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an group');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/enable-group/id/' + tmp;
}

function disableGroup()
{
    var all = document.getElementsByName('allGroups');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an group');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
user/admin/disable-group/id/' + tmp;
}

</script>