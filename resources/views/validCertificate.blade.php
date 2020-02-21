@extends('layouts.app')
@section('title', '| Home')

<!-- Pre Loader -->
@include('_includes.preLoader')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <style>
        .cert {
            width: 100%;
            height: 30vh;
            background-image: url("{{ asset('img/cert_bg.jpg') }}");
            background-size: 333px;
            color: #fff;
            vertical-align: center;
            text-align: center;
            position: relative;
        }

        .cert h2 {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            padding: 5px 20px;
            border: 0;
            border-radius: 0;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }

        .display-5 {
            font-size: 3.0rem;
            font-weight: 300;
            line-height: 1.1
        }

         h1, h3, h4 {
             font-family: 'Be Vietnam', sans-serif;
         }

        @media (min-width: 320px) and (max-width: 768px) {
            .cert h2 {
                font-size: 3rem;
                text-align: center;
                padding: 0 5px;
            }


        }
    </style>
@stop

@section('content')
    <!-- Main Content Start -->
    <div class="row">
        <div class="cert">
            <h2 class="display-3 text-success">VERIFIED</h2>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card p-4" style="box-shadow: 0 0 3px 3px #ccc; margin-bottom: 10px;">
                    <div class="row">
                        <div class="col-md-6 text-center border-right">
                            <img class="rounded rounded-circle"  style="width: 200px; height: 200px;"  src="{{ asset('cert_student_images/' . $certificate->student_image) }}" alt="">
                            <hr>
                            <h4>CERTIFICATE ID: <span class="text-info">{{ $certificate->certificate_id }}</span></h4>
                            <hr>
                            <h4>NAME: <span class="text-info">{{ $certificate->student_name }}</span></h4>
                            <hr>
                            <h4>COURSE NAME: <span class="text-info">{{ $certificate->course_name }}</span></h4>
                            <hr>
                            <h4>GRADE: <span class="text-info">{{ $certificate->grade }}</span></h4>
                        </div>
                        <div class="col-md-6">
                            <img class="img-fluid" src="{{ asset('img/verified.jpg') }}" alt="VERIFIED">
                            <h5 class="display-4 text-success text-center">VERIFIED</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content End -->
    <hr>
    @include('_includes.footer')
@endsection


