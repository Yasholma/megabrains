@extends('multiauth::layouts.app')
@section('styles')
    <style>

    </style>
@stop
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <form action="{{route('admin.partner.update',[$partner->id])}}" method="post" enctype="multipart/form-data">
                                @csrf @method('patch')
                                <div class="form-group">
                                    <h5><label for="name">Partner Name</label></h5>
                                    <input type="text" class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $partner->name }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <h5><label for="image">Partner Image</label></h5>
                                    <input type="file" class="form-control form-control-sm {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="image">
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <h5><label for="description">Partner Description</label></h5>
                                    <textarea name="description" id="description" rows="5"
                                              class="form-control form-control-sm {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $partner->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="status" {{ $partner->featured == 1 ? 'checked' : '' }} class="custom-control-input {{ $errors->has('status') ? ' is-invalid' : '' }}" id="active" value="1">
                                        <label class="custom-control-label" for="active">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="status" {{ $partner->featured == 0 ? 'checked' : '' }} class="custom-control-input {{ $errors->has('status') ? ' is-invalid' : '' }}" id="inactive" value="0">
                                        <label class="custom-control-label" for="inactive">Inactive</label>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.homeContent.partners') }}" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-step-backward-2"></i> Back</a>

                                    <button type="submit" class="btn btn-outline-success btn-sm float-right">Update <i class="mdi mdi-content-save-outline"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card p-3">
                            <h4 class="text-center">{{ $partner->name }} Information</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <img src="{{ asset('img/partners/' . $partner->image) }}" style="border-radius: 100%" width="200" height="200" id="img_prev" alt="">
                                </div>
                            </div>
                            <div class="card-body mt-0">
                                <h5><label for="description">Description</label></h5>
                                <p style="padding: 15px; box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
">{{ $partner->description }}</p>
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


