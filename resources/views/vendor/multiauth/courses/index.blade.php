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
                        All Courses
                    </h4>

                </div>


                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            @include('multiauth::message')
                            <div class="card-body">
{{--                                <h4 class="card-title">Courses Structure</h4>--}}
                                {{--             Super Admin                   --}}
                                @admin('super')
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Course Title
                                                </th>
                                                <th>
                                                    Course Tutor
                                                </th>
                                                <th>
                                                    Due Date
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($courses as $c)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.courses.show', $c->id) }}">{{ $c->title }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $c->tutor->name }}
                                                        </td>
                                                        <td>
                                                            {{ $c->created_at->toFormattedDateString() }}
                                                        </td>
                                                        <td>
                                                            <div class="progress">
                                                                @if ($c->active == 1)
                                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                @else
                                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{ $courses->links() }}
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    {{--             Tutor Section                   --}}
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Course Title
                                                    </th>
                                                    <th>
                                                        Date Created
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $c)
                                                @if (Auth()->user()->id == $c->tutor_id)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.courses.show', $c->id) }}">{{ $c->title }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $c->created_at->toFormattedDateString() }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.courses.edit', $c->id) }}" class="btn btn-xs btn-gradient-primary"><i class="mdi mdi-pen"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            {{ $courses->links() }}
                                            </tbody>
                                        </table>
                                    </div>
                                @endadmin
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