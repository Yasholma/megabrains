<?php

    // Main Index Routing
    Route::get('/', 'WelcomeController@index')->name('index');
    Route::get('/verify', 'WelcomeController@verifyCertificate')->name('verifyCert');
    Route::get('category/{categoryId}', 'WelcomeController@showCategory')->name('category');
    Route::get('courseDetails/{courseId}', 'WelcomeController@courseDetails')->name('courseDetails');
    Route::get('courses/all', 'WelcomeController@allCourses')->name('courses.all');
    Route::get('/partners/all', 'WelcomeController@allPartners')->name('partners.all');
    Route::get('/about', 'WelcomeController@aboutUs')->name('aboutUs');
    Route::get('/contact-us', 'WelcomeController@contact')->name('contact');
    Route::get('/student-testimonies', 'WelcomeController@getTestimonies')->name('testimonies');

    // APIController
    Route::post('/search/program/{data}', 'APIController@search')->name('program.search');

    Route::post('/certificate/check', 'WelcomeController@checkCert')->name('verify');


    Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');


// Admin Section
    Route::prefix('admin')->name('admin.')->group(function () {

        // Admin Profile Handling
        Route::resource('profile', 'AdminProfileController');
        Route::get('profile/{profileId}/picture', 'AdminProfileController@showPicture')->name('profile.picture');
        Route::patch('profile/picture/update', 'AdminProfileController@updatePicture')->name('profile.picture.update');


        // Categories
        Route::resource('categories', 'CategoryController');

        // Courses
        Route::resource('courses','CourseController');

        Route::post('/courses/addLectures/{id}', 'CourseController@addLectures')->name('courses.addLectures');
        Route::post('/courses/addMoreLectures/{id}', 'CourseController@addMoreLectures')->name('courses.addMoreLectures');
        Route::post('courses/activate/{id}', 'CourseController@activate')->name('courses.activate');

        Route::get('/courses/showMoreLectures/{id}', 'CourseController@showMoreLectures')->name('courses.showMoreLectures');
        Route::get('/courses/showLectures/{id}', 'CourseController@showLectures')->name('courses.showLectures');

        Route::get('/courses/resources/{courseId}', 'CourseController@resources')->name('course.resources');
        Route::post('courses/resources/store', 'CourseController@storeResource')->name('course.store.resources');
        Route::delete('courses/resources/destroy/{resourceId}', 'CourseController@destroyResource')->name('course.resource.destroy');

        // CourseTest Handling Routes
        Route::get('/courses/{id}/test', 'TestController@index')->name('course.test');
        Route::get('/courses/{id}/createTest', 'TestController@createTest')->name('test.create');
        Route::post('/courses/test', 'TestController@storeTest')->name('test.store');
        Route::get('/courses/test/{testId}/edit/', 'TestController@editTest')->name('test.edit');
        Route::patch('/courses/test/update', 'TestController@updateTest')->name('test.update');
        Route::patch('/courses/publish/{testId}', 'TestController@publish')->name('test.publish');

        Route::get('/courses/test/questions/{id}', 'TestController@showQuestions')->name('questions.show');
        Route::get('/courses/question/add/{id}', 'TestController@addQuestion')->name('questions.create');
        Route::get('/courses/question/edit/{id}', 'TestController@editQuestion')->name('questions.edit');
        Route::delete('/courses/question/{id}/{testId}', 'TestController@destroyQuestion')->name('questions.delete');

        Route::post('/courses/question/{id}/store', 'TestController@storeQuestion')->name('questions.store');
        Route::patch('/courses/question/{id}/update', 'TestController@updateQuestion')->name('questions.update');

        // General Test Section
        Route::get('/general/tests/all', 'TestController@showGeneralTests')->name('general.test');
        Route::get('/general/test/create', 'TestController@createGeneralTest')->name('general.test.create');
        Route::post('/general/test/store', 'TestController@storeGeneralTest')->name('general.test.store');
        Route::patch('/general/publish/{testId}', 'TestController@generalTestPublish')->name('general.test.publish');

        Route::get('/general/test/questions/{id}', 'TestController@showGeneralQuestions')->name('general.questions.show');
        Route::get('/general/question/add/{id}', 'TestController@addGeneralQuestion')->name('general.questions.create');
        Route::get('/general/question/edit/{id}', 'TestController@editGeneralQuestion')->name('general.questions.edit');
        Route::delete('/general/question/{id}/{testId}', 'TestController@destroyGeneralQuestion')->name('general.questions.delete');

        Route::post('/general/question/{id}/store', 'TestController@storeGeneralQuestion')->name('general.questions.store');
        Route::patch('/general/question/{id}/update', 'TestController@updateGeneralQuestion')->name('general.questions.update');
        
        
        Route::get('/general/test/results/{testId}/{courseTitle}', 'TestController@getGeneralTestResultsForCourseTutor')->name('general.test.admin.view');

        
        /****
         * Certificate
         * Upload and Management
         */
        Route::get('/certificate', 'AdminController@getCertificates')->name('certificate');
        Route::get('/certificate/create', 'AdminController@createCertificate')->name('certificate.create');
        Route::post('/certificate', 'AdminController@storeCertificate')->name('certificate.store');
        Route::get('/certificate/{certId}', 'AdminController@showCertificate')->name('certificate.show');
        Route::get('/certificate/{certId}/edit', 'AdminController@editCertificate')->name('certificate.edit');
        Route::patch('/certificate/update/{certId}', 'AdminController@updateCertificate')->name('certificate.update');
        Route::delete('certificate/{certId}', 'AdminController@deleteCertificate')->name('certificate.delete');





        /****
         * Transactions
         * Course Purchases Routing happens here
         */
        Route::get('/transactions/all', 'TransactionController@index')->name('transactions.all');
        Route::get('/transactions/{transactionId}', 'TransactionController@show')->name('transaction.show');

        // Course API
        Route::get('/api/course/addLecture', 'API\CourseController@addLecture');
        Route::get('/api/course', 'API\CourseController@courses');


        // Category API
        Route::get('/api/category', 'API\CategoryController@index');
        Route::get('/api/category/{id}', 'API\CategoryController@show');

        // Countries API
        Route::get('/api/countries', 'API\AdminCountryController@index');

        // Home Content Management
        Route::get('/homeContent', 'AdminController@homeContent')->name('homeContent');
        Route::get('/homeContent/carousel', 'AdminController@carousel')->name('homeContent.carousel');
        Route::get('/homeContent/motivational', 'AdminController@motivational')->name('homeContent.motivational');
        Route::get('/homeContent/mpo', 'AdminController@mpo')->name('homeContent.mpo');
        Route::get('/homeContent/partners', 'AdminController@partners')->name('homeContent.partners');
        Route::get('/homeContent/testimonies', 'AdminController@getTestimonies')->name('homeContent.testimonies');
        Route::get('/homeContent/feedbacks', 'AdminController@getFeedbacks')->name('homeContent.feedbacks');

        // Edit View
        Route::get('/homeContent/{id}/partner/', 'AdminController@editPartner')->name('editPartner');
        Route::patch('/homeContent/partner/{id}', 'AdminController@updatePartner')->name('partner.update');
        Route::patch('/homeContent/testimony/visibility/{testimonyId}', 'AdminController@updateVisibilty')->name('homeContent.testimony.updateVisibility');
        Route::delete('/homeContent/testimony/delete/{testimonyId}', 'AdminController@destroyTestimony')->name('homeContent.testimony.delete');
        Route::delete('/homeContent/feedback/delete/{feedbackId}', 'AdminController@destroyFeedback')->name('homeContent.feedback.delete');


        Route::post('/motivation', 'AdminController@motivationStore')->name('motivation');
        Route::post('/mpo', 'AdminController@mpoStore')->name('mpo');
        Route::post('/partners', 'AdminController@partnerStore')->name('partner');

    });


