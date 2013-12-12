            <h2>News Letter Mail Manager</h2>
            
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
           
            
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <div style="float:left;">
                        <a name="listofcontent"><h3>List of Mails</h3></a>
                   </div>     
                   <div style="float:right;padding-right:20px;padding-top:5px;">
                        <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}mail/admin/newsletter-manager">
                            <input class="text-input small-input" type="text" name="condition[keyword]" id="keyword" value="{{$condition.keyword}}"/>
                            
                            <input class="button" type="submit" value="Search" />
                        </form>
                        
                   </div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                       
                       
                        <!-- MESSAGE HERE -->
                        {{if $allMails|@count <= 0}}
                        <div class="notification information png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                No content with above conditions.
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $mailMessage|@count > 0 && $mailMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$mailMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $mailMessage|@count > 0 && $mailMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$mailMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                        
                        
                        
                        {{if $allMails|@count > 0}}
                        <table>
                            <thead>
                                <tr>
                                   <th width="3%"><input class="check-all" type="checkbox" /></th>
                                   <th width="3%">ID</th>
                                   <th width="30%">Subject</th>
                                   <th width="43%">Content</th>
                                   <th width="10%" class="center" style="padding-right:20px;">Edit</th>
                                </tr>
                                
                            </thead>
                         
                         
                            <tbody>
                            
                            {{foreach from=$allMails item=item}}
                                <tr>
                                    <td><input type="checkbox" value="{{$item.newsletter_mail_id}}" name="allMails"/></td>
                                    <td>{{$item.newsletter_mail_id}}</td>
                                    <td>{{$item.subject}}</td>
                                    <td>{{$item.content}}</td>
                                     <td width="10%" class="center">
                                            <a href="{{$APP_BASE_URL}}mail/admin/edit-newsletter/id/{{$item.newsletter_mail_id}}" title="Edit"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/pencil.png"  alt="Edit" /></a>
                                     </td>
                                </tr>
                            {{/foreach}}    
                            </tbody>
                        </table>
                        
                        <br/>
                        
                        <div class="bulk-actions align-left" style="float: left;padding-top: 10px;">
                            <form class="search" name="search" method="post" action="{{$APP_BASE_URL}}mail/admin/newsletter-manager">
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

</script>
