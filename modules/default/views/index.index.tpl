 <style>
 
h3 {
	
}
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
        
        
        <div class="band mb25" >
         
            <div class="container">
            <div class="left">
                <hr>
                <h3 class="sectionhead">{{$news.title}}</h3>
                <div class="sixteen columns">
        			{{$news.full_text}}
        		</div>
        	</div>
        	<div class="right" style="margin-top:40px;">
        	

                <ul class="nav nav-pills nav-stacked confullblue" style="margin-top:20px;">  
                <li class="confullblueTitle">Main menu</li>
    <li>
        <a href="/acis2014/admin/" style="float:right;">
            Control Panel
        </a>       
    </li>
        <li style="float:right;"> 
        <a href="#" style="float:right;">
        Users &amp; Groups
        </a>
    </li>
        
    
        <li> 
        <a  href="#" style="float:right;">
        Content
        </a>
    </li>
        
	

    
</ul>
        	</div>
        </div>
     
 		</div>       