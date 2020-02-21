<?php

namespace App\Http\Controllers;

use App\Lecture;
use App\Resource;
use App\Section;
use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\LectureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $courses = Course::paginate(10);
        return view('vendor.multiauth.courses.index')->with('courses', $courses);
    }

    public function create()
    {
        return view('vendor.multiauth.courses.create');
    }

    public function store(CourseRequest $request)
    {
        $request->validated();
        $course = new Course;

        // Form Data
        $course->title = $request->title;
        $course->sub_title = $request->sub_title;
        $course->price = $request->price ?? $request->price;
        $course->description = $request->description;
        $course->offer = $request->offer;
        $course->category_id = $request->category;
        $course->tutor_id = Auth()->user()->id;


        $coverImage = $request->file('image');
        $originalName = $coverImage->getClientOriginalName();

        $courseTitle= strtolower($request->title);
        $originalName = $courseTitle .'_'. $originalName;
        $destination = 'courses' . DIRECTORY_SEPARATOR . 'cover_images' . DIRECTORY_SEPARATOR;

        $coverImage->move($destination, $originalName);

        $course->imagePath = $originalName;


        $course->save();
        return redirect(route('admin.courses.index'))->with('message', 'New Course is created successfully. Click course to add lectures');
    }

    public function addLectures(LectureRequest $request, $courseId)
    {
        $c = new Course();

        // Working fine now
        $request->validated();
        $sectionTitle = $request->section;
        $sectionDesc = $request->sectionDesc;

        $msg = [];


        // Change done here 1
        if ($request->hasFile('lectureVid')) {
            for ($i = 0; $i < count($request->file('lectureVid')); $i++) {
                $vid = $request->file('lectureVid')[$i];
                if ($vid->getClientMimeType() != 'video/mp4') {
                    $msg['error'] = "Only mp4 files are allowed";
                }
            }
        }

        $course = Course::findOrFail($courseId);


        if ($msg) {
            return view('vendor.multiauth.courses.show')->with(['course' => $course, 'msg' => $msg['error']]);
        } else {
            $lectTitle = $request->lecture;
            $lectureNotes = $request->notes;

            // Configuring lectures video directory
            $lectureVidDestination = $course->title  . DIRECTORY_SEPARATOR . strtolower($sectionTitle);
            $destination = 'courses' . DIRECTORY_SEPARATOR . 'videos' . DIRECTORY_SEPARATOR . $course->tutor_id . DIRECTORY_SEPARATOR . $lectureVidDestination;

            // Database schema problem
            // Section Table - fields(title, description, courseId)
            $section = new Section;

            // Getting sections variables
            $section->title = $sectionTitle;
            $section->description = $sectionDesc;
            $section->course_Id = $course->id;

            // Saving Section into the database
            $section->save();
            $sectionId = $section->id;

            for ($i = 0; $i < count($lectTitle); $i++) {
                // Lecture Table - fields(title, video_link, notes, sectionId)
                $lecture = new Lecture;



                // Getting lectures table variables
                $lecture->title = $lectTitle[$i];
                $lectVideo = $request->file('lectureVid')[$i];

                if ($lectVideo != null) {
                    $lecture->video_link = $c->cleanString(basename($lectVideo->getClientOriginalName()) . '.' . $lectVideo->getClientOriginalExtension());


                    // Move lectures videos to the necessary directory
                    $lectVideo->move($destination, $c->cleanString(basename($lectVideo->getClientOriginalName()) . '.' . $lectVideo->getClientOriginalExtension()));
                }

                $lecture->notes = $lectureNotes[$i];
                $lecture->section_Id = $sectionId;

                // Save Lecture in the database
                $lecture->save();

            }

            return redirect(route('admin.courses.show', $courseId))->with('message', 'Section created and lectures successfully added.');
        }
    }

    public function addMoreLectures(Request $request, $sectionId)
    {
        $msg = [];

        $c = new Course();

        // Change done here 1
        if ($request->hasFile('lectureVid')) {
            for ($i = 0; $i < count($request->file('lectureVid')); $i++) {
                $vid = $request->file('lectureVid')[$i];
                if ($vid->getClientMimeType() != 'video/mp4') {
                    $msg['error'] = "Only mp4 files are allowed";
                }
            }
        }

        $section = Section::find($sectionId);
        $course = Course::findOrFail($section->course_id);


        if ($msg) {
            return view('vendor.multiauth.courses.showMoreLectures')->with(['course' => $course, 'msg' => $msg['error'], 'section' => $section]);
        } else {
            $lectTitle = $request->lecture;
            $lectureNotes = $request->notes;

            // Configuring lectures video directory
            $lectureVidDestination = $course->title  . DIRECTORY_SEPARATOR . strtolower($section->title);
            $destination = 'courses' . DIRECTORY_SEPARATOR . 'videos' . DIRECTORY_SEPARATOR . $course->tutor_id . DIRECTORY_SEPARATOR . $lectureVidDestination;

            for ($i = 0; $i < count($lectTitle); $i++) {
                // Lecture Table - fields(title, video_link, sectionId)
                $lecture = new Lecture;

                $lectVideo = $request->file('lectureVid')[$i];

                if ($lectVideo != null) {
                    $lecture->video_link = $c->cleanString(basename($lectVideo->getClientOriginalName()) . '.' . $lectVideo->getClientOriginalExtension());

                    // Move lectures videos to the necessary directory
                    $lectVideo->move($destination, $c->cleanString(basename($lectVideo->getClientOriginalName()) . '.' . $lectVideo->getClientOriginalExtension()));
                }

                // Getting lectures table variables
                $lecture->title = $lectTitle[$i];
                $lecture->notes = $lectureNotes[$i];
                $lecture->section_Id = $section->id;

                // Save Lecture in the database
                $lecture->save();

            }
            return redirect(route('admin.courses.showMoreLectures', $sectionId))->with('message', "Lectures successfully added to $section->title Section.");
        }
    }

    public function show(Course $course)
    {
        // Checking if the Teacher created this course Except Super Admin
        if (Auth()->user()->email != 'super@admin.com') {
            if (!Course::where('id', $course->id)->where('tutor_id', Auth()->user()->id)->exists()) {
                return abort(404);
            }
        }
        return view('vendor.multiauth.courses.show', compact('course'));
    }

    public function showLectures($courseID)
    {
        // Checking if the Teacher created this course Except Super Admin
        if (Auth()->user()->email != 'super@admin.com') {
            if (!Course::where('id', $courseID)->where('tutor_id', Auth()->user()->id)->exists()) {
                return redirect(route('admin.home'));
            }
        }

        $course = Course::findOrFail($courseID);
        return view('vendor.multiauth.courses.showLectures', compact('course'));
    }

    public function showMoreLectures($sectionId)
    {
        $section = Section::find($sectionId);
        $course = Course::find($section->course_id);

        // Checking if the Teacher created this course
        if (Auth()->user()->email != 'super@admin.com') {
            if (!Course::where('id', $section->course_id)->where('tutor_id', Auth()->user()->id)->exists()) {
                return redirect(route('admin.home'));
            }
        }

        return view('vendor.multiauth.courses.showMoreLectures', compact('section', 'course'));
    }

    public function edit(Course $course)
    {
        // Checking if the Teacher created this course
        if (!Course::where('id', $course->id)->where('tutor_id', Auth()->user()->id)->exists()) {
            return abort(404);
        }
        return view('vendor.multiauth.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if ($request->file('image') == null) {
            $originalName = $course->imagePath;
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255|min:3',
                'sub_title' => 'required|max:255',
                'description' => 'required'
            ]);
            $validator->validated();
        } elseif ($request->hasFile('image')) {
            $messages = [
                'image.required' => 'The Cover Image is required.',
                'image.image' => 'The Cover Image must be of type jpg, jpeg or png.',
            ];
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255|min:3',
                'sub_title' => 'required|max:255',
                'description' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ], $messages);
            $validator->validated();
            $coverImage = $request->file('image');
            $originalName = $coverImage->getClientOriginalName();
            $courseTitle = strtolower($request->title);
            $destination = 'courses' . DIRECTORY_SEPARATOR . 'cover_images' . DIRECTORY_SEPARATOR;
            $originalName = $courseTitle .'_'. $originalName;

            // Getting previous image path from the DB
            $prevImage = $course->imagePath;

            // Checking to see if image still exist in disk, then deleting it.
            if (file_exists($destination . $prevImage)) {
                unlink($destination . $prevImage);
            }

            // move the new file to the appropriate directory
            $coverImage->move($destination, $originalName);
        }

        $course = Course::find($course->id);

        // Form Data
        $course->title = $request->title;
        $course->sub_title = $request->sub_title;
        $course->price = $request->price === null ? null : $request->price;
        $course->description = $request->description;
        $course->offer = $request->offer;
        $course->category_id = $request->category;
        $course->tutor_id = Auth()->user()->id;
        $course->imagePath = $originalName;

        $course->save();

        return redirect(route('admin.courses.index'))->with('message', 'Course is updated successfully.');
    }

    public function activate($courseId)
    {
        $course = Course::find($courseId);
        $status = $course->active;
        if ($status == 0) {
            $status = 1;
            // Activate course
            $course->active = $status;
            $course->save();

            return back()->with('message', 'Course has been successfully activated');
        } else {
            $status = 0;
            // Deactivate Course
            $course->active = $status;
            $course->save();

            return back()->with('message', 'Course has been successfully deactivated');
        }


    }

    public function resources($courseId)
    {
        // Checking if the Teacher created this course
        if (Auth()->user()->email != 'super@admin.com') {
            if (!Course::where('id', $courseId)->where('tutor_id', Auth()->user()->id)->exists()) {
                return redirect(route('admin.home'));
            }
        }

        $course = Course::findorFail($courseId);
        return view('vendor.multiauth.courses.resources', compact('course'));
    }

    public function storeResource(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'resource' => 'required|mimes:docx,doc,pdf,zip'
        ]);

        $validator->validated();

        // Move file to resource destination
        if ($request->hasFile('resource')) {
            $resource = $request->file('resource');
            $destination = 'courses' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . $course->tutor_id . DIRECTORY_SEPARATOR;

            $ext = $resource->getClientOriginalExtension();

            $resource_name = $request->title . '.' .$ext;

            $resource->move($destination, $resource_name);
        }

        Resource::create([
           'title' => $request->title,
           'resource_name' => $resource_name,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('admin.course.resources', $course->id)->with('success', 'Resource file added successfully');
    }

    public function destroyResource($resourceId)
    {
        $resource = Resource::findOrFail($resourceId);
        $courseId = $resource->course->id;
        $resource->delete();

        return redirect()->route('admin.course.resources', $courseId)->with('warning', 'Resource file deleted successfully');
    }

    public function destroy(Course $course)
    {
        //
    }
}
