@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h4 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                        {{ __('Course Title') }}: {{ $course->title }}
                    </h4>
                </div>
                <div class="row">
                    <div class="col md-8 mx-auto">
                        @include('multiauth::message')
                        @if(@$msg)
                            <div class="alert alert-danger">{{ $msg }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="row mt-2">
                                <div class="col-md-10 mr-auto">
                                    @admin('super')
                                        <a href="{{ route('admin.courses.showLectures', $course->id) }}" class="btn btn-outline-info btn-sm ml-2 float-right"><i class="mdi mdi-monitor-multiple"></i> View Lessons</a>

                                        <a href="{{ route('admin.course.resources', $course->id) }}" class="btn btn-outline-primary btn-sm float-right"><i class="mdi mdi-file-document-box"></i> View Resources</a>
                                    @else
                                        <a href="{{ route('admin.courses.showLectures', $course->id) }}" class="btn btn-outline-info btn-sm ml-2 float-right"><i class="mdi mdi-monitor-multiple"></i> View Lessons</a>

                                        <a href="{{ route('admin.course.test', $course->id) }}" class="btn btn-outline-danger btn-sm ml-2 float-right"><i class="mdi mdi-comment-question-outline"></i> View Test &amp; Questions</a>

                                        <a href="{{ route('admin.course.resources', $course->id) }}" class="btn btn-outline-primary btn-sm float-right"><i class="mdi mdi-file-document-box"></i> View Resources</a>

                                    @endadmin

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <ol class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3 border-right">
                                                                <strong>{{ __('Sub Title') }}:</strong>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="float-right">
                                                                    {{ $course->sub_title }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3 border-right">
                                                                <strong>{{ __('Course Description') }}:</strong>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="float-right">
                                                                    {!! $course->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3 border-right">
                                                                <strong>{{ __('Course Offer') }}:</strong>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="float-right">
                                                                    {!!  $course->offer == 1 ? 'Free' : 'Premium: ' .'&#8358;'. $course->price !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 p-3">
                                    <img src="{{ asset('courses/cover_images') . DIRECTORY_SEPARATOR . $course->imagePath }}" width="200" height="200" class="rounded img-responsive" alt="">
                                </div>
                            </div>
                            @admin('super')
                                <div class="col-md-4 ml-auto mb-2">
                                    <form action="{{ route('admin.courses.activate', $course->id) }}" method="post">
                                        @csrf
                                        @if ($course->active == 1)
                                            <button type="submit" class="btn btn-danger">Deactivate Course</button>
                                        @else
                                            <button type="submit" class="btn btn-success">Activate Course</button>
                                        @endif
                                    </form>
                                </div>
                            @else
                                <div class="card" style="margin-top: -30px" id="lecture-zone">
                                    {{--    Add Lecture Section   --}}
                                    <form action="{{ route('admin.courses.addLectures', $course->id) }}" method="post" class="p-5" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row section">
                                            <div class="col-md-6 mr-auto">
                                                <h4 class="card-title">Section</h4>
                                                <div class="form-group">
                                                    <input type="text" name="section" id="section" value="{{ old('section') }}" class="form-control {{ $errors->has('section') ? ' is-invalid' : '' }}" placeholder="Enter Section Title" required autofocus>
                                                    @if ($errors->has('section'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('section') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div id="lecture-panel">

                                                </div>

                                                <!--<div class="row">-->
                                                <!--    <div class="col-md-12 mx-auto">-->
                                                <!--        <button type="button" class="btn btn-sm btn-outline-success" id="addLectureBtn" style="width: 150px">Add Lecture</button>-->
                                                <!--        <button type="button" class="btn btn-sm btn-outline-danger" id="removeLectureBtn" style="width: 150px">Remove Lecture</button>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h3 class="display-5">Section Description</h3>
                                                    <textarea name="sectionDesc" id="sectionDesc" cols="30" rows="10" class="form-control {{ $errors->has('sectionDesc') ? ' is-invalid' : '' }}">{{ old('sectionDesc') }}</textarea>
                                                    @if ($errors->has('sectionDesc'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('sectionDesc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('admin.courses.showLectures', $course->id) }}" class="btn btn-outline-warning btn-sm float-right">View All Lectures</a>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-warning"><i class="mdi mdi-chevron-double-left"></i> Back</a>
                                                <button type="submit" class="btn btn-outline-success float-right">Upload Lectures</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            @endadmin

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('multiauth::includes.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
@endsection

@section('scripts')
    <!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        // tinymce.init({
        //     selector: '#sectionDesc'
        // });

        var editor = CKEDITOR.replace('sectionDesc');
        
    
        // CKEDITOR.on("instanceReady", function(event) {
        //     var iframe = document.querySelector('#cke_1_contents iframe');
        //     editor.setReadOnly(true);
        //  });
    </script>

    </script>
    <script>
        addNewLecture();

        // Targeting Add Button
        $("#addLectureBtn").on('click', (e) => {
            e.preventDefault();
            addNewLecture();
        });

        $("#removeLectureBtn").on('click', (e) => {
            e.preventDefault();
            removeLecture();
        });

        
        function addNewLecture() {
            axios.get('https://megabrainsinfotech.com/admin/api/course/addLecture').then(res => $("#lecture-panel").append(res.data));
        }

        function removeLecture() {
            $("#lecture-panel").children('.lecture:last').remove();
        }

    </script>





@endsection
