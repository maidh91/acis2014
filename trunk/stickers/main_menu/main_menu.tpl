<style>
nav.primary ul li a {
    display: inline-block;
    font-size: 12px;
    letter-spacing: 0.09em;
    line-height: 32px;
    padding: 0 7px;
    text-decoration: none;
    text-transform: uppercase;
}

</style> 
      	<nav class="primary container">
      	 <ul class="sf-menu sf-js-enabled sf-shadow" id="navLinks">
      	 {{foreach from=$menus item=item name=sub}}
                        <li id="menu_{{$item.id}}" class="{{if $item.id==$menuId}}current{{/if}}">
                        <a href="{{$item.url}}" >{{$item.name}} </a>
                        </li>
        {{/foreach}}
      </ul>
      </nav>
	