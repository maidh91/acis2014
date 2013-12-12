<?php /* Smarty version 2.6.25, created on 2013-12-12 10:42:21
         compiled from permission/views/admin.manager.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'p', 'permission/views/admin.manager.tpl', 10, false),array('modifier', 'count', 'permission/views/admin.manager.tpl', 17, false),)), $this); ?>
       
<script src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery.treeview.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/css/jquery.treeview.css" />

           <div style="float:left;">
                <h2>Manage Permissions</h2>
           </div>     
           <div style="float:right;padding-right:35px;padding-top:8px;">
                <?php $this->_tag_stack[] = array('p', array('name' => 'rescan_permission','module' => 'permission')); $_block_repeat=true;Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/rescan"><img style="vertical-align: middle;" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/refresh_16.png">Rescan all permissions</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Permission::checkPermisison($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
           </div>
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <!-- MESSAGE -->
            <?php if (count($this->_tpl_vars['permissionMessage']) > 0 && $this->_tpl_vars['permissionMessage']['success'] == true): ?>
            <div class="notification success png_bg" style="width:96%">
                <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    <?php echo $this->_tpl_vars['permissionMessage']['message']; ?>

                </div>
            </div>
            <?php endif; ?>
            <!-- END MESSAGE -->
            
            <!-- GROUP -->
            <div class="content-box" style="float:left; width:20%; margin-right: 5px; min-height: 400px;">
                <div class="content-box-header">
                    <h3>Group</h3>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content" style="padding-bottom: 0px;">
                    <ul id="group" class="filetree">
                        <li><span class="group">Group</span>
                            <ul>
                                <?php $_from = $this->_tpl_vars['allGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <li><span class="file"><a href="javascript:chooseGroup(<?php echo $this->_tpl_vars['item']['group_id']; ?>
, '<?php echo $this->_tpl_vars['item']['name']; ?>
');"><span style="color:<?php echo $this->_tpl_vars['item']['color']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</span></a></span></li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- END GROUP -->
            
            <!-- MODULE -->
            <div class="content-box" style="float:left; width:20%; margin-right: 5px; min-height: 400px;">
                <div class="content-box-header">
                    <h3>Access</h3>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content" style="padding-bottom: 0px;">
                    <ul id="module" class="filetree">
                        <li><span class="global">Applications</span>
                            <ul>
                                <?php $_from = $this->_tpl_vars['allApps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <li><span class="file"><a href="javascript:chooseAccess('application::<?php echo $this->_tpl_vars['item']; ?>
');"><?php echo $this->_tpl_vars['item']; ?>
</a></span></li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </li>
                        <li><span class="module">Modules</span>
                            <ul>
                                <?php $_from = $this->_tpl_vars['allModules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <li><span class="file"><a href="javascript:chooseAccess('<?php echo $this->_tpl_vars['item']; ?>
');"><?php echo $this->_tpl_vars['item']; ?>
</a></span></li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- END MODULE -->
           
            <!-- PERMISSION -->
            <div class="content-box" style="float:left;width:55%; min-height: 400px;">
                <div class="content-box-header">
                    <h3><span id="group_name">???</span> > <span id="access_name">???</span></h3>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content" style="padding-bottom: 0px;" id="permission_box">
                
                Please select group and access.
                </div>
            </div>
            <!-- END PERMISSION -->
            
            <div class="clear"></div>
            
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    
    // second example
    $("#group").treeview();
    $("#module").treeview();
});

var groupId = '';
var access = '';

function chooseGroup(id, name) {
	groupId = id;
	$("#group_name").html(name);
	loadPermission();
}
function chooseAccess(name, atype) {
	access = name;
    $("#access_name").html(name);
    loadPermission();
}
function loadPermission() {
	if ('' == groupId || '' == access) {
		return;
	}
	$("#permission_box").html('Loading...');
	
	$.ajax({
	       type: "POST",
	       cache: false,
	       url: "<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/get-permission",
	       data: {
    		   'groupId': groupId,
    		   'access': access
		   },
	       success: function(msg){
			   $("#permission_box").html(msg);
			   $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows // Add class "alt-row" to even table rows
	       }
	     });
	
}

function enablePermission(gid, pid, expandid) {
//    $("#permission_box").html('Loading...');
    
    $.ajax({
           type: "POST",
           cache: false,
           url: "<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/enable-permission",
           data: {
               'gid': gid,
               'pid': pid,
               'expandid': expandid
           },
           success: function(msg){
               $("#permission_box").html(msg);
               $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows
           }
         });
}

function enableAllPermissions(gid, pid) {
//    $("#permission_box").html('Loading...');
    
    $.ajax({
           type: "POST",
           cache: false,
           url: "<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/enable-all-permissions",
           data: {
               'gid': gid,
               'pid': pid
           },
           success: function(msg){
               $("#permission_box").html(msg);
               $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows
           }
         });
}

function disablePermission(gid, pid, expandid) {
//    $("#permission_box").html('Loading...');
    
    $.ajax({
           type: "POST",
           cache: false,
           url: "<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/disable-permission",
           data: {
               'gid': gid,
               'pid': pid,
               'expandid': expandid
           },
           success: function(msg){
               $("#permission_box").html(msg);
               $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows
           }
         });
}
function disableAllPermissions(gid, pid) {
//    $("#permission_box").html('Loading...');
    
    $.ajax({
           type: "POST",
           cache: false,
           url: "<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
permission/admin/disable-all-permissions",
           data: {
               'gid': gid,
               'pid': pid
           },
           success: function(msg){
               $("#permission_box").html(msg);
               $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows
           }
         });
}
</script>