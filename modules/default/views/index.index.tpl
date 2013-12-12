 <div class="content white pb25">
            <div class="container tiles_hub">
                <div id="slider" class="flexslider_small sixteen columns alpha">
                    <ul class="slides">
                    {{foreach from=$images.images item=item key=i name=images }} 
                    
                        <li><img src="{{if $item}}{{$BASE_URL}}{{$item}}{{/if}}" alt="" title="" /></li>
<!--                         <li><img src="{{$LAYOUT_HELPER_URL}}front/images/home/3.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="{{$LAYOUT_HELPER_URL}}front/images/home/2.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="{{$LAYOUT_HELPER_URL}}front/images/home/4.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="{{$LAYOUT_HELPER_URL}}front/images/home/5.jpg" alt="" title="" /></li> -->
<!--                         <li><img src="{{$LAYOUT_HELPER_URL}}front/images/home/6.jpg" alt="" title="" /></li> -->
                   {{/foreach}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="band mb25" id="welcome">
            <div class="container">
                <hr>
                <h3 class="sectionhead welcome">{{$news.title}}</h3>
                <div class="sixteen columns">
        {{$news.full_text}}
        </div>
        </div>
        </div>
     
        