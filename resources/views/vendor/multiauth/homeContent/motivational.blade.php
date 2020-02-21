@extends('multiauth::layouts.app')
@section('styles')
    <style>
        .quotes-section {
            height: 40vh;
            overflow-y: auto;
        }
        .quote {
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            margin-bottom: 10px;
        }

    /*  Video Upload Section   */
        .upload-video-section input[type='file'].form-control {
            height: auto;
        }

        .upload-quotes-section {
            margin-top: 10px;
        }

        .upload-quotes-section textarea {
            box-shadow: 0 14px 28px rgba(0,0,0,0.11), 0 5px 5px rgba(0, 0, 0, 0.11);
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="display-4">Active Motivational</h4>
                            </div>
                            <div class="card-body pt-0 pt-2">
                                <div class="row">
                                    <!--<a href="" class="btn btn-xs mb-2 btn-outline-primary">Change Video <i class="mdi mdi-pencil-box-outline"></i></a>-->
                                    <video src="{{ asset('videos/' . $active->video ) }}" width="100%" class="mb-3" controls></video>
                                </div>
                                <div class="row quotes-section">
                                    <h4>Quotes</h4>
                                    @foreach ($active->quotes as $quote)
                                        <div class="card-body quote mb-2">
                                            {{ $quote->quotes }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <!--@include('multiauth::message')-->
                            <div class="card-header">
                                <h4 class="display-4">Change Active</h4>
                            </div>
                            <div class="card-body pt-0 pt-2">
                                <form action="{{ route('admin.motivation') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="prev_video_name" value="{{ $active->video }}" >
                                    <div class="row upload-video-section">
                                        <label for="m_video">Motivation Video Upload</label>
                                        <input type="file" name="motivation_video" id="motivation_video" class="form-control form-control-sm {{ $errors->has('motivation_video') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('motivation_video'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('motivation_video') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row upload-quotes-section">
                                        <label for="quotes">Enter at most three different Quotes</label>
                                        <textarea name="quote1" id="quotes"  rows="4" class="form-control form-control-sm mb-2 {{ $errors->has('quote1') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('quote1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('quote1') }}</strong>
                                            </span>
                                        @endif

                                        <textarea name="quote2" id="quotes"  rows="4" class="form-control form-control-sm mb-2"></textarea>
                                        @if ($errors->has('quote2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('quote2') }}</strong>
                                            </span>
                                        @endif

                                        <textarea name="quote3" id="quotes"  rows="4" class="form-control form-control-sm mb-2"></textarea>
                                        @if ($errors->has('quote3'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('quote3') }}</strong>
                                            </span>
                                        @endif


                                    </div>
                                    <div class="row mt-3">
                                        <button type="submit" class="btn btn-outline-success float-right">Upload <i class="mdi mdi-upload"></i></button>
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


