<style>
.confullblue {
    background: none repeat scroll 0 0 #3FBEEF;
    margin: 5px 0;
    overflow: hidden;
    color: #FFFFFF;
    min-height: 540px;
}

.confullblue li {
    
    color: #FFFFFF;
/*      line-height: 10px; */
    margin-bottom: 11px;
}
.confullblueTitle li {
	line-height: 29px;
}
.confullblueTitle {
/*     border-bottom: 1px solid #529FCF; */
    border-bottom: 1px dashed #E5E5E5;
    color: #FFFFFF;
    display: block;
    font-size: 17px;
    height: 30px;
    line-height: 30px;
    margin: 0 3px;
    padding-left: 60px;
    text-transform: uppercase;
/*     margin-top:5px; */
    
    text-decoration: none;
}
li.item{
	padding-left: 20px;
}
ul.confullblue li a {
    display: inline-block;
    font-size: 11px;
    letter-spacing: 0.09em;
   
    padding: 0 7px;
    text-decoration: none;
    text-transform: uppercase;
}
.currentmenu{
	text-transform: uppercase;
}
</style> 
<ul class="confullblue" style="margin-top:20px;"> 
<li class="confullblueTitle">Main menu</li> 
 	{{foreach from=$menus item=item name=sub}}
                        <li   id="menu_{{$item.id}}" class="item {{if $item.id==$menuId}}currentmenu{{/if}}">
                        <a href="{{$item.url}}" >{{$item.name}} </a>
                        </li>
        {{/foreach}}
        
 </ul>

    
   
        
	

    
