@extends('student.layouts.app')
@section('styles')
    <style>
        .course {
            margin-top: -24px;
            background: #c0ddf6;
            width: 100%;
            min-height: 100vh;
            height: 100%;
        }

        .course .left-panel {
            width: 100%;
            height: 40vh;
            background: #fff;
            margin: 20px 0 10px 30px;
            padding: 50px 20px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .section {
            width: 100%;
            height: auto;
            margin-left: 10px;
            padding: 50px 20px;
        }

        .sectionTitle a.title {
            text-decoration: none;
            color: #000;
            font-family: "Nunito", sans-serif;
            font-size: 2.1rem;
            letter-spacing: 0.1em;
            margin: 10px;
        }

        .sectionTitle a>.card-header {
            background: #fff;
            box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 5px 5px rgba(0, 0, 0, 0.12);
        }

        .lectureHead a.lecture {
            text-decoration: none;
            color: #6a6a6a;
            font-family: "Helvetica Neue", sans-serif;
            font-size: 1.1rem;
        }

        .lectureHead .description {
            margin-left: 20px;
            font-family: "Helvetica Neue", sans-serif;
            font-size: 18px;
            padding: 10px;
            text-align: center;
        }

        .lectureHead .description>p {
            margin: 0;
            padding: 0;
        }

        
        .lecture>.card-body {
            box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 5px 5px rgba(0, 0, 0, 0.12);
        }

        .lecture>.card-body:hover {
            background: #0d4876;
            color: #fff;
        }

        /*    Media Queries    */
        @media (min-width: 320px) and (max-width: 768px) {

            .course .left-panel {
                width: 88%;
                height: auto;
                background: #fff;
                margin: 20px auto;
                padding: 30px 20px;
                box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .course .left-panel h4 {
                font-size: 1.2rem;
                margin-top: .3rem;
            }

            .course .left-panel .progress {
                margin-top: -1rem !important;
            }

            .course .left-panel .continue-btn{
                display: none;
            }

            .course .left-panel .rating-section {
                margin-top: -.5rem !important;
            }

            .section {
                width: 100%;
                height: auto;
                margin: 0 auto;
                padding: 30px 20px;
            }

            .sectionTitle a.title {
                font-size: .1rem;
                margin: 5px;
            }

            .sectionTitle a>.card-header {
                background: #fff;
                box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 5px 5px rgba(0, 0, 0, 0.12);
            }

            .lectureHead a.lecture {
                font-size: .8rem;
            }

            .section button {
                display: none;
            }

            .lectureHead .description {
                margin-left: 10px;
                margin-top: 2px;
                font-size: .8rem;
                padding: 5px;
                text-align: left;
            }

            /*.lectureHead .description>p {*/
            /*    margin: 0;*/
            /*    padding: 0;*/
            /*}*/


            /*.lecture>.card-body {*/
            /*    box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 5px 5px rgba(0, 0, 0, 0.12);*/
            /*}*/

            /*.lecture>.card-body:hover {*/
            /*    background: #0d4876;*/
            /*    color: #fff;*/
            /*}*/


        }

    </style>
@stop
@section('content')

    <div class="container-fluid course">
        <div class="row">
            <div class="col-md-10 mx-auto mt-1">
                @include('flash-message')
            </div>
            <div class="col-md-10 ml-auto top-section">
                <div class="left-panel">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('courses/cover_images/' . $courseInfo->imagePath) }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-4 border-right">
                            <h4 class="sub-title">{{ $courseInfo->title }}</h4>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="progress mt-2">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                             role="progressbar"
                                             style="width: {{ $progress }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-1">{{ $progress }}% Completed</div>
                                    @for ($star = 1; $star <= 5; $star++)
                                        @if ($star <= $courseInfo->rating)
                                            <i class="fa fa-star text-warning"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-8 mr-auto">
                                    <a href="" class="btn btn-outline-primary continue-btn">Continue Learning <i class="fa fa-fast-forward"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 rating-section">
                            <h5><label for="rating">Ratings: {{ $courseInfo->rating }} / 5</label></h5>
                            <form action="{{ route('course.rate', $courseInfo->id) }}" method="post">
                                @csrf
                                <select name="rating" id="rating" class="form-control form-control-sm">
                                    <option value="1">Awful</option>
                                    <option value="2">Not too good</option>
                                    <option value="3">Good</option>
                                    <option value="4" selected>Satisfactory</option>
                                    <option value="5">Excellent</option>
                                </select>
                                <button type="submit" class="btn btn-outline-primary mt-1 mb-1 float-right btn-sm">Rate <i class="fa fa-thumbs-o-up"></i></button>
                            </form>
                            <div class="clearfix"></div>

                            @if ($progress == 100)
                                <small class="text-success">Congratulations on completing {{ $courseInfo->title }}. You can now proceed to take the test in order for you to request for certificate.</small>
                                <br>
                                <a href="{{ route('student.course.test', $courseInfo->id) }}" class="btn btn-sm btn-outline-success float-right">Take Test</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>

        <div class="row">
            <div class="col-md-10 mr-auto">
                <div class="section">
                    <div class="card-header text-white bg-secondary">
                        <h4>Sections ({{ $courseInfo->sections->count() }})</h4>
                    </div>
                    @foreach ($courseInfo->sections as $section)
                        <div id="section{{$section->id}}" role="tablist" aria-multiselectable="true">
                            <div class="card sectionTitle">
                                <a data-toggle="collapse" class="title" data-parent="#section{{$section->id}}" href="#section1Content{{$section->id}}"
                                   aria-expanded="true" aria-controls="section1Content{{$section->id}}">
                                    <div class="card-header" role="tab" id="section1Header{{$section->id}}">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="mb-0 text-uppercase">
                                                    {{ $section->title }}
                                                </h5>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="float-right mb-0">{{ Auth::guard('student')->user()->lessons()->where('section_id', $section->id)->count() }} of {{ $section->lectures->count() }} Completed</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="section1Content{{$section->id}}" class="collapse in lectureHead" role="tabpanel"
                                     aria-labelledby="section1Header{{$section->id}}">
                                    <div class="description text-muted">
                                        <p>{!! $section->description !!}</p>
                                    </div>
                                    @foreach ($section->lectures as $lecture)
                                        <a href="{{ route('student.dashboard.play', [$lecture->id]) }}" class="lecture">
                                            <div class="card-body">
                                                <i class="fa fa-file-movie-o mr-3"></i>
                                                @if (DB::table('lesson_student')->where('course_id', 1)->where('student_id', Auth::guard('student')->user()->id)->where('lecture_id', $lecture->id)->exists())
                                                    <div class="float-left">
                                                        <img src="{{ asset('img/w.png') }}" alt="" class="img-responsive" style="margin-top:-10px; margin-right: 10px; width: 50px; height: 50px;">
                                                    </div>
                                                @endif
                                                {{ $lecture->title }}
                                                <div class="float-right">
                                                    <button class="btn btn-sm btn-outline-success"><i class="fa fa-play"></i> Play Lecture</button>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="mt-5">
        @include('_includes.footer')
    </div>
@endsection