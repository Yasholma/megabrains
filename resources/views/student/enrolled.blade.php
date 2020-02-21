@extends('student.layouts.app')
@section('styles')
    <style>

    </style>
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="display-4">Dashboard || Enrolled Courses</h1>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <table class="table table-responsive-lg">
                    <thead class="thead-inverse">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>COURSE TUTOR</th>
                            <th>DATE ENROLLED</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrolledCourses as $enrolled)
                            <tr>
                                <td><a href="{{ route('student.dashboard.course', $enrolled->course->id) }}" style="text-decoration: none;">{{ $enrolled->course->title }}</a></td>
                                <td>{{ $enrolled->course->tutor->name }}</td>
                                <td>{{ $enrolled->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <a href="{{ route('student.dashboard.course', $enrolled->course->id) }}" class="btn btn-info btn-sm">View course</a>
                                </td>
                            </tr>
                        @endforeach
                    {{ $enrolledCourses->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection