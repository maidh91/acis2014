<div id="featured" >
      <ul class="ui-tabs-nav">
        <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-1"><a href="#fragment-1">1</a></li>
        <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2">2</a></li>
        <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3">3</a></li>
        <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4">4</a></li>
      </ul>
      
      <!-- First Content -->
      <div id="fragment-1" class="ui-tabs-panel" style=""> <img src="{{$BASE_URL}}{{$intro1.main_image}}" alt="" />
        <div class="info" >
          <p><a href="{{$intro1.url}}" >{{$intro1.title}}</a></p>
          <dl>{{$intro1.summary_intro_text}}</dl>
        </div>
      </div>
      
      <!-- Second Content -->
      <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style=""> <img src="{{$BASE_URL}}{{$intro2.main_image}}" alt="" />
        <div class="info" >
        	 <p><a href="{{$intro2.url}}" >{{$intro2.title}}</a></p>
          	<dl>{{$intro2.summary_intro_text}}</dl>
        </div>
      </div>
      
      <!-- Third Content -->
      <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style=""> <img src="{{$BASE_URL}}{{$intro3.main_image}}" alt="" />
        <div class="info" >
        	 <p><a href="{{$intro3.url}}" >{{$intro3.title}}</a></p>
          	<dl>{{$intro3.summary_intro_text}}</dl>
        </div>
      </div>
      
      <!-- Fourth Content -->
      <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style=""> <img src="{{$BASE_URL}}{{$intro4.main_image}}" alt="" />
        <div class="info" >
        	 <p><a href="{{$intro4.url}}" >{{$intro4.title}}</a></p>
          <dl>{{$intro4.summary_intro_text}}</dl>
        </div>
      </div>
    </div>