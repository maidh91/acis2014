<div class="bg_tt1 text_gioithieu">
            <p class="tt_intro">{{$name}}</p>
          </div>
          <div class="border1 p11t p11r p10l p5b mh111 lh18 text_gioithieu">
           <div class="w315 p10b float_left">
           <a href="{{$latestNews.url}}"><img src="{{$BASE_URL}}{{$latestNews.images}}"/></a> <a href="{{$latestNews.url}}"><span class="color_bule">{{$latestNews.title}}</span></a> <p></p>
           {{$latestNews.intro_text}}
<p class="chitiet m10t m3r"><a href="{{$latestNews.url}}">{{l}}Detail{{/l}}</a></p>
</div>
           <div class="w315 p10b float_right">
           <div class="box_text_news bo_d_b p5b"><a href="{{$latestNews.url}}"> <img src="{{$BASE_URL}}{{$threeContent[0].images}}" border="0"/> </a><span class="color_bule"><a href="{{$threeContent[0].url}}">{{$threeContent[0].title}}</a></span>
              <p></p>
                  {{$threeContent[0].text}}
                  <div class="cb"></div>
            </div>
           <div class="box_text_news bo_d_b p5b p5t"> <a href="{{$threeContent[1].url}}"><img src="{{$BASE_URL}}{{$threeContent[1].images}}" border="0"/></a> <span class="color_bule"><a href="{{$threeContent[1].url}}">{{$threeContent[1].title}}</a></span>
                  <p></p>
                  {{$threeContent[1].text}}
                  <div class="cb"></div>
             </div>
			<div class="box_text_news p5b p5t"> <a href="{{$latestNews.url}}"><img src="{{$BASE_URL}}{{$threeContent[2].images}}"/></a> <span class="color_bule"><a href="{{$threeContent[2].url}}">{{$threeContent[2].title}}</a></span>
                  <p></p>
                   {{$threeContent[2].text}}
                  <div class="cb"></div>
             </div>
           
           </div>
           <p class="cb"></p>
          </div>
          <div class="border1 bg_light_gray">
          <div class="bo_b">
          <p class="tt_tinlienquan">{{l}}More news{{/l}}</p>
          <div class="pages float_right">
            {{if $countAllPages > 1}}
	          <div class="pages float_right p2t">
	            <ul>
	              {{if $first}}
	              	<li><a href="?page=1"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	              {{if $prevPage}}
	              <li><a href="?page={{$prevPage}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	              {{foreach from=$prevPages item=item}}
	              	<li><a href="?page={{$item}}">{{$item}}</a></li>
	              {{/foreach}}
	              <li class="current"><a href="#">{{$currentPage}}</a></li>
	              
	              {{foreach from=$nextPages item=item}}
                  	<li><a href="?page={{$item}}">{{$item}}</a></li>
                  {{/foreach}}
	              
	              {{if $nextPage}}
	              	<li><a href="?page={{$nextPage}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_right1.png"/></a></li>
	              {{/if}}
	              {{if $last}}
	              	<li><a href="?page={{$countAllPages}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	            </ul>
	            <div class="cb"></div>
	          </div>
	        <!-- END PANAVIGATION -->
          	{{/if}}
            <div class="cb"></div>
          </div>
          <div class="cb"></div>
          </div>
          <div class="p5t p10b">
              {{foreach from=$allNews item=item1 }}
               <div class="bg_box_news p8t p7b">
              		{{foreach from=$item1 item=item key=index}}
              			{{if $index is even}}
              			<div class="box_text_news float_left p15l">
              			{{else}}
              			<div class="box_text_news float_right">
              			{{/if}}
              			<a href="{{$item.url}}"><img src="{{$BASE_URL}}{{$item.images}}"/></a> <span class="color_bule"><a href="{{$item.url}}">{{$item.title}}</a></span>
                  		<p></p>
                  {{$item.text}}
                  <div class="cb"></div>
                </div>
              		{{/foreach}}
              		 <div class="cb"></div>
              	</div>
              {{/foreach}}
        
              <div class=" p10t">
       
          <div class="pages float_right">
           {{if $countAllPages > 1}}
	          <div class="pages float_right p2t">
	            <ul>
	              {{if $first}}
	              	<li><a href="?page=1"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	              {{if $prevPage}}
	              <li><a href="?page={{$prevPage}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	              {{foreach from=$prevPages item=item}}
	              	<li><a href="?page={{$item}}">{{$item}}</a></li>
	              {{/foreach}}
	              <li class="current"><a href="#">{{$currentPage}}</a></li>
	              
	              {{foreach from=$nextPages item=item}}
                  	<li><a href="?page={{$item}}">{{$item}}</a></li>
                  {{/foreach}}
	              
	              {{if $nextPage}}
	              	<li><a href="?page={{$nextPage}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_right1.png"/></a></li>
	              {{/if}}
	              {{if $last}}
	              	<li><a href="?page={{$countAllPages}}"><img src="{{$LAYOUT_HELPER_URL}}front/images/bulet_left1.png"/></a></li>
	              {{/if}}
	            </ul>
	            <div class="cb"></div>
	          </div>
	        <!-- END PANAVIGATION -->
          	{{/if}}
            <div class="cb"></div>
          </div>
          <div class="cb"></div>
          </div>
            </div>
          </div>
         