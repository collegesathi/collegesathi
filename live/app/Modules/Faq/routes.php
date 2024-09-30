<?php
/*
|--------------------------------------------------------------------------
| Faq Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Faq module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */


 
Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Faq\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
		
		Route::any('/faqs-manager',array('as'=>'Faq.index','uses'=>'FaqController@listFaq'));
		Route::get('faqs-manager/add-faqs',array('as'=>'Faq.add','uses'=>'FaqController@addFaq'));
		Route::post('faqs-manager/add-faqs',array('as'=>'Faq.save','uses'=>'FaqController@saveFaq'));
		Route::get('faqs-manager/edit-faqs/{id}',array('as'=>'Faq.edit','uses'=>'FaqController@editFaq'));
		Route::post('faqs-manager/edit-faqs/{id}',array('as'=>'Faq.update','uses'=>'FaqController@updateFaq'));
		Route::get('faqs-manager/update-status/{id}/{status}',array('as'=>'Faq.status','uses'=>'FaqController@updateFaqStatus'));
		Route::any('faqs-manager/delete-faqs/{id}',array('as'=>'Faq.delete','uses'=>'FaqController@deleteFaq'));
		Route::get('faqs-manager/view-faqs/{id}',array('as'=>'Faq.view_faqs','uses'=>'FaqController@viewFaq'));
		Route::post('faqs-manager/multiple-action',array('as'=>'Faq.Multipleaction','uses'=>'FaqController@performMultipleAction'));
		Route::any('faqs-manager/faq-view/{id}',array('as'=>'Faq.view','uses'=>'FaqController@viewFaq'));

		Route::any('/university-faqs-manager/{uni_id}',array('as'=>'UniversityFaq.index','uses'=>'FaqController@listFaq'));
		Route::get('university-faqs-manager/add-faqs/{uni_id}',array('as'=>'UniversityFaq.add','uses'=>'FaqController@addFaq'));
		Route::post('university-faqs-manager/add-faqs/{uni_id}',array('as'=>'UniversityFaq.save','uses'=>'FaqController@saveFaq'));
		Route::get('university-faqs-manager/edit-faqs/{id}/{uni_id}',array('as'=>'UniversityFaq.edit','uses'=>'FaqController@editFaq'));
		Route::post('university-faqs-manager/edit-faqs/{id}/{uni_id}',array('as'=>'UniversityFaq.update','uses'=>'FaqController@updateFaq'));
		Route::get('university-faqs-manager/update-status/{id}/{status}/{uni_id}',array('as'=>'UniversityFaq.status','uses'=>'FaqController@updateFaqStatus'));
		Route::any('university-faqs-manager/delete-faqs/{id}/{uni_id}',array('as'=>'UniversityFaq.delete','uses'=>'FaqController@deleteFaq'));
		Route::get('university-faqs-manager/view-faqs/{id}/{uni_id}',array('as'=>'UniversityFaq.view_faqs','uses'=>'FaqController@viewFaq'));
		Route::post('university-faqs-manager/multiple-action/{uni_id}',array('as'=>'UniversityFaq.Multipleaction','uses'=>'FaqController@performMultipleAction'));
		Route::any('university-faqs-manager/faq-view/{id}/{uni_id}',array('as'=>'UniversityFaq.view','uses'=>'FaqController@viewFaq'));
   


		Route::any('/course-faqs-manager/{uni_id}/{course_id}',array('as'=>'CourseFaq.index','uses'=>'FaqController@listFaq'));
		Route::get('course-add-faqs/{uni_id}/{course_id}',array('as'=>'CourseFaq.add','uses'=>'FaqController@addFaq'));
		Route::post('course-add-faqs/{uni_id}/{course_id}',array('as'=>'CourseFaq.save','uses'=>'FaqController@saveFaq'));
		Route::get('course-edit-faqs/{id}/{uni_id}/{course_id}',array('as'=>'CourseFaq.edit','uses'=>'FaqController@editFaq'));
		Route::post('course-edit-faqs/{id}/{uni_id}/{course_id}',array('as'=>'CourseFaq.update','uses'=>'FaqController@updateFaq'));
		Route::get('course-faqs-manager/update-status/{id}/{status}/{uni_id}/{course_id}',array('as'=>'CourseFaq.status','uses'=>'FaqController@updateFaqStatus'));
		Route::any('course-faqs-manager/delete-faqs/{id}/{uni_id}/{course_id}',array('as'=>'CourseFaq.delete','uses'=>'FaqController@deleteFaq'));
		Route::get('course-view-faqs/{id}/{uni_id}/{course_id}',array('as'=>'CourseFaq.view','uses'=>'FaqController@viewFaq'));
		Route::post('course-faqs-manager/multiple-action/{uni_id}/{course_id}',array('as'=>'CourseFaq.Multipleaction','uses'=>'FaqController@performMultipleAction'));
    });

});

Route::group(array('prefix' => '', 'namespace' => 'App\Modules\Faq\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
        Route::get('/faqs', array('as' => 'Faq.frontIndex', 'uses' => 'FaqController@index'));
    });
});