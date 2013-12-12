    {{if true == $success}}
 <center>
    {{l}}Updating...{{/l}} 
 </center>   
 <form>
    <textarea rows="1" cols="1" style="display: none;" id="customValue">{{$data.custom_value}}</textarea>
</form>
<script type="text/javascript">
$(document).ready(function() {
	window.parent.document.getElementById('{{$targetId}}').innerHTML = document.getElementById('customValue').innerHTML;
	window.parent.closePopup(); 
});
</script>
    {{else}}
    <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
            
       
            <div class="content-box"><!-- Start Content Box -->
                
                
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
                                    <div style="float:left;"><label>{{l}}Custom Value{{/l}}</label></div>
                                    <div style="float:left;width: 730px;"><textarea style="float:left;" class="text-input textarea editor"  name="data[custom_value]" rows="15" cols="90">{{$data.custom_value}}</textarea></div>
                                    <div class="clear"></div>
                                </p>
                                
                                <p>
                                <br/>
                                    <input class="button" type="submit" value="{{l}}Save & Update{{/l}}" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End #tab1 --> 
                    
                    
                  </form>
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>
            

<script type="text/javascript">
    //<![CDATA[
    
        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.
        
//        CKFinder.setupCKEditor( null, '{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/' );
//        CKEDITOR.replaceAll( 'editor');
    
//]]>
</script>
<style type="text/css">
.cke_top {
    background-color: #dddddd;
}
</style>
{{/if}}
