            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Settings</h3>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="tab-content" id="tab1">
                    
                        <!-- MESSAGE HERE -->
                        
                        {{if $message|@count > 0 && $message.success == true}}
                        <div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$message.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        {{if $message|@count > 0 && $message.success == false}}
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                {{$message.message}}
                            </div>
                        </div>
                        {{/if}}
                        
                        <!-- END MESSAGE -->
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Website title</label>
                                        <input class="text-input small-input" type="text"  name="data[site_title]" value="{{$data.site_title}}" />
                                </p>
                                <p>
                                    <label>System mail</label>
                                        <input class="text-input small-input" type="text"  name="data[admin_email]" value="{{$data.admin_email}}" />
                                </p>
                                
                                <p>
                                    <label>Meta Keywords</label>
                                        <input class="text-input large-input" type="text"  name="data[meta_keywords]" value="{{$data.meta_keywords}}" />
                                </p>
                                
                                <p>
                                    <label>Meta Description</label>
                                        <input class="text-input large-input" type="text"  name="data[meta_desc]" value="{{$data.meta_desc}}" />
                                </p>
                                
                                <p>
                                <br/>
                                    <input class="button" type="submit" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End #tab1 --> 
                    
                  </form>
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>
