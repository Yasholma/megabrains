<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use Bitfumes\Multiauth\Model\Admin;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function courses()
    {
        $admin_id = Auth()->user()->id;
        $adminInfo = Admin::find($admin_id);
        if ($adminInfo->email !== 'super@admin.com') {
            $courses = Course::where('tutor_id', $admin_id)
                                ->where('active', true)
                                ->get();
        } else {
            $courses = Course::where('active', true)->get();
        }

        foreach ($courses as $course) {
            echo "<option value='$course->id'>$course->title</option>";
        }
    }

    public function addLecture()
    {
        return view('vendor.multiauth.courses.addLectures');
    }

    public function addSection()
    {
        return view('vendor.multiauth.courses.addSection');
    }
}
