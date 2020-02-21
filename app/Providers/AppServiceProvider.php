<?php

namespace App\Providers;

use App\Category;
use App\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(190);



        view()->composer('*', function ($view) {

            $categories = Category::all();

            $avatar = "no_image.png";
            $megabrains_id = "<span class='text-danger'>No ID Yet</span>";

            if (Auth::guard('student')->check()) {
                if (StudentProfile::where('student_id', Auth::guard('student')->user()->id)->exists()) {
                    // Check if male or female
                    $profile = StudentProfile::where('student_id', Auth::guard('student')->user()->id)->first();
                    $avatar = $profile->picture;
                    $megabrains_id = Auth::guard('student')->user()->profile->country->sortname . '/' . Auth::guard('student')->user()->created_at->year . '/' . '00' . Auth::guard('student')->user()->id;
                } else {
                    $avatar = "no_image.png";
                    $megabrains_id = "<span class='text-danger'>No ID Yet</span>";
                }
            }
            $view->with(['avatar' => $avatar, 'megabrains_id' => $megabrains_id, 'categories' => $categories]);
        });
    }
}
