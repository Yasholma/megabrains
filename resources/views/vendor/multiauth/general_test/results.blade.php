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
                    <div class="col-md-6 mx-auto">
                        @include('flash-message')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header pb-1">
                                <strong>General Test Result for {{ $courseTitle }}</strong>
                                <a href="{{ route('admin.general.test') }}" class="btn btn-sm btn-outline-primary float-right">Back</a>
                            </div>

                            <div class="card-body p-0">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Student Names</th>
                                        <th>Result</th>
                                        <th>Date Taken</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($results as $res)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $res->student->name }}</td>
                                            <td>{{ $res->result }}%</td>
                                            <td>{{ $res->created_at->toFormattedDateString() }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
