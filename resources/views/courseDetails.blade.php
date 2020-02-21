@extends('layouts.app')
@section('title', '| CourseDetails')
@section('content')
    <div>
        <div class="container mt-2 pt-2">
            @include('multiauth::message')
            <div class="row courseDetail">
                <div class="col-md-12">
                    <div class="course-head" style="background: url('{{ asset('courses/cover_images/' . $course->imagePath) }}');">
                        <div class="row">
                            <div class="col-md-6 title">
                                <h1 class="display-5"><strong class="text-white">{{ $course->title }}</strong></h1>
                            </div>
                            <div class="col-md-3">
                                <h1 class="display-5 text-white" style="background-color: #00000a; padding: 0.5rem; border-radius: 20px"><i class="fa fa-money text-white"></i>{!!  $course->offer == 1 ? 'Free' : '&#8358;'. number_format($course->price) . '.00' !!}
                                </h1>
                            </div>
                            <div class="col-md-3">
                                @if (Auth::guard('student')->user())
                                    @if (\App\CourseEnroll::where(['student_id' => Auth::guard('student')->user()->id, 'course_id' => $course->id])->exists())
                                        <a href="{{ route('student.dashboard.course', $course->id) }}" class="interestedBtn btn btn-block float-right">Continue to course</a>
                                    @else
                                        <a href="{{ route('student.enroll', $course->id) }}" class="interestedBtn btn btn-primary btn-block float-right">I'm Interested <i class="fa fa-check"></i></a>
                                    @endif
                                @else
                                    <a href="{{ route('student.enroll', $course->id) }}" class="interestedBtn btn btn-primary btn-block float-right">I'm Interested <i class="fa fa-check"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="course-content">
                        <div class="row">
                            <div class="col-md-4 mr-auto mt-2">
                                Ratings:
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($star <= $course->rating)
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="course-description">
                                    <h4>What You Will Learn:</h4>
                                    {!! $course->description !!}
                                </div>
                                @if (Auth::guard('student')->user())
                                    @if (\App\CourseEnroll::where(['student_id' => Auth::guard('student')->user()->id, 'course_id' => $course->id])->exists())
                                        <a href="{{ route('student.dashboard.course', $course->id) }}" class="interestedBtn btn btn-block float-right">Continue to course</a>
                                    @else
                                        <a href="{{ route('student.enroll', $course->id) }}" class=" btn btn-outline-primary btn-block float-right">I'm Interested <i class="fa fa-check"></i></a>
                                    @endif
                                @else
                                    <a href="{{ route('student.enroll', $course->id) }}" class=" btn btn-outline-primary btn-block float-right">I'm Interested <i class="fa fa-check"></i></a>
                                @endif
                            </div>

                            <div class="col-md-5">
                                <div class="course-instructor">
                                    <h4 class="instructor-title">Meet Your Instructor</h4>
                                    <div class="card">
                                        <div class="instructor-img">
                                            <img class="card-img-top rounded-circle" src="{{ $course->tutor->profile ? asset('admin_assets/images/faces/' . $course->tutor->profile->picture) : asset('admin_assets/images/faces/no_image.jpg') }}" alt="">
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2 border-right">
                                                    <i class="fa fa-user-circle-o pull-right"></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h4 class="card-title"> {{ $course->tutor->name }}</h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2 border-right">
                                                    <i class="fa fa-envelope pull-right"></i>
                                                </div>
                                                <div class="col-md-10">
                                                    <h4 class="card-text"> {{ $course->tutor->email }}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <hr>


    @include('_includes.footer')
@endsection
