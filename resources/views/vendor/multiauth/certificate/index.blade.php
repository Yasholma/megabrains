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
                            <div class="card-header">All Certificates <a href="{{ route('admin.certificate.create') }}" class="btn float-right btn-sm btn-gradient-primary">Add New Certificate</a></div>
                            @include('multiauth::message')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                        <tr>
                                            <th>
                                                Category ID
                                            </th>
                                            <th>
                                                Date Added
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($certificates as $cert)
                                            <tr>
                                                <td>
                                                    {{ $cert->certificate_id }}
                                                </td>
                                                <td>
                                                    {{ $cert->created_at->toFormattedDateString() }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.certificate.show', $cert->id) }}" class="btn btn-sm btn-outline-info"><i class="mdi mdi-eye-outline"></i></a>
                                                    <a href="" onclick="if (confirm('Are you sure you want to delete this certificate?')) {event.preventDefault(); document.getElementById('delete-form-{{ $cert->id }}').submit();} else {alert('Action aborted, no changes made.');} return false;" class="btn btn-xs btn-outline-danger"><i class="mdi mdi-recycle"></i></a>
                                                </td>
                                                <form id="delete-form-{{ $cert->id }}" action="{{ route('admin.certificate.delete', $cert->id) }}" method="POST" style="display: none;">
                                                    @csrf @method('delete')
                                                </form>
                                            </tr>
                                        @endforeach
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
