<?php

namespace App\Http\Controllers\API;

use App\AdminProfile;
use App\Country;
use App\Http\Controllers\Controller;

class AdminCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (AdminProfile::where('admin_id', Auth()->user()->id)->exists()) {
            $admin = Country::findOrFail(Auth()->user()->profile->country_id);
            $value = $admin->count() != 0 ? $admin->id : 0;
            $c = $admin->count() != 0 ? $admin->name : '-- Select Country --';
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
