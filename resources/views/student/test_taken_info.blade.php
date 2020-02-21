@extends('student.layouts.app')
@section('styles')
    <style>
        /* Mobile Phones */
        @media (min-width: 320px) and (max-width: 768px) {
            .container {
                display: grid;
                grid-template-columns: 1fr;
                grid-template-rows: 1fr 1fr;
                justify-content: center;
                align-content: center;
            }

            strong {
                display: block;
                text-align: center;
            }

            a.alert-link {
                margin: 0 auto 0 25px;
                color: #fff !important;
            }
            
            .pipe {
                display: none;
            }
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="alert alert-info" role="alert">
            <strong>{{ $info }}</strong>
            <a href="{{ route('student.course.test.retake', $course->id) }}" class="alert-link btn btn-danger btn-sm">Retake Test</a>
            <span class="pipe">||</span>
            <a href="{{ route('student.test.result', $test_id) }}" class="alert-link btn btn-success btn-sm">View Test Result</a>
        </div>
    </div>

    <div class="mt-5">
        @include('_includes.footer')
    </div>
@endsection

@section('scripts')

@stop
