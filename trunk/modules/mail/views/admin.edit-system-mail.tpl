<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/ckfinder.js"></script> 
       
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Edit System Mail</h3>
                    
                    <ul class="content-box-tabs">
                        {{if $fullPermisison}}<li><a href="#tab0" {{if false==$lid}}class="default-tab"{{/if}}>General</a></li>{{/if}}
                        {{foreach from=$allLangs item=item}}
                        <li><a href="#tab{{$item.lang_id}}" {{if $item.lang_id==$lid}}class="default-tab"{{/if}} style="padding-bottom: 4px;"><image style="vertical-align:middle;" src="{{$BASE_URL}}{{$item.lang_image}}"> {{$item.name}}</a></li>
                        {{/foreach}}
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <!-- GENERAL -->
                    <div class="tab-content {{if false!=$lid}}hidden{{/if}}" id="tab0">
                    
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
                                    <b><i>{{$data.name}}</i></b>
                                    <br /><small>This name is used for finding system mail. This name is only changed by programmer</small>
                                </p>
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End GENERAL --> 
                    
                    {{foreach from=$allLangs item=item}}
                    <!-- LANGUAGES -->
                    <div class="tab-content {{if $item.lang_id!=$lid}}hidden{{/if}}" id="tab{{$item.lang_id}}">
                        <div style="float: left;min-width: 200px; min-height: 500px; margin-right: 10px; padding-left: 10px;padding-top: 10px; line-height: 2em; background-color: #eeeeee;"> 
                               <i>Mail values:</i><br/>
                               <br/> 
                                {{$data.data}}
                        </div style="float: left;">
                        <div>
                    
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <b>Subject</b><br/>
                                        <input class="text-input small-input" type="text"  name="data[{{$item.lang_id}}][subject]" value="{{$data[$item.lang_id].subject}}" />
                                </p>
                                <p>
                                    <b>Content</b>
                                    <div style="float:left;width: 730px;"><textarea style="float:left;" class="text-input textarea editor"  name="data[{{$item.lang_id}}][content]" rows="20" cols="90">{{$data[$item.lang_id].content}}</textarea></div>
                                    <div class="clear"></div>
                                </p>
                                
                            </fieldset>
                       </div> 
                       
                        <div class="clear"></div><!-- End .clear -->
                        
                        <p>
                        <br/>
                            <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                            <input class="button" type="submit" value="Save" />
                        </p>    
                            
                    </div>
                    {{/foreach}}
                  </form>
                  
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>

<script type="text/javascript">
    //<![CDATA[
    
        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.
        
        CKFinder.setupCKEditor( null, '{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/' );
        CKEDITOR.replaceAll( 'editor');
    
//]]>
</script>
<style type="text/css">
.cke_top {
	background-color: #dddddd;
}
</style>