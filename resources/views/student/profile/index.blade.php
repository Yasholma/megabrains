@extends('student.layouts.app')
@section('styles')
    <style>
        .profile {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        /*    Media Queries    */
        @media (min-width: 320px) and (max-width: 768px) {
            .profile img {
                margin-left: 3.3rem;
            }

            .profile .section {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
            }

            .profile .section i {
                font-size: 1.3rem;
                grid-column: 1/1 !important;
            }

            .profile .section .name {
                grid-column: 2/6;
            }

            .profile .section h5 {
                font-size: 1.1rem;
            }

            .profile-btn-section {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-btn-section a:first-child {
                font-size: .8rem;
            }


        }
    </style>
@stop
@section('content')

    <div class="container">
        @if (!$profileStatus)
            <div class="row">
                <div class="col-md-8 mx-auto">
                        <div class="alert alert-danger">{{ $error }} <a href="{{ route('profile.create') }}" class="btn btn-outline-danger btn-sm pull-right">Add Profile</a></div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 mx-auto">
                    @include('multiauth::message')
                    <div class="card profile">
                        <div class="row p-2">
                            <div class="col-md-5 mx-auto">
                                <img width="200" height="200" src="{{ asset('img/students/avatars/' . $profile->picture) }}" class="rounded-circle" alt="{{ $profile->picture }}">
                            </div>
                        </div>
                        <hr>
                        <div class="card-body pt-0">
                            <div class="row p-2 section">
                                <div class="col-md-2 border-right">
                                    <i class="fa fa-user-circle-o fa-lg float-right mt-2 fa-2x"></i>
                                </div>
                                <div class="col-md-10 name">
                                    <h5 class="card-title mt-2"> {{ Auth::guard('student')->user()->name }}</h5>
                                </div>
                            </div>

                            <div class="row p-2 section">
                                <div class="col-md-2 border-right">
                                    <i class="fa fa-envelope fa-lg float-right mt-2 fa-2x"></i>
                                </div>
                                <div class="col-md-10 name">
                                    <h5 class="card-title mt-2"> {{ Auth::guard('student')->user()->email }}</h5>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush p-2">
                                <li class="list-group-item"><i class="fa fa-2x {{ $profile->gender == 'male' ? 'fa-male' : 'fa-female' }}"></i> {{ ucfirst($profile->gender) }}</li>
                                <li class="list-group-item"><i class="fa fa-flag"></i> {{ $profile->country->name }}</li>
                                <li class="list-group-item"><i class="fa fa-phone"></i> {{ $profile->phone }}</li>
                                <li class="list-group-item"><i class="fa fa-address-card"></i> {{ $profile->address }}</li>
                            </ul>
                        </div>
                        <div class="row p-2 profile-btn-section">
                            <div class="col-md-4 mr-auto">
                                <a href="{{ route('student.dashboard') }}" class="btn btn-warning">Back to Dashboard</a>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <a href="{{ route('profile.edit', $profile->id) }}" class="btn float-right btn-block btn-outline-primary">Edit Profile <i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection