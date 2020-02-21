@extends('student.layouts.app')
@section('styles')
    <style>
        .question-body {
            margin-bottom: 10px;
        }

        .question {
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .options {
            margin-left: 10px;
        }

        /* Mobile Phones */
        @media (min-width: 320px) and (max-width: 768px) {
            h2 {
                font-size: 1.3rem;
            }
            h5.text-info {
                font-size: .9rem;
                text-align: center;
            }
        }
    </style>
@stop
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-5 justify-content-center mx-auto">
                <a href="{{ route('student.course.test', $course->id) }}" class="alert-link float-right">Back <i class="fa fa-angle-double-left"></i></a>
                <h2 class="display-5 text-center">{{ $course->title }} Test Result </h2>
                <div class="row mt-1">
                    <div class="col-md-6">
                        <h5 class="text-info">You have {{ $success_percentage }}% success rate.</h5>
                    </div>
                    <div class="col-md-6">
                        @if ($success_percentage < 50)
                            <span class="text-danger"><strong>{{ __("Sorry, you can't apply for certificate, you have to retake the course.") }}</strong>
                            </span>
                        @else
                            <!--<a href="" class="alert-link float-right">Apply for certificate</a>-->
                        @endif

                    </div>
                </div>

                <hr>
                <?php $n = 1; ?>
                <div class="question-body">
                    @foreach ($questions as $question)
                        <div class="card mb-2">
                            <div class="card-body question">
                                {{ $n++ . '.' }} {{ $question->question }}
                            </div>
                        </div>

                        @if ($question->question_image)
                            <div class="card-img justify-content-center">
                                <img src="{{ asset('admin_assets/images/tests/question_images/' . $question->question_image) }}" class="img-fluid text-center mt-2 mb-2" alt="">
                            </div>
                        @endif
                        <input type="hidden" name="answers[{{ $question->id }}]" class="custom-control-input" value="0">

                        <div class="options">
                            @foreach ($question->options as $option)
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="answer_{{ $option->id }}" {{ $option->correct == 1 ? 'checked' : '' }} name="answers[{{ $question->id }}]" class="custom-control-input" disabled value="{{ $option->id }}">
                                    <label class="custom-control-label {{ $option->correct == 1 ? 'text-success' : '' }} " for="answer_{{ $option->id }}">{{ $option->option_text }}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    @endforeach
                </div>

                <div class="form-group">
                        <a href="{{ route('student.course.test', $course->id) }}" class="alert-link">Back <i class="fa fa-angle-double-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        @include('_includes.footer')
    </div>
@endsection

@section('scripts')

@stop
