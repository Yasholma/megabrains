<?php

namespace App\Http\Controllers;

use App\AdminProfile;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $id = Auth()->user()->id;
        $admin = Admin::find($id);
        return view('vendor.multiauth.profile.index')->with(['admin' => $admin]);
    }

    public function create()
    {
        $id = Auth()->user()->id;
        $admin = Admin::find($id);
        return view('vendor.multiauth.profile.create')->with(['admin' => $admin]);
    }

    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'picture' => 'image|mimes:jpeg,jpg,png|max:512',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required|max:100',
            'bio' => 'nullable|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url'
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
            $destination = public_path('admin_assets/images/faces' . DIRECTORY_SEPARATOR);
            $avatar = Auth()->user()->id .'_'. time() .'_'. $image->getClientOriginalName();

            $image->move($destination, $avatar);
        }

        $profile = new AdminProfile();

        $profile->picture = $avatar;
        $profile->admin_id = Auth()->user()->id;
        $profile->gender = $request->gender;
        $profile->phone = $request->phone;
        $profile->facebook = $request->facebook;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->country_id = $request->country;
        $profile->address = $request->address;
        $profile->biography = $request->bio;

        $profile->save();

        return redirect(route('admin.profile.index'))->with('success', 'Profile created successfully.');
    }

    public function edit($admin_id)
    {
        $profile = Admin::find($admin_id);
        return view('vendor.multiauth.profile.edit')->with(['profile' => $profile]);
    }

    public function update(Request $request, $profileId)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:10',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required|max:100',
            'bio' => 'nullable|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url'
        ]);

        $validator->validate();

        $profile = AdminProfile::find($profileId);
        $admin = Admin::find($profile->admin_id);

        $admin->name = $request->name;
        $admin->save();

        $profile->gender = $request->gender;
        $profile->phone = $request->phone;
        $profile->facebook = $request->facebook;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->country_id = $request->country;
        $profile->address = $request->address;
        $profile->biography = $request->bio;

        $profile->save();
        return redirect(route('admin.profile.index'))->with('success', 'Profile updated successfully.');
    }

    public function showPicture($profileId)
    {
        $profile = AdminProfile::find($profileId);
        return view('vendor.multiauth.profile.showPicture')->with(['profile' => $profile]);
    }

    public function updatePicture(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'picture' => 'image|mimes:jpeg,jpg,png|max:512',
        ]);

        $validator->validated();

        $profile = AdminProfile::find($request->profile_id);

        // If  picture is not available -- User didn't select any for upload
        if ($request->file('picture') == null) {
            // check the user gender - if male -> send male avatar to DB otherwise
            if ($request->gender == 'male')
                $avatar = 'male.png';
            else
                $avatar = 'female.png';
        } else {
            $prev_image = $profile->picture;
            $image = $request->file('picture');
            $destination = 'admin_assets/images/faces' . DIRECTORY_SEPARATOR;
            $avatar = Auth()->user()->id .'_'. time() .'_'. $image->getClientOriginalName();

            // removing previous image from directory
            if (file_exists($destination . $prev_image)) {
                unlink($destination . $prev_image);
            }

            $image->move($destination, $avatar);
        }

        $profile->picture = $avatar;
        $profile->save();

        return redirect(route('admin.profile.index'))->with('success', 'Profile picture updated successfully.');
    }
}
