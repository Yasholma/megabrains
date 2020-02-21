@extends('multiauth::layouts.app')
@section('styles')
    <style>
        .comment-wrapper .panel-body {
            max-height:650px;
            overflow:auto;
            margin-top: 1rem;
        }

        .comment-wrapper .media-list .media img {
            width:64px;
            height:64px;
            border:2px solid #e5e7e8;
            margin-right: 1rem;
        }

        .comment-wrapper .media-list .media {
            border-bottom:1px dashed #efefef;
            margin-bottom:25px;
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
                <h3 class="text-center">All Testimonies</h3>
                <div class="row">
                    <div class="col-md-6 mx-auto mt-2">
                        <small>@include('flash-message')</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 card mx-auto">

                        <div class="comment-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <div class="clearfix"></div>
                                    <ul class="media-list">
                                        @foreach ($testimonies as $testimony)
                                            <li class="media">
                                                <a href="#" class="pull-left">
                                                    @if ($testimony->student->profile)
                                                        <img src="{{ asset('img/students/avatars/' . $testimony->student->profile->picture) }}" alt="Student Picture" class="img-circle">
                                                    @else
                                                        <img src="{{ asset('img/students/avatars/no_image.png') }}" alt="Student Picture" class="img-circle">
                                                    @endif
                                                    
                                                </a>
                                                <div class="media-body">
                                                <span class="text-muted pull-right">
                                                    <small class="text-muted">{{ $testimony->created_at->diffForHumans() }}</small>
                                                </span>
                                                    <strong class="text-success">{{ $testimony->student->name }}</strong>
                                                    <form action="{{ route('admin.homeContent.testimony.updateVisibility', $testimony->id) }}" style="display: inline;" method="post">
                                                        @csrf @method('patch')
                                                        @if ($testimony->is_visible)
                                                            <button type="submit" class="badge badge-pill badge-success">Visible</button>
                                                        @else
                                                            <button type="submit" class="badge badge-pill badge-danger">Not Visible</button>
                                                        @endif
                                                    </form>

                                                    <form action="{{ route('admin.homeContent.testimony.delete', $testimony->id) }}" style="display: inline;" method="post">
                                                        @csrf @method('delete')
                                                        <button type="submit" onclick="return confirm('Are you sure of you want to delete this?')" class="badge badge-pill badge-danger float-right"><i class="mdi mdi-close"></i></button>
                                                    </form>
                                                    <p>
                                                        {{ $testimony->testimony }}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                        {{ $testimonies->links() }}
                                        
                                    </ul>
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


