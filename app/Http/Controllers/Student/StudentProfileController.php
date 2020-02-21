<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use App\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    public function index()
    {

        $profileStatus = Auth::guard('student')->user()->profile()->exists();
        if ($profileStatus) {
            $profile = Auth::guard('student')->user()->profile;
        } else {
            return view('student.profile.index')->with(['error' => 'Your profile is not available. Please click the add button.', 'profileStatus' => $profileStatus]);
        }
        return view('student.profile.index')->with(['profile' => $profile, 'profileStatus' => $profileStatus]);
    }

    public function create()
    {
        return view('student.profile.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'picture' => 'image|mimes:jpeg,jpg,png|max:512',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required|max:100'
        ]);

        $validator->validated();

        // If  picture is not available -- User didn't select any for upload
        if ($request->file('picture') == null) {
            // check the user gender - if male -> send male avatar to DB otherwise
            if ($request->gender == 'male')
                $avatar = 'male.png';
            else
                $avatar = 'female.png';
        } else {
            $image = $request->file('picture');
            $destination = 'img' . DIRECTORY_SEPARATOR . 'students' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR;
            $avatar = Auth::guard('student')->user()->id .'_'. time() .'_'. $image->getClientOriginalName();

            $image->move($destination, $avatar);
        }

        $profile = new StudentProfile;

        $profile->picture = $avatar;
        $profile->student_id = Auth::guard('student')->user()->id;
        $profile->gender = $request->gender;
        $profile->phone = $request->phone;
        $profile->country_id = $request->country;
        $profile->address = $request->address;

        $profile->save();

        return redirect(route('profile.index'))->with('message', 'Profile created successfully.');
    }

    public function show(StudentProfile $studentProfile)
    {
        //
    }


    public function edit($id)
    {
        $profileInfo = StudentProfile::find($id);
        return view('student.profile.edit')->with(['profile' => $profileInfo]);
    }


    public function update(Request $request, $id)
    {
        $prevData = StudentProfile::find($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200|min:10',
            'picture' => 'image|mimes:jpeg,jpg,png|max:512',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required|max:100'
        ]);

        $validator->validated();

        if ($request->file('picture') == null) {
            $avatar = $prevData->picture;
        } else {
            $image = $request->file('picture');
            $destination = 'img' . DIRECTORY_SEPARATOR . 'students' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR;
            $avatar = Auth::guard('student')->user()->id .'_'. time() .'_'. $image->getClientOriginalName();

            // Deleting previous avatar if not male.png or female.png

            $prevImageName = (string)strtolower($prevData->picture);
            $male = strtolower("male.png");
            $female = strtolower("female.png");

            if ($prevImageName != $male) {
                if ($prevImageName != $female) {
                    // Delete the file from disk
                    $prevImage = $prevData->picture;
                    if (file_exists($destination . $prevImage)) {
                        unlink($destination . $prevImage);
                    }
                }
            }

            $image->move($destination, $avatar);

        }

        $std = Student::find(Auth::guard('student')->user()->id);
        $std->name = $request->name;
        $std->save();

        $stdProfile = StudentProfile::find($id);
        $stdProfile->picture = $avatar;
        $stdProfile->student_id = Auth::guard('student')->user()->id;
        $stdProfile->gender = $request->gender;
        $stdProfile->phone = $request->phone;
        $stdProfile->country_id = $request->country;
        $stdProfile->address = $request->address;
        $stdProfile->save();

        return redirect(route('profile.index'))->with('message', 'Profile updated successfully.');
    }


    public function destroy(StudentProfile $studentProfile)
    {
        //
    }
}
