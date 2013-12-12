<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="description" content="visualidea administrator" >
<meta name="keywords" content="visualidea administrator" >
<link rel="Shortcut Icon" href="{{$LAYOUT_HELPER_URL}}admin/images/vi.ico">       

<link href="{{$HELPER_URL}}/css/admin.login.css" rel="stylesheet" type="text/css" />
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
                    <h3>{{l}}Administrator - Login{{/l}}</h3>
        </div>
        
        <div id="login-content">
        
            <br/>

            <!-- ERROR MESSAGE -->
            {{if $loginError}}
            <div class="notification information"><div>{{l}}Username or Password is incorrect{{/l}}</div></div>
            <div class="clear"></div>
            {{/if}}
            {{if $accessMessage}}
            <div class="notification information"><div>{{$accessMessage}}</div></div>
            <div class="clear"></div>
            {{/if}}
            
            <form action="{{$submitHandler}}" method="post" name="login" id="form-login" style="clear: both;">
                <p id="form-login-username">
                    <label for="modlgn_username">{{l}}Username{{/l}}</label>
                    <input name="username" id="modlgn_username" type="text" class="inputbox" size="15" />
                </p>
            
                <p id="form-login-password">
                    <label for="modlgn_passwd">{{l}}Password{{/l}}</label>
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
                                {{l}}Login{{/l}}</a>
                
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
