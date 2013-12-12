<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/jquery.validate.js"></script>

<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#login").validate({
        rules: {
            'username': "required",
            'password': "required"
        },
        messages: {
            'username': "",
            'password': ""
        }
    });
});

function submitForm()
{
	$("#login").submit();
}

</script>

<div id="mainContent">
		<div class="SubWrapper">
            <div class="Title01 M20Top">
                <h5><label>G</label>odkend&nbsp;<label>B</label>rugerbetingelser </h5>
            </div> 
            <div class="Rows M9Top">
                <div class="RowCol04 LightBackground">
                    <div class="P15Tb">
                        <p>
                            Nunc aliquam dui augue, non dignissim velit. Nunc viverra, ante volutpat commodo mattis, nibh urna tincidunt nunc, non dapibus diam lacus ut metus. Etiam a ligula neque. Nullam et porta leo. Cras laoreet posuere dui, id varius elit imperdiet eget. Vestibulum ipsum magna, sagittis eget lobortis non, elementum sed nisl. In hac habitasse platea dictumst. Sed sagittis ipsum sit amet eros placerat sit amet facilisis enim malesuada. Quisque posuere aliquet magna. Morbi sodales aliquam sodales. Ut vitae sem nisi, at rhoncus nibh. <br /><br />
                            Donec in venenatis massa. Mauris rhoncus posuere dolor eu commodo. Integer tincidunt pretium volutpat. Nullam viverra porttitor velit, a commodo ante tempor ac. Nulla facilisi. Nunc porttitor eros eget ipsum ornare dictum viverra mi porta.Maecenas vel nulla lobortis lectus condimentum sollicitudin sed et elit. Aenean blandit odio ac nisl mollis et placerat odio imperdiet. Donec eleifend volutpat 
                        </p>
                    </div>   
                </div>
				<form name="login" id="login" action="" method="POST">
                <div class="RowCol04 LightBackground M9Left">
                    <div class="P15Tb">
                        <div class="Title02 Border01">
                            <h5><label>L</label>Ogin</h5>
                        </div>
                        <div class="KantForm01">
                            <label>Bbrugernavn</label>
                            <input type="text" name="username" /><br />
                            <label>Password</label>
                            <input type="password" name="password" /><br />
                        </div>
                        <div class="LoginButton">
                            <div class="ButtonRed">
                                <a href="javascript:submitForm();" title="Login"><span><label>Login</label>&nbsp;<img src="{{$LAYOUT_HELPER_URL}}front/img/icon12.png" alt="Icon" /></span></a>
                            </div>
                        </div>
                        <div class="RegisterLink">
                            <p><a href="#" title="Jeg har glemt password">Jeg har glemt password</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" title="Register her!">Register her!</a></p>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>