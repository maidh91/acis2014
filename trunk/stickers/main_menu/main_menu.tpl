 
      	
      	 <ul class="sf-menu sf-js-enabled sf-shadow" id="navLinks">
      	 {{foreach from=$menus item=item name=sub}}
                        <li id="menu_{{$item.id}}" class="{{if $item.id==$menuId}}current{{/if}}">
                        <a href="{{$item.url}}" >{{$item.name}}</a></li>
        {{/foreach}}
      </ul>
	