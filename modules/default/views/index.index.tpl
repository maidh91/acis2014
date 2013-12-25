 <style>
 img.cover {
 	height: 500px;
 	width: 1100px;
}

p {
    margin: 0 0 21px;
}
 </style>
 
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
        
        
        <div class="band mb25" id="welcome">
            <div class="container">
                <hr>
                <h3 class="sectionhead welcome">{{$news.title}}</h3>
                <div class="sixteen columns">
        			{{$news.full_text}}
        </div>
        </div>
        </div>
     
        