<?php
/*
|--------------------------------------------------------------------------
| University Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the University module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

 Route::group(array('namespace' => 'App\Modules\University\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
       
        Route::get('university/{slug}', array('as' => 'University.frontIndex', 'uses' => 'UniversityController@index'));
        Route::post('apply-university', array('as' => 'University.applyUniversity', 'uses' => 'UniversityController@applyUniversity'));
        Route::any('universities', array('as' =>'University.listing', 'uses'=>'UniversityController@allUniversityList'));
        Route::any('view-more-university', array('as'=>'University.viewMoreUniversity', 'uses'=>'UniversityController@viewMoreUniversity'));
        Route::get('university-course/{uni_slug}/{course_slug}', array('as' => 'University.universityCourseDetail', 'uses' => 'UniversityController@index'));
        Route::any('university-course-filter', array('as' => 'University.filterCourse', 'uses'=>'UniversityController@filterCourse'));
        Route::any('download-prospectus', array('as'=>'University.downloadProspectus', 'uses'=>'UniversityController@downloadProspectus'));
        Route::post('add-compare-university', array('as' => 'University.addCompareUniversity', 'uses' => 'UniversityController@addCompareUniversity'));
        Route::get('compare', array('as' => 'University.compare', 'uses' => 'UniversityController@universityCompare'));

        Route::any('send-otp', array('as' => 'University.send-otp', 'uses' => 'UniversityController@verifyOtp'));
        Route::post('view-all-reviews', array('as' => 'University.viewAllReviews', 'uses' => 'UniversityController@viewAllReviews'));

        Route::any('load-more-filter-course', array('as'=>'University.load_more_filter_courses', 'uses'=>'UniversityController@getCourseFiltersList'));
    });
});

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\University\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        Route::get('/university-manager', array('as' => 'University.index', 'uses' => 'UniversityController@listUniversity'));
        Route::get('university-manager/add-university', array('as' => 'University.add', 'uses' => 'UniversityController@addUniversity'));
        Route::post('university-manager/add-university', array('as' => 'University.save', 'uses' => 'UniversityController@saveUniversity'));
        Route::get('university-manager/edit-university/{id}', array('as' => 'University.edit', 'uses' => 'UniversityController@editUniversity'));
        Route::post('university-manager/edit-university/{id}', array('as' => 'University.update', 'uses' => 'UniversityController@updateUniversity'));
        Route::any('university-manager/delete-university/{id}', array('as' => 'University.delete', 'uses' => 'UniversityController@deleteUniversity'));
        Route::get('university-manager/update-status/{id}/{status}', array('as' => 'University.status', 'uses' => 'UniversityController@updateUniversityStatus'));
        Route::post('university-manager/multiple-action', array('as' => 'University.Multipleaction', 'uses' => 'UniversityController@performMultipleAction'));
        Route::any('/download-document/{id}', array('as' => 'University.downloadDocument', 'uses' => 'UniversityController@downloadDocument'));
        Route::get('university-manager/view/{id}',array('as' => 'University.view', 'uses' => 'UniversityController@viewUniversity'));



        Route::get('/university-application-manager/{uni_id?}', array('as' => 'UniversityApplication.applicationindex', 'uses' => 'UniversityApplicationController@listUniversityApplication'));
        
       /*  Route::any('university-application-manager/delete-university/{id}', array('as' => 'UniversityApplication.applicationdelete', 'uses' => 'UniversityApplicationController@deleteUniversityApplication'));

        Route::get('university-application-manager/update-status/{id}/{status}', array('as' => 'UniversityApplication.applicationstatus', 'uses' => 'UniversityApplicationController@updateUniversityApplicationStatus')); */

        Route::post('university-application-manager/multiple-action', array('as' => 'UniversityApplication.Multipleaction', 'uses' => 'UniversityApplicationController@performMultipleAction'));

        Route::get('university-application-manager/view/{id}/{uni_id?}', array('as' => 'UniversityApplication.viewapplication', 'uses' => 'UniversityApplicationController@viewUniversityApplication'));



        Route::get('courses/{id}', array('as' => 'Course.listCourse', 'uses'=>'CourseController@listCourses'));
        Route::get('add-courses/{id}', array('as' => 'Course.add', 'uses'=>'CourseController@addCourses'));
        Route::post('save-courses', array('as' => 'Course.save', 'uses'=>'CourseController@saveCourses'));
        Route::get('edit-courses/{id}', array('as' => 'Course.edit', 'uses'=>'CourseController@editCourses'));
        Route::post('update-courses-save/{id}', array('as' => 'Course.update', 'uses'=>'CourseController@updateCourses'));
        Route::any('update-course-status/{id}/{status}/{uni_id}', array('as' => 'Course.status', 'uses' => 'CourseController@updateCourseStatus'));
        Route::get('view-courses/{id}/{uni_id}', array('as' => 'Course.view', 'uses'=>'CourseController@viewCourses'));




        Route::get('campuses/{id}', array('as' => 'University.campuses', 'uses'=>'UniversityController@listCampuses'));
        Route::post('save-campus', array('as' => 'University.saveCampus', 'uses'=>'UniversityController@saveCampus'));
        Route::any('delete-campus/{id}/{uni_id}', array('as' => 'University.deleteCampus', 'uses'=>'UniversityController@deleteUniversityCampus')); 

        Route::get('semesters/{uni_id}/{course_id}', array('as' => 'Course.semester', 'uses'=>'CourseController@semester'));
        Route::post('add-semester', array('as' => 'Course.addSemester', 'uses'=>'CourseController@addSemester')); 
        Route::any('delete-semester/{id}/{semester}', array('as' => 'Course.deleteSemester', 'uses'=>'CourseController@deleteSemester'));

        Route::get('loan-and-emi/{course_id}', array('as' => 'Course.loanAndEmi', 'uses' => 'CourseController@loanAndEmi'));
        Route::post('save-loan-and-emi/{course_id}', array('as' => 'Course.saveLoanAndEmi', 'uses' => 'CourseController@saveLoanAndEmi'));

        Route::get('loan-partners/{id}', array('as' => 'University.loan_partners', 'uses'=>'UniversityController@loanPartners'));
        Route::get('add-loan-partners/{id}', array('as' => 'University.add_loan_partners', 'uses'=>'UniversityController@addLoanPartners'));
        Route::post('save-loan-partners', array('as' => 'University.save_loan_partners', 'uses'=>'UniversityController@saveLoanPartners'));
        Route::any('delete-loan-partner/{id}/{uni_id}', array('as' => 'University.deleteLoanPartner', 'uses'=>'UniversityController@deleteLoanPartner'));


        Route::any('mark-as-all-active-semester/{course_id}/{uid}', array('as'=>'Course.markAsAllActive', 'uses'=>'CourseController@markAsAllSemesterActive'));

        Route::any('mark-as-all-inactive-semester/{course_id}/{uid}', array('as'=>'Course.markAsAllInactive', 'uses'=>'CourseController@markAsAllSemesterInactive'));
    }); 
});
