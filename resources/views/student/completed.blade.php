@extends('student.layouts.app')
@section('styles')
    <style>
        /*    Media Queries    */
        @media (min-width: 320px) and (max-width: 768px) {
            h1 {
                font-size: 1.7rem !important;
            }

        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="display-4">Completed Courses</h1>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                @include('flash-message')
                <table class="table table-responsive-sm">
                    <thead class="thead-inverse">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>COURSE TUTOR</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedCourses as $completed)
                            <tr>
                                <td><a href="{{ route('student.dashboard.course', $completed->course->id) }}" style="text-decoration: none;">{{ $completed->course->title }}</a></td>
                                <td>{{ $completed->course->tutor->name }}</td>
                                <td>
                                    <a href="{{ route('student.dashboard.course', $completed->course->id) }}" class="btn btn-outline-info btn-sm mb-1">View course</a>
                                    <a href="{{ route('student.course.test', $completed->course->id) }}" class="btn btn-sm btn-outline-success mb-1">Take Test</a>
                                </td>
                            </tr>
                        @endforeach
                        {{ $completedCourses->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection