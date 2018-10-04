<!--=== Header ===-->
<div class="header">
  <!-- Navbar -->
  <div class="navbar navbar-default mega-menu" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="fa fa-bars"></span>
        </button>
        <a class="navbar-brand" href="/home">
          <img src="https://hrm.froid.works/assets/admin/layout/img/logo.png" height="22px" width="86px" id="logo-header" class="logo-default" />
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">

          <!-- Home -->
          <li class="active">
            <a href="/home">
              Home
            </a>
          </li>
          <!-- End Home -->

          <!-- Leave -->
          <li class="dropdown ">
            <a href="" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"  >
              Leave
            </a>
            <ul class="dropdown-menu">
              <li><a href="" data-toggle="modal" data-target=".apply_modal">Apply Leave</a></li>

            </ul>
          </li>
          <!-- End Leave -->
          <!-- My Account -->
          <li class="dropdown">
            <a href="" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
              My Account
            </a>
            <ul class="dropdown-menu">
              {{--<li><a href="" data-toggle="modal" data-target=".change_password_modal" id="change_password_link">Change Password</a></li>--}}
              <!-- Logout -->
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                  {{ csrf_field() }}
                </form>

              </li>
              <!-- End Logout -->

            </ul>
          </li>
          <!-- End Leave -->

        </ul>
      </div><!--/navbar-collapse-->
    </div>
  </div>
  <!-- End Navbar -->
</div>
<!--=== End Header ===-->