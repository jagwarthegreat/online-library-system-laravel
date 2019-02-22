<aside>
      <div id="sidebar" class="nav-collapse ">
      
        <ul class="sidebar-menu">
          <li class="{{Request::segment('2') == 'home' ? 'active': ''}}">
            <a class="" href="{{route('librarian')}}">
                  <i class="icon_house_alt"></i>
                  <span>Reservation</span>
            </a>
          </li>

           <li class="{{Request::segment('2') == 'books' ? 'active': ''}}">
            <a class="" href="{{route('librarian_books')}}">
                  <i class="icon_book_alt"></i>
                  <span>Books</span>
            </a>
          </li>

          <li class="{{Request::segment('2') == 'reserve-now' ? 'active': ''}}">
            <a class="" href="{{route('librarian_reserve_now')}}">
                  <i class="icon_toolbox"></i>
                  <span>Reserve Now</span>
            </a>
          </li>

          <li class="{{Request::segment('2') == 'history' ? 'active': ''}}">
            <a class="" href="{{route('librarian_history')}}">
                  <i class="icon_search_alt"></i>
                  <span>History</span>
            </a>
          </li>

          <li class="{{Request::segment('2') == 'reports' ? 'active': ''}}">
            <a class="" href="{{route('librarian_reports')}}">
                  <i class="icon_book_alt"></i>
                  <span>Reports</span>
            </a>
          </li>
          
          
          
          
        </ul>
        
      </div>
    </aside>