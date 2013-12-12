<script type="text/javascript">

$().ready(function() {
    // validate signup form on keyup and submit
    $("input[type=password]").val('');
});
</script>
          
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>{{l}}Edit User{{/l}}</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">{{l}}Basic{{/l}}</a></li>
                        {{if !$limit}}<li><a href="#tab2">{{l}}Detail{{/l}}</a></li>{{/if}}
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <div class="tab-content" id="tab1">
                    
                        <!-- MESSAGE HERE -->
                        {{if $userMessage|@count > 0 && $userMessage.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$userMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $userMessage|@count > 0 && $userMessage.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$userMessage.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>{{l}}Username{{/l}}<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[username]" value="{{$data.username}}" />{{if $errors.username}}<span class="input-notification error png_bg">{{$errors.username}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>{{l}}New Password{{/l}}<span class="red">*</span></label>
                                        <input class="text-input small-input" type="password"  name="data[password]" value="" />{{if $errors.password}}<span class="input-notification error png_bg">{{$errors.password}}</span>{{/if}}
                                        <br /><small>{{l}}Between 6-20 characters{{/l}}</small>
                                </p>
                                <p>
                                    <label>{{l}}Repeat New Password{{/l}}<span class="red">*</span></label>
                                        <input class="text-input small-input" type="password" name="data[repeat_password]" value="{{$data.repeat_password}}" />{{if $errors.repeat_password}}<span class="input-notification error png_bg">{{$errors.repeat_password}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>{{l}}Email{{/l}}</label>
                                        <input class="text-input small-input" type="text"  name="data[email]"  value="{{$data.email}}" />{{if $errors.email}}<span class="input-notification error png_bg">{{$errors.email}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>{{l}}First Name{{/l}}<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[first_name]"  value="{{$data.first_name}}" />{{if $errors.first_name}}<span class="input-notification error png_bg">{{$errors.first_name}}</span>{{/if}}
                                </p>
                                
                                <p>
                                    <label>{{l}}Last Name{{/l}}<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[last_name]"  value="{{$data.last_name}}" />{{if $errors.last_name}}<span class="input-notification error png_bg">{{$errors.last_name}}</span>{{/if}}
                                </p>
                                
                                {{p module=user name=change_group}}
                                <p>
                                    <label>{{l}}Group{{/l}}<span class="red">*</span></label>              
                                    <select name="data[group_id]" class="small-input">
                                    {{foreach from=$allGroups item=item}}
                                        <option value="{{$item.group_id}}" {{if $data.group_id == $item.group_id}}selected="selected"{{/if}}>{{$item.name}}</option>
                                    {{/foreach}}
                                    </select> 
                                    <!-- {{if 1 == $loggedGroupId}}
                                    <br /><small>Each group has different <a href="{{$APP_BASE_URL}}permission/admin/manager">permissions</a>.</small>
                                    {{/if}} -->
                                </p>
                                {{/p}}
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; {{l}}Back{{/l}}" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="{{l}}Save{{/l}}" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End #tab1 --> 
                    
                    <div class="tab-content hidden" id="tab2">
                    
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label>{{l}}Enable user{{/l}}</label>
                                    <input type="radio" name="data[enabled]" value="1" {{if $data.enabled != '0'}}checked="checked"{{/if}}/> {{l}}Yes{{/l}} &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[enabled]" value="0" {{if $data.enabled == '0'}}checked="checked"{{/if}}/> {{l}}No{{/l}}
                                </p>
                                
                                <p>
                                    <label>{{l}}Note{{/l}}</label>
                                    <textarea class="text-input textarea" id="textarea" name="data[admin_note]" cols="79" rows="5">{{$data.admin_note}}</textarea>
                                </p>
                                
                                <p>
                                    <input class="button" type="button" value="&laquo; {{l}}Back{{/l}}" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="{{l}}Save{{/l}}" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>      
                      
                  </form>
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>