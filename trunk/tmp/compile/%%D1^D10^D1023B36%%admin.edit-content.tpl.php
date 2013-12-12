<?php /* Smarty version 2.6.25, created on 2013-12-08 19:17:54
         compiled from content/views/admin.edit-content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'content/views/admin.edit-content.tpl', 106, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/ckfinder/ckfinder.js"></script>  
<link href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery-ui/css/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery-ui/js/jquery-ui.js"></script>
<script src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery.slug.js"></script>

<script type="text/javascript">
    //<![CDATA[

    jQuery(document).ready(function (){
        CKFinder.setupCKEditor( null, '<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/ckfinder/' );
        jQuery( "#images" ).sortable();
        jQuery( "#images" ).disableSelection();
        //Datepicker
        jQuery( ".date" ).datepicker({
            showAnim        : 'slideDown',
            showButtonPanel : true,
            dateFormat      : '<?php echo $this->_tpl_vars['datepickerFormat']['js']; ?>
'
        });
        //Display images
        jQuery(".input_image[value!='']").parent().find('div').each( function (index, element){
            jQuery(this).toggle();
        });
        //Make slug
        <?php $_from = $this->_tpl_vars['allLangs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['langDiv'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['langDiv']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['langDiv']['iteration']++;
?>
        jQuery('#title<?php echo $this->_foreach['langDiv']['iteration']; ?>
').makeSlug({
            slug: jQuery('#alias<?php echo $this->_foreach['langDiv']['iteration']; ?>
')
        });
        <?php endforeach; endif; unset($_from); ?>

        <?php if ($this->_tpl_vars['lid']): ?>
        //Display tabs
        jQuery("ul.content-box-tabs  a").removeClass('current');
        jQuery("#tab_a<?php echo $this->_tpl_vars['lid']; ?>
").addClass('current');
        
        jQuery("div.tab-content").addClass('hidden');
        jQuery("#tab<?php echo $this->_tpl_vars['lid']; ?>
").removeClass('hidden');
        <?php endif; ?>
            
    });
    var imgId;
    function chooseImage(id)
    {
        imgId = id;
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
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
                        <?php if ($this->_tpl_vars['fullPermisison']): ?><li><a href="#tab0" class="default-tab">General</a></li><?php endif; ?>
                        <?php $_from = $this->_tpl_vars['allLangs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['langTab'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['langTab']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['langTab']['iteration']++;
?>
                        <li><a <?php if (! $this->_tpl_vars['fullPermisison'] && ($this->_foreach['langTab']['iteration'] <= 1)): ?>class="default-tab"<?php endif; ?> id="tab_a<?php echo $this->_tpl_vars['item']['lang_id']; ?>
" href="#tab<?php echo $this->_tpl_vars['item']['lang_id']; ?>
" style="padding-bottom: 4px;"><image style="vertical-align:middle;" src="<?php echo $this->_tpl_vars['BASE_URL']; ?>
<?php echo $this->_tpl_vars['item']['lang_image']; ?>
"> <?php echo $this->_tpl_vars['item']['name']; ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                
                    <form action="" method="post">
                    
                    <!-- GENERAL -->
                    <div class="tab-content <?php if (! $this->_tpl_vars['fullPermisison']): ?>hidden<?php endif; ?>" id="tab0">
                    
                        <!-- ERROR -->
                        <?php if (count($this->_tpl_vars['errors']) > 0): ?>
                        <div class="notification error png_bg">
                            <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                <?php if ($this->_tpl_vars['errors']['main']): ?>
                                    Error: <?php echo $this->_tpl_vars['errors']['main']; ?>

                                <?php else: ?>
                                    Error: Please check following information again
                                <?php endif; ?> 
                                                                       
                            </div>
                        </div>
                        <?php endif; ?>
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                               <p style="display:none">
                                    <label>Category<span class="red">*</span></label>              
                                    <select name="data[content_category_gid]" class="small-input">
                                    <?php $_from = $this->_tpl_vars['allCats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="5" <?php if ($this->_tpl_vars['data']['content_category_gid'] == $this->_tpl_vars['item']['content_category_gid']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                    </select> 
                                </p>
                          
                                
         <!-- IMAGES -->   
                                    
                                <h4>Images: </h4>   
                                
                                <p>Drap to sort below images:</p> 
                                
                                <p><a href="javascript:addMoreImg()">+ Add more images</a></p> 
                                <ul id="images">
                                    <?php $_from = $this->_tpl_vars['data']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['images'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['images']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
        $this->_foreach['images']['iteration']++;
?> 
                                     <li <?php if ($this->_tpl_vars['i'] >= 2 && null == $this->_tpl_vars['item']): ?>class="hidden"<?php endif; ?>>   
                                            <input class="input_image" type="hidden" id="chooseImage_input<?php echo $this->_tpl_vars['i']; ?>
" name="data[images][]" value="<?php if ($this->_tpl_vars['item']): ?><?php echo $this->_tpl_vars['BASE_URL']; ?>
<?php echo $this->_tpl_vars['item']; ?>
<?php endif; ?>">
                                            <div id="chooseImage_div<?php echo $this->_tpl_vars['i']; ?>
" style="display: none;">
                                                <img src="<?php if ($this->_tpl_vars['item']): ?><?php echo $this->_tpl_vars['BASE_URL']; ?>
<?php echo $this->_tpl_vars['item']; ?>
<?php endif; ?>" id="chooseImage_img<?php echo $this->_tpl_vars['i']; ?>
" style="max-width: 150px; max-height:150px; border:dashed thin;"></img>
                                            </div>
                                            <div id="chooseImage_noImage_div<?php echo $this->_tpl_vars['i']; ?>
" style="width: 150px; border: thin dashed; text-align: center; padding:70px 0px;">
                                                No image
                                            </div>
                                            <br/>
                                            <a href="javascript:chooseImage(<?php echo $this->_tpl_vars['i']; ?>
);">Choose image</a>
                                            | 
                                            <a href="javascript:clearImage(<?php echo $this->_tpl_vars['i']; ?>
);">Delete</a>
                                    </li>
                                    <?php endforeach; endif; unset($_from); ?>
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
                    
                    <?php $_from = $this->_tpl_vars['allLangs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['langDiv'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['langDiv']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['langDiv']['iteration']++;
?>
                    <!-- LANGUAGES -->
                    <div class="tab-content <?php if ($this->_tpl_vars['fullPermisison'] || ! ($this->_foreach['langDiv']['iteration'] <= 1)): ?>hidden<?php endif; ?>" id="tab<?php echo $this->_tpl_vars['item']['lang_id']; ?>
">
                    
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                 <p>
                                    <label>Published<span class="red">*</span></label>
                                    <input type="radio" name="data[genabled]" value="1" <?php if ($this->_tpl_vars['data']['genabled'] != '0'): ?>checked="checked"<?php endif; ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="data[genabled]" value="0" <?php if ($this->_tpl_vars['data']['genabled'] == '0'): ?>checked="checked"<?php endif; ?>/> No
                                </p>
                                <p>
                                    <label>Title</label>
                                        <input id="title<?php echo $this->_foreach['langDiv']['iteration']; ?>
" class="text-input large-input" type="text"  name="data[<?php echo $this->_tpl_vars['item']['lang_id']; ?>
][title]" value="<?php echo $this->_tpl_vars['data'][$this->_tpl_vars['item']['lang_id']]['title']; ?>
" />
                                </p>
                                <p>
                                    <label>Alias<br/><br/></label>
                                        <input id="alias<?php echo $this->_foreach['langDiv']['iteration']; ?>
" style="width: 675px;" class="text-input small-input" type="text"  name="data[<?php echo $this->_tpl_vars['item']['lang_id']; ?>
][alias]" value="<?php echo $this->_tpl_vars['data'][$this->_tpl_vars['item']['lang_id']]['alias']; ?>
" /> .html
                                </p>
                                
                                <p>
                                    <div><textarea style="float:left;" class="text-input textarea ckeditor"  name="data[<?php echo $this->_tpl_vars['item']['lang_id']; ?>
][full_text]" rows="20" cols="90"><?php echo $this->_tpl_vars['data'][$this->_tpl_vars['item']['lang_id']]['full_text']; ?>
</textarea></div>
                                    
                                </p>
                                
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button submit" type="button" value="Save" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                    </div>
                                
                        
                    <?php endforeach; endif; unset($_from); ?>
                    
                  </form>
                  
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            
            <div class="clear"></div>
