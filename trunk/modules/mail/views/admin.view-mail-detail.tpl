            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    <h3>View Mail Detail</h3>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                <form action="" method="post">
                            <fieldset>
                                
                                <p>
                                    <label><b>From</b></label>
                                    <input class="text-input small-input" type="text"  name="data[from]" value="{{$mail.from}}" />
                                </p>
                                
                        		<p>
                        			<label><b>To</b></label>
                                    <input class="text-input small-input" type="text"  name="data[to]" value="{{$mail.to}}" />
                        		</p>
		                       	
		                       	<p>
                        			<label><b>Send Date</b></label>
                                    <input class="text-input small-input" type="text"  name="data[date]" value="{{$mail.date}}" />
                        		</p>
                        		
		                       	<p>
		                        	<label><b>Subject</b></label>
		                        		<input class="text-input small-input" type="text"  name="data[subject]" value="{{$mail.subject}}" />
		                       </p>
		                       
		                        <p>
                                    <label><b>Content</b></label>
                                    <div style="float:left;width: 730px;border: 1px solid #D5D5D5;color: #333333;font-size: 13px;padding: 10px;">
                                    	{{$mail.content}}
                                    </div>
                                    <div class="clear"></div>
                                </p>
                                
                                <div class="clear"></div>
                                
                                <p>
                                	<label></label>
<!--                                    <input class="button" type="button" value="&laquo; Back" onclick="javascript:history.back();"/>-->
                                    <input class="button" type="submit" name="action" value="Delete" onclick="javascript:deleteAMail({{$mail.mail_store_id}});"/>
                                </p>
                                
<!--                            </fieldset>-->
                        <div class="clear"></div><!-- End .clear -->
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
<script type="text/javascript">
function deleteAMail(id)
{
    result = confirm('Are you sure you want to delete this mail?');
    if (false == result) {
        return;
    }
    window.location.href = '{{$APP_BASE_URL}}mail/admin/delete-mail/id/' + id;
}

</script>
<style type="text/css">
.cke_top {
	background-color: #dddddd;
}
</style>
