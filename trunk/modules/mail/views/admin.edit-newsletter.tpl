<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckfinder/ckfinder.js"></script> 
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/ckeditor/_source/adapters/jquery.js"></script>
<link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/js/autocomplete/autocomplete.css"  type="text/css"  />
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/autocomplete/autocomplete.js"></script>
<script type="text/javascript">
	var toUser = new Array();
	{{foreach from=$allUsers item=item key=index }}
		toUser[{{$index}}] = {
			fullname: "{{$item.full_name|@addslashes}}",
			email: "{{$item.email|@addslashes}}"
		}
	{{/foreach}}

	$(document).ready(function(){
		//Autocomplete user
	    $("#touser").autocomplete(toUser,{
	        minChars: 0,
	        width: 500,
	        max: 6,
	        highlightItem: true,
	        multiple: true,
	        multipleSeparator: ";",
	        matchContains: "word",
	        autoFill: false,
	        formatItem: function(row, i, max) {
	            return '"' + row.fullname + '"' + '<' + row.email + ">";
	        },
	        formatMatch: function(row, i, max) {
	            return row.fullname + " " + row.email;
	        },
	        formatResult: function(row) {
	            return '"' + row.fullname + '"' + '<' + row.email + ">";
	        }
	    });
	    $("#touser").result(function(event, data, formatted) {
		    $("#touser").append('"' + data.fullname + '"' + '<' +  data.email + ">");
	    });
	});
</script>      
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    <h3>Edit Newsletter Mail</h3>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <form action="" method="post">
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label>Select group<span class="red">*</span></label>
<!--                                   	<select size={{$countAllGroups}}>-->
<!--										{{foreach from=$allGroups item=item}}-->
<!--											<option id={{$item.group_id}}>{{$item.name}}</option>-->
<!--										{{/foreach}}-->
<!--									</select>-->
									<select name="data[groups][]" multiple="multiple">
                            		{{foreach from=$allGroups item=item}}
                                		<option value="{{$item.group_id}}" {{if in_array($item.group_id,$data.groups) }} selected="selected"{{/if}}>{{$item.name}} ({{$item.count}})</option>
                            		{{/foreach}}
                            		</select> 
                                </p>
                                
                                <p>
                                    <label>Or Enter User</label>
                                    <textarea id="touser" class="text-input textarea wysiwyg" rows="5" cols="79" name="data[to_user]">{{$data.to_user}}</textarea>
                                </p>
                        		<br/>
                                <div style="float: left;min-width: 200px; min-height: 500px; margin-right: 10px; padding-left: 10px;padding-top: 10px; line-height: 2em; background-color: #eeeeee;"> 
                               		<i>Mail values:</i><br/>
                               		<br/> 
                                		{{$mailAlias.value}}
                        		</div style="float: left;">
		                       	
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
                                
		                            </fieldset>
		                       		<div class="clear"></div><!-- End .clear -->
                    			</div>
                       
                        <div class="clear"></div><!-- End .clear -->
                                <p>
                                <br/>
                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>
                                    <input class="button" type="submit" name="action" value="Save" />
                                    <input class="button" type="submit" name="action" value="Send" />
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
