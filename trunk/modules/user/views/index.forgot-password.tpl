<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/jquery.validate.js"></script>

<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#register").validate({
        rules: {
            'email': {
                required: true,
                email: true
            }
        },
        messages: {
            'email': ""
        }
    }); 
});

function submitForm()
{
	$("#register").submit();
}

</script>

<div id="mainContent">
		<div class="SubWrapper">
            <div class="Title01 M20Top">
                <h5><label>F</label>orgot&nbsp;<label>P</label>assword</h5>
            </div>
            <div class="Rows">
                <div class="RowCol09">
                    <img src="{{$LAYOUT_HELPER_URL}}front/img/img07.jpg" alt="Image" />
                    <div class="CreatList">
                        <ul>
                            <li>
                                <a href="#" title="Nunc aliquam dui augue, non dignissim velit. Nunc viverra">Nunc aliquam dui augue, non dignissim velit. Nunc viverra</a>
                            </li>
                            <li>
                                <a href="#" title="Ante volutpat commodo mattis, nibh urna tincidunt nunc non">Ante volutpat commodo mattis, nibh urna tincidunt nunc non</a>
                            </li>
                            <li>
                                <a href="#" title="Etiam a ligula neque. Nullam et porta leo cras laoreet posuere">Etiam a ligula neque. Nullam et porta leo cras laoreet posuere</a>
                            </li>
                            <li>
                                <a href="#" title="Dui id varius elit imperdiet eget. Vestibulum ipsum magna sagittis">Dui id varius elit imperdiet eget. Vestibulum ipsum magna sagittis</a>
                            </li>
                            <li>
                                <a href="#" title="Etiam a ligula neque. Nullam et porta leo cras laoreet posuere">Etiam a ligula neque. Nullam et porta leo cras laoreet posuere</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="RowCol10">
                    <p>
                        Nunc aliquam dui augue, non dignissim velit. Nunc viverra, ante volutpat commodo mattis, nibh urna tincidunt nunc, non dapibus diam lacus ut metus. Etiam a ligula neque. Nullam et porta leo. Cras laoreet posuere dui, id varius elit imperdiet eget. Vestibulum ipsum magna, sagittis eget lobortis non, elementum sed nisl. In hac habitasse platea dictumst. Sed sagittis ipsum sit amet eros placerat sit amet facilisis enim malesuada. Quisque posuere aliquet magna. Morbi sodales aliquam sodales. Ut vitae sem nisi, at rhoncus nibh. Donec in venenatis massa. Mauris rhoncus posuere dolor eu commodo. Integer tincidunt pretium volutpat. Nullam viverra porttitor velit, a commodo ante tempor ac. Nulla facilisi. Nunc porttitor eros eget ipsum ornare dictum viverra mi porta.<br /><br />
                        Maecenas vel nulla lobortis lectus condimentum sollicitudin sed et elit. Aenean blandit odio ac nisl mollis et placerat odio imperdiet. Donec eleifend volutpat pharetra. Morbi scelerisque suscipit nisi, eu mollis magna posuere bibendum. Nullam et mauris nec quam egestas imperdiet id eu nisl. Curabitur sed enim a felis suscipit dictum. 
                    </p>
                    <div class="Box04 M15Top">
                        <div class="TopBox04">
                            <div class="TopItem01"></div>
                            <div class="TopItem02 W734"></div>
                            <div class="TopItem03"></div>
                        </div>
                        <form method="POST" name="register" id="register" action="">
                        <div class="CenterBox04 W746 Rows">
                           
                           {{if $errors}        
				            <div class="register_error">
				                <b>Error:</b> Email doesn't exist. Please try with correct email.
				            </div>
				            {{/if}}
				            
                           <div class="RowCol11">
                                <div class="CreateForm">
                                    <label>Din e-mail adresse<span style="color:red">*</span></label>
                                    <input type="text" id="email" name="email" value="{{email}}" style="width:300px;" />&nbsp;
                                    <a href="#" title="Icon"><img src="{{$LAYOUT_HELPER_URL}}front/img/icon06.gif" alt="Icon" /></a><br style="clear: both;" />
                                </div>
                                <div class="CreateButton">
                                    <div class="ButtonRed">
                                        <a href="javascript:submitForm();" title="Save Candidate"><span><label>Save Candidate</label>&nbsp;<img src="{{$LAYOUT_HELPER_URL}}front/img/icon12.png" alt="Icon" /></span></a>
                                    </div>
                               </div>
                           </div>
                           
                           <div class="RowCol12">
                                <img src="{{$LAYOUT_HELPER_URL}}front/img/img09.jpg" alt="Image" />
                           </div>
                        </div>
                        </form>
                        <div class="BotBox04">
                            <div class="BotItem01"></div>
                            <div class="BotItem02 W734"></div>
                            <div class="BotItem03"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>