@extends('layouts.app')
@section('title', '| Home')

<!-- Pre Loader -->
@include('_includes.preLoader')

@section('styles')
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
            background: rgba(2,3,4, 0.8);
            padding: 5px;
            border: 0;
            border-radius: 5px;
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

        @media (min-width: 320px) and (max-width: 768px) {
            .cert h2 {
                font-size: 1.1rem;
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
            <h2 class="display-4-5">Verify Your Certificate By Entering The Certificate Number</h2>
        </div>
    </div>
    <div class="container mt-3">
        @include('flash-message')
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('verify') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="certNo"></label><input required autofocus type="text" name="certNo" id="certNo" class="form-control form-control-lg" placeholder="Input certificate number.">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 mx-auto">
                                <button type="submit" class="btn btn-outline-primary btn-block">Check</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <div class="row" id="course">
            <div class="course-headers">
                <h1 class="display-4 text-center mt-3 d-md-none">Our Courses</h1>
                <h3 class="text-center display-5">Learn in-demand skills on your own schedule</h3>
            </div>

            @foreach ($courses->shuffle() as $course)
                <div class="col-md-3">
                    <div class="card course">
                        <div class="card-body">
                            <h5 class="card-title" style="margin-top: -10px;">{{ strlen($course->title) > 17 ? Str::limit($course->title, $limit = 14, $end = '...') : Str::limit($course->title, $limit = 17, $end = '...') }}</h5>
                        </div>
                        <div class="cover-image">
                            <img src="{{ asset('courses/cover_images' . DIRECTORY_SEPARATOR . $course->imagePath) }}" alt="{{ $course->imagePath }}" style="max-height: 200px;">
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

    <!-- Main Content End -->

    @include('_includes.footer')
@endsection


