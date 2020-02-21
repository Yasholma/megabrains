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
                        Dashboard
                    </h4>

                </div>


                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">All Categories <a href="{{ route('admin.categories.create') }}" class="btn float-right btn-sm btn-gradient-primary">Add New Category</a></div>
                            @include('multiauth::message')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                        <tr>
                                            <th>
                                                Category Name
                                            </th>
                                            <th>
                                                Date Created
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $cat)
                                                <tr>
                                                    <td>
                                                        {{ $cat->name }}
                                                    </td>
                                                    <td>
                                                        {{ $cat->created_at->toFormattedDateString() }}
                                                    </td>
                                                    <td>
                                                        @if($cat->status === 1)
                                                            <span class="mdi mdi-checkbox-marked-circle"></span>
                                                        @else
                                                            <span class="mdi mdi mdi-checkbox-blank-circle"></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="" onclick="if (confirm('Are you sure you want to delete this category?')) {event.preventDefault(); document.getElementById('delete-form-{{ $cat->id }}').submit();} else {alert('Action aborted, no changes made.');} return false;" class="btn btn-xs btn-outline-danger"><i class="mdi mdi-recycle"></i></a>
                                                    </td>
                                                    <form id="delete-form-{{ $cat->id }}" action="{{ route('admin.categories.destroy',$cat->id) }}" method="POST" style="display: none;">
                                                        @csrf @method('delete')
                                                    </form>
                                                </tr>
                                            @endforeach
{{--                                           Links in Here                     --}}
                                        </tbody>
                                    </table>
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
