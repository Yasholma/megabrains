@extends('student.layouts.app')
@section('styles')
    <style>
        a.lecture{
            text-decoration: none;
            margin-top: -5px;
        }
        
        .lecture>.card-body {
            height: 10px;
            color: #000;
        }

        .lecture>.card-body:hover {

        }

        .btn.btn-xs {
            padding: 0.5rem 0.75rem;
            font-size: 0.625rem;
        }
        
        .lecture-section-sm {
            display: none;
        }

        #notes {
            padding: 10px;
            box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 5px 5px rgba(0, 0, 0, 0.12);
            border-radius: 10px;
            /*background: #2a2a2a;*/
            /*color: #fff;*/
            height: 60vh;
            overflow-y: auto;
            margin-bottom: 20px;
        }
    /*    Custom    */
        .card-inner{
            margin-left: 4rem;
            margin-top: 1.2rem;
        }


        /** ====================
         * Lista de Comentarios
         =======================*/
        .comments-container {
            margin: 20px auto 15px;
            width: 768px;
        }

        .comments-container h1 {
            font-size: 36px;
            color: #283035;
            font-weight: 400;
        }

        .comments-container h1 a {
            font-size: 18px;
            font-weight: 700;
        }

        .comments-list {
            margin-top: 30px;
            position: relative;
        }

        /**
         * Lineas / Detalles
         -----------------------*/
        .comments-list:before {
            content: '';
            width: 2px;
            height: 100%;
            background: #c7cacb;
            position: absolute;
            left: 32px;
            top: 0;
        }

        .comments-list:after {
            content: '';
            position: absolute;
            background: #c7cacb;
            bottom: 0;
            left: 27px;
            width: 7px;
            height: 7px;
            border: 3px solid #dee1e3;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .reply-list:before, .reply-list:after {display: none;}
        .reply-list li:before {
            content: '';
            width: 60px;
            height: 2px;
            background: #c7cacb;
            position: absolute;
            top: 25px;
            left: -55px;
        }


        .comments-list li {
            margin-bottom: 15px;
            display: block;
            position: relative;
        }

        .comments-list li:after {
            content: '';
            display: block;
            clear: both;
            height: 0;
            width: 0;
        }

        .reply-list {
            padding-left: 88px;
            clear: both;
            margin-top: 15px;
        }
        /**
         * Avatar
         ---------------------------*/
        .comments-list .comment-avatar {
            width: 65px;
            height: 65px;
            position: relative;
            z-index: 99;
            float: left;
            border: 3px solid #FFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .comments-list .comment-avatar img {
            width: 100%;
            height: 100%;
        }

        .reply-list .comment-avatar {
            width: 50px;
            height: 50px;
        }

        .comment-main-level:after {
            content: '';
            width: 0;
            height: 0;
            display: block;
            clear: both;
        }
        /**
         * Caja del Comentario
         ---------------------------*/
        .comments-list .comment-box {
            width: 680px;
            float: right;
            position: relative;
            -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
            -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
            box-shadow: 0 1px 1px rgba(0,0,0,0.15);
        }

        .comments-list .comment-box:before, .comments-list .comment-box:after {
            content: '';
            height: 0;
            width: 0;
            position: absolute;
            display: block;
            border-width: 10px 12px 10px 0;
            border-style: solid;
            border-color: transparent #FCFCFC;
            top: 8px;
            left: -11px;
        }

        .comments-list .comment-box:before {
            border-width: 11px 13px 11px 0;
            border-color: transparent rgba(0,0,0,0.05);
            left: -12px;
        }

        .reply-list .comment-box {
            width: 610px;
        }
        .comment-box .comment-head {
            background: #FCFCFC;
            padding: 10px 12px;
            border-bottom: 1px solid #E5E5E5;
            overflow: hidden;
            -webkit-border-radius: 4px 4px 0 0;
            -moz-border-radius: 4px 4px 0 0;
            border-radius: 4px 4px 0 0;
        }

        .comment-box .comment-head i {
            float: right;
            margin-left: 14px;
            position: relative;
            top: 2px;
            color: #A6A6A6;
            cursor: pointer;
            -webkit-transition: color 0.3s ease;
            -o-transition: color 0.3s ease;
            transition: color 0.3s ease;
        }

        .comment-box .comment-head i:hover {
            color: #03658c;
        }

        .comment-box .comment-name {
            color: #283035;
            font-size: 14px;
            font-weight: 700;
            float: left;
            margin-right: 10px;
        }

        .comment-box .comment-name a {
            color: #283035;
        }

        .comment-box .comment-head span {
            float: left;
            color: #999;
            font-size: 13px;
            position: relative;
            top: 1px;
        }

        .comment-box .comment-content {
            background: #FFF;
            padding: 12px;
            font-size: 15px;
            color: #595959;
            -webkit-border-radius: 0 0 4px 4px;
            -moz-border-radius: 0 0 4px 4px;
            border-radius: 0 0 4px 4px;
        }

        .comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
        .comment-box .comment-name.by-author:after {
            content: 'autor';
            background: #03658c;
            color: #FFF;
            font-size: 12px;
            padding: 3px 5px;
            font-weight: 700;
            margin-left: 10px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        /** =====================
         * Responsive
         ========================*/
        @media only screen and (max-width: 766px) {
            .comments-container {
                width: 380px;
            }

            .comments-list .comment-box {
                width: 390px;
            }

            .reply-list .comment-box {
                width: 300px;
            }
        }

        /*    Media Queries    */
        @media (min-width: 320px) and (max-width: 768px) {

            .currently {
                margin-bottom: 1rem !important;
            }

            .currently h4 {
                font-size: 1.1rem;
                line-height: 1.4;
            }

            .currently h4>span {
                font-size: .9rem;
                margin-bottom: 4px;
            }

            .lecture-section-md {
                display: none;
            }
            
            .lecture-section-sm {
                display: block;
            }
            
            .video-section video {
                width: 100%;
            }

            .video-section .link-btn-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }

            .prev {
                grid-column: 1/1;
                margin-left: 1.2rem;
            }

            .next {
                grid-column: 3/3 !important;
                justify-content: flex-end;
            }
            
            .other-section {
                display: grid;
                font-size: .7rem;
            }

            .discussion-section {
                overflow-x: visible;
            }

            .comments-container h1 {
                text-align: center;
                font-size: 1.4rem;
                margin-left: -116px;
            }

            .comments-container form {
                width: 83%;
            }

            .comments-container .comments-list {
                margin-left: -37px;
            }

            .comments-container .comment-content {
                font-size: 0.7rem;
            }


        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ route('student.dashboard') }}">Home</a>
                    <a class="breadcrumb-item" href="{{ route('student.dashboard.course', $course->id) }}">Lectures</a>
                    <span class="breadcrumb-item active">{{ $lecture->section->title }} :: {{ $lecture->title }}</span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 currently">
                <h4><i class="fa fa-play-circle"></i> <span>Currently Watching:</span> <strong>{{ $lecture->title }}</strong></h4>
                <h5 class="text-muted">from: <strong>{{ $course->title }}</strong> <small>with {{ $course->tutor->name }}</small></h5>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row lect-vid-section">
            <div class="col-md-4 border-right lecture-section-md">
            <!-- Meant for Left Side to display remaining lectures  -->
                <div class="card section-videos">
                    <div class="card-header text-uppercase">{{ $lecture->section->title }} ~ SECTION</div>
                    <div class="card-body">
                        @foreach ($lecture->section->lectures as $lec)
                            <a href="{{ route('student.dashboard.play', [$lec->id]) }}" class="lecture">
                                <div class="card-body">
                                    <i class="fa fa-file-movie-o mr-3"></i>
                                    @if (DB::table('lesson_student')->where('course_id', 1)->where('student_id', Auth::guard('student')->user()->id)->where('lecture_id', $lec->id)->exists())
                                        <div class="float-left">
                                            <img src="{{ asset('img/w.png') }}" alt="" class="img-responsive" style="margin-top:-7px; margin-right: 5px; width: 20px; height: 20px;">
                                        </div>
                                    @endif
                                    {{ $lec->title }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="card section-videos mt-2" style="height: 40vh; overflow-y: auto;">
                    @foreach ($course->sections as $section)
                        @if ($section->title != $lecture->section->title)
                            <div class="card-header text-uppercase">{{ $section->title }} ~ SECTION</div>
                            <div class="card-body">

                                @foreach ($section->lectures as $lect)
                                    <a href="{{ route('student.dashboard.play', [$lect->id, $lect->title]) }}" class="lecture">
                                        <div class="card-body">
                                            <i class="fa fa-file-movie-o mr-3"></i>
                                            @if (DB::table('lesson_student')->where('course_id', 1)->where('student_id', Auth::guard('student')->user()->id)->where('lecture_id', $lect->id)->exists())
                                                <div class="float-left">
                                                    <img src="{{ asset('img/w.png') }}" alt="" class="img-responsive" style="margin-top:-7px; margin-right: 5px; width: 20px; height: 20px;">
                                                </div>
                                            @endif
                                            {{ $lect->title }}
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="row mt-3 ml-2">
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('student.dashboard.course', $course->id)}}">All Sections</a>
                    </nav>
                </div>
            </div>

            <div class="col-md-8">
                <div class="video-section">
                    <div class="row justify-content-center mt-1 mb-2 link-btn-container">
                        <div class="col-md-3 mr-auto prev">
                            @if ($prev)
                                <a href="{{ route('student.dashboard.play', [$prev]) }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left"></i> Previous</a>
                            @endif
                        </div>


                        <div class="col-md-3 ml-auto next">
                            @if ($next)
                                <a href="{{ route('student.dashboard.play', [$next]) }}" class="btn btn-primary btn-sm">Next <i class="fa fa-angle-double-right"></i></a>
                            @else
                                <a href="{{ route('student.course.test', $course->id) }}" class="btn btn-success btn-sm">Take Test <i class="fa fa-question-circle"></i></a>
                            @endif
                        </div>
                    </div>

                    @if ($lecture->video_link != null)
                    <!-- Video Play  -->
                        <video controls id="player" src="{{ asset('/courses/videos/' . $course->tutor_id . '/' . $course->title .'/'. strtolower($lecture->section->title) .'/'. $lecture->video_link) }}" width="600" height="400" class="mb-5"></video>
                    @endif

                    @if ($lecture->notes)
                        <h2>Notes</h2>
                        <div id="notes">
                            {!! $lecture->notes !!}
                        </div>
                    @endif

                    <div class="row justify-content-center mt-1 mb-2 link-btn-container">
                        <div class="col-md-3 mr-auto prev">
                            @if ($prev)
                                <a href="{{ route('student.dashboard.play', [$prev]) }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left"></i> Previous</a>
                            @endif
                        </div>


                        <div class="col-md-3 ml-auto next">
                            @if ($next)
                                <a href="{{ route('student.dashboard.play', [$next]) }}" class="btn btn-primary btn-sm">Next <i class="fa fa-angle-double-right"></i></a>
                            @else
                                <a href="{{ route('student.course.test', $course->id) }}" class="btn btn-success btn-sm">Take Test <i class="fa fa-question-circle"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lecture-section-sm">
                    <div class="col-md-4 border-right lecture-section">
                        <!-- Meant for Left Side to display remaining lectures  -->
                        <div class="card section-videos">
                            <div class="card-header text-uppercase">{{ $lecture->section->title }} ~ SECTION</div>
                            <div class="card-body">
                                @foreach ($lecture->section->lectures as $lec)
                                    <a href="{{ route('student.dashboard.play', [$lec->id]) }}" class="lecture">
                                        <div class="card-body">
                                            <i class="fa fa-file-movie-o mr-3"></i>
                                            @if (DB::table('lesson_student')->where('course_id', 1)->where('student_id', Auth::guard('student')->user()->id)->where('lecture_id', $lec->id)->exists())
                                                <div class="float-left">
                                                    <img src="{{ asset('img/w.png') }}" alt="" class="img-responsive" style="margin-top:-7px; margin-right: 5px; width: 20px; height: 20px;">
                                                </div>
                                            @endif
                                            {{ $lec->title }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="card section-videos mt-2" style="height: 40vh; overflow-y: auto;">
                            @foreach ($course->sections as $section)
                                @if ($section->title != $lecture->section->title)
                                    <div class="card-header text-uppercase">{{ $section->title }} ~ SECTION</div>
                                    <div class="card-body">

                                        @foreach ($section->lectures as $lect)
                                            <a href="{{ route('student.dashboard.play', [$lect->id, $lect->title]) }}" class="lecture">
                                                <div class="card-body">
                                                    <i class="fa fa-file-movie-o mr-3"></i>
                                                    @if (DB::table('lesson_student')->where('course_id', 1)->where('student_id', Auth::guard('student')->user()->id)->where('lecture_id', $lect->id)->exists())
                                                        <div class="float-left">
                                                            <img src="{{ asset('img/w.png') }}" alt="" class="img-responsive" style="margin-top:-7px; margin-right: 5px; width: 20px; height: 20px;">
                                                        </div>
                                                    @endif
                                                    {{ $lect->title }}
                                                </div>
                                            </a>
                                        @endforeach

                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="row mt-3 ml-2">
                            <nav class="breadcrumb">
                                <a class="breadcrumb-item" href="{{ route('student.dashboard.course', $course->id)}}">All Sections</a>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="container other-section">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false">Course Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="resource" aria-selected="true">Resources</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="transcript-tab" data-toggle="tab" href="#transcript" role="tab" aria-controls="transcript" aria-selected="false">Transcript</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                {{--             Course Info Section          --}}
                                <div class="tab-pane fade show active" id="course" role="tabpanel" aria-labelledby="course-tab">
                                    <div class="container border-bottom border-primary pb-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mt-1">
                                                    <img src="{{ asset('courses/cover_images/' . $course->imagePath) }}" width="300" height="300" alt="" class="img-fluid mt-2 ml-2">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ $course->title }}</h4>
                                                        @for ($star = 1; $star <= 5; $star++)
                                                            @if ($star <= $course->rating)
                                                                <i class="fa fa-star text-warning"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 justify-content-center">
                                                <h4 class="text-center mt-1 mb-1">Instructor</h4>
                                                <div class="text-center">
                                                    <img src="{{ $course->tutor->profile->picture ? asset('admin_assets/images/faces/' . $course->tutor->profile->picture) : asset('admin_assets/images/faces/no_image.jpg') }}" width="100" height="100" alt="" class="rounded rounded-circle">
                                                    <h4 class="card-title mt-2">{{ $course->tutor->name }}</h4>
                                                    <h5 class="card-title mt-1">{{ $course->tutor->email }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--             Resources Section          --}}
                                <div class="tab-pane fade" id="resource" role="tabpanel" aria-labelledby="resource-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>File Name</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $n = 1; ?>
                                                    @foreach($course->resources as $resource)
                                                        <tr>
                                                            <td>
                                                                {{ $n++ }}
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-file-pdf-o"></i> {{ $resource->title }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ asset('courses/resources/' . $course->tutor->id . DIRECTORY_SEPARATOR . $resource->resource_name) }}" download class="btn btn-outline-success btn-xs"><i class="fa fa-download"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{--             Transcript Section          --}}
                                <div class="tab-pane fade" id="transcript" role="tabpanel" aria-labelledby="transcript-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--       Disussion Panel       --}}
                <div class="container discussion-section">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>

                    <div class="row">
                        <div class="comments-container">
                            <h1 class="text-center">Student Discussions</h1>

                            <form action="{{ route('student.course.comment') }}" method="post">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control form-control-sm {{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="Enter your comment or question here..."></textarea>
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif

                                    <button type="submit" class="btn btn-success float-right mt-2">Send <i class="fa fa-send"></i></button>
                                </div>
                            </form>

                            <div class="clearfix"></div>

                            <ul id="comments-list" class="comments-list">
                                @foreach ($course->discussions as $comment)
                                    <li class="mt-3">
                                        <div class="comment-main-level">
                                            <!-- Avatar -->
                                            <div class="comment-avatar"><img src="{{ asset('img/students/avatars/' . $comment->student->profile->picture) }}" alt=""></div>
                                            <!-- Comment-Box -->
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name by-author"><a href="">{{ $comment->student->name }}</a></h6>
                                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                    <i class="fa fa-reply" onclick="toggleReplyForm('{{ $comment->id }}')"></i>
                                                    <small class="pull-right">&nbsp;{{ \App\CommentLike::where('comment_id', $comment->id)->count() }} Likes</small>
                                                    <i class="fa fa-heart {{ \App\CommentLike::where('student_id', Auth::guard('student')->user()->id)->where('comment_id', $comment->id)->exists() ? 'text-danger' : '' }}" onclick="toggleLike('{{ $comment->id }}')"></i>
                                                </div>
                                                <div class="comment-content">
                                                    {{ $comment->comment }}
                                                </div>
                                            </div>
                                        </div>
                                        {{--                   Reply Form                     --}}
                                        <form action="{{ route('student.course.comment.reply') }}" method="post" class="mt-2 col-md-8 ml-auto replyForm_{{ $comment->id }}">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <input type="hidden" name="course_id" value="{{ $comment->course_id }}">
                                            <div class="d-none reply">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="comment-avatar"><img src="{{ asset('img/students/avatars/' . $avatar) }}" alt=""></div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea name="reply_{{ $comment->id }}" id="reply" rows="3" class="form-control form-control-sm {{ $errors->has('reply' . $comment->id) ? ' is-invalid' : '' }}" placeholder="Enter your reply here..."></textarea>
                                                        @if ($errors->has('reply' . $comment->id))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('reply' . $comment->id) }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-xs mt-1 float-right">Reply <i class="fa fa-reply"></i></button>
                                            </div>
                                        </form>

                                        <!-- Reply -->
                                        <ul class="comments-list reply-list">
                                            @foreach ($comment->replies as $reply)
                                                <li>
                                                    <!-- Avatar -->
                                                    <div class="comment-avatar"><img src="{{ asset('img/students/avatars/' . $reply->student->profile->picture) }}" alt=""></div>
                                                    <!-- Comment Box -->
                                                    <div class="comment-box">
                                                        <div class="comment-head">
                                                            <h6 class="comment-name"><a href="">{{ $reply->student->name }}</a></h6>
                                                            <span>{{ $reply->created_at->diffForHumans() }}</span>
                                                            <i class="fa fa-heart {{ \App\CommentLike::where('student_id', Auth::guard('student')->user()->id)->where('comment_id', $reply->id)->exists() ? 'text-danger' : '' }}" onclick="toggleLike('{{ $reply->id }}')"></i>
                                                            <small class="pull-right">&nbsp;{{ \App\CommentLike::where('comment_id', $reply->id)->count() }} Likes</small>
                                                        </div>
                                                        <div class="comment-content">
                                                            {{ $reply->comment }}
                                                        </div>
                                                    </div>
                                                </li>
                                                {{--                Like Form Submission                                --}}
                                                <form action="{{ route('student.course.comment.like') }}" method="post" class="like_form d-none">
                                                    @csrf
                                                    <input type="hidden" name="comment_id" class="comment_id">
                                                </form>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>


    <hr>

    <div class="mt-5">
        @include('_includes.footer')
    </div>
@endsection

@section('scripts')
    <script>

        function toggleReplyForm(commentId) {
            let replyForm = $(`.replyForm_${commentId} .reply`);

            if (replyForm.hasClass("d-none")) {
                replyForm.removeClass("d-none");
            } else {
                replyForm.addClass("d-none");
            }
        }

        function toggleLike(commentId) {
            $(".comment_id").val(commentId);
            $(".like_form").submit();
        }
    </script>
@stop