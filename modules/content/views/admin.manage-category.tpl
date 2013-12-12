            <h2>Manage Categories</h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div style="float:left;">
                        <a name="listofcategory"><h3>List of Categories</h3></a>
                   </div>     
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}content/admin/manage-category">
                            Name <input class="text-input small-input" type="text" name="condition[keyword]" id="keyword" value="{{$condition.keyword}}"/>
                            <input class="button" type="submit" value="Search" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        {{if $allCategories|@count <= 0}}
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                No category with above conditions.
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $categoryMessage|@count > 0 && $categoryMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$categoryMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $categoryMessage|@count > 0 && $categoryMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$categoryMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        <form method="POST" name="sortForm">
                        {{if $allCategories|@count > 0}}
                        <table>
                            <thead>
                                <tr>
                                   <th width="3%"><input class="check-all" type="checkbox" /></th>
                                   <th width="3%">#</th>
                                   <th width="10%">Parent</th>
                                   <th width="10%">Created</th>
                                   <th class="center" width="4%">
                                        Sort
                                        {{if $fullPermisison}}
                                        <a href="javascript:document.sortForm.submit();"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/save_16.png" alt="Save sorting"></a>
                                        {{/if}}
                                   </th>
                                   <th width="55%">Name</th>
                                   <th width="5%">Pub</th>
                                   <th width="5%">Edit</th>
                                   <th width="5%">GID/ID</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            {{foreach from=$allCategories item=item name=category}}
                                <tr>
                                    <td>{{if 1 == $item.content_deleteable}}<input type="checkbox" value="{{$item.content_category_gid}}" name="allCategories"/>{{else}}<img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/unselect.png" alt="Do not delete, enable, disable" />{{/if}}</td>
                                    <td>{{$smarty.foreach.category.iteration}}</td>
                                    <td>{{$item.parent}}</td>
                                    <td>{{$item.created_date}}</td>
                                    <td class="center">
                                        {{if $fullPermisison}}
                                        <input name="data[{{$item.content_category_gid}}]" value="{{$item.sorting}}" size="3" style="text-align: center;"></input>
                                        {{else}}
                                        {{$item.sorting}}
                                        {{/if}}
                                    </td>
                                    
                                    <td colspan="5" style="padding:0px;">
                                    <!-- All languages -->
                                        <table style="border-collapse: separate">
                                            <tbody id="table{{$item.content_category_id}}">
                                                <tr>
                                                    <td width="75%">--</td>
                                                    <td width="7%">
                                                        {{if $item.genabled == '1'}}
                                                            {{if $fullPermisison}}
                                                            <a href="{{$APP_BASE_URL}}content/admin/disable-category/gid/{{$item.content_category_gid}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png"></a>
                                                            {{else}}
                                                            <img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png">
                                                            {{/if}}
                                                        {{else}}
                                                            {{if $fullPermisison}}
                                                            <a href="{{$APP_BASE_URL}}content/admin/enable-category/gid/{{$item.content_category_gid}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png"></a>
                                                            {{else}}
                                                            <img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png">
                                                            {{/if}}
                                                        {{/if}}
                                                    </td>
                                                    <td width="10%">
                                                        {{if $fullPermisison}}
                                                        <a href="{{$APP_BASE_URL}}content/admin/edit-category/gid/{{$item.content_category_gid}}" title="Edit Category"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit Category" /></a>
                                                        {{else}}
                                                        --
                                                        {{/if}}
                                                    </td>
                                                    <td width=8%">
                                                        {{$item.content_category_gid}}
                                                    </td>
                                                </tr>
                                                
                                                {{foreach from=$item.langs item=item2}}
                                                <tr>
                                                    <td><image style="vertical-align:middle;" src="{{$BASE_URL}}{{$item2.lang_image}}"> {{$item2.name}}</td>
                                                    <td>
                                                    
                                                    {{assign var='langId' value=$item2.lang_id}}
                                                    
                                                    {{if $item.genabled == '1'}}
                                                    
                                                        <!-- FULL PERMISSION -->
                                                        {{p name=edit_category module=content expandId=$langId}}
                                                            {{if $item2.enabled == '1' }}
                                                            	{{if 1 == $item.content_deleteable}}
                                                                	<a href="{{$APP_BASE_URL}}content/admin/disable-category/gid/{{$item.content_category_gid}}/lid/{{$item2.lang_id}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png"></a>
                                                            	{{else}}
                                                            		<img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png">
                                                            	{{/if}}
                                                            {{else}}
                                                            	{{if 1 == $item.content_deleteable}}
                                                                	<a href="{{$APP_BASE_URL}}content/admin/enable-category/gid/{{$item.content_category_gid}}/lid/{{$item2.lang_id}}" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png"></a>
                                                            	{{else}}
                                                            		<img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png">
                                                            	{{/if}}
                                                            {{/if}}
                                                        {{/p}}
                                                        <!-- DON'T HAVE PERMISSION -->
                                                        {{np name=edit_category module=content expandId=$langId}}
                                                            {{if $item2.enabled == '1'}}
                                                                <img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png">
                                                            {{else}}
                                                                <img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png">
                                                            {{/if}}
                                                        {{/np}}
                                                    {{else}}
                                                        <img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png">
                                                    {{/if}}
                                                    </td>
                                                    <td>
                                                        {{p name=edit_category module=content expandId=$langId}}
                                                        <a href="{{$APP_BASE_URL}}content/admin/edit-category/gid/{{$item.content_category_gid}}/lid/{{$item2.lang_id}}" title="Edit Category"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit Category" /></a>
                                                        {{/p}}
                                                        {{np name=edit_category module=content expandId=$langId}}
                                                        --
                                                        {{/np}}
                                                    </td>
                                                    <td>
                                                        {{$item2.content_category_id}}
                                                    </td>
                                                </tr>
                                                {{/foreach}}
                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            {{/foreach}}    
                                
                            
                            </tbody>
                        </table>
                        </form>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        {{p name=edit_category module=content}}
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";">Choose an action...</option>
                                {{p name=delete_category module=content}}
                                <option value="deleteCategory();">Delete</option>
                                {{/p}}
                                <option value="enableCategory();">Enable</option>
                                <option value="disableCategory();">Disable</option>
                            </select>
                            <a class="button" href="javascript:applySelected();">Apply to selected</a>
                        </div>
                        {{/p}}
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}content/admin/manage-category">
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
    window.location.href = '{{$APP_BASE_URL}}content/admin/enable-category/gid/' + tmp;
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
    window.location.href = '{{$APP_BASE_URL}}content/admin/disable-category/gid/' + tmp;
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
    window.location.href = '{{$APP_BASE_URL}}content/admin/delete-category/gid/' + tmp;
}


function deleteACategory(id)
{
    result = confirm('Are you sure you want to delete this category?');
    if (false == result) {
        return;
    }
    window.location.href = '{{$APP_BASE_URL}}content/admin/delete-category/gid/' + id;
}
</script>
