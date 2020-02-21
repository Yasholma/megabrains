<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ route('admin.home') }}"><img src="{{ asset('admin_assets/images/logo.jpg') }}" alt="logo"/></a>
    <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}"><img src="{{ asset('admin_assets/images/logo-mini.jpg') }}" alt="logo"/></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    @guest('admin')
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            <i class="mdi mdi-home"></i>
            Main Site
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.login') }}" class="nav-link">Login <i class="mdi mdi-login-variant"></i></a>
        </li>
      </ul>
    @else
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">
            <i class="mdi mdi-home"></i>
            Main Site
          </a>
        </li>
        <li class="nav-item d-none d-lg-block full-screen-link">
          <a class="nav-link">
            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
          </a>
        </li>
        <!--<li class="nav-item dropdown">-->
        <!--  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">-->
        <!--    <i class="mdi mdi-email-outline"></i>-->
        <!--    <span class="count-symbol bg-warning"></span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">-->
        <!--    <h6 class="p-3 mb-0">Messages</h6>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item preview-item">-->
        <!--      <div class="preview-thumbnail">-->
        <!--          <img src="{{ asset('admin_assets/images/faces/no_image.jpg') }}" alt="image" class="profile-pic">-->
        <!--      </div>-->
        <!--      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
        <!--        <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>-->
        <!--        <p class="text-gray mb-0">-->
        <!--          1 Minutes ago-->
        <!--        </p>-->
        <!--      </div>-->
        <!--    </a>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item preview-item">-->
        <!--      <div class="preview-thumbnail">-->
        <!--          <img src="{{ asset('admin_assets/images/faces/face2.jpg') }}" alt="image" class="profile-pic">-->
        <!--      </div>-->
        <!--      <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
        <!--        <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>-->
        <!--        <p class="text-gray mb-0">-->
        <!--          15 Minutes ago-->
        <!--        </p>-->
        <!--      </div>-->
        <!--    </a>-->
        <!--    <div class="dropdown-divider"></div>-->
            <!--<a class="dropdown-item preview-item">-->
            <!--  <div class="preview-thumbnail">-->
            <!--      <img src="{{ asset('admin_assets/images/faces/no_image.jpg') }}" alt="image" class="profile-pic">-->
            <!--  </div>-->
            <!--  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
            <!--    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>-->
            <!--    <p class="text-gray mb-0">-->
            <!--      18 Minutes ago-->
            <!--    </p>-->
            <!--  </div>-->
            <!--</a>-->
        <!--    <div class="dropdown-divider"></div>-->
            <!--<h6 class="p-3 mb-0 text-center">4 new messages</h6>-->
        <!--  </div>-->
        <!--</li>-->
        <!--<li class="nav-item dropdown">-->
        <!--  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">-->
        <!--    <i class="mdi mdi-bell-outline"></i>-->
        <!--    <span class="count-symbol bg-danger"></span>-->
        <!--  </a>-->
          <!--<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">-->
          <!--  <h6 class="p-3 mb-0">Notifications</h6>-->
          <!--  <div class="dropdown-divider"></div>-->
          <!--  <a class="dropdown-item preview-item">-->
          <!--    <div class="preview-thumbnail">-->
          <!--      <div class="preview-icon bg-success">-->
          <!--        <i class="mdi mdi-calendar"></i>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
          <!--      <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>-->
          <!--      <p class="text-gray ellipsis mb-0">-->
          <!--        Just a reminder that you have an event today-->
          <!--      </p>-->
          <!--    </div>-->
          <!--  </a>-->
          <!--  <div class="dropdown-divider"></div>-->
          <!--  <a class="dropdown-item preview-item">-->
          <!--    <div class="preview-thumbnail">-->
          <!--      <div class="preview-icon bg-warning">-->
          <!--        <i class="mdi mdi-settings"></i>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
          <!--      <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>-->
          <!--      <p class="text-gray ellipsis mb-0">-->
          <!--        Update dashboard-->
          <!--      </p>-->
          <!--    </div>-->
          <!--  </a>-->
            <!--<div class="dropdown-divider"></div>-->
            <!--<a class="dropdown-item preview-item">-->
              <!--<div class="preview-thumbnail">-->
              <!--  <div class="preview-icon bg-info">-->
              <!--    <i class="mdi mdi-link-variant"></i>-->
              <!--  </div>-->
              <!--</div>-->
              <!--<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">-->
              <!--  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>-->
              <!--  <p class="text-gray ellipsis mb-0">-->
              <!--    New admin wow!-->
              <!--  </p>-->
              <!--</div>-->
            <!--</a>-->
            <!--<div class="dropdown-divider"></div>-->
            <!--<h6 class="p-3 mb-0 text-center">See all notifications</h6>-->
        <!--  </div>-->
        <!--</li>-->
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-img">
                
              <img src="{{ Auth()->user()->profile ? asset('admin_assets/images/faces/' . Auth()->user()->profile['picture']) : asset('admin_assets/images/faces/no_image.jpg') }}" alt="image">
              <span class="availability-status online"></span>
            </div>
            <div class="nav-profile-text">
              <p class="mb-1 text-black">{{ Auth()->user()->name }}</p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
              <i class="mdi mdi-account-card-details mr-2 text-success"></i>
              Profile
            </a>
            @admin('super')
              <a class="dropdown-item" href="{{ route('admin.show') }}">
                <i class="mdi mdi-format-list-bulleted-type mr-2 text-success"></i>
                {{ ucfirst(config('multiauth.prefix')) }}
              </a>
              <a class="dropdown-item" href="{{ route('admin.roles') }}">
                <i class="mdi mdi-key-plus mr-2 text-success"></i>
                Roles
              </a>
            @endadmin
            <a class="dropdown-item" href="{{ route('admin.password.change') }}">
              <i class="mdi mdi-key mr-2 text-success"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout mr-2 text-primary"></i>
              Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    @endguest
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
