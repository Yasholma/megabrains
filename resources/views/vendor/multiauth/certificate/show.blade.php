@extends('multiauth::layouts.app')
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <style>
        h1, h3, h4 {
            font-family: 'Be Vietnam', sans-serif;
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
                <div class="page-header">
                    <h4 class="page-title">
                      <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                      </span>
                        Dashboard
                    </h4>

                </div>


                <div class="row">
                    <div class="col-md-10 grid-margin stretch-card">
                        <div class="card p-4">
                            <div class="ro">
                                @include('flash-message')
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-center border-right">
                                    <img class="rounded rounded-circle" width="150" height="150"  src="{{ asset('cert_student_images/' . $certificate->student_image) }}" alt="">
                                    <hr>
                                    <h4>CERTIFICATE ID: <span class="text-info">{{ $certificate->certificate_id }}</span></h4>
                                    <hr>
                                    <h4>NAME: <span class="text-info">{{ $certificate->student_name }}</span></h4>
                                    <hr>
                                    <h4>COURSE NAME: <span class="text-info">{{ $certificate->course_name }}</span></h4>
                                    <hr>
                                    <h4>GRADE: <span class="text-info">{{ $certificate->grade }}</span></h4>
                                    <hr>
                                    <a href="{{ route('admin.certificate') }}" class="btn btn-outline-warning btn-sm float-left"><i class="mdi mdi-chevron-double-left"></i> Back</a>
                                    <a href="{{ route('admin.certificate.edit', $certificate->id) }}" class="btn btn-outline-primary btn-sm float-right"><i class="mdi mdi-account-edit"></i> Edit</a>
                                </div>
                                <div class="col-md-6">
                                    <img class="img-fluid" src="{{ asset('img/verified.jpg') }}" alt="VERIFIED">
                                    <h1 class="display-2 text-success text-center">VERIFIED</h1>
                                </div>
                            </div>

                        </div>
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
