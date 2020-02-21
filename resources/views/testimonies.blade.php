@extends('layouts.app')
@section('title', '| Students Stories')
@section('styles')
    <style>
        .about-section p {
            font-weight: 500;
            font-size: 16px;
            color: #00000a;
        }

        .executives {
            font-family: Roboto, sans-serif;
        }

        .testimony-card {
            background: #fff;
            height: 60vh;
            border-radius: 0;
            padding: 10px;
            color: #00000a;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin-top: 15px;
        }

    </style>
@stop
@section('content')
    <div>
        <div class="container mt-2 pt-2">
            <div class="row mt-3">
                <div class="col-md-12 executives">
                    <h2 class="text-center text-info">Student Testimonies &amp; Stories</h2>
                    <div class="row mt-3">
                        @foreach ($testimonies as $tm)
                            <div class="col-md-4 col-sm-12">
                                <div class="text-center">
                                    <div class="card-body bg-info text-white mb-2" style="border-radius: 20px;">
                                        <h4 class="card-title"><img class="rounded rounded-circle" width="50" height="50"  src="{{ $tm->student->profile ? asset('img/students/avatars/' . $tm->student->profile->picture) : asset('img/students/avatars/no_image.png') }}" alt="Student Image">
                                            {{ $tm->student->name }}</h4>
                                        <p id="testimony-body" class="text-white">
                                            {{ $tm->testimony }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <hr>
    @include('_includes.footer')
@endsection
