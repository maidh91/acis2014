            
            <div style="float:left;">
                <h2>Quản Lý Danh Mục</h2>
           </div>     
           <div style="float:right;padding-right:35px;padding-top:8px;">
                <a href="{{$APP_BASE_URL}}category/admin/new-value/cid/{{$category.category_id}}"><img style="vertical-align: middle;" src="{{$LAYOUT_HELPER_URL}}admin/images/icons/add_16.png"> Thêm giá trị</a>
           </div>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <a name="listofvalue"><h3>Danh mục: "{{$category.name}}"</h3></a> 
                   
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}category/admin/category-value-manage/id/{{$category.category_id}}">
                            
                          Giá trị:  <input class="text-input small-input" type="text" name="condition[name]" id="categoryValuename" value="{{$condition.name}}"/>
                            
                            <input class="button" type="submit" value="Tìm" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        {{if $allCategoryValues|@count <= 0}}
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                Không có giá trị nào với điều kiện trên.
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $categoryValueMessage|@count > 0 && $categoryValueMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$categoryValueMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $categoryValueMessage|@count > 0 && $categoryValueMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$categoryValueMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        
                        {{if $allCategoryValues|@count > 0}}
                        <form method="POST" name="sortForm">
                        <table>
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>ID</th>
                                   <th>Giá trị</th>
                                   <th class="center">Sắp xếp <a href="javascript:document.sortForm.submit();"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/save_16.png"></img></a></th>
                                   <th class="center">Thao tác</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            {{foreach from=$allCategoryValues item=item}}
                                <tr>
                                    <td><input type="checkbox" value="{{$item.category_value_id}}" name="allCategoryValues"/></td>
                                    <td>{{$item.category_value_id}}</td>
                                    <td>
                                        {{$item.name}}
                                        
                                        {{if null != $item.custom_value}}
                                            ("{{$item.custom_value}}")
                                        {{/if}}
                                    </td>
                                    <td class="center">
                                        <input name="data[{{$item.category_value_id}}]" value="{{$item.sorting}}" style="width: 40px;text-align: center;"></input>
                                    </td>
                                    <td class="center">
                                        <!-- Icons -->
                                         <a href="{{$APP_BASE_URL}}category/admin/edit-value/cid/{{$category.category_id}}/id/{{$item.category_value_id}}" title="Edit"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit" /></a>
                                         <a href="javascript:deleteACategoryValue({{$item.category_value_id}});" title="Delete"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross.png"  alt="Delete" /></a> 
                                    </td>
                                </tr>
                            {{/foreach}}    
                                
                            
                            </tbody>
                        </table>
                        </form>
                        
                        <br/>
                        <!-- CHOOSE ACTION -->
                        <div class="bulk-actions align-left" style="float: left;padding-top: 14px;">
                            <select id="action">
                                <option value=";">Chọn 1 thao tác...</option>
                                <option value="deleteCategoryValue();">Xóa</option>
                            </select>
                            <a class="button" href="javascript:applySelected();">Thực hiện thao tác</a>
                        </div>
                        
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px; padding-left:30px;">
                            <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}category/admin/category-value-manage/id/{{$category.category_id}}">
                                Hiển thị #
                                <select name="displayNum" onchange="this.parentNode.submit();" style="clear: both;">
                                    <option value="5" {{if $displayNum == 5}} selected="selected" {{/if}}>5</option>
                                    <option value="10" {{if $displayNum == 10}} selected="selected" {{/if}}>10</option>
                                    <option value="20" {{if $displayNum == 20}} selected="selected" {{/if}}>20</option>
                                    <option value="50" {{if $displayNum == 50}} selected="selected" {{/if}}>50</option>
                                    <option value="100" {{if $displayNum == 100}} selected="selected" {{/if}}>100</option>
                                    <option value="1000000000" {{if $displayNum >= 1000000000}} selected="selected" {{/if}}>Tất cả</option>
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
    document.getElementById('categoryValuename').select();
    document.getElementById('categoryValuename').focus();
});

function applySelected()
{
    var task = document.getElementById('action').value;
    eval(task);
}

function deleteCategoryValue()
{
    var all = document.getElementsByName('allCategoryValues');
    var tmp = '';
    var count = 0;
    for (var i = 0; i < all.length; i++) {
        if (all[i].checked) {
             tmp = tmp + '_' + all[i].value;
             count++;
        }
    }
    if ('' == tmp) {
        alert('Please choose a value');
        return;
    } else {
        result = confirm('Are you sure you want to delete ' + count + ' value(s)?');
        if (false == result) {
            return;
        }
    }
    window.location.href = '{{$APP_BASE_URL}}category/admin/delete-value/cid/{{$category.category_id}}/id/' + tmp;
}


function deleteACategoryValue(id)
{
    result = confirm('Are you sure you want to delete this value?');
    if (false == result) {
        return;
    }
    window.location.href = '{{$APP_BASE_URL}}category/admin/delete-value/cid/{{$category.category_id}}/id/' + id;
}
</script>
