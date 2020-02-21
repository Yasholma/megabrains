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
                        Edit Test for  {{ $course->title }}
                    </h4>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card p-3">
                                <form action="{{ route('admin.test.update') }}" method="post">
                                    @csrf @method('patch')
                                    <input type="hidden" name="test_id" value="{{ $test->id }}">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" disabled id="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                            <option value="{{ $test->type }}">{{ ucfirst($test->type) }} Course Test</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Test Time</label>
                                        <input type="text" id="time" name="time" value="{{ $test->time }}" class="form-control {{ $errors->has('time') ? ' is-invalid' : '' }}" placeholder="Enter time in seconds">
                                        @if ($errors->has('time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('admin.course.test', $course->id) }}" class="btn btn-outline-warning">Back</a>
                                        <button type="submit" class="btn btn-outline-info float-right">Update</button>
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