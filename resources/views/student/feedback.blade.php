@extends('student.layouts.app')
@section('styles')
    <style>
        .std_dash {
            text-decoration: none;
            color: #6a6a6a;
        }

        .std_dash .enrolled {
            /*border: 2px solid #6d8eff;*/
            border-radius: 5px;
            background-color: rgba(200, 200, 200, 0.3);
            box-shadow: 2px 2px 5px 2px rgb(52, 58, 64);
        }

        .std_dash > .card {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            height: 50vh;
            border-radius: 15px;
        }

        .std_dash > .card:hover {
            color: #1a1a1a;
            cursor: pointer;
        }

        .std_dash a:hover {
            transform: scale(1.05);
            transition: all .3s ease-in-out;
            box-shadow: 2px 2px 5px 2px rgb(52, 58, 64);
        }

        .left-side {
            width: 100%;
            height: 100%;
            background: #2C3942;
            color: #fff;
            justify-content: center;
        }

        .left-side h6 {
            color: #a2a2a2;
        }

        .header {
            background: #fff;
            border-radius: 5px;
        }

        .header li {
            background: #fff;
            padding: 10px 0;
            list-style-type: none;
        }

        .header li:hover {
            background: #0d4876;
            color: #fff !important;
        }

        .header li>a {
            text-decoration: none;
            color: #0d4876;
            font-size: 1.3em;
        }

        .header li>a:hover {
            color: #fff;
        }

        .header .col-md-6 {
            padding: 0;
        }

        .header li.active {
            background: #1abc9c;
            color: #fff !important;
        }

        /*    Media Queries    */
        @media (min-width: 320px) and (max-width: 768px) {
            .feedback {
                margin-top: 1rem;
            }

        }





    </style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: -10px">
            <h1 class="display-5 mt-0">My Dashboard</h1>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="left-side">
                    <div class="container">
                        <div class="row header">
                            <div class="col-md-6 text-center border-right">
                                <li><a href="{{ route('profile.index') }}"><i class="fa fa-angle-double-left"></i> Profile</a></li>
                            </div>
                            <div class="col-md-6 text-center">
                                <li class="active"><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <img src="{{ asset('img/students/avatars/' . $avatar) }}" width="150" height="150" alt="" class="rounded-circle mt-3">
                    </div>

                    <div class="row justify-content-center mt-3">
                        <h4>{{ Auth::guard('student')->user()->name }}</h4><br>
                    </div>

                    <div class="row justify-content-center">
                        <h6>MegaBrains ID: {!! $megabrains_id !!}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        @include('flash-message')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 feedback">
                        <form action="{{ route('student.dashboard.feedback.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h4><label for="feedback">Feedback</label></h4>
                                <textarea id="feedback" name="feedback" class="form-control form-control-sm" rows="10" placeholder="Please, we need your response to improve."></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary float-right">Submit Feedback</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 testimony">
                        <form action="{{ route('student.dashboard.testimony.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h4><label for="testimony">Testimony</label></h4>
                                <textarea id="testimony" name="testimony" class="form-control form-control-sm" rows="10" placeholder="Please, we need your testimony or success story with MegaBrains Infotech Institute."></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success float-right">Submit Testimony</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection