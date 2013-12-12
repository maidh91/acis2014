 
 
 
 <script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#editlist").validate({
        rules: {
            'data[name]': "required"
        },
        messages: {
            'data[name]': ""
        }
        
        
    }); 
});
</script> 
    <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
            
       
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Chỉnh Sửa Giá Trị</h3>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form name="editlist" id="editlist" action="" method="post">
                    
                    <div class="tab-content" id="tab1">
                    
                        <!-- ERROR -->
                            {{if $errors|@count > 0}}
                            <div class="notification error png_bg">
                                <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                                <div>
                                    {{if $errors.main}}
                                        Error: {{$errors.main}}
                                    {{else}}
                                        Error: please check information below
                                    {{/if}} 
                                                                           
                                </div>
                            </div>
                            {{/if}}
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Parent List</label>
                                        <select name="data[parent_id]" class=" small-input">
                                    {{foreach from=$list item=item }}
                                        {{if $data.list_id != $item.list_id}} <option value="{{$item.list_id}}" {{if $item.list_id == $data.parent_id}}selected="selected" {{/if}}>{{$item.name}}</option>{{/if}}
                                        {{/foreach}}
                                </select>
                                </p>
                                <p>
                                    <label>Name</label>
                                        <input class="text-input small-input" type="text"  name="data[name]" value="{{$data.name}}" />
                                </p>
                                
                                <p>
                                    <div style="float:left;"><label> Custom Value</label></div>
                                    <div style="float:left;width: 730px;"><textarea style="float:left;" class="text-input textarea editor"  name="data[custom_value]" rows="20" cols="90">{{$data.custom_value}}</textarea></div>
                                    <div class="clear"></div>
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
