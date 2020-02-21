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
                                <form action="{{ route('admin.general.questions.update', $question->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf @method('patch')
                                    <h4><label for="question">Question</label></h4>
                                    <div class="form-group">
                                        <textarea name="question" id="question" cols="30" rows="3" class="form-control form-control-sm {{ $errors->has('question') ? ' is-invalid' : '' }}">{{ $question->question }}</textarea>
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

                                    @if ($question->question_image != null)
                                        <div class="form-group">
                                            <img src="{{ asset('admin_assets/images/tests/question_images/' . $question->question_image) }}" alt="" class="img-fluid img-responsive" width="580" height="400">
                                        </div>
                                    @endif


                                    <?php $n = 1; ?>

                                    @foreach ($question->options as $key => $option)
                                        <h6><label for="option_{{ $key + 1 }}">Option {{ $key + 1 }}</label></h6>
                                        <div class="form-group">
                                            <textarea name="option_{{ $key + 1 }}" id="option_{{ $key + 1 }}" cols="30" rows="1" class="form-control form-control-sm">{{ $option->option_text }}</textarea>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" value="0" type="hidden" name="correct_{{ $key + 1 }}" id="correct_{{ $key + 1 }}">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" value="1" {{ $option->correct == 1 ? 'checked' : '' }} type="checkbox" name="correct_{{ $key + 1 }}" id="correct_{{ $key + 1 }}"> Correct
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <a href="{{ route('admin.general.questions.show', $question->general_test_id) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-chevron-double-left"></i>Back To Questions</a>
                                        <button type="submit" class="btn btn-outline-warning btn-sm float-right">Update <i class="mdi mdi-content-save-all"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <a href="{{ route('admin.general.questions.show', $question->general_test_id) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-chevron-double-left"></i>Back To Questions</a>
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