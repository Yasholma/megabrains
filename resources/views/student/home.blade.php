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
            .std_dash {
                margin-bottom: 1rem;
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

                <div class="row justify-content-center">
                    <div class="card text-dark">
                        <div class="card-body p-0">
                            <h4 class="card-title text-center pt-2 pl- 2 pr-2">General Test</h4>
                        </div>

                        <ul class="list-group list-group-flush">
                            @foreach ($generalTestResults as $result)
                                <li class="list-group-item"><small>{{ $result->course->title }} <a href="{{ route('student.general.test.result', $result->test_id) }}" class="btn btn-sm btn-info">view result</a></small> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    @include('flash-message')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa fa-clock-o"></i> Enrolled Courses ({{ $enrolledCourses->count() }})</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-lg table-hover">
                                <thead>
                                    <tr>
                                        <th>COURSE TITLE</th>
                                        <th>PROGRESS</th>
                                        <th>DATE ENROLLED</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($enrolledCourses as $enrolled)
                                    <tr>
                                        <td><a href="{{ route('student.dashboard.course', $enrolled->course->id) }}" style="text-decoration: none;">{{ $enrolled->course->title }}</a></td>
                                        <td>
                                            @php
                                                $totalLessons = 0;
                                                $progressPercent = 0;
                                                $sections = $enrolled->course->sections;
                                                foreach ($sections as $sec):
                                                    $totalLessons += $sec->lectures->count();
                                                endforeach;

                                                $prog = DB::table('lesson_student')->where('course_id', '=', $enrolled->course_id)->where('student_id', '=', Auth::guard('student')->user()->id)->count();

                                                if ($totalLessons > 0)
                                                    $progressPercent = ($prog / $totalLessons) * 100;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ ceil($progressPercent) }}%;"
                                                     aria-valuenow="{{ ceil($progressPercent) }}" aria-valuemin="0" aria-valuemax="100">{{ ceil($progressPercent) }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $enrolled->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ route('student.dashboard.course', $enrolled->course->id) }}" class="btn btn-info text-white btn-sm">Continue Learning <i class="fa fa-play-circle-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $enrolledCourses->links() }}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 std_dash">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary display-4 enrolled">{{ $completedCourses }}</h3>
                            <h4 class="display-4">Completed Courses</h4>
                            <a href="{{ route('student.dashboard.completed') }}" class="btn btn-outline-primary btn-block mt-4 border-0">View Courses</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 std_dash">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-primary display-4 enrolled">{{ $enrolledCount }}</h3>
                            <h4 class="display-4">Certificates Obtained</h4>
                            <a href="{{ route('student.dashboard.enrolled') }}" class="btn btn-outline-primary btn-block mt-4 border-0">View Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>
@endsection