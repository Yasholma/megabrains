@extends('multiauth::layouts.app')
@section('styles')
    <style>
        .mpo .row {
            margin-bottom: 10px;
        }

        .mpo .card {
            height: 27vh;
        }

        .mpo .card-body {
            overflow-y: auto;
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
                <div class="row">

                    <div class="col-md-6 mpo">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">Mission</div>
                                <div class="card-body pt-0 pt-3">
                                    {{ $mpo->mission }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card">
                                <div class="card-header">Philosophy</div>
                                <div class="card-body pt-0 pt-3">
                                    {{ $mpo->philosophy }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card">
                                <div class="card-header">Objective</div>
                                <div class="card-body pt-0 pt-3">
                                    {{ $mpo->objective }}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            @include('multiauth::message')
                            <div class="card-header">
                                <h4 class="display-4">Edit MPO</h4>
                            </div>
                            <div class="card-body pt-0 pt-2">
                                <form action="{{ route('admin.mpo') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="mission">Mission</label>
                                        <textarea name="mission" id="mission"  rows="4" class="form-control form-control-sm mb-2 {{ $errors->has('mission') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('mission'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mission') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="philosophy">Philosophy</label>
                                        <textarea name="philosophy" id="philosophy"  rows="4" class="form-control form-control-sm mb-2 {{ $errors->has('philosophy') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('philosophy'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('philosophy') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="objective">Objective</label>
                                        <textarea name="objective" id="objective"  rows="4" class="form-control form-control-sm mb-2 {{ $errors->has('objective') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('objective'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('objective') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-success float-right">Update <i class="mdi mdi-content-save-all"></i></button>
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


