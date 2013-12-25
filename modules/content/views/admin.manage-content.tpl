            <h2>Manage Content</h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div style="float:left;">
                        <a name="listofcontent"><h3>List of Content</h3></a>
                   </div>     
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}content/admin/manage-content">
                            Title <input class="text-input small-input" type="text" name="condition[keyword]" id="keyword" value="{{$condition.keyword}}"/>
                            
                            
                            <input class="button" type="submit" value="Search" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        {{if $allContent|@count <= 0}}
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                No content with above conditions.
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $contentMessage|@count > 0 && $contentMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$contentMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $contentMessage|@count > 0 && $contentMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$contentMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        <form method="POST" name="sortForm">
                        {{if $allContent|@count > 0}}
                        <table>
                            <thead>
                                <tr>
                                   <th width="3%"><input class="check-all" type="checkbox" /></th>
                                   <th width="45%">Title</th>
                                   <th width="12%">Created</th>
                                   <th width="12%">Update</th>
                                 
                                   
                                  
                                   
                                   <th width="7%">Edit</th>
                                   <th width="5%">ID</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            {{foreach from=$allContent item=item name=content}}
                                <tr>
<!--                               <td><input type="checkbox" value="{{$item.content_gid}}" name="allContent"/></td>-->
                                   <td><input type="checkbox" value="{{$item.content_gid}}" name="allContent"/></td>
                                    
                                   
                                    
                                   
                                    
                                  
                                   
                                               
                                                
                                                {{foreach from=$item.langs item=item2}}
                                                
                                                    <td>{{$item2.title}}</td>
                                                   <td>{{$item.created_date}}</td>
                                                   <td>{{$item.update_date}}</td>
                                   
                                                  
                                                    <td>
                                                        {{p name=edit_content module=content expandId=$langId}}
                                                        <a href="{{$APP_BASE_URL}}content/admin/edit-content/gid/{{$item.content_gid}}/lid/{{$item2.lang_id}}" title="Edit Content"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit Content" /></a>
                                                        {{/p}}
                                                        {{np name=edit_content module=content expandId=$langId}}
                                                        --
                                                        {{/np}}
                                                    </td>
                                                    <td>
                                                        {{$item2.content_id}}
                                                    </td>
                                               
                                                {{/foreach}}
                                                
                                           
                                  
                                </tr>
                            {{/foreach}}    
                                
                            
                            </tbody>
                        </table>
                        </form>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        {{p name=edit_content module=content}}
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";">Choose an action...</option>
                                {{p name=delete_content module=content}}
                                <option value="deleteContent();">Delete</option>
                                {{/p}}
                               
                            </select>
                            <a class="button" href="javascript:applySelected();">Apply to selected</a>
                        </div>
                        {{/p}}
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:35px;">
                            <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}content/admin/manage-content">
                                Display #
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
$(document).ready(function(){
    document.getElementById('keyword').select();
    document.getElementById('keyword').focus();
});

function applySelected()
{
	var task = document.getElementById('action').value;
	eval(task);
}
function enableContent()
{
    var all = document.getElementsByName('allContent');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an content');
    }
    window.location.href = '{{$APP_BASE_URL}}content/admin/enable-content/gid/' + tmp;
}

function disableContent()
{
    var all = document.getElementsByName('allContent');
    var tmp = '';
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
        }
    }
    if ('' == tmp) {
        alert('Please choose an content');
    }
    window.location.href = '{{$APP_BASE_URL}}content/admin/disable-content/gid/' + tmp;
}

function deleteContent()
{
    var all = document.getElementsByName('allContent');
    var tmp = '';
    var count = 0;
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
             count++;
        }
    }
    if ('' == tmp) {
        alert('Please choose an content');
        return;
    } else {
    	result = confirm('Are you sure you want to delete ' + count + ' content(s)?');
        if (false == result) {
            return;
        }
    }
    window.location.href = '{{$APP_BASE_URL}}content/admin/delete-content/gid/' + tmp;
}


function deleteAContent(id)
{
    result = confirm('Are you sure you want to delete this content?');
    if (false == result) {
        return;
    }
    window.location.href = '{{$APP_BASE_URL}}content/admin/delete-content/gid/' + id;
}
</script>
