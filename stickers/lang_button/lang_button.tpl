{{if $allLangs|@count > 1}}
        {{foreach from=$allLangs item=item}}
            <a href="{{$BASE_URL}}{{$item.lang_code}}/"><img src="{{$LAYOUT_HELPER_URL}}front/images/fag_{{$item.lang_code}}.jpg" width="28" height="22"/></a> 
        {{/foreach}}
{{/if}}