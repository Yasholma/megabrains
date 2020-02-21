@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-title">
                                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                  <i class="mdi mdi-test-tube"></i>
                                </span>
                                {{ ucfirst($test->type) }} Questions for {{ $test->course->title }} (No. Of Questions = {{ $questions->count() }})
                              </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('admin.course.test', $test->course->id) }}" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-chevron-double-left"></i></a>
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('admin.questions.create', $test->id) }}" class="btn btn-outline-primary btn-sm">Add Question</a>
                        </div>
                    </div>
                </div>

                <div class="main-content mb-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                @include('flash-message')
                                <div class="card p-3">
                                    <table class="table table-bordered mb-3">
                                        <thead>
                                        <tr>
                                            <th><h5>Question</h5></th>
                                            <th><h5>Options</h5></th>
                                            <th><h5>Correct Answer(s)</h5></th>
                                            <th style="width: 2%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td>{{ $question->question }}</td>
                                                    <td>
                                                        @foreach ($question->options as $option)
                                                            <li class="mb-1">{{ $option->option_text }}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($question->options as $option)
                                                            @if ($option->correct)
                                                                <li class="text-success">{{ $option->option_text }}</li>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-xs btn-outline-primary mb-1"><i class="mdi mdi-tooltip-edit"></i></a>
                                                        <a href="" class="btn btn-xs btn-outline-danger "><i class="mdi mdi-delete-forever" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $question->id }}').submit();"></i></a>

                                                        <form id="delete-form-{{ $question->id }}" action="{{ route('admin.questions.delete', [$question->id, $question->test_id]) }}" method="POST" style="display: none;">
                                                            @csrf @method('delete')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{ $questions->links() }}
                                        </tbody>
                                    </table>
                                    {{ $questions->links() }}
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