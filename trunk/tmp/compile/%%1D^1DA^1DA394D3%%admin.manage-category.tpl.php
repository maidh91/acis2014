<?php /* Smarty version 2.6.25, created on 2013-12-05 18:37:09
         compiled from content/views/admin.manage-category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'content/views/admin.manage-category.tpl', 33, false),array('block', 'p', 'content/views/admin.manage-category.tpl', 147, false),array('block', 'np', 'content/views/admin.manage-category.tpl', 163, false),)), $this); ?>
            <h2>Manage Categories</h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div style="float:left;">
                        <a name="listofcategory"><h3>List of Categories</h3></a>
                   </div>     
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/manage-category">
                            Name <input class="text-input small-input" type="text" name="condition[keyword]" id="keyword" value="<?php echo $this->_tpl_vars['condition']['keyword']; ?>
"/>
                            <input class="button" type="submit" value="Search" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        <?php if (count($this->_tpl_vars['allCategories']) <= 0): ?>
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                No category with above conditions.
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['categoryMessage']) > 0 && $this->_tpl_vars['categoryMessage']['success'] == true): ?>
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['categoryMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (count($this->_tpl_vars['categoryMessage']) > 0 && $this->_tpl_vars['categoryMessage']['success'] == false): ?>
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php echo $this->_tpl_vars['categoryMessage']['message']; ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        <form method="POST" name="sortForm">
                        <?php if (count($this->_tpl_vars['allCategories']) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                   <th width="3%"><input class="check-all" type="checkbox" /></th>
                                   <th width="3%">#</th>
                                   <th width="10%">Parent</th>
                                   <th width="10%">Created</th>
                                   <th class="center" width="4%">
                                        Sort
                                        <?php if ($this->_tpl_vars['fullPermisison']): ?>
                                        <a href="javascript:document.sortForm.submit();"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/save_16.png" alt="Save sorting"></a>
                                        <?php endif; ?>
                                   </th>
                                   <th width="55%">Name</th>
                                   <th width="5%">Pub</th>
                                   <th width="5%">Edit</th>
                                   <th width="5%">GID/ID</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            <?php $_from = $this->_tpl_vars['allCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['category']['iteration']++;
?>
                                <tr>
                                    <td><?php if (1 == $this->_tpl_vars['item']['content_deleteable']): ?><input type="checkbox" value="<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
" name="allCategories"/><?php else: ?><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/unselect.png" alt="Do not delete, enable, disable" /><?php endif; ?></td>
                                    <td><?php echo $this->_foreach['category']['iteration']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['parent']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['created_date']; ?>
</td>
                                    <td class="center">
                                        <?php if ($this->_tpl_vars['fullPermisison']): ?>
                                        <input name="data[<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
]" value="<?php echo $this->_tpl_vars['item']['sorting']; ?>
" size="3" style="text-align: center;"></input>
                                        <?php else: ?>
                                        <?php echo $this->_tpl_vars['item']['sorting']; ?>

                                        <?php endif; ?>
                                    </td>
                                    
                                    <td colspan="5" style="padding:0px;">
                                    <!-- All languages -->
                                        <table style="border-collapse: separate">
                                            <tbody id="table<?php echo $this->_tpl_vars['item']['content_category_id']; ?>
">
                                                <tr>
                                                    <td width="75%">--</td>
                                                    <td width="7%">
                                                        <?php if ($this->_tpl_vars['item']['genabled'] == '1'): ?>
                                                            <?php if ($this->_tpl_vars['fullPermisison']): ?>
                                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/disable-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png"></a>
                                                            <?php else: ?>
                                                            <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png">
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if ($this->_tpl_vars['fullPermisison']): ?>
                                                            <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/enable-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png"></a>
                                                            <?php else: ?>
                                                            <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png">
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td width="10%">
                                                        <?php if ($this->_tpl_vars['fullPermisison']): ?>
                                                        <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/edit-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
" title="Edit Category"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/pencil.png"  alt="Edit Category" /></a>
                                                        <?php else: ?>
                                                        --
                                                        <?php endif; ?>
                                                    </td>
                                                    <td width=8%">
                                                        <?php echo $this->_tpl_vars['item']['content_category_gid']; ?>

                                                    </td>
                                                </tr>
                                                
                                                <?php $_from = $this->_tpl_vars['item']['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
                                                <tr>
                                                    <td><image style="vertical-align:middle;" src="<?php echo $this->_tpl_vars['BASE_URL']; ?>
<?php echo $this->_tpl_vars['item2']['lang_image']; ?>
"> <?php echo $this->_tpl_vars['item2']['name']; ?>
</td>
                                                    <td>
                                                    
                                                    <?php $this->assign('langId', $this->_tpl_vars['item2']['lang_id']); ?>
                                                    
                                                    <?php if ($this->_tpl_vars['item']['genabled'] == '1'): ?>
                                                    
                                                        <!-- FULL PERMISSION -->
                                                        <?php $this->_tag_stack[] = array('p', array('name' => 'edit_category','module' => 'content','expandId' => $this->_tpl_vars['langId'])); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                                            <?php if ($this->_tpl_vars['item2']['enabled'] == '1'): ?>
                                                            	<?php if (1 == $this->_tpl_vars['item']['content_deleteable']): ?>
                                                                	<a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/disable-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
/lid/<?php echo $this->_tpl_vars['item2']['lang_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png"></a>
                                                            	<?php else: ?>
                                                            		<img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png">
                                                            	<?php endif; ?>
                                                            <?php else: ?>
                                                            	<?php if (1 == $this->_tpl_vars['item']['content_deleteable']): ?>
                                                                	<a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/enable-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
/lid/<?php echo $this->_tpl_vars['item2']['lang_id']; ?>
" ><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png"></a>
                                                            	<?php else: ?>
                                                            		<img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png">
                                                            	<?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                        <!-- DON'T HAVE PERMISSION -->
                                                        <?php $this->_tag_stack[] = array('np', array('name' => 'edit_category','module' => 'content','expandId' => $this->_tpl_vars['langId'])); $_block_repeat=true;Nine_View_Register_Permission::checkNotPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                                            <?php if ($this->_tpl_vars['item2']['enabled'] == '1'): ?>
                                                                <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/visible16x16.png">
                                                            <?php else: ?>
                                                                <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png">
                                                            <?php endif; ?>
                                                        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkNotPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                    <?php else: ?>
                                                        <img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/invisible16x16.png">
                                                    <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php $this->_tag_stack[] = array('p', array('name' => 'edit_category','module' => 'content','expandId' => $this->_tpl_vars['langId'])); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                                        <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/edit-category/gid/<?php echo $this->_tpl_vars['item']['content_category_gid']; ?>
/lid/<?php echo $this->_tpl_vars['item2']['lang_id']; ?>
" title="Edit Category"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/pencil.png"  alt="Edit Category" /></a>
                                                        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                        <?php $this->_tag_stack[] = array('np', array('name' => 'edit_category','module' => 'content','expandId' => $this->_tpl_vars['langId'])); $_block_repeat=true;Nine_View_Register_Permission::checkNotPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                                        --
                                                        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkNotPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $this->_tpl_vars['item2']['content_category_id']; ?>

                                                    </td>
                                                </tr>
                                                <?php endforeach; endif; unset($_from); ?>
                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>    
                                
                            
                            </tbody>
                        </table>
                        </form>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        <?php $this->_tag_stack[] = array('p', array('name' => 'edit_category','module' => 'content')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";">Choose an action...</option>
                                <?php $this->_tag_stack[] = array('p', array('name' => 'delete_category','module' => 'content')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                <option value="deleteCategory();">Delete</option>
                                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                <option value="enableCategory();">Enable</option>
                                <option value="disableCategory();">Disable</option>
                            </select>
                            <a class="button" href="javascript:applySelected();">Apply to selected</a>
                        </div>
                        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/manage-category">
                                Display #
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
$(document).ready(function(){
    document.getElementById('keyword').select();
    document.getElementById('keyword').focus();
});

function applySelected()
{
	var task = document.getElementById('action').value;
	eval(task);
}
function enableCategory()
{
    var all = document.getElementsByName('allCategories');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an category');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/enable-category/gid/' + tmp;
}

function disableCategory()
{
    var all = document.getElementsByName('allCategories');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an category');
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/disable-category/gid/' + tmp;
}

function deleteCategory()
{
    var all = document.getElementsByName('allCategories');
    var tmp = '';
    var count = 0;
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
             count++;
        }
    }
    if ('' == tmp) {
        alert('Please choose an category');
        return;
    } else {
    	result = confirm('Are you sure you want to delete ' + count + ' category(s)?');
        if (false == result) {
            return;
        }
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/delete-category/gid/' + tmp;
}


function deleteACategory(id)
{
    result = confirm('Are you sure you want to delete this category?');
    if (false == result) {
        return;
    }
    window.location.href = '<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
content/admin/delete-category/gid/' + id;
}
</script>