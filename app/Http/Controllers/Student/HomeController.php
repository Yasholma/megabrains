<?php

namespace App\Http\Controllers\Student;

use App\CommentLike;
use App\Course;
use App\CourseEnroll;
use App\CourseTest;
use App\Feedback;
use App\GeneralQuestion;
use App\GeneralTest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StepsController;
use App\Lecture;
use App\Question;
use App\StudentCourseDiscussion;
use App\StudentGeneralTestAnswer;
use App\StudentGeneralTestResult;
use App\StudentTestAnswer;
use App\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    protected $redirectTo = '/student/login';

    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        $studentID = Auth::guard('student')->user()->id;
        $enrolledCount = CourseEnroll::where('student_id', $studentID)->where('completed', false)->count();
        $completedCourses = CourseEnroll::where('student_id', $studentID)->where('completed', true)->count();
        $enrolledCourses = CourseEnroll::where('student_id', $studentID)->where('completed', false)->latest()->paginate(5);

        $generalTestResults = StudentGeneralTestResult::where('student_id', '=', $studentID)->get();

        return view('student.home')->with(['enrolledCount' => $enrolledCount, 'completedCourses' => $completedCourses, 'enrolledCourses' => $enrolledCourses, 'generalTestResults' => $generalTestResults]);
    }

    public function enroll($courseId)
    {
        $studentID = Auth::guard('student')->user()->id;
        $course = Course::find($courseId);

        // Checking If Student has already enrolled for this course
        $enroll = CourseEnroll::where('course_id', $courseId)->where('student_id', $studentID)->exists();

        // If Not enrolled
        if (!$enroll) {
            // Check if course is a paid course
            if ($course->offer == 2) {
                $coursePrice = $course->price;
                return view('payment')->with(['course' => $course, 'price' => $coursePrice]);
            }


            // Enroll Student
            $courseEnroll  = new CourseEnroll;
            $courseEnroll->student_id = $studentID;
            $courseEnroll->course_id = $courseId;
            $courseEnroll->save();

            return back()->with("message", "Congratulations, you have been successfully enrolled to {$course->title}.");
        } else {
            // Notify Student that he/she has been enrolled
            return back()->with("error", "You have been enrolled in this course already.");
        }

    }

    public function rateCourse($course_id, Request $request)
    {
        $rating = $request->rating;
        CourseEnroll::where('student_id', Auth::guard('student')->user()->id)->where('course_id', $course_id)->update(['rating' => $rating]);

        return redirect()->back()->with('success', 'Thank you for rating this course.');
    }

    public function enrolled()
    {
        $studentID = Auth::guard('student')->user()->id;
        $enrolledCourses = CourseEnroll::where('student_id', $studentID)->where('completed', false)->latest()->paginate(5);

        return view('student.enrolled', compact('enrolledCourses'));
    }

    public function completed()
    {
        $studentID = Auth::guard('student')->user()->id;
        $completedCourses = CourseEnroll::where('student_id', $studentID)->where('completed', true)->latest()->paginate(5);

        return view('student.completed', compact('completedCourses'));
    }

    public function courseDetails($courseId)
    {

        if (DB::table('course_enrolls')->where('student_id', Auth::guard('student')->user()->id)->where('course_id', $courseId)->exists()) {
            $courseInfo = Course::findOrFail($courseId);
        } else {
            return redirect()->action('Student\HomeController@index');
        }

        $totalLessons = 0;
        $progressPercent = 0;
        foreach ($courseInfo->sections as $sec) {
            $totalLessons += $sec->lectures->count();
        }


        $prog = DB::table('lesson_student')->where('course_id', '=', $courseId)->where('student_id', '=', Auth::guard('student')->user()->id)->count();

        if ($totalLessons > 0) {
            $progressPercent = ($prog / $totalLessons) * 100;
        }

        if ($progressPercent === 100) {
            $enc = CourseEnroll::where('student_id', Auth::guard('student')->user()->id)->where('course_id', $courseId)->first();

            $enc->completed = 1;
            $enc->update();
        }

        return view('student.course')->with(['courseInfo' => $courseInfo, 'progress' => ceil($progressPercent)]);
    }

    public function play($lectureId)
    {
        $stdId = Auth::guard('student')->user()->id;
        $lecture = Lecture::findOrFail($lectureId);
        $courseId = $lecture->section->course_id;
        $course = Course::findOrFail($courseId);

        $sections = $course->sections;
        $lectures = [];

        $steps = new StepsController();

        foreach ($sections as $sec) {
            foreach ($sec->lectures as $key => $lect) {
                $steps->add($lect->id);
            }
        }

        $steps->setCurrent($lectureId);

        $current = $steps->getCurrent();
        $currentVid = Lecture::find($current);

        $prev = $steps->getPrevious();
        $next = $steps->getNext();


        if (DB::table('course_enrolls')->where('student_id', $stdId)->where('course_id', $courseId)->exists()) {
            if (Auth::guard('student')->check()) {
                if ($lecture->students()->where('id', Auth::guard('student')->user()->id)->count() == 0) {
                    $lecture->students()->attach(Auth::guard('student')->user()->id, ['course_id' => $courseId]);
                }
            }
        } else {
            return redirect()->action('Student\HomeController@index');
        }

        return view('student.play')->with(['lecture' => $currentVid, 'course' => $course, 'lectures' => $lectures, 'next' => $next, 'prev' => $prev]);
    }

    public function showTest($courseId)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $course = Course::find($courseId);
        $test = CourseTest::where('course_id', $course->id)
                            ->where('type', 'final')
                            ->where('published', true)
                            ->first();
        if (!$test)
            return back()->with('error', 'Test is not yet available for this course. Please, check back later. Thank You.');

        // Checking to see if student has already taken course test
        $student_course_test = StudentTestAnswer::where('student_id', $student_id)
                                                ->where('test_id', $test->id)->exists();
        if ($student_course_test) {
            return view('student.test_taken_info')->with(["info" => 'You have taken this test already. Choose any action below.', 'test_id' => $test->id, 'course' => $course]);
        }

        $questions = Question::where('test_id', $test->id)->get();

        return view('student.test')->with(['course' => $course, 'questions' => $questions, 'testId' => $test->id, 'test' => $test]);
    }

    public function showTestRetake($courseId)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $course = Course::find($courseId);
        $test = CourseTest::where('course_id', $course->id)
                            ->where('type', 'final')
                            ->where('published', true)
                            ->first();

        // Checking to see if student has already taken course test
        StudentTestAnswer::where('student_id', $student_id)
                                                ->where('test_id', $test->id)->delete();

        $questions = Question::where('test_id', $test->id)->get();

        return view('student.test')->with(['course' => $course, 'questions' => $questions, 'testId' => $test->id, 'test' => $test]);
    }

    public function submitAnswer(Request $request)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $test_id = $request->test_id;
        $test = CourseTest::find($test_id);
        $course = $test->course;

        $questions = Question::where('test_id', $test_id)->get();
        $question_count = $questions->count();

        // Inserting results into the database table (student_test_answers)
        foreach ($request->answers as $question_id => $answer) {

            $student_test_answer = new StudentTestAnswer;

            $student_test_answer::create([
                'student_id' => $student_id,
                'test_id' => $test_id,
                'question_id' => $question_id,
                'answer' => $answer
            ]);
        }

        // Getting back results from the answers table
        $student_test_result = StudentTestAnswer::where('student_id', $student_id)
                                                ->where('test_id', $test_id)->get();

        $correct = 0;
        $correct_answers = [];

        // Checking if results matches
        foreach ($questions as $question) {
            // question has question id
            foreach ($student_test_result as $result) {
                // result has question_id
                if ($question->id == $result->question_id) {
                    foreach ($question->options as $option) {
                        // option has correct answer which is = 1
                        if ($option->correct == 1) {
                            if ($option->id == $result->answer) {
                                $correct_answers[] = $option->id;
                                $correct += 1;
                            }
                        }
                    }
                }
            }
        }

        $wrong = $question_count - $correct;

        $success_percentage = ceil(($correct / $question_count) * 100);


        return redirect(route('student.test.result', $test_id))->with(['course' => $course, 'testId' => $test_id, 'questions' => $questions, 'correct' => $correct, 'wrong' => $wrong, 'success_percentage' => $success_percentage]);
    }

    public function showTestResult($testId)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $test = CourseTest::find($testId);
        $course = $test->course;

        $questions = Question::where('test_id', $test->id)->get();
        $question_count = $questions->count();

        // Getting back results from the answers table
        $student_test_result = StudentTestAnswer::where('student_id', $student_id)
                                                ->where('test_id', $test->id)->get();


        $correct = 0;
        $correct_answers = [];

        // Checking if results matches
        foreach ($questions as $question) {
            // question has question id
            foreach ($student_test_result as $result) {
                // result has question_id
                if ($question->id == $result->question_id) {
                    foreach ($question->options as $option) {
                        // option has correct answer which is = 1
                        if ($option->correct == 1) {
                            if ($option->id == $result->answer) {
                                $correct_answers[] = $option->id;
                                $correct += 1;
                            }
                        }
                    }
                }
            }
        }

        $s_answer = [];

        for ($i = 0; $i < count($student_test_result); $i++) {
//            $s_answer[$student_test_result[$i]->question_id ] = $student_test_result[$i]->answer;
            $s_answer[] = $student_test_result[$i]->question_id;
        }

        $wrong = $question_count - $correct;

        $success_percentage = ceil(($correct / $question_count) * 100);

        return view('student.test_result')->with(['course' => $course, 'testId' => $test->id, 'questions' => $questions, 'correct' => $correct, 'wrong' => $wrong, 'success_percentage' => $success_percentage, 'student_answers' => $s_answer]);
    }

    public function postComment(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        $course_id = $request->course_id;

        $data = Validator::make($request->all(), [
            'comment' => 'required|max:200'
        ]);

        $data->validate();

        StudentCourseDiscussion::create([
           'student_id' => $student_id,
           'course_id' => $course_id,
           'comment' => $request->comment,
            'parent_id' => null
        ]);

        return redirect()->back();
    }

    public function replyComment(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        $parent_id = $request->parent_id;
        $course_id = $request->course_id;

        $messages = [
            'reply_' . $parent_id .'.required' => 'The comment box is empty.'
        ];


        $data = Validator::make($request->all(), [
            'reply_' . $parent_id => 'required|max:200'
        ], $messages);

        $data->validate();

        $reply = Input::get('reply_' . $parent_id);


        StudentCourseDiscussion::create([
           'student_id' => $student_id,
           'course_id' => $course_id,
           'comment' => $reply,
           'parent_id' => $parent_id
        ]);

        return redirect()->back();
    }

    public function likeComment(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        $comment_id = $request->comment_id;

        // Delete if Exist
        if (CommentLike::where('student_id', $student_id)->where('comment_id', $comment_id)->exists()) {
            CommentLike::where('student_id', $student_id)
                ->where('comment_id', $comment_id)
                ->delete();

            return redirect()->back();
        }

        CommentLike::create([
           'student_id' => $student_id,
           'comment_id' => $comment_id
        ]);

        return redirect()->back();
    }

    public function showFeedbackForm()
    {
        return view('student.feedback');
    }

    public function storeFeedback(Request $request)
    {
        $messages = ['feedback.required' => 'Please, feedback field should be filled before submitting'];
        $validator = Validator::make($request->all(), [
            'feedback' => "required|min:20|max:500"
        ], $messages);

        $validator->validate();

        $student_id = Auth::guard('student')->user()->id;
        $feedback = $request->feedback;

        Feedback::create([
            'student_id' => $student_id,
            'feedback' => $feedback
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback.');
    }

    public function storeTestimony(Request $request)
    {
        $messages = ['testimony.required' => 'Please, testimony field should be filled before submitting'];
        $validator = Validator::make($request->all(), [
            'testimony' => "required|min:20|max:500"
        ], $messages);

        $validator->validate();

        $student_id = Auth::guard('student')->user()->id;
        $testimony = $request->testimony;

        Testimony::create([
            'student_id' => $student_id,
            'testimony' => $testimony
        ]);

        return redirect()->back()->with('success', 'Thank you for your testimony. It will be reviewed and displayed on the stories page.');
    }

//    student/general/test/2 test-link

    public function showGeneralTest($testId)
    {
        $student_id = Auth()->guard('student')->user()->id;

        $test = GeneralTest::where('id', $testId)
            ->where('published', true)
            ->first();

        $course = Course::find($test->course_id);

        if (!$test)
            return redirect(route('student.dashboard'))->with('error', 'Test is not yet available for this course. Please, check back later. Thank You.');

        // Checking to see if student has already taken course test
            
        $test_taken = StudentGeneralTestResult::where('student_id', '=', $student_id)->where('test_id', '=', $testId)->exists();

        if ($test_taken) {
            return redirect(route('student.dashboard'))->with(["info" => 'You have taken this test already.', 'test_id' => $test->id, 'course' => $course]);
        }

        $questions = GeneralQuestion::where('general_test_id', $test->id)->get();

        return view('student.general_test.index')->with(['course' => $course, 'questions' => $questions, 'testId' => $test->id, 'test' => $test]);
    }

    public function submitGeneralTestAnswer(Request $request)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $test_id = $request->test_id;
        $test = GeneralTest::find($test_id);
        $course = $test->course;

        $questions = GeneralQuestion::where('general_test_id', $test_id)->get();
        $question_count = $questions->count();

        // Inserting results into the database table (student_test_answers)
        foreach ($request->answers as $question_id => $answer) {

            $student_test_answer = new StudentGeneralTestAnswer;

            $student_test_answer::create([
                'student_id' => $student_id,
                'general_test_id' => $test_id,
                'question_id' => $question_id,
                'answer' => $answer
            ]);
        }

        // Getting back results from the answers table
        $student_test_result = StudentGeneralTestAnswer::where('student_id', $student_id)
            ->where('general_test_id', $test_id)->get();

        $correct = 0;
        $correct_answers = [];

        // Checking if results matches
        foreach ($questions as $question) {
            // question has question id
            foreach ($student_test_result as $result) {
                // result has question_id
                if ($question->id == $result->question_id) {
                    foreach ($question->options as $option) {
                        // option has correct answer which is = 1
                        if ($option->correct == 1) {
                            if ($option->id == $result->answer) {
                                $correct_answers[] = $option->id;
                                $correct += 1;
                            }
                        }
                    }
                }
            }
        }

        $wrong = $question_count - $correct;

        $success_percentage = ceil(($correct / $question_count) * 100);

        // Store result in another database table - Student General Test Result
        StudentGeneralTestResult::create([
           'student_id' => $student_id,
           'course_id' => $course->id,
           'test_id' => $test_id,
           'result' =>  $success_percentage
        ]);


        return redirect(route('student.general.test.result', $test_id))->with(['course' => $course, 'testId' => $test_id, 'questions' => $questions, 'correct' => $correct, 'wrong' => $wrong, 'success_percentage' => $success_percentage]);
    }

    public function showGeneralTestResult($testId)
    {
        $student_id = Auth()->guard('student')->user()->id;
        $test = GeneralTest::find($testId);
        $course = $test->course;

        $questions = GeneralQuestion::where('general_test_id', $test->id)->get();
        $question_count = $questions->count();

        // Getting back results from the answers table
        $student_test_result = StudentGeneralTestAnswer::where('student_id', $student_id)
            ->where('general_test_id', $test->id)->get();


        $correct = 0;
        $correct_answers = [];

        // Checking if results matches
        foreach ($questions as $question) {
            // question has question id
            foreach ($student_test_result as $result) {
                // result has question_id
                if ($question->id == $result->question_id) {
                    foreach ($question->options as $option) {
                        // option has correct answer which is = 1
                        if ($option->correct == 1) {
                            if ($option->id == $result->answer) {
                                $correct_answers[] = $option->id;
                                $correct += 1;
                            }
                        }
                    }
                }
            }
        }

        $s_answer = [];

        for ($i = 0; $i < count($student_test_result); $i++) {
            $s_answer[] = $student_test_result[$i]->question_id;
        }

        $wrong = $question_count - $correct;

        $success_percentage = ceil(($correct / $question_count) * 100);

        return view('student.test_result')->with(['course' => $course, 'testId' => $test->id, 'questions' => $questions, 'correct' => $correct, 'wrong' => $wrong, 'success_percentage' => $success_percentage, 'student_answers' => $s_answer]);
    }









}