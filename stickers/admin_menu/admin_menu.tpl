<ul id="main-nav">  
    <li>
        <a href="{{$APP_BASE_URL}}" class="nav-top-item no-submenu {{if $menu[0]=='controlpanel'}}current{{/if}}">
            Control Panel
        </a>       
    </li>
    {{p name='see_user' module='user'}}
    <li> 
        <a href="#" class="nav-top-item {{if $menu[0]=='usergroup'}}current{{/if}}">
        Users & Groups
        </a>
        <ul>
            {{p name='new_user' module='user'}}<li><a href="{{$APP_BASE_URL}}user/admin/new-user" class="{{if $menu[1]=='newuser'}}current{{/if}}">New User</a></li>{{/p}}
            {{p name='see_user' module='user'}}<li><a href="{{$APP_BASE_URL}}user/admin/manage-user" class="{{if $menu[1]=='manageuser'}}current{{/if}}">Manage Users </a></li>{{/p}}
            {{p name='see_group' module='user'}}<li><a href="{{$APP_BASE_URL}}user/admin/manage-group" class="{{if $menu[1]=='managegroup'}}current{{/if}}"> Manage Groups</a></li>{{/p}}
            
            {{p name='see_permission' module='permission'}}<li><a href="{{$APP_BASE_URL}}permission/admin/manager" class="{{if $menu[1]=='managepermission'}}current{{/if}}"> Manage Permissions</a></li>{{/p}}
     
        </ul>
    </li>
    {{/p}}
    
    {{if $userGroup.group_id == 2}}
    <li>
        <a href="{{$APP_BASE_URL}}user/admin/edit-user/id/{{$userGroup.user_id}}" class="nav-top-item no-submenu {{if $menu[0]=='usergroup'}}current{{/if}}">
            My Account
        </a>       
    </li>
    {{/if}}

    {{p name='new_content' module='content'  expandId='?'}}
    <li> 
        <a href="#" class="nav-top-item {{if $menu[0]=='content'}}current{{/if}}">
        Content
        </a>
        <ul>
            {{p name='new_content' module='content'  expandId='?'}}<li><a href="{{$APP_BASE_URL}}content/admin/new-content" class="{{if $menu[1]=='newcontent'}}current{{/if}}">New Content</a></li>{{/p}}
            {{p name='see_content' module='content'  expandId='?'}}<li><a href="{{$APP_BASE_URL}}content/admin/manage-content" class="{{if $menu[1]=='managecontent'}}current{{/if}}"> Manage Content</a></li>{{/p}}
            
<!--             {{p name='new_category' module='content'  expandId='?'}}<li><a href="{{$APP_BASE_URL}}content/admin/new-category" class="{{if $menu[1]=='newcategory'}}current{{/if}}">New Category</a></li>{{/p}} -->
<!--             {{p name='see_category' module='content'  expandId='?'}}<li><a href="{{$APP_BASE_URL}}content/admin/manage-category" class="{{if $menu[1]=='managecategory'}}current{{/if}}"> Manage Categories</a></li>{{/p}} -->
        </ul>
    </li>
    {{/p}}
    
	
  

<!--     {{p name='see_translation' module='language'}} -->
<!--     <li>  -->
<!--         <a href="#" class="nav-top-item {{if $menu[0]=='others'}}current{{/if}}"> -->
<!--         Others -->
<!--         </a> -->
<!--         <ul> -->
<!--             {{p name='see_translation' module='language'  expandId='?'}}<li><a href="{{$APP_BASE_URL}}language/translation/manage" class="{{if $menu[1]=='manage-translation'}}current{{/if}}">Manage Translations</a></li>{{/p}} -->
<!--         </ul> -->
<!--     </li> -->
<!--     {{/p}} -->
    
</ul> 