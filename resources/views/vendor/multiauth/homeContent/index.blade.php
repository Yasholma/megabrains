@extends('multiauth::layouts.app')
@section('styles')
    <style>
        a.homeContent {
            text-decoration: none;
            color: #6a6a6a;
        }

        a.homeContent > .card {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            height: 35vh;
        }

        a.homeContent > .card:hover {
            background: #0e6c5e;
            color: #fff;
            transform: scale(1.05);
            transition: all .3s ease-in-out;
            box-shadow: 2px 2px 5px 2px rgb(52, 58, 64);
            cursor: pointer;
        }
    </style>
@stop
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.homeContent.carousel') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Carousel and Contents</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('admin.homeContent.motivational') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Motivational Quote and Video</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('admin.homeContent.mpo') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Mission, Philosophy &amp; Objectives</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('admin.homeContent.partners') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Partners Management</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('admin.homeContent.testimonies') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Testimonies Management</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('admin.certificate') }}" class="homeContent">
                            <div class="card text-center" style="background: url({{ asset('img/cert_bg.jpg') }}); background-size: cover; color: #000;">
                                <div class="card-body">
                                    <h4 class="display-4">Certificate Management</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mt-4">
                        <a href="{{ route('admin.homeContent.feedbacks') }}" class="homeContent">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="display-4">Student Feedbacks</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('multiauth::includes.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
@endsection


