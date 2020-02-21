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
                            <div class="card-header">
                                <a href="{{ route('admin.general.test.create') }}" class="btn btn-sm btn-outline-primary float-right">Add New General Test</a>
                            </div>

                            <div class="card-body pb-0">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Test Title</th>
                                        <th>Test Description</th>
                                        <th>Time</th>
                                        <th>Date Created</th>
                                        <th>Author</th>
                                        <th>Test Link</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gtests as $test)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.general.questions.show', $test->id) }}" class="alert-link">{{ $test->course->title }}</a>
                                                </td>
                                                <td>{{ $test->test_desc }}</td>
                                                <td>{{ secToHR(0 . $test->time) }}</td>
                                                <td>{{ $test->created_at->toFormattedDateString() }}</td>
                                                <td>{{ Auth()->user()->id == $test->tutor_id ? 'Self' : $test->course->tutor->name }}</td>
                                                <td><a>{{ 'https://megabrainsinfotech.com/student/general/test/' . $test->id }}</a></td>
                                                <td>
                                                   @if (Auth()->user()->id == $test->tutor_id)
                                                   <a href="{{ route('admin.general.test.admin.view', [$test->id, $test->course->title]) }}" class="btn btn-sm btn-outline-primary mb-2">results</a>
                                                        @if ($test->published)
                                                            <form action="{{ route('admin.general.test.publish', $test->id) }}" method="post">
                                                                @csrf @method('patch')
                                                                <button type="submit" class="btn btn-success btn-xs"><i class="mdi mdi-checkbox-marked-circle"></i></button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.general.test.publish', $test->id) }}" method="post">
                                                                @csrf @method('patch')
                                                                <button type="submit" class="btn btn-danger btn-xs"><i class="mdi mdi-checkbox-blank-circle"></i></button>
                                                            </form>
                                                        @endif
                                                   @endif
                                                </td>
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
