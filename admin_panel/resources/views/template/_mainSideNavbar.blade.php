<!--left side navbar with logo-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <div class="menu-list-search">
       <div class="input-group  sidebar-form">
        <input type="text" class=" form-control" placeholder="Search Menu"/>
        <span class="input-group-btn">
          <button name="search" id="search-btn" class="btn btn-flat">
            <i class="fa fa-search"></i>
          </button>
        </span>
       </div>
      </div>
      <ul class="menu-list-filter sidebar-menu" data-widget="tree">
        {!! get_menu($ap_menu,$perm_uri,true) !!}
      </ul>
      @if(env('APP_ENV')!='production')
        <ul class="menu-list-filter sidebar-menu" data-widget="tree">
          <li class="header">Developer Mode</li>
          <li>
            <a href="{{route('list-menu-admin')}}">
              <i class="fa fa-circle-o text-info"></i>
              <span>Admin Menu</span>
            </a>
          </li>
          <li>
            <a href="{{route('errorr')}}">
              <i class="fa fa-circle-o text-red"></i>
              <span>Error Report</span>
            </a>
          </li>
          <li>
            <a href="{{route('performance')}}">
              <i class="fa fa-circle-o text-yellow"></i>
              <span>Performance Log</span>
            </a>
          </li>
          <li>
            <a href="{{route('routes')}}">
              <i class="fa fa-circle-o text-info"></i>
              <span>All Routes</span>
            </a>
          </li>
          <li>
            <a href="{{route('activity-history')}}">
              <i class="fa fa-circle-o text-yellow"></i>
              <span>Activity History</span>
            </a>
          </li>
          <li>
            <a href="{{route('anomaly')}}">
              <i class="fa fa-circle-o text-red"></i>
              <span>Anomaly</span>
            </a>
          </li>
        </ul>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>