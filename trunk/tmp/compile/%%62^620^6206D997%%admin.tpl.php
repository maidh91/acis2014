<?php /* Smarty version 2.6.25, created on 2013-12-06 11:26:27
         compiled from admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sticker', 'admin.tpl', 52, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php echo $this->_tpl_vars['headTitle']; ?>

    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="description" content="visualidea administrator" >
    <meta name="keywords" content="visualidea administrator" >
    <link rel="Shortcut Icon" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/vi.ico">       
    <?php echo $this->_tpl_vars['headLink']; ?>

    <?php echo $this->_tpl_vars['headStyle']; ?>

	
    
    <!--                       CSS                       -->

    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/css/reset.css"  type="text/css"  />
  
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/css/style.css" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/css/invalid.css"  type="text/css" />   
    
    
    
    <!--                       Javascripts                       -->

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/jquery.validate.js"></script>
    
    <!-- jQuery Configuration -->

    <script type="text/javascript" src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/js/my.jquery.configuration.js"></script>
    
</head>
<body><div id="body-wrapper" class="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div style="float: left; position: absolute; z-index: 100; width:230px;">
          <a href="javascript:hideSlideBar();"><p id="hide_slidebar_button" style="text-align: right;padding: 0px;"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/arrow_left.png"></img></p></a>
          <a href="javascript:showSlideBar();"><p id="show_slidebar_button" style="text-align: left;padding: 0px; display: none;"><img src="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/icons/arrow_right.png"></img></p></a>
        </div>  
        <div id="sidebar">
          <div id="sidebar-wrapper"> 
		  
		  <!-- Sidebar with logo and menu -->
            
            <div><h1  style="top:20px;padding-left:20px; color:white;">Administrator</h1></div>
            <!-- Logo (221px wide) -->
          
            <!-- Sidebar Profile links -->
            <div id="profile-links" style="padding-top:100px;">
            
                <!-- WELCOME MESSAGE -->
                <?php echo Nine_View_Register_Sticker::executeSticker(array('name' => 'admin_user'), $this);?>

                <!-- END WELCOM -->
            
                <br />
                <a target="_blank" href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
../" title="View the Site">View the Site</a> | <a href="<?php echo $this->_tpl_vars['APP_BASE_URL']; ?>
access/admin/logout" title="Sign Out">Sign Out</a>
            </div>        
            
            <!-- MENU -->
            <?php echo Nine_View_Register_Sticker::executeSticker(array('name' => 'admin_menu'), $this);?>

            <!-- END MENU -->
            
			<!-- End #main-nav -->
        </div>
		</div>
		<!-- End #sidebar -->
        
        <div id="main-content"> 
		
		<!-- Main Content Section with everything -->
            
            <noscript>
			<!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="javascript:if(confirm('http://browsehappy.com/  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a domain or path outside the boundaries set for its Starting Address.  \n\nDo you want to open it from the server?'))window.location='http://browsehappy.com/'" title="Upgrade to a better browser">upgrade</a> your browser or <a href="javascript:if(confirm('http://www.google.com/support/bin/answer.py?answer=23852  \n\nThis file was not retrieved by Teleport Pro, because it is addressed on a domain or path outside the boundaries set for its Starting Address.  \n\nDo you want to open it from the server?'))window.location='http://www.google.com/support/bin/answer.py?answer=23852'"  title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    </div>
                </div>
            </noscript>
            
            <!-- PAGE START -->
            
            <?php echo $this->_tpl_vars['content']; ?>

            
            <div id="footer">
                <small> 
				
				<!-- footer -->
                        &#169; Copyright 2014  | <a href="#">Top</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div>
</body>
</html>

