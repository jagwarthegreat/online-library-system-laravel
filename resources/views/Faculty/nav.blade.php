<header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

     
      <a href="index.html" class="logo">Library <span class="lite">Faculty Dashboard</span></a>
     

      <div class="nav search-row" id="top_menu">
      
      </div>

      <div class="top-nav notification-row">
       
        <ul class="nav pull-right top-menu">

          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                           
                            <span class="username">{{Auth::user()->name}} </span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              
              <li>
                <a href="{{route('faculty_change_password')}}"><i class="icon_key_alt"></i>Change Password</a>
              </li>
              
              <li>
                <a href="{{route('student_logout')}}"><i class="icon_key_alt"></i> Log Out</a>
              </li>
             
            </ul>
          </li>
          
        </ul>
       
      </div>
    </header>