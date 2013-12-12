<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/ckfinder.js"></script>  
<link href="{{$LAYOUT_HELPER_URL}}admin/js/jquery-ui/css/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery-ui/js/jquery-ui.js"></script>
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.slug.js"></script>

<script type="text/javascript">
    //<![CDATA[

    jQuery(document).ready(function (){
        CKFinder.setupCKEditor( null, '{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/' );
        jQuery( "#images" ).sortable();
        jQuery( "#images" ).disableSelection();
        //Datepicker
        jQuery( ".date" ).datepicker({
            showAnim        : 'slideDown',
            showButtonPanel : true,
            dateFormat      : '{{$datepickerFormat.js}}'
        });
        //Display images
        jQuery(".input_image[value!='']").parent().find('div').each( function (index, element){
            jQuery(this).toggle();
        });
        //Make slug
        {{foreach from=$allLangs item=item name=langDiv}}
        jQuery('#title{{$smarty.foreach.langDiv.iteration}}').makeSlug({
            slug: jQuery('#alias{{$smarty.foreach.langDiv.iteration}}')
        });
        {{/foreach}}

        {{if $lid}}
        //Display tabs
        jQuery("ul.content-box-tabs  a").removeClass('current');
        jQuery("#tab_a{{$lid}}").addClass('current');
        
        jQuery("div.tab-content").addClass('hidden');
        jQuery("#tab{{$lid}}").removeClass('hidden');
        {{/if}}
            
    });
    var imgId;
    function chooseImage(id)
    {
        imgId = id;
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = setFileField;
        finder.popup();
    } 
    // This is a sample function which is called when a file is selected in CKFinder.
    function setFileField( fileUrl )
    {
        document.getElementById( 'chooseImage_img' + imgId ).src = fileUrl;
        document.getElementById( 'chooseImage_input' + imgId).value = fileUrl;
        document.getElementById( 'chooseImage_div' + imgId).style.display = '';
        document.getElementById( 'chooseImage_noImage_div' + imgId ).style.display = 'none';
    }
    function clearImage(imgId)
    {
        document.getElementById( 'chooseImage_img' + imgId ).src = '';
        document.getElementById( 'chooseImage_input' + imgId ).value = '';
        document.getElementById( 'chooseImage_div' + imgId).style.display = 'none';
        document.getElementById( 'chooseImage_noImage_div' + imgId).style.display = '';
    }

    function addMoreImg()
    {
        jQuery("ul#images > li.hidden").filter(":first").removeClass('hidden');
    }

//]]>
</script>
<style type="text/css">
    #images { list-style-type: none; margin: 0; padding: 0;}
    #images li { margin: 10px; float: left; text-align: center;  height: 180px;}
</style>


       
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Edit Content</h3>
                    
                    <ul class="content-box-tabs">
                        {{if $fullPermisison}}<li><a href="#tab0" class="default-tab">General</a></li>{{/if}}
                        {{foreach from=$allLangs item=item index=index name=langTab}}
                        <li><a {{if !$fullPermisison && $smarty.foreach.langTab.first}}class="default-tab"{{/if}} id="tab_a{{$item.lang_id}}" href="#tab{{$item.lang_id}}" style="padding-bottom: 4px;"><image style="vertical-align:middle;" src="{{$BASE_URL}}{{$item.lang_image}}"> {{$item.name}}</a></li>
                        {{/foreach}}
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <!-- GENERAL -->
                    <div class="tab-content {{if !$fullPermisison}}hidden{{/if}}" id="tab0">
                    
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
                               <p style="display:none">
                                    <label>Category<span class="red">*</span></label>              
                                    <select name="data[content_category_gid]" class="small-input">
                                    {{foreach from=$allCats item=item}}
                                        <option value="5" {{if $data.content_category_gid == $item.content_category_gid}}selected="selected"{{/if}}>{{$item.name}}</option>
                                    {{/foreach}}
                                    </select> 
                                </p>
                          
                                
         <!-- IMAGES -->   
                                    
                                <h4>Images: </h4>   
                                
                                <p>Drap to sort below images:</p> 
                                
                                <p><a href="javascript:addMoreImg()">+ Add more images</a></p> 
                                <ul id="images">
                                    {{foreach from=$data.images item=item key=i name=images }} 
                                     <li {{if $i >=2 && null == $item}}class="hidden"{{/if}}>   
                                            <input class="input_image" type="hidden" id="chooseImage_input{{$i}}" name="data[images][]" value="{{if $item}}{{$BASE_URL}}{{$item}}{{/if}}">
                                            <div id="chooseImage_div{{$i}}" style="display: none;">
                                                <img src="{{if $item}}{{$BASE_URL}}{{$item}}{{/if}}" id="chooseImage_img{{$i}}" style="max-width: 150px; max-height:150px; border:dashed thin;"></img>
                                            </div>
                                            <div id="chooseImage_noImage_div{{$i}}" style="width: 150px; border: thin dashed; text-align: center; padding:70px 0px;">
                                                No image
                                            </div>
                                            <br/>
                                            <a href="javascript:chooseImage({{$i}});">Choose image</a>
                                            | 
                                            <a href="javascript:clearImage({{$i}});">Delete</a>
                                    </li>
                                    {{/foreach}}
                                </ul>
         <!-- END IMAGES -->                       
                                
                                <br style="clear: both;"/>
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button submit" type="button" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>  <!-- End GENERAL --> 
                    
                    {{foreach from=$allLangs item=item name=langDiv}}
                    <!-- LANGUAGES -->
                    <div class="tab-content {{if $fullPermisison || !$smarty.foreach.langDiv.first}}hidden{{/if}}" id="tab{{$item.lang_id}}">
                    
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                 <p>
                                    <label>Published<span class="red">*</span></label>
                                    <input type="radio" name="data[genabled]" value="1" {{if $data.genabled != '0'}}checked="checked"{{/if}}/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[genabled]" value="0" {{if $data.genabled == '0'}}checked="checked"{{/if}}/> No
                                </p>
                                <p>
                                    <label>Title</label>
                                        <input id="title{{$smarty.foreach.langDiv.iteration}}" class="text-input large-input" type="text"  name="data[{{$item.lang_id}}][title]" value="{{$data[$item.lang_id].title}}" />
                                </p>
                                <p>
                                    <label>Alias<br/><br/></label>
                                        <input id="alias{{$smarty.foreach.langDiv.iteration}}" style="width: 675px;" class="text-input small-input" type="text"  name="data[{{$item.lang_id}}][alias]" value="{{$data[$item.lang_id].alias}}" /> .html
                                </p>
                                
                                <p>
                                    <div><textarea style="float:left;" class="text-input textarea ckeditor"  name="data[{{$item.lang_id}}][full_text]" rows="20" cols="90">{{$data[$item.lang_id].full_text}}</textarea></div>
                                    
                                </p>
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button submit" type="button" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>
                                
                        
                    {{/foreach}}
                    
                  </form>
                  
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>

