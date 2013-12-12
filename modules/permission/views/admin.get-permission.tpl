{{if $allPers|@count > 0 }}
<table>
    <tbody>
    
    {{foreach from=$allPers item=item}}
        {{if $item.expand|@count > 0 }}
        <!-- Expandable permission -->
        <tr> 
            <td>{{$item.description}}</td>
            <td style="text-align: right;padding-right: 20px;"">
                <a href="javascript:enableAllPermissions({{$groupId}},{{$item.permission_id}});">Enable All</a> 
                | 
                <a  href="javascript:disableAllPermissions({{$groupId}},{{$item.permission_id}});">Disable All</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    {{foreach from=$item.expand item=item2}}
                    <tr> 
                        <td>{{$item2.expand_display_name_value}}</td>
                        <td  style="text-align: right;">
                            {{if $item2.enabled == '1'}}
                                <a href="javascript:disablePermission({{$groupId}},{{$item.permission_id}}, {{$item2.expand_table_id_value}});" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png"></a>
                            {{else}}
                                <a href="javascript:enablePermission({{$groupId}},{{$item.permission_id}}, {{$item2.expand_table_id_value}});" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png"></a>
                            {{/if}}
                        </td>
                    </tr>
                    {{/foreach}}
                </table>
            </td>
        </tr>
        <tr><td colspan="2"></td></tr>
        {{else}}
        <tr>
            <td>{{$item.description}}</td>
            <td  style="text-align: right;padding-right: 20px;">
                {{if $item.enabled == '1'}}
                    <a href="javascript:disablePermission({{$groupId}},{{$item.permission_id}}, '*');" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/visible16x16.png"></a>
                {{else}}
                    <a href="javascript:enablePermission({{$groupId}},{{$item.permission_id}}, '*');" ><img src="{{$LAYOUT_HELPER_URL}}admin/images/icons/invisible16x16.png"></a>
                {{/if}}
            </td>
        </tr>
        {{/if}}
    {{/foreach}}    
        
    
    </tbody>
</table>
{{else}}
<div class="notification information png_bg">
    <div>
        There is no permission in this access.
    </div>
</div>
{{/if}}