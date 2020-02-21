@extends('layouts.app')
@section('title', '| Course Category')
@section('styles')
    <style>
        .category-title {
            text-transform: uppercase;
            border: 2px solid #cacaca;
            padding: 15px;
            background: #000;
            color: #fff;
            border-radius: 5px;
        }
    </style>
@stop
@section('content')
    <div class="category-show">
        <div class="container mt-3 pt-2">
            @include('multiauth::message')
            <div class="row">
                <div class="col-md-4">
                    <div class="category-title">{{ $category->name . ' ' . __('Courses') }}</div>
                </div>
            </div>
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-3">
                        <div class="card course">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-top: -10px;">{{ strlen($course->title) > 17 ? Str::limit($course->title, $limit = 14, $end = '...') : Str::limit($course->title, $limit = 17, $end = '...') }}</h5>
                            </div>
                            <div class="cover-image">
                                <img src="{{ asset('courses/cover_images' . DIRECTORY_SEPARATOR . $course->imagePath) }}" alt=""{{ $course->imagePath }}>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle text-muted">{{ Str::limit($course->sub_title, $limit = 70, $end = '...') }}</h6>
                                Ratings:
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($star <= $course->rating)
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <hr>
                                @if (Auth::guard('student')->user())
                                    @if (\App\CourseEnroll::where(['student_id' => Auth::guard('student')->user()->id, 'course_id' => $course->id])->exists())
                                        <a href="{{ route('student.dashboard.course', $course->id) }}" class="btn btn-sm btn-outline-primary float-right">Enrolled. Continue to course</a>
                                    @else
                                        <a href="{{ route('courseDetails', $course->id) }}" class="btn btn-sm btn-outline-info float-left">Details</a>
                                        <a href="{{ route('student.enroll', $course->id) }}" class="btn btn-sm btn-outline-success float-right">Enroll Now</a>
                                    @endif
                                @else
                                    <a href="{{ route('courseDetails', $course->id) }}" class="btn btn-sm btn-outline-info float-left">Details</a>
                                    <a href="{{ route('student.enroll', $course->id) }}" class="btn btn-sm btn-outline-success float-right">Enroll Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    @include('_includes.footer')
@endsection