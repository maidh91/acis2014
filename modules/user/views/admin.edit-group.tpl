            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Edit Group</h3>
                    
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <div class="tab-content" id="tab1">
                    
                        <!-- ERROR -->
                        {{if $errors|@count > 0}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{if $errors.main}}
                                    Error: {{$errors.main}}
                                {{else}}
                                    Error: Please check following information again
                                {{/if}} 
                                                                       
                            </div>
                        </div>
                        {{/if}}
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Name<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[name]" value="{{$data.name}}" />{{if $errors.name}}<span class="input-notification error png_bg">{{$errors.name}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>Color<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[color]" value="{{$data.color}}" />{{if $errors.color}}<span class="input-notification error png_bg">{{$errors.color}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>Sorting<span class="red">*</span></label>
                                        <input class="text-input small-input" type="text"  name="data[sorting]" value="{{$data.sorting}}" />{{if $errors.sorting}}<span class="input-notification error png_bg">{{$errors.sorting}}</span>{{/if}}
                                </p>
                                <p>
                                    <label>Enable group</label>
                                    <input type="radio" name="data[enabled]" value="1" {{if $data.enabled != '0'}}checked="checked"{{/if}}/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[enabled]" value="0" {{if $data.enabled == '0'}}checked="checked"{{/if}}/> No
                                </p>
                                <p>
                                    <label>Default</label>
                                    <input type="radio" name="data[default]" value="1" {{if $data.default != '0'}}checked="checked"{{/if}}/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[default]" value="0" {{if $data.default == '0'}}checked="checked"{{/if}}/> No
                                </p>
                                <p>
                                    <label>Description</label>
                                    <textarea class="text-input textarea" id="textarea" name="data[description]" cols="79" rows="5">{{$data.description}}</textarea>
                                </p>
                                
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End #tab1 --> 
                    
                      
                  </form>
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>