<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/jquery.validate.js"></script>
<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
 <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
 <link rel="stylesheet" type="text/css" href="{{$LAYOUT_HELPER_URL}}front/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
function submitForm()
{
	$('#contact').submit();
}

$().ready(function() {
    // validate signup form on keyup and submit
    $("#contact").validate({
        rules: {
            'data[name]': "required",        
            'data[message]': "required",      
            'data[captcha]': "required",
            'data[mail]': "required"
        },
        messages: {
            'data[name]': "",
            'data[message]': "",
            'data[captcha]': "",
            'data[mail]':""
        }
    });
   
    jQuery("a#map1").fancybox({
    	 'width'    : 820,
         'height'   : 620,
         'titleShow' : false,
         'autoScale'   : false,
         'transitionIn'  : 'none',
         'transitionOut'  : 'none',
         'type'    : 'iframe'
    });

    jQuery("a#map2").fancybox({
   	 'width'    : 820,
     'height'   : 620,
     'titleShow' : false,
     'autoScale'   : false,
     'transitionIn'  : 'none',
     'transitionOut'  : 'none',
     'type'    : 'iframe'
      });
    
    jQuery("a#map3").fancybox({
   	 'width'    : 820,
     'height'   : 620,
     'titleShow' : false,
     'autoScale'   : false,
     'transitionIn'  : 'none',
     'transitionOut'  : 'none',
     'type'    : 'iframe'
      });
    jQuery("a#map4").fancybox({
     	 'width'    : 820,
       'height'   : 620,
       'titleShow' : false,
       'autoScale'   : false,
       'transitionIn'  : 'none',
       'transitionOut'  : 'none',
       'type'    : 'iframe'
        });

    //Remove/add default text
    jQuery("input").click(function(){
        var defaultVal = jQuery(this).attr('title');
        if (jQuery(this).val() == defaultVal) {
        	jQuery(this).val('');
        }
    });
    jQuery("input").focusout(function(){
        var defaultVal = jQuery(this).attr('title');
        if (jQuery(this).val() == '') {
        	jQuery(this).val(defaultVal);
        }
    });
    jQuery("textarea").click(function(){
        var defaultVal = jQuery(this).attr('title');
        if (jQuery(this).html() == defaultVal) {
        	jQuery(this).html('');
        }
    });
    jQuery("textarea").focusout(function(){
        var defaultVal = jQuery(this).attr('title');
        if (jQuery(this).html() == '') {
        	jQuery(this).html(defaultVal);
        }
    });
   
});


</script>
          <div class="bg_tt1">
            <p class="tt_intro">{{l}}CONTACT{{/l}}</p>
          </div>
          <div class="border1 p11t p5r p15l p5b">
	          <div class=" w145 p30t float_left"><a href="index.html"><img src="{{$LAYOUT_HELPER_URL}}front/images/logo.png"/></a></div>
	          <div class="float_left w520">
		          <p class="bo_d_b font16 color_bule text_up">{{$allStatic[0].title}}</p>
		          <div class=" w263 p11t float_left lh18">
		          	{{$allStatic[0].intro_text}}<p></p>
		          </div>
		          
		          <div class="w246 p11t float_right lh18">
		          	{{$allStatic[0].full_text}}<br />
					<p class="p5t"><a id="map1" href="{{$BASE_URL}}media/maps/map1.html"><img src="{{$LAYOUT_HELPER_URL}}front/images/bt_bando.png"/></a></p>
		          </div>
		          
		          <p class="cb"></p>
	          </div>
	          <p class="cb"></p>
          </div>
          <div class="border1 p11t p15l p5b">
          
          
          
          <div class="box_dc_all m15r float_left">
          	<div class="box_dc">
            <p class="bo_d_b font16 color_bule text_up">{{$allStatic[3].title}}</p>
            <div class=" w263 p11t lh18" style="min-height:200px;">
           		{{$allStatic[3].full_text}}
           	</div>
              <p class="p24t"><a id="map4" href="{{$BASE_URL}}media/maps/map4.html"><img src="{{$LAYOUT_HELPER_URL}}front/images/bt_bando.png"/></a></p>
            </div>
          </div>
          
          <div class="box_dc_all float_left">
          	<div class="box_dc">
            <p class="bo_d_b font16 color_bule text_up">{{$allStatic[2].title}}</p>
            <div class=" w263 p11t lh18" style="min-height:200px;">{{$allStatic[2].full_text}}</div>
              <p class="p24t"><a id ="map3" href="{{$BASE_URL}}media/maps/map2.html"><img src="{{$LAYOUT_HELPER_URL}}front/images/bt_bando.png"/></a></p>
            </div>
          </div>
          
          <p class="cb"></p>
          
          <div class="box_dc_all m15r float_left">
          	<div class="box_dc">
            <p class="bo_d_b font16 color_bule text_up">{{$allStatic[1].title}}</p>
            <div class=" w263 p11t lh18" style="min-height:200px;">
           		{{$allStatic[1].full_text}}
           	</div>
              <p class="p24t"><a id="map2" href="{{$BASE_URL}}media/maps/map3.html"><img src="{{$LAYOUT_HELPER_URL}}front/images/bt_bando.png"/></a></p>
            </div>
          </div>
          
          <p class="cb"></p>
          
          	
          
          <div class="box_comment w633 m10b ">
          {{if $contactMessage|@count > 0}}        	
          	<span style="color:red;padding-left: 15px;">{{$contactMessage.message}}</span>          	
       		 {{/if}}
           <form method="POST" id="contact" name="contact">  
           
          <div class=" w315 float_left p2l">
            <input name="data[name]" type="text" class="txt_comment w300" value="{{l}}Name{{/l}}" title="{{l}}Name{{/l}}"/>
            <input name="data[mail]" type="text" class="txt_comment w300" value="{{l}}E-mail{{/l}}" title="{{l}}E-mail{{/l}}"/>
            <input name="data[adr]" type="text" class="txt_comment w300" value="{{l}}Adress{{/l}}" title="{{l}}Adress{{/l}}"/>
            <input name="data[phone]" type="text" class="txt_comment w300" value="{{l}}Phone number{{/l}}" title="{{l}}Phone number{{/l}}"/>
            </div>
            <div class="w315 float_left">
            
            <textarea name="data[content]" class=" w300" cols="" rows="" title="{{l}}Content{{/l}}">{{l}}Content{{/l}}</textarea>
            <input name="data[captcha]" type="text" class="txt_comment w115" value="{{l}}Captcha{{/l}}" title="{{l}}Captcha{{/l}}" />
           	<span class="float_left m5l"><img src="{{$LAYOUT_HELPER_URL}}front/captcha/create_image.php?r={{$randomNumber}}" style="padding-top:4px;" /></span>
<!--            <span class="float_left m5l"><input name="SUBMIT" type="image" src="{{$LAYOUT_HELPER_URL}}front/images/bt_gui1_{{$LANG_CODE}}.jpg" /></span>-->
            <label>&nbsp;</label>
	        <input onclick="javascript:submitForm();" name="" type="image" src="{{$LAYOUT_HELPER_URL}}front/images/bt_gui1_{{$LANG_CODE}}.jpg" /><br class="cb" />
            <br class="cb" />
            </div>
            <br class="cb" />
            </form>
          </div>
          
          </div>

		
         