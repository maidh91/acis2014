<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->

    <head>

        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <title>ACIS 2014: The Third Asian Conference on Information Systems, December 8-10, 2014, Nha Trang, Viet Nam</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Mobile Specific Metas \ -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Javascripts BEGIN -->
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/modernizr-2.5.3.min.js"></script>
        <script type="text/javascript"  src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery-1.7.1.min.js"></script>
        <script type="text/javascript"  src="{{$LAYOUT_HELPER_URL}}front/javascripts/plugins.all.js"></script>
        <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.address-1.4.min.js"></script>
        <!-- Javascripts END -->

        <!--  Fonts BEGIN  -->
<!--         <link href='../../fonts.googleapis.com/css@family=Lato_3A300,400,700,300italic,400italic' rel='stylesheet' type='text/css'> -->

<!--         <link href='../../fonts.googleapis.com/css@family=Open+Sans_3A400italic,400,300,700,600' rel='stylesheet' type='text/css'> -->
        <!--  Fonts END  -->

        <!--  CSS BEGIN  -->
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/base.css">
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/skeleton.css">
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/layout.css">
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/themes/light-blue.css" title="lightblue">
        <!--  CSS END  -->

        <!--  Components BEGIN  -->
        <!--  Flex Slider  -->
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.flexslider-min.js"></script>

        <!--PrettyPhoto-->
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/prettyPhoto.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.prettyPhoto.js"></script>

        <!--Superfish menu-->

        <link rel="stylesheet" media="screen" href="{{$LAYOUT_HELPER_URL}}front/stylesheets/superfish.css" />
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.hoverIntent.minified.js"></script>
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/superfish.js"></script>
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/supersubs.js"></script>

        <!--  Components END  -->

        <!--Scripts - More in footer-->

        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/common.js"></script>
        <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.all.libraries.js"></script>
        <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/javascripts/sliders.js"></script>
        <!--[if lt IE 9]>
        <!-- JS
        ================================================== -->
        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/tabs.js"></script>

        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.tweet.js"></script>

        <script src="{{$LAYOUT_HELPER_URL}}front/javascripts/jquery.flickrush.pack.js"></script>
       
       <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/css/boostrap.css">
<link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}front/css/boostrap.min.css">
        
<style>

 img.cover {
 	height: 500px;
 	width: 1100px;
}

p {
    margin: 0 0 21px;
}

 
 
h3.sectionhead {
   
    padding-left: 15px;
}
.left{
	float:left;
	height: auto;
	position:relative;
	width: 75%;

	
}
.right{
	float:left;
	width: 25%;
	padding-left: 10px;
}



.confullblue li {
    
    color: #FFFFFF;
}


ul.confullblue li a, a:visited {
    color: #FFFFFF;
    outline: 0 none;
/*     text-decoration: underline; */
}
 
ul.confullblue li a:hover, a:focus{
	color: #000000;
}
li.item a:hover, a:focus{
	color: #000000;
}
</style>
    </head>

    <body>
        <div id="top"></div>
        {{sticker name = title}}
        

        <div id="tray">
            <div id="nav" class="band navigation">
                <div>
                    <nav class="primary container">
                    {{sticker name = main_menu }}
                       
                       
                    </nav>
                </div>
            </div>
        </div><!--end band-->

        
        
        {{sticker name = photos }}
       
          <div class="band mb25" >
         
            <div class="container">
            <div class="left">
                 {{$content}}
        	</div>
        	<div class="right" style="margin-top:40px;">
        	{{sticker name = sidebar }}
        	</div>
        </div>
     
 		</div>  
        

        <div class="band bottom">

            <footer class="bottom container">

                <div class="eight columns first-credit">
                    <p>
                        Copyright &copy; 2014 | <a href="#">Ho Chi Minh City University of Technology</a> | All Rights Reserved.
                    </p>
                </div>

                <div class="eight columns last-credit">
                    <p></p>
                </div>

            </footer><!-- container -->

        </div><!--end band-->

        <div id="tooltip"></div>
        <div id="colourTooltip"></div>

    </body>
</html>