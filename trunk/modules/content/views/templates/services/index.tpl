		<div class="bg_tt1">
            <p class="tt_intro">{{$name}}</p>
          </div>
          <div class="border1 p5t p15l p15r p5b bg_light_gray mh827">
          {{foreach from=$allContents item=item1 name=content}}
          	
          	{{if !$smarty.foreach.content.last}}
          		
            	<div class="text_dv_all">
            {{else}}
            	<div class="text_dv_all last">
            {{/if}}
            
            {{foreach from=$item1 key=index item=item}}
            
            	{{if $index is even}}
            
	              <div class="text_dv float_left line_right">
	            {{else}}
	            
	             <div class="text_dv float_right">
	             {{/if}}
	             
	                <dl>
	                  <a href="{{$item.url}}"><img src="{{$BASE_URL}}{{$item.images}}" /></a>
	                </dl>
	                <div class="w280 p10t">
	                  <p class="font14 color_bule"><strong><a href="{{$item.url}}">{{$item.title}}</a></strong></p>
	                 {{$item.intro_text}}</div>
	              </div>
	              {{/foreach}}
	              
	              <p class="cb"></p>
	           
	            </div>
            
            {{/foreach}}
            
          </div>