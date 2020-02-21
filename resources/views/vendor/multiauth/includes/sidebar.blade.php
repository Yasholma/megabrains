<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ Auth()->user()->profile ? asset('admin_assets/images/faces/' . Auth()->user()->profile['picture']) : asset('admin_assets/images/faces/no_image.jpg') }}" alt="profile">
                    <span class="login-status online"></span> <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth()->user()->name }}</span>
                    @foreach(Auth()->user()->roles as $role)
                        <span class="text-secondary text-small">{{ ucfirst($role->name) . ' Admin' }}</span>
                    @endforeach
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item {{ strpos(url()->current(), 'home') ? 'show' : '' }}">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @admin('super')
            <li class="nav-item {{ strpos(url()->current(), 'admin.homeContent') ? 'show' : '' }}">
                <a class="nav-link" href="{{ route('admin.homeContent') }}">
                    <span class="menu-title">Home Content Settings</span>
                    <i class="mdi mdi-account-settings-variant menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-cat" aria-expanded="false" aria-controls="ui-cat">
                    <span class="menu-title">Category Management</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-cards-playing-outline menu-icon"></i>
                </a>
                <div class="collapse {{ strpos(url()->current(), 'categories') ? 'show' : '' }}" id="ui-cat">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.categories.index') }}">Category List</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.categories.create') }}">Add Category</a></li>
                    </ul>
                </div>
            </li>

        @endadmin
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-course" aria-expanded="false" aria-controls="ui-course">
                <span class="menu-title">Course Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart-outline menu-icon"></i>
            </a>
            <div class="collapse {{ strpos(url()->current(), 'courses') ? 'show' : '' }}" id="ui-course">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.courses.index') }}">Course List</a></li>
                    @admin('super')
                    @else
                        <li class="nav-item"> <a class="nav-link" href="{{ route('admin.courses.create') }}">Add Course</a></li>
                    @endadmin
                </ul>
            </div>
        </li>

        {{--            General Test Section        --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-gen" aria-expanded="false" aria-controls="ui-gen">
                <span class="menu-title">General Test</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-question"></i>
            </a>
            <div class="collapse {{ strpos(url()->current(), 'general') ? 'show' : '' }}" id="ui-gen">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.general.test') }}">Manage General Test</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ strpos(url()->current(), 'transactions') ? 'show' : '' }}">
            <a class="nav-link" href="{{ route('admin.transactions.all') }}" aria-expanded="false">
                <span class="menu-title">Transactions</span>
                <i class="menu-icon"></i>
                <i class="mdi mdi-account-alert"></i>
            </a>
        </li>
    </ul>
</nav>
