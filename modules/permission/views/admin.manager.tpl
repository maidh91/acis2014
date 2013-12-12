       
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.treeview.js" type="text/javascript"></script>
<link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/jquery.treeview.css" />

           <div style="float:left;">
                <h2>Manage Permissions</h2>
           </div>     
           <div style="float:right;padding-right:35px;padding-top:8px;">
                {{p name='rescan_permission' module='permission'}}<a href="{{$APP_BASE_URL}}permission/admin/rescan"><img style="vertical-align: middle;" src="{{$LAYOUT_HELPER_URL}}admin/images/icons/refresh_16.png">Rescan all permissions</a>{{/p}}
           </div>
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <!-- MESSAGE -->
            {{if $permissionMessage|@count > 0 && $permissionMessage.success == true}}
            <div class="notification success png_bg" style="width:96%">
                <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    {{$permissionMessage.message}}
                </div>
            </div>
            {{/if}}
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
                                {{foreach from=$allGroups item=item}}
                                <li><span class="file"><a href="javascript:chooseGroup({{$item.group_id}}, '{{$item.name}}');"><span style="color:{{$item.color}}">{{$item.name}}</span></a></span></li>
                                {{/foreach}}
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
                                {{foreach from=$allApps item=item}}
                                <li><span class="file"><a href="javascript:chooseAccess('application::{{$item}}');">{{$item}}</a></span></li>
                                {{/foreach}}
                            </ul>
                        </li>
                        <li><span class="module">Modules</span>
                            <ul>
                                {{foreach from=$allModules item=item}}
                                <li><span class="file"><a href="javascript:chooseAccess('{{$item}}');">{{$item}}</a></span></li>
                                {{/foreach}}
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
	       url: "{{$APP_BASE_URL}}permission/admin/get-permission",
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
           url: "{{$APP_BASE_URL}}permission/admin/enable-permission",
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
           url: "{{$APP_BASE_URL}}permission/admin/enable-all-permissions",
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
           url: "{{$APP_BASE_URL}}permission/admin/disable-permission",
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
           url: "{{$APP_BASE_URL}}permission/admin/disable-all-permissions",
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
