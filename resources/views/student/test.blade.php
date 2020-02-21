@extends('student.layouts.app')
@section('styles')
    <style>
        .time {
            position: fixed;
            top: 13%;
            left: 70%;
        }

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
            .container {
                display: grid;
                grid-template-columns: 1fr;
            }
            .time {
                position: fixed;
                top: 0;
                left: 8px;
                margin: 4rem auto 10rem !important;
                font-size: 1rem;
                border-bottom: 2px dashed #4ab3c4;
            }

            .time h3 {
                font-size: 1.5rem;
            }

            .question-container {
                margin: 0 !important;
                padding-top: 12rem;
            }

            .question-container h2 {
                font-size: 1.3rem;
            }

            .question-body {
                margin: 1rem auto;
            }

            .question {
                margin-left: 0;
            }

            .options {
                margin-left: 0;
            }
        }
    </style>
@stop
@section('content')

    <div class="container">
        <div class="time">
            <h3 class="display-5 text-center text-info">Time Remaining:</h3>
            <div class="clock" style="margin:2em;"></div>
        </div>
        <form action="{{ route('student.course.test.submit') }}" method="post" id="testForm">
            @csrf
            <input type="hidden" name="test_id" value="{{ $testId }}">
            <div class="row">
                <div class="col-md-8 ml-5 justify-content-center question-container">
                    <h2 class="display-5 text-center">{{ $course->title }} Test Questions || <small class="text-info">No. of Questions ({{ $questions->count() }})</small></h2>
                    <hr>
                    <?php $n = 1; ?>
                    <div class="question-body">
                        @foreach ($questions->shuffle() as $question)
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
                                @foreach ($question->options->shuffle() as $option)
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="answer_{{ $option->id }}" name="answers[{{ $question->id }}]" class="custom-control-input" value="{{ $option->id }}">
                                        <label class="custom-control-label" for="answer_{{ $option->id }}">{{ $option->option_text }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary float-right" type="submit">Submit <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5">
        @include('_includes.footer')
    </div>
@endsection

@section('scripts')
    <script>
        let testForm = $('#testForm');
        // 1800 seconds = 30 Minutes
        let clock = $('.clock').FlipClock('{{ $test->time }}', {
            clockFace: "MinuteCounter",
                countdown: true,
                callbacks: {
                stop: function() {
                    testForm.submit();
                }
            }
        });

        // $(window).on('scroll', () => {
        //         if ($(window).scrollTop() > 0) {
        //             $('.time').slideUp();
        //         } else {
        //             $('.time').slideDown();
        //         }
        //     }
        // );


    </script>
@stop
