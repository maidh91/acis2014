<style>
nav.primary ul li a {
    display: inline-block;
    font-size: 10px;
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
                        {{if $item.id == "Paper"}}<ul style="width:20px;">
		<li>
			<a href="">Call For Papers</a>
		</li>
		<li>
			<a href="">Call For Tutorials</a>
		</li>
		<li>
			<a href="">Call For Workshop Proposals</a>
		</li>
        <li>
			<a href="">Call For Industry Track Papers</a>
		</li>
		<li>
			<a href="">Call For Doctoral Symposium</a>
		</li>
	</ul>{{/if}}</li>
        {{/foreach}}
      </ul>
      </nav>
	