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
                        All Test For {{ $course->title }}
                    </h4>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            @include('flash-message')
                            <div class="row mb-3">
                                <div class="col-md-4 mr-auto">
                                    <a href="{{ route('admin.courses.index') }}" class="btn btn-block btn-primary"><i class="mdi mdi-chevron-double-left"></i>Back to Course List</a>
                                </div>
                                <div class="col-md-4 ml-auto">
                                    <a href="{{ route('admin.test.create', $course->id) }}" class="btn btn-block btn-outline-success"><i class="mdi mdi-plus-circle"></i> Add Test</a>
                                </div>
                            </div>
                            <div class="card p-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Questions</th>
                                        <th>Test Time <small>(secs)</small></th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tests as $test)
                                            <tr>
                                                <td>{{ $test->id }}</td>
                                                <td>{{ $test->type }}</td>
                                                <td>
                                                    <a href="{{ route('admin.questions.show', $test->id) }}" class="btn btn-xs btn-outline-info"><i class="mdi mdi-view-list"></i></a>
                                                </td>
                                                <td>{{ secToHR(0 . $test->time) }}</td>
                                                <td>{{ $test->created_at->toFormattedDateString() }}</td>
                                                <td>
                                                    @if ($test->published)
                                                        <form action="{{ route('admin.test.publish', $test->id) }}" method="post">
                                                            @csrf @method('patch')
                                                            <button type="submit" class="btn btn-danger btn-sm">Un-Publish Test</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.test.publish', $test->id) }}" method="post">
                                                            @csrf @method('patch')
                                                            <button type="submit" class="btn btn-success btn-sm">Publish Test</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.test.edit', $test->id) }}" class="btn btn-outline-primary btn-xs"><i class="mdi mdi-pencil-circle"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{ $tests->links() }}
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