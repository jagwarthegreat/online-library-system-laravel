<aside>
      <div id="sidebar" class="nav-collapse ">
      
        <ul class="sidebar-menu">
          <li class="{{Request::segment('2') == 'home' ? 'active': ''}}">
            <a class="" href="{{route('student')}}">
                  <i class="icon_house_alt"></i>
                  <span>Home </span>
            </a>
          </li>

          <li class="{{Request::segment('2') == 'history' ? 'active': ''}}">
            <a class="" href="{{route('student_history')}}">
                  <i class="icon_search_alt"></i>
                  <span>History </span>
            </a>
          </li>
          
          
          
          
        </ul>
        
      </div>
    </aside>