<?php

namespace App\Http\Controllers;

use App\Category;
use App\Certificate;
use App\Course;
use App\Motivations;
use App\Mpo;
use App\Partner;
use App\Testimony;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('active', 1)->latest()->take(8)->get();
        $motivation = Motivations::where('active', '=', 1)->latest()->first();
        $mpo = Mpo::first();
        $partners = Partner::where('featured', true)->latest()->limit(4)->get();
        $testimonies = Testimony::where('is_visible', true)->limit(3)->get();

        return view('index')->with([
            'courses' => $courses,
            'motivation' => $motivation,
            'mpo' => $mpo,
            'partners' => $partners,
            'testimonies' => $testimonies
        ]);
    }

    public function showCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $courses = Course::where('category_id', '=',  $categoryId)->where('active', '=', 1)->get();
        return view('showCategoryCourses')->with(['courses' => $courses, 'category' => $category]);
    }

    public function courseDetails($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('courseDetails')->with('course', $course);
    }

    public function allCourses()
    {
        $categories = Category::all();
        $allCourses = Course::where('active', 1)->latest()->get();
        return view('allCourses')->with(['allCourses' => $allCourses, 'categories' => $categories]);
    }

    public function verifyCertificate()
    {
        $courses = Course::where('active', 1)->latest()->take(8)->get();
        return view('verifyCertificate')->with(['courses' => $courses]);
    }

    public function checkCert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certNo' => 'required'
        ]);

        $validator->validated();

        $certNo = strtoupper($request->certNo);

        $checkResult = Certificate::where('certificate_id', $certNo)->exists();

        if (!$checkResult) {
            return back()->with('error','Certificate is invalid!');
        } else {
            $certificate = Certificate::where('certificate_id', $certNo)->get()->first();
            return view('validCertificate')->with(['certificate' => $certificate]);
        }
    }

    public function allPartners()
    {
        $partners = Partner::all();
        return view('partners')->with(['partners' => $partners]);
    }

    public function aboutUs()
    {
        $instructors = Admin::where('email', '!=', 'super@admin.com')->get();
        $mpo = Mpo::first();
        $testimonies = Testimony::where('is_visible', 1)->limit(3)->get();
        return view('about')->with(['instructors' => $instructors, 'mpo' => $mpo, 'testimonies' => $testimonies]);
    }
    
    
    public function contact()
    {
        return view('contact');
    }


    public function getTestimonies()
    {
        $testimonies = Testimony::where('is_visible', 1)->get();
        return view('testimonies')->with(['testimonies' => $testimonies]);
    }

}
