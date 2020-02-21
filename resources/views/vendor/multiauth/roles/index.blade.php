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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-gradient-primary text-white">
                                    Roles
                                    <span class="float-right">
                                        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-success">New Role</a>
                                    </span>
                                </div>

                                <div class="card-body">
                                    @include('multiauth::message')
                                    <ol class="list-group">
                                        @foreach ($roles as $role)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $role->name }}
                                                <span class="badge badge-primary badge-pill">{{ $role->admins->count() }} {{ ucfirst(config('multiauth.prefix')) }}</span>
                                                <div class="float-right">
                                                    <a href="" class="btn btn-sm btn-outline-danger mr-3" onclick="if (confirm('Are you sure you want to delete this role?')) {event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();}"><i class="mdi mdi-recycle"></i></a>
                                                    <form id="delete-form-{{ $role->id }}" action="{{ route('admin.role.delete',$role->id) }}" method="POST" style="display: none;">
                                                        @csrf @method('delete')
                                                    </form>

                                                    <a href="{{ route('admin.role.edit',$role->id) }}" class="btn btn-sm btn-primary mr-3"><i class="mdi mdi-tooltip-edit"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
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