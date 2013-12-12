       
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.treeview.js" type="text/javascript"></script>
<link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/jquery.treeview.css" />

           <div style="float:left;">
                <h2>Manage Translation</h2>
           </div>     
           <div style="float:right;padding-right:35px;padding-top:8px;">
<!--                {{p name='rescan_translations' module='translations'}}<a href="{{$APP_BASE_URL}}/admin/rescan"><img style="vertical-align: middle;" src="{{$LAYOUT_HELPER_URL}}admin/images/icons/refresh_16.png">Rescan all translations</a>{{/p}}-->
           </div>
             <!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <!-- MESSAGE -->
            {{if $translationMessage|@count > 0 && $translationMessage.success == true}}
            <div class="notification success png_bg" style="width:96%">
                <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    {{$translationMessage.message}}
                </div>
            </div>
            {{/if}}
            <!-- END MESSAGE -->
            
            
            <!-- MODULE -->
            <div class="content-box" style="float:left; width:20%; margin-right: 5px; min-height: 400px;">
                <div class="content-box-header">
                    <h3>Access</h3>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content" style="padding-bottom: 0px;">
                    <ul id="module" class="filetree">
                        <li><span class="module">Layouts</span>
                            <ul>
                                {{foreach from=$allLayouts item=item}}
                                <li><span class="file"><a href="javascript:chooseAccess('{{$item}}', 'Layout');">{{$item}}</a></span></li>
                                {{/foreach}}
                            </ul>
                        </li>
                        <li><span class="module">Modules</span>
                            <ul>
                                {{foreach from=$allModules item=item}}
                                <li><span class="file"><a href="javascript:chooseAccess('{{$item}}', 'Module');">{{$item}}</a></span></li>
                                {{/foreach}}
                            </ul>
                        </li>
                        <li><span class="module">Stickers</span>
                            <ul>
                                {{foreach from=$allStickers item=item}}
                                <li><span class="file"><a href="javascript:chooseAccess('{{$item}}', 'Sticker');">{{$item}}</a></span></li>
                                {{/foreach}}
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- END MODULE -->
           
            <!-- PERMISSION -->
            <form action="#" method="post"  name="translation" id="translation" onsubmit="submitForm();return false;">
            <div class="content-box" style="float:left;width:79%; min-height: 700px;">
                <div class="content-box-header">
                
                    <h3><span id="access_type">???</span> > <span id="access_name">???</span></h3>
                    
                </div> 
                 
                <!-- End .content-box-header -->
                
                <div class="content-box-content" style="padding-bottom: 0px;" id="translation_box">
                
                Please select access.
                </div>
            </div>
            </form>
            <!-- END PERMISSION -->
            
            <div class="clear"></div>
            
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    // second example
    $("#module").treeview();
});
var access = '';
var atype = '';
function chooseAccess(name, type) {
	access = name;
	atype = type;
    $("#access_name").html(name);
    $("#access_type").html(atype);
    loadTranslation();
}
function loadTranslation() {
	if ('' == atype || '' == access) {
		return;
	}
	$("#translation_box").html('Loading...');
	
	$.ajax({
	       type: "POST",
	       cache: false,
	       url: "{{$APP_BASE_URL}}language/translation/translate?r=" + Math.random(),
	       data: {
    		   'access': access,
    		   'atype': atype
		   },
	       success: function(msg){
			   $("#translation_box").html(msg);
			   $( 'html, body' ).animate( { scrollTop: 0 }, 0 );
//			   $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows // Add class "alt-row" to even table rows
	       }
	     });
	
}

function submitForm() {
	
	$.ajax({
	       type: "POST",
	       cache: false,
	       url: "{{$APP_BASE_URL}}language/translation/translate?r=" + Math.random(),
	       data: {
    		   'access': access,
    		   'atype': atype,
    		   'data' : jQuery("#translation").serialize()
		   },
		   beforeSend: function (a, o) {
			   $("#translation_box").html('Saving...');
			   $( 'html, body' ).animate( { scrollTop: 0 }, 'fast' );
		   },
	       success: function(msg){
			   $("#translation_box").html(msg);
//			   $('tbody > tr:odd').addClass("alt-row"); // Add class "alt-row" to even table rows // Add class "alt-row" to even table rows
	       }
	     });
	
}

</script>
