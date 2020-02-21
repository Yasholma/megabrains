<?php

namespace App\Http\Controllers;

use App\CourseTest;
use App\Course;
use App\GeneralQuestion;
use App\GeneralQuestionOptions;
use App\GeneralTest;
use App\StudentGeneralTestResult;
use App\Question;
use App\QuestionOptions;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($courseId)
    {
        // Checking if the Teacher created this course
        if (!Course::where('id', $courseId)->where('tutor_id', Auth()->user()->id)->exists()) {
            return redirect(route('admin.home'));
        }

        $course = Course::findOrFail($courseId);
        $tests = $course->tests()->paginate(5);

        return view('vendor.multiauth.test.index')->with(['course' => $course, 'tests' => $tests]);
    }

    public function createTest($id)
    {
        // Checking if the Teacher created this course
        if (!Course::where('id', $id)->where('tutor_id', Auth()->user()->id)->exists()) {
            return redirect(route('admin.home'));
        }
        $course = Course::findOrFail($id);
        return view('vendor.multiauth.test.create')->with(['course' => $course]);
    }

    public function editTest($testId)
    {
        $test = CourseTest::find($testId);
        $course = Course::findOrFail($test->course->id);
        return view('vendor.multiauth.test.edit')->with(['test' => $test, 'course' => $course]);
    }

    public function storeTest(Request $request)
    {
        $messages = [
            'time.integer' => 'The test time must be in seconds'
        ];

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'time' => 'required|integer'
        ], $messages);

        $validator->validated();

        if (CourseTest::where('course_id', $request->course_id)->where('type', $request->type)->exists()) {
            if ($request->type == 'final')
                return redirect(route('admin.course.test', $request->course_id))->with('error', 'Course Test Already Exists');
        }

        $test = new CourseTest;

        $test->course_id = $request->course_id;
        $test->type = $request->type;
        $test->time = $request->time;

        $test->save();

        return redirect(route('admin.course.test', $request->course_id))->with('success', 'CourseTest Created Successfully');
    }

    public function updateTest(Request $request)
    {
        $messages = [
            'time.integer' => 'The test time must be in seconds'
        ];

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'time' => 'required|integer'
        ], $messages);

        $validator->validated();

        $test = CourseTest::find($request->test_id);

        $test->time = $request->time;

        $test->save();

        return redirect(route('admin.course.test', $test->course->id))->with('success', 'Course Test Updated Successfully');
    }

    public function showQuestions($id)
    {
        $test = CourseTest::findOrFail($id);
        // Checking if the Teacher created this course
        if (!Course::where('id', $test->course->id)->where('tutor_id', Auth()->user()->id)->exists()) {
            return redirect(route('admin.home'));
        }

        $questions = Question::where('test_id',$id)->paginate(10);

        return view('vendor.multiauth.test.questions.show')->with(['test' => $test, 'questions' => $questions]);
    }

    public function addQuestion($testId)
    {
        $test = CourseTest::findOrFail($testId);
        // Checking if the Teacher created this course
        if (!Course::where('id', $test->course->id)->where('tutor_id', Auth()->user()->id)->exists()) {
            return redirect(route('admin.home'));
        }
        return view('vendor.multiauth.test.questions.create')->with(['test' => $test]);
    }

    public function storeQuestion(Request $request, $testId)
    {
        $question_image_name = null;

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        $validator->validated();

        if ($request->hasFile('question_image')) {
            $question_image = $request->file('question_image');
            // Moving to the directory and other stuff
            $question_image_name = time() .'_'. $question_image->getClientOriginalName();

            $destination = 'admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR;
            $question_image->move($destination, $question_image_name);
        }

        $question = Question::create([
            'test_id' => $testId,
            'question' => $request->question,
            'question_image' => $question_image_name
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $option = $request->input('option_' . $i, '');
            if ($option != '') {
                QuestionOptions::create([
                    'question_id' => $question->id,
                    'option_text' => $option,
                    'correct' => $request->input('correct_' . $i)
                ]);
            }
        }

        return redirect()->route('admin.questions.show', $testId)->with('success', 'Question successfully added');
    }

    public function editQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('vendor.multiauth.test.questions.edit')->with(['question' => $question]);
    }

    public function updateQuestion(Request $request, $questId)
    {
        $question_image_name = null;

        $question = Question::findOrFail($questId);

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        $validator->validated();

        if ($request->hasFile('question_image')) {
            $question_image = $request->file('question_image');
            // Moving to the directory and other stuff
            $question_image_name = time() .'_'. $question_image->getClientOriginalName();

            $destination = 'admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR;

            // Delete Previous File
            if (file_exists($destination . $question->question_image)) {
                unlink($destination . $question->question_image);
            }

            $question_image->move($destination, $question_image_name);
        }

        $question->update([
            'question' => $request->question,
            'question_image' => $question_image_name
        ]);

        QuestionOptions::where('question_id', $question->id)->delete();

        for ($i = 1; $i <= 4; $i++) {
            $option = $request->input('option_' . $i, '');
            if ($option != '') {
                QuestionOptions::create([
                    'question_id' => $question->id,
                    'option_text' => $option,
                    'correct' => $request->input('correct_' . $i)
                ]);
            }
        }

        return redirect()->route('admin.questions.show', $question->test_id)->with('success', 'Question Updated successfully');
    }

    public function publish($testId)
    {
        $test = CourseTest::find($testId);
        $status = $test->published;
        if ($status == 0) {
            $status = 1;
            // Activate course
            $test->published = $status;
            $test->save();

            return back()->with('success', 'Test has been published');
        } else {
            $status = 0;
            // Deactivate Course
            $test->published = $status;
            $test->save();

            return back()->with('warning', 'Test has been un-published');
        }
    }


    public function destroyQuestion($questionId, $test_id)
    {
        $question = Question::findOrFail($questionId);
        if (Question::where('id', $questionId)->delete()) {
            $destination = 'admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR;

            // Delete Previous File
            if (file_exists($destination . $question->question_image)) {
                unlink($destination . $question->question_image);
            }
            QuestionOptions::where('question_id', $questionId)->delete();
        }


        return redirect()->route('admin.questions.show', $test_id)->with('warning', 'Question Deleted');
    }

    // General Test Creation

    public function showGeneralTests()
    {
        $tutor_id = Auth()->user()->id;
        $adminInfo = Admin::find($tutor_id);
        if ($adminInfo->email !== 'super@admin.com') {
            $g_tests = GeneralTest::where('tutor_id', $tutor_id)->get();
        } else {
            $g_tests = GeneralTest::all();
        }
        return view('vendor.multiauth.general_test.index')->with(['gtests' => $g_tests]);
    }

    public function createGeneralTest()
    {
        return view('vendor.multiauth.general_test.create');
    }

    public function storeGeneralTest(Request $request)
    {
        // Tutor Id or Admin ID
        $tutor_id = Auth()->user()->id;
        $course_id = $request->course_title;
        $test_desc = $request->test_desc;
        $time = $request->time;

        GeneralTest::create([
            'tutor_id' => $tutor_id,
            'course_id' => $course_id,
            'test_desc' => $test_desc,
            'time' => $time
        ]);

        return redirect(route('admin.general.test'))->with(['success' => 'Test created successfully, click to add questions']);
    }

    public function showGeneralQuestions($id)
    {
        $test = GeneralTest::findOrFail($id);

        $questions = GeneralQuestion::where('general_test_id',$id)->paginate(10);

        return view('vendor.multiauth.general_test.questions.show')->with(['test' => $test, 'questions' => $questions]);
    }

    public function addGeneralQuestion($testId)
    {
        $test = GeneralTest::find($testId);
        return view('vendor.multiauth.general_test.questions.create')->with(['test' => $test]);
    }

    public function storeGeneralQuestion(Request $request, $testId)
    {
        $question_image_name = null;

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        $validator->validated();

        if ($request->hasFile('question_image')) {
            $question_image = $request->file('question_image');
            // Moving to the directory and other stuff
            $question_image_name = time() .'_'. $question_image->getClientOriginalName();

            $destination = 'admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR;
            $question_image->move($destination, $question_image_name);
        }

        $question = GeneralQuestion::create([
            'general_test_id' => $testId,
            'question' => $request->question,
            'question_image' => $question_image_name
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $option = $request->input('option_' . $i, '');
            if ($option != '') {
                GeneralQuestionOptions::create([
                    'general_question_id' => $question->id,
                    'option_text' => $option,
                    'correct' => $request->input('correct_' . $i)
                ]);
            }
        }

        return redirect()->route('admin.general.questions.show', $testId)->with('success', 'Question successfully added');
    }

    public function editGeneralQuestion($questionId)
    {
        $question = GeneralQuestion::findOrFail($questionId);
        return view('vendor.multiauth.general_test.questions.edit')->with(['question' => $question]);
    }

    public function updateGeneralQuestion(Request $request, $questId)
    {
        $question_image_name = null;

        $question = GeneralQuestion::findOrFail($questId);

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'question_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);

        $validator->validated();

        if ($request->hasFile('question_image')) {
            $question_image = $request->file('question_image');
            // Moving to the directory and other stuff
            $question_image_name = time() . '_' . $question_image->getClientOriginalName();

            $destination = public_path('admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR);

            // Delete Previous File
            if (file_exists($destination . $question->question_image)) {
                unlink($destination . $question->question_image);
            }

            $question_image->move($destination, $question_image_name);
        }
        $question->update([
            'question' => $request->question,
            'question_image' => $question_image_name
        ]);

        GeneralQuestionOptions::where('general_question_id', $question->id)->delete();

        for ($i = 1; $i <= 4; $i++) {
            $option = $request->input('option_' . $i, '');
            if ($option != '') {
                GeneralQuestionOptions::create([
                    'general_question_id' => $question->id,
                    'option_text' => $option,
                    'correct' => $request->input('correct_' . $i)
                ]);
            }
        }

        return redirect()->route('admin.general.questions.show', $question->general_test_id)->with('success', 'Question Updated successfully');
    }

    public function generalTestPublish($testId)
    {
        $test = GeneralTest::find($testId);
        $status = $test->published;
        if ($status == 0) {
            $status = 1;
            // Activate course
            $test->published = $status;
            $test->save();

            return back()->with('success', 'Test has been published');
        } else {
            $status = 0;
            // Deactivate Course
            $test->published = $status;
            $test->save();

            return back()->with('warning', 'Test has been un-published');
        }
    }
    
    
    public function destroyGeneralQuestion($questionId, $test_id)
    {
        $question = GeneralQuestion::findOrFail($questionId);
        $qImage = $question->question_image;
        if (GeneralQuestion::where('id', $questionId)->delete()) {
            $destination = public_path('admin_assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'question_images' . DIRECTORY_SEPARATOR);

            // Delete Previous File
            if (file_exists($destination . $qImage)) {
                unlink($destination . $qImage);
            }

            GeneralQuestionOptions::where('general_question_id', $questionId)->delete();
        }


        return redirect()->route('admin.general.questions.show', $test_id)->with('warning', 'Question Deleted');
    }
    
    public function getGeneralTestResultsForCourseTutor($testId, $courseTitle)
    {
        $results = StudentGeneralTestResult::where('test_id', '=', $testId)->get();
        $n = 1;

        return view('vendor.multiauth.general_test.results')->with(["results" => $results, "n" => $n, "courseTitle" => $courseTitle]);
    }
    
    
}
