@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h4 class="page-title mb-2">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                        {{ __('Course Title') }}: {{ $course->title }}
                    </h4>
                </div>
                <div class="row mb-3">
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
                            <div class="card" style="margin-top: -30px" id="lecture-zone">
                                {{--    Add Lection Section   --}}
                                <form action="{{ route('admin.courses.addMoreLectures', $section->id) }}" method="POST" class="p-5" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row section">
                                        <div class="col-md-6 mr-auto">
                                            <h4 class="card-title">Section</h4>
                                            <div class="form-group">
                                                <input type="text" name="section" id="section" readonly value="{{ $section->title }}" class="form-control">
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
                                                <textarea name="sectionDesc" id="sectionDesc" readonly cols="30" disabled rows="10" class="form-control">{{ $section->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('admin.courses.showLectures', $course->id) }}" class="btn btn-outline-warning"><i class="mdi mdi-chevron-double-left"></i> Back</a>
                                            <button type="submit" class="btn btn-outline-success float-right">Upload Lectures</button>
                                        </div>
                                    </div>



                                </form>
                            </div>

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
        var editor = CKEDITOR.replace('sectionDesc');
        
        editor.on("instanceReady", function(event) {
            // var iframe = document.querySelector('#cke_1_contents iframe');
            editor.setReadOnly(true);
         });
        // editor.setData($("#oldDesc").val());
        // tinymce.init({
        //     selector: '#sectionDesc',
        //     readonly: 1
        // });
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
