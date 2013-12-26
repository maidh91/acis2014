<div class="content white pb25">
            <div class="container tiles_hub">
                <div id="slider" class="flexslider_small sixteen columns alpha">
                    <ul class="slides">
                    {{foreach from=$images.images item=item key=i name=images }} 
                    
                        <li><img class="cover" src="{{if $item}}{{$BASE_URL}}{{$item}}{{/if}}" alt="" title="" /></li>
                   {{/foreach}}
                    </ul>
                </div>
            </div>
        </div>