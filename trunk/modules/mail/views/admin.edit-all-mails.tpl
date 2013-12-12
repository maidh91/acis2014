<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/ckfinder.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/_source/adapters/jquery.js"></script>
       
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    <h3>Edit Newsletter Mail</h3>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <form action="" method="post">
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
<!--                                <p>-->
<!--                                    <label>Select group<span class="red">*</span></label>-->
<!--                                   	<select size={{$countAllGroups}}>-->
<!--										{{foreach from=$allGroups item=item}}-->
<!--											<option id={{$item.group_id}}>{{$item.name}}</option>-->
<!--										{{/foreach}}-->
<!--									</select>-->
<!--									<select name="data[group_id]">-->
<!--                            		{{foreach from=$allGroups item=item}}-->
<!--                                		<option value="{{$item.group_id}}" {{if $data.group_id == $item.group_id}}selected="selected"{{/if}}>{{$item.name}}</option>-->
<!--                            		{{/foreach}}-->
<!--                            		</select> -->
<!--                                </p>-->
                                
<!--                                <p>-->
<!--                                    <label>Or Enter a User</label>-->
<!--                                    <input type="text" name="username" />-->
<!--                                </p>-->
                                
                                <p>
                                    <label>To</label>
                                    <input type="text" name="data[to]" value="{{$data.to}}"/>
                                </p>
                                
                        		<br/>
		                       	
                    			<div>
		                    
		                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
		                                
		                                <p>
		                                    <b>Subject</b><br/>
		                                        <input class="text-input small-input" type="text"  name="data[subject]" value="{{$data.subject}}" />
		                                </p>
		                                <p>
                                    		<b>Content</b>
                                    		<div style="float:left;width: 730px;"><textarea style="float:left;" class="text-input textarea editor"  name="data[content]" rows="20" cols="90">{{$data.content}}</textarea></div>
                                    		<div class="clear"></div>
                                		</p>
                                
<!--                                		<p>-->
<!--                                    		<b>Enable</b><br/>-->
<!--                                    		<input type="radio" name="data[enabled]" value="1" {{if $data.enabled == '1'}}checked="checked"{{/if}}/> Yes &nbsp;&nbsp;&nbsp;&nbsp;-->
<!--                                    		<input type="radio" name="data[enabled]" value="0" {{if $data.enabled != '1'}}checked="checked"{{/if}}/> No-->
<!--                                		</p>-->
		                                
		                            </fieldset>
		                       		<div class="clear"></div><!-- End .clear -->
                    			</div>
                       
                        <div class="clear"></div><!-- End .clear -->
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
<!--                                    <input class="button" type="submit" name="action" value="Save" />-->
                                    <!-- 20110709 -->
                                    {{if '1' != $data.type}} <!-- If this is system mail, then view only, can not send -->
	                                    <input class="button" type="submit" name="action" value="Send" />
	                                {{/if}}
	                                <!-- 20110709 -->
                                </p>
                                
                            </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                  	</form>
                  
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            <div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
  $("button#add").click(function(){
    $("#{{$item.group_id}}").fadeTo("slow",0.25);
  });
});
</script>

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
