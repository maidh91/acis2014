<?php /* Smarty version 2.6.25, created on 2013-12-05 18:32:23
         compiled from access/views/admin.login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'l', 'access/views/admin.login.tpl', 23, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="description" content="visualidea administrator" >
<meta name="keywords" content="visualidea administrator" >
<link rel="Shortcut Icon" href="<?php echo $this->_tpl_vars['LAYOUT_HELPER_URL']; ?>
admin/images/vi.ico">       

<link href="<?php echo $this->_tpl_vars['HELPER_URL']; ?>
/css/admin.login.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
    function setFocus() {
        document.login.username.select();
        document.login.username.focus();
    }
</script>
</head>
<body onload="javascript:setFocus()" id="login" class="blue">
        
    <div id="login-wrapper">
        <div id="login-top" style="background-color: #000000;">
                <div id="logo"> </div>
                    <h3><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Administrator - Login<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
        </div>
        
        <div id="login-content">
        
            <br/>

            <!-- ERROR MESSAGE -->
            <?php if ($this->_tpl_vars['loginError']): ?>
            <div class="notification information"><div><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username or Password is incorrect<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div></div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['accessMessage']): ?>
            <div class="notification information"><div><?php echo $this->_tpl_vars['accessMessage']; ?>
</div></div>
            <div class="clear"></div>
            <?php endif; ?>
            
            <form action="<?php echo $this->_tpl_vars['submitHandler']; ?>
" method="post" name="login" id="form-login" style="clear: both;">
                <p id="form-login-username">
                    <label for="modlgn_username"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                    <input name="username" id="modlgn_username" type="text" class="inputbox" size="15" />
                </p>
            
                <p id="form-login-password">
                    <label for="modlgn_passwd"><?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                    <input name="password" id="modlgn_passwd" type="password" class="inputbox" size="15" />
                </p>
                <!-- 
                    <p id="form-login-lang" style="clear: both;">
                    <label for="lang">Language</label>
                    <select name="lang" id="lang"  class="inputbox"><option value=""  selected="selected">Default</option><option value="en-GB" >English (United Kingdom)</option></select> </p>
                 -->
                <div class="button_holder">
                    <div class="button1" style="margin-left: 120px;">
                        <div class="next">
                            <a onclick="login.submit();">
                                <?php $this->_tag_stack[] = array('l', array()); $_block_repeat=true;Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo Nine_View_Register_Translation::translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
                
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                <input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="Login" />
            </form>
        
        </div>
                
    </div>
    
    <noscript>
        Warning! JavaScript must be enabled for proper operation of the Administrator back-end.
    </noscript>
    <div class="clr"></div>
</body>
</html>