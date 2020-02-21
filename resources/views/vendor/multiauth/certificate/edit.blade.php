@extends('multiauth::layouts.app')
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <style>
        h1, h3, h4 {
            font-family: 'Be Vietnam', sans-serif;
        }
    </style>
@stop
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            @include('flash-message')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <div class="card p-4">
                                <form action="{{ route('admin.certificate.update', $certificate->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf @method('patch')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4><label for="certificate_id">Certificate ID</label></h4>
                                            <div class="form-group">
                                                <input type="text" name="certificate_id" id="certificate_id" value="{{ $certificate->certificate_id }}" class="form-control {{ $errors->has('certificate_id') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('certificate_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('certificate_id') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                            <h4><label for="student_name">Student Name</label></h4>
                                            <div class="form-group">
                                                <input type="text" name="student_name" value="{{ $certificate->student_name }}" id="student_name" class="form-control {{ $errors->has('student_name') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('student_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('student_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                            <h4><label for="course_name">Course Name</label></h4>
                                            <div class="form-group">
                                                <input type="text" name="course_name" value="{{ $certificate->course_name }}" id="course_name" class="form-control {{ $errors->has('course_name') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('course_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('course_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                            <h4><label for="grade">Grade</label></h4>
                                            <div class="form-group">
                                                <input type="text" name="grade" id="grade" value="{{ $certificate->grade }}" class="form-control {{ $errors->has('grade') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('grade'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('grade') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><h4>File upload</h4></label>
                                                <input type="file" name="image" value="{{ $certificate->student_image }}" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" value="{{ old('image') }}" class="form-control file-upload-info {{ $errors->has('image') ? ' is-invalid' : '' }}" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                      <button class="file-upload-browse btn btn-sm btn-gradient-primary" type="button">Upload</button>
                                                    </span>
                                                    @if ($errors->has('image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <label><strong><span class="text-info">Student Image Preview</span></strong></label>
                                                <hr>
                                                <img src="{{ asset('cert_student_images/' . $certificate->student_image) }}" id="img_prev" alt="" width="200" height="200" class="rounded rounded-circle" style="border: none;">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ route('admin.certificate') }}" class="btn btn-outline-danger">Cancel</a>
                                        <button type="submit" class="btn btn-outline-primary float-right">Update</button>
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
    <script>
        (function($) {
            'use strict';
            $(function() {
                $('.file-upload-browse').on('click', function() {
                    var file = $(this).parent().parent().parent().find('.file-upload-default');
                    file.trigger('click');
                });
                $('.file-upload-default').on('change', function() {
                    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
                });
            });
        })(jQuery);

        // Image Preview Handler
        function  readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $("#img_prev").attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload-default").change(function () {
            readUrl(this)
        })
    </script>
@stop