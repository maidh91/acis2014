{{if $allTrans|@count > 0 }}
<table>
    <tbody>
    
    {{foreach from=$allTrans item=item key=index}}
        <!-- Expandable translation -->
        <tr> 
            <td>{{$index}}</td>
        </tr>
        <tr>
            <td>
                <table>
                    {{foreach from=$item item=item2 key=langCode}}
                    <tr> 
                        <td>[{{$langCode|@strtoupper}}]:</br> <textarea class="text-input textarea" id="textarea" name="data[trans]" cols="75" rows="5">{{$data.trans}}</textarea></td>
                    </tr>
                    {{/foreach}}
                </table>
            </td>
        </tr>
        <tr><td colspan="2"></td></tr>
    {{/foreach}}    
        
    
    </tbody>
</table>
{{else}}
<div class="notification information png_bg">
    <div>
        There is no translated word in this access.
    </div>
</div>
{{/if}}