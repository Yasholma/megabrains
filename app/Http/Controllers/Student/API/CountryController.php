<?php

namespace App\Http\Controllers\Student\API;

use App\Country;
use App\Http\Controllers\Controller;
use App\StudentProfile;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {
        if (StudentProfile::where('student_id', Auth::guard('student')->user()->id)->exists()) {
            $stdCountry = Country::findOrFail(Auth::guard('student')->user()->profile->country_id);
            $value = $stdCountry->count() != 0 ? $stdCountry->id : 0;
            $c = $stdCountry->count() != 0 ? $stdCountry->name : '-- Select Country --';
        } else {
            $value = '';
            $c = '-- Select Country --';
        }



        echo "<option value='$value'>$c</option>";

        $countries = Country::all();

        foreach ($countries as $country) {
            echo "<option value='$country->id'>$country->name</option>";
        }
    }
}
