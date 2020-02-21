@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row align-content-center mx-auto">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header bg-gradient-success text-white">Create New Category <a href="{{ route('admin.categories.index') }}"
                                                                                                           class="btn btn-sm btn-outline-warning float-right">Back</a></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.categories.store') }}" >
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" id="name" placeholder="Category Name" required autofocus >
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" id="optionsRadios1" value="1" checked>
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status" id="optionsRadios2" value="0">
                                                InActive
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-3 float-right">
                                        <button type="submit" class="btn btn-md btn-gradient-success font-weight-small auth-form-btn">
                                            {{ __('Save') }}
                                        </button>
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
