<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{$headTitle}}
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="description" content="visualidea administrator" >
    <meta name="keywords" content="visualidea administrator" >
    <link rel="Shortcut Icon" href="{{$LAYOUT_HELPER_URL}}admin/images/vi.ico">       
    {{$headLink}}
    {{$headStyle}}
    
    <!--                       CSS                       -->
      
    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/reset.css"  type="text/css"  />
  
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/style.css" type="text/css" />
    
    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/invalid.css"  type="text/css" />   
    
    
    <!-- Internet Explorer Fixes Stylesheet -->
    
    <!--[if lte IE 7]>
        <link rel="stylesheet" href="{{$LAYOUT_HELPER_URL}}admin/css/ie.css" type="text/css" media="screen" />
    <![endif]-->
    
    <!--                       Javascripts                       -->

    <!-- jQuery -->
    <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.js"></script>
    <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/jquery.validate.js"></script>
    
    <!-- jQuery Configuration -->

    <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/my.jquery.configuration.js"></script>
    
    
    <!-- jQuery WYSIWYG Plugin -->
    
    
    <!-- Internet Explorer .png-fix -->
    
    <!--[if IE 6]>
        <script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}admin/js/DD_belatedPNG_0.0.7a.js" ></script>
        <script type="text/javascript">
            DD_belatedPNG.fix('.png_bg, img, li');
        </script>
    <![endif]-->
    
</head>
<body class="white_body"><div id="body-wrapper" class="body-wrapper white_body"> <!-- Wrapper for the radial gradient background -->
		
		
		<div id="main-content" style="margin-left: 30px;"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="javascript:if(confirm('http://browsehappy.com/  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a domain or path outside the boundaries set for its Starting Address.  \n\nDo you want to open it from the server?'))window.location='http://browsehappy.com/'" title="Upgrade to a better browser">upgrade</a> your browser or <a href="javascript:if(confirm('http://www.google.com/support/bin/answer.py?answer=23852  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a domain or path outside the boundaries set for its Starting Address.  \n\nDo you want to open it from the server?'))window.location='http://www.google.com/support/bin/answer.py?answer=23852'"  title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- PAGE START -->
			
			{{$content}}
			
			
		</div> <!-- End #main-content -->
		
	</div>
</body>
</html>

