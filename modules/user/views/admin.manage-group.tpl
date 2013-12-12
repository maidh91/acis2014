            <h2>{{l}}Manage Groups{{/l}}</h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            <div class="content-box"><!-- Start Content Box -->
                
                
                <div class="content-box-content" style="border-top: none;">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        {{if $allGroups|@count <= 0}}
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{l}}No group in system now.{{/l}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $groupMessage|@count > 0 && $groupMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$groupMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $groupMessage|@count > 0 && $groupMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$groupMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        
                        {{if $allGroups|@count > 0}}
                        <table>
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>ID</th>
                                   <th>{{l}}Group{{/l}}</th>
                                   <th>{{l}}Description{{/l}}</th>
                                   <th class="center">{{l}}Sorting{{/l}}</th>
                                   <th class="center">{{l}}Enabled{{/l}}</th>
                                   <th class="center">{{l}}Action{{/l}}</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            {{foreach from=$allGroups item=item}}
                                <tr>
                                    <td><input type="checkbox" value="{{$item.group_id}}" name="allGroups"/></td>
                                    <td>{{$item.group_id}}</td>
                                    <td><span style="
                                                        {{if $item.color}} color: {{$item.color}}; {{/if}}
                                                ">{{$item.name}}</span></td>
                                    <td>{{$item.description}}</td>
                                    <td class="center">{{$item.sorting}}</td>
                                    <td class="center">
                                        {{if $item.enabled == '1'}}
                                            <a href="{{$APP_BASE_URL}}user/admin/disable-group/id/{{$item.group_id}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png"></a>
                                        {{else}}
                                            <a href="{{$APP_BASE_URL}}user/admin/enable-group/id/{{$item.group_id}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png"></a>
                                        {{/if}}
                                    </td>
                                    <td class="center">
                                        <!-- Icons -->
                                         <a href="{{$APP_BASE_URL}}user/admin/edit-group/id/{{$item.group_id}}" title="Edit"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit" /></a>
                                       <!--   
                                         <a href="#" title="Send Mail"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/mail_send_16.png"  alt="Send Mail" /></a>
                                        -->
                                    </td>
                                </tr>
                            {{/foreach}}    
                                
                            
                            </tbody>
                        </table>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";">{{l}}Choose an action...{{/l}}</option>
                                <option value="enableGroup();">{{l}}Enable{{/l}}</option>
                                <option value="disableGroup();">{{l}}Disable{{/l}}</option>
                            </select>
                            <a class="button" href="javascript:applySelected();">{{l}}Apply to selected{{/l}}</a>
                        </div>
                        
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}user/admin/manage-group">
                                {{l}}Display {{/l}}#
                                <select name="displayNum" onchange="this.parentNode.submit();" style="clear: both;">
                                    <option value="5" {{if $displayNum == 5}} selected="selected" {{/if}}>5</option>
                                    <option value="10" {{if $displayNum == 10}} selected="selected" {{/if}}>10</option>
                                    <option value="20" {{if $displayNum == 20}} selected="selected" {{/if}}>20</option>
                                    <option value="50" {{if $displayNum == 50}} selected="selected" {{/if}}>50</option>
                                    <option value="100" {{if $displayNum == 100}} selected="selected" {{/if}}>100</option>
                                    <option value="1000000000" {{if $displayNum >= 1000000000}} selected="selected" {{/if}}>All</option>
                                </select>
                            </form>
                        </div>
                        
                        <!-- PAGINATION -->
                        {{if $countAllPages > 1}}
                        <div class="pagination" style="float: right;">
                            {{if $first}}
                            <a href="?page=1" class="number" title="First Page">&laquo; First</a>
                            {{/if}}
                            {{if $prevPage}}
                            <a href="?page={{$prevPage}}" class="number" title="Previous Page">&laquo;</a>
                            {{/if}}
                            
                            {{foreach from=$prevPages item=item}}
                            <a href="?page={{$item}}" class="number" title="{{$item}}">{{$item}}</a>
                            {{/foreach}}
                            
                            <a href="#" class="number current" title="{{$currentPage}}">{{$currentPage}}</a>
                            
                            {{foreach from=$nextPages item=item}}
                            <a href="?page={{$item}}" class="number" title="{{$item}}">{{$item}}</a>
                            {{/foreach}}
                            
                            {{if $nextPage}}
                            <a href="?page={{$nextPage}}" class="number" title="Next Page">&raquo;</a>
                            {{/if}}
                            {{if $last}}
                            <a href="?page={{$countAllPages}}" class="number" title="Last Page">Last &raquo;</a>
                            {{/if}}
                        </div> <!-- End .pagination -->
                        {{/if}}
                    {{/if}}    
                        
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
    window.location.href = '{{$APP_BASE_URL}}user/admin/enable-group/id/' + tmp;
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
    window.location.href = '{{$APP_BASE_URL}}user/admin/disable-group/id/' + tmp;
}

</script>
