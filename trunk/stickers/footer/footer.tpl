<div id="footer">
  <div class="footer_content p15t">
    <div class="nav_foter"> 
    {{foreach from=$menus item=item name= submenu}}
<!--        	<li id="menu_{{$item.id}}" {{if $item.id==$menuId}}class="current"{{/if}}><a href="{{$item.url}}"><span>{{$item.name}}</span></a></li>-->
    	<a id="menu_{{$item.id}}" {{if $item.id==$menuId}}class="current"{{/if}} href="{{$item.url}}">{{$item.name}}</a>
    	{{if !$smarty.foreach.submenu.last}}
    	|
    	{{/if}}
    {{/foreach}}
    
    </div>
    <div class=" p10t p11l">
      {{$text}}
    </div>
    </p>
  </div>
</div>