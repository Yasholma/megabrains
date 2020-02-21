@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card p-3">
                                <form action="{{ route('admin.general.questions.store', $test->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h4><label for="question">Question</label></h4>
                                    <div class="form-group">
                                        <textarea name="question" id="question" cols="30" rows="3" class="form-control form-control-sm {{ $errors->has('question') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('question'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <h5><label for="question_image">Question Image (Optional)</label></h5>
                                    <div class="form-group">
                                        <input type="file" name="question_image" id="question_image" class="form-control form-control-sm {{ $errors->has('question_image') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('question_image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question_image') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    @for ($i = 1; $i <= 4; $i++)
                                        <h6><label for="option_{{ $i }}">Option {{ $i }}</label></h6>
                                        <div class="form-group">
                                            <textarea name="option_{{ $i }}" id="option_{{ $i }}" cols="30" rows="1" class="form-control form-control-sm"></textarea>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" value="0" type="hidden" name="correct_{{ $i }}" id="correct_{{ $i }}">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" value="1" type="checkbox" name="correct_{{ $i }}" id="correct_{{ $i }}"> Correct
                                                </label>
                                            </div>
                                        </div>
                                    @endfor

                                    <div class="form-group">
                                        <a href="{{ route('admin.general.questions.show', [$test->id]) }}" class="btn btn-outline-warning">Back</a>
                                        <button type="submit" class="btn btn-outline-primary float-right">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <a href="{{ route('admin.general.questions.show', [$test->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-chevron-double-left"></i>Back To Questions</a>
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