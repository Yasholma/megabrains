@extends('multiauth::layouts.app')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-body">
                                        <h4 class="card-title">Update profile picture</h4>
                                        <form class="forms-sample" method="post" action="{{ route('admin.profile.picture.update') }}" enctype="multipart/form-data">
                                            @csrf @method('patch')
                                            <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                                            <div class="form-group">
                                                <label>Avatar upload</label>
                                                <input type="file" name="picture" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                      <button class="file-upload-browse btn btn-gradient-primary btn-sm" type="button">Upload</button>
                                                    </span>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-gradient-primary mr-2">Upload</button>
                                            <a href="{{ route('admin.profile.index') }}" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
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
@stop