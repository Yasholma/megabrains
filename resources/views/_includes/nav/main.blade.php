<header class="header-area">
        <!-- Top Header Area Start -->
        <div class="top-header-area fixed-top" style="position: fixed;">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-3 welcome">
                        <div class="top-header-content">
                            <p>Welcome to MegaBrains Infotech</p>
                        </div>
                    </div>
                    <div class="col-4 lg-v-btn">
                        <a href="{{ route('verifyCert') }}" class="btn btn-sm btn-info btn-block ">Click to Verify Certificate</a>
                    </div>
                    <div class="col-6 sm-v-btn">
                        <a href="{{ route('verifyCert') }}" class="btn btn-sm btn-info btn-block">Click to Verify Certificate</a>
                    </div>
                    <div class="col-5">
                        <div class="top-header-content text-right">
                            <p class="phone-md">
                                <i class="fa fa-clock-o text-white" aria-hidden="true"></i>
                                Mon-Sat: 8.00 to 17.00 <span class="mx-2"></span> | <span class="mx-2"></span>
                                <i class="fa fa-phone text-white" aria-hidden="true"></i> Call us: (+234) 703 110 2787
                            </p>
                            <p class="phone-sm">
                                <i class="fa fa-phone text-white" aria-hidden="true"></i> (+234) 703 110 2787
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="akameNav">

                    <!-- Logo -->
                    <!--md-logo-->
                    <a class="nav-brand mt-2 md-logo" href="{{ route('index') }}"><img width="200" height="200" src="{{ asset('admin_assets/images/logo.jpg') }}" alt="MegaBrains"></a>

                    <a class="nav-brand d-md-none" href="{{ route('index') }}"><img style="height: 55px" class="img-fluid img-responsive"  src="{{ asset('admin_assets/images/logo.jpg') }}" alt="MegaBrains"></a>


                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="{{ route('index') }}">Home</a></li>
                                    <li><a>Course Categories</a>
                                        <ul class="dropdown">
                                            @foreach ($categories as $cat)
                                                <li><a href="{{ route('category', $cat->id) }}">{{ $cat->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('testimonies') }}">Student Stories</a></li>
                                    <li><a href="">Blog</a></li>
{{--                                    <li><a href="">Carriers</a></li>--}}
                                    <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                                    <li>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-dashboard"></i> Create Your Course</a>
                                    </li>
                                    @if(Auth::guard('student')->guest())
                                        <li>
                                            <a href="{{ route('student.register')  }}" class="btn btn-primary account">{{__('Sign Up')}}<i></i></a>
                                        </li>

                                        <li>
                                            <a href="{{ route('student.login') }}" class="login">{{ __('Login') }}</a>
                                        </li>
                                    @else
                                        <li><a href="#">{{ explode(" ", Auth::guard('student')->user()->name)[0] }}</a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('student.dashboard') }}">My Dashboard</a></li>
                                                <li><a href="{{ route('profile.index') }}">Profile</a></li>
                                                <li><a href="{{ route('student.logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">{{__('Logout')}}</a></li>
                                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>