@extends('multiauth::layouts.app')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    @include('flash-message')
                    <div class="row">
                        <div class="col-md-8">
                            @if ($admin->profile == null)
                                <a href="{{ route('admin.profile.create') }}" class="btn btn-gradient-primary">Add Profile</a>
                            @else
                                <a href="{{ route('admin.profile.edit', $admin->id) }}" class="btn btn-gradient-primary">Edit Profile</a>
                                <a href="{{ route('admin.profile.picture', $admin->profile->id) }}" class="btn btn-gradient-info">Change Profile Picture</a>
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">

                            </div>
                        </div>
                        <div class="col-md-4">

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