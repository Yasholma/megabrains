<?php

Route::group(['namespace' => 'Student'], function() {
    // Student Dashboard Handling
    Route::get('/', 'HomeController@index')->name('student.dashboard');
    Route::get('dashboard/course/{id}', 'HomeController@courseDetails')->name('student.dashboard.course');
    Route::get('course/playlecture/{id}', 'HomeController@play')->name('student.dashboard.play');
    Route::get('course/enrolled', 'HomeController@enrolled')->name('student.dashboard.enrolled');
    Route::get('course/completed', 'HomeController@completed')->name('student.dashboard.completed');

    // Student Profile
    Route::resource('dashboard/profile', 'StudentProfileController');

    // Student Feedback/Contact and Testimony
    Route::get('dashboard/feedback', 'HomeController@showFeedbackForm')->name('student.dashboard.feedback');
    Route::post('dashboard/feedback', 'HomeController@storeFeedback')->name('student.dashboard.feedback.store');
    Route::post('dashboard/testimony', 'HomeController@storeTestimony')->name('student.dashboard.testimony.store');

    // Course Enrollment
    Route::get('enroll/{courseId}', 'HomeController@enroll')->name('student.enroll');
    Route::post('course/{courseId}/rate', 'HomeController@rateCourse')->name('course.rate');

    // Student Course Test Handling
    Route::get('course/test/{courseId}', 'HomeController@showTest')->name('student.course.test');
    Route::post('course/test/result', 'HomeController@submitAnswer')->name('student.course.test.submit');
    Route::get('course/test/result/{testId}', 'HomeController@showTestResult')->name('student.test.result');
    Route::get('course/test/{courseId}/retake', 'HomeController@showTestRetake')->name('student.course.test.retake');

    // Student General Test
    Route::get('general/test/{testId}', 'HomeController@showGeneralTest')->name('general.test');
    Route::post('general/test/result', 'HomeController@submitGeneralTestAnswer')->name('student.general.test.submit');
    Route::get('general/test/result/{testId}', 'HomeController@showGeneralTestResult')->name('student.general.test.result');

    // Student Course Discussion
    Route::post('course/comment', 'HomeController@postComment')->name('student.course.comment');
    Route::post('course/comment/reply', 'HomeController@replyComment')->name('student.course.comment.reply');
    Route::post('course/comment/like/', 'HomeController@likeComment')->name('student.course.comment.like');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('student.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('student.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('student.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('student.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('student.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('student.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('student.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('student.verification.verify');


    // Country API
    Route::get('/api/countries', 'API\CountryController@index');
    Route::get('/api/country/{id}', 'API\CountryController@show');

});