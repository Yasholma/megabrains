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
                        @include('flash-message')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <div class="row">
                                <div class="col-md-8 border-right card p-2">
                                    <h4 class="text-center">Resources Listing</h4>
                                    <hr>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>File Title</th>
                                            <th>Resource File</th>
                                            <th>Uploaded Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @admin('super')
                                                @foreach ($course->resources as $resource)
                                                    <tr>
                                                        <td>{{ $resource->title }}</td>
                                                        <td>{{ $resource->resource_name }}</td>
                                                        <td>{{ $resource->created_at->toFormattedDateString() }}</td>
                                                        <td>
                                                            <a href="{{ asset('courses/resources/' . $course->tutor->id . DIRECTORY_SEPARATOR . $resource->resource_name) }}" download class="btn btn-xs btn-outline-success"><i class="mdi mdi-download"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($course->resources as $resource)
                                                    <tr>
                                                        <td>{{ $resource->title }}</td>
                                                        <td>{{ $resource->resource_name }}</td>
                                                        <td>{{ $resource->created_at->toFormattedDateString() }}</td>
                                                        <td>
                                                            <a href="{{ asset('courses/resources/' . $course->tutor->id . DIRECTORY_SEPARATOR . $resource->resource_name) }}" download class="btn btn-xs btn-outline-success"><i class="mdi mdi-download"></i></a>
                                                            <button onclick="if (confirm('Are you sure you want to delete this resource?')) {event.preventDefault(); document.getElementById('delete-form-{{ $resource->id }}').submit();} else {alert('Action aborted, no changes made.');} return false;" class="btn btn-xs btn-outline-danger"><i class="mdi mdi-recycle"></i></button>
                                                        </td>
                                                        <form id="delete-form-{{ $resource->id }}" action="{{ route('admin.course.resource.destroy',$resource->id) }}" method="POST" style="display: none;">
                                                            @csrf @method('delete')
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            @endadmin
                                        </tbody>
                                    </table>
                                </div>
                                @admin('super')
                                @else
                                    <div class="col-md-4 card p-2">
                                        <h4 class="text-center">Adding More Resources</h4>
                                        <hr>
                                        <div class="card-body p-2">
                                            <form action="{{ route('admin.course.store.resources') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <div class="form-group">
                                                    <label for="title"><h4>File Title</h4></label>
                                                    <input type="text" name="title" id="title" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Enter file title">
                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label><h4>File upload</h4></label>
                                                    <input type="file" name="resource" class="file-upload-default">
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" value="{{ old('resource') }}" class="form-control file-upload-info {{ $errors->has('resource') ? ' is-invalid' : '' }}" disabled placeholder="Upload Resource">
                                                        <span class="input-group-append">
                                                          <button class="file-upload-browse btn btn-sm btn-gradient-primary" type="button">Upload</button>
                                                        </span>
                                                        @if ($errors->has('resource'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('resource') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-success"><i
                                                                class="mdi mdi-upload-multiple"></i> Upload File</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endadmin
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
    </script>
@endsection
