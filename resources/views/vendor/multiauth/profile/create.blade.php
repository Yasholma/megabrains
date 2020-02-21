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
                                        <h4 class="card-title">Add profile</h4>
                                        <form class="forms-sample" method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                                            @csrf
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

                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" id="gender" name="gender">
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <h4 class="mb-0"><label>Social Links</label></h4>
                                            <div class="form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="text" name="facebook" id="facebook" placeholder="https://www.facebook.com/username" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('facebook'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('facebook') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="twitter">Twitter</label>
                                                <input type="text" name="twitter" id="twitter" placeholder="https://www.twitter.com/username" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('twitter'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('twitter') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="linkedin">LinkedIn</label>
                                                <input type="text" name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username" class="form-control {{ $errors->has('linkedin') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('linkedin'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select name="country" id="country" class="form-control form-control-sm {{ $errors->has('country') ? ' is-invalid' : '' }}"></select>
                                                @if ($errors->has('country'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('country') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" placeholder="+2348012345678" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="bio">Biography</label>
                                                <textarea class="form-control {{ $errors->has('bio') ? ' is-invalid' : '' }}" placeholder="Just a brief biography about yourself for the about page. Be brief please." name="bio" id="bio" rows="4"></textarea>
                                                @if ($errors->has('bio'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bio') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="City, State/Region" name="address" id="address" rows="4"></textarea>
                                                @if ($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
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
        $(function () {
            axios.get('https://megabrainsinfotech.com/admin/api/countries').then((res) => {
                $("#country").html(res.data);
            }).catch(err => console.log(err));
        });
    </script>

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