{{if $allTrans|@count > 0 }}
	<!-- MESSAGE -->
	{{if true == $translationSucess}}
						<div class="notification success png_bg">
                            <a href="#" class="close"><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                Translation is saved successfully
                            </div>
                        </div>
	{{/if}}
	<!-- END MESSAGE -->
<p><input class="button" type="submit" value="Save" /></p>	
<table>
    <tbody>
    
    {{foreach from=$allTrans item=item key=word name=translation}}
    	{{assign var="i" value=$smarty.foreach.translation.iteration}}
        <!-- Expandable permission -->
        <tr> 
            <td>
            	<strong>{{$word}}</strong>
            	<input type="hidden" name="data[{{$i}}][key]" value="{{$word}}">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="border-collapse: separate;">
                    {{foreach from=$item key=lang item=item2}}
                    <tr class="alt-row"> 
                        <td style="width: 10px;"><img src="{{$BASE_URL}}media/userfiles/images/icons/flags/language/16/{{$lang}}.png" /></td>
                        <td><input style="width: 97%" class="text-input small-input" id="trans" name="data[{{$i}}][{{$lang}}] " value="{{$item2}}"></input></td>
                    </tr> 
                    {{/foreach}}
                </table>
            </td>
        </tr>
        <tr><td colspan="2"></td></tr>
    {{/foreach}}    
        
    
    </tbody>
</table>
<p><input class="button" type="submit" value="Save" /></p>
{{else}}
<div class="notification information png_bg">
    <div>
        There is no translate in this language.
    </div>
</div>
{{/if}}