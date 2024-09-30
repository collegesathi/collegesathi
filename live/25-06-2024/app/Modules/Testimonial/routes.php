<?php
/*
|--------------------------------------------------------------------------
| Testimonial Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Testimonial module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */


Route::group(array('prefix'=>'','namespace'=>'App\Modules\Testimonial\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']),function(){
		Route::get('/testimonials',array('as' => 'Testimonial.frontindex','uses'=>'TestimonialController@frontindex'));
	});
});

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Testimonial\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        Route::any('/testimonial-manager', array('as' => 'Testimonial.index', 'uses' => 'TestimonialController@listTestimonial'));
        Route::get('testimonial-manager/add-testimonial', array('as' => 'Testimonial.add', 'uses' => 'TestimonialController@addTestimonial'));
        Route::post('testimonial-manager/add-testimonial', array('as' => 'Testimonial.save', 'uses' => 'TestimonialController@saveTestimonial'));
        Route::get('testimonial-manager/edit-testimonial/{id}', array('as' => 'Testimonial.edit', 'uses' => 'TestimonialController@editTestimonial'));
        Route::post('testimonial-manager/edit-testimonial/{id}', array('as' => 'Testimonial.update', 'uses' => 'TestimonialController@updateTestimonial'));
        Route::get('testimonial-manager/update-status/{id}/{status}', array('as' => 'Testimonial.status', 'uses' => 'TestimonialController@updateTestimonialStatus'));
        Route::get('testimonial-manager/delete-testimonial/{id}', array('as' => 'Testimonial.delete', 'uses' => 'TestimonialController@deleteTestimonial'));
        Route::delete('testimonial-manager/delete-testimonial/{id}', array('as' => 'Testimonial.delete', 'TestimonialController@deleteTestimonial'));
        Route::any('testimonial-manager/multiple-action', array('as' => 'Testimonial.Multipleaction', 'uses' => 'TestimonialController@performMultipleAction'));
        Route::any('testimonial-manager/view/{id}', array('as' => 'Testimonial.view', 'uses' => 'TestimonialController@viewTestimonial'));


        Route::any('/university-testimonial-manager/{uni_id}', array('as' => 'UniversityTestimonial.index', 'uses' => 'TestimonialController@listTestimonial'));
        Route::get('university-testimonial-manager/add-testimonial/{uni_id}', array('as' => 'UniversityTestimonial.add', 'uses' => 'TestimonialController@addTestimonial'));
        Route::post('university-testimonial-manager/add-testimonial/{uni_id}', array('as' => 'UniversityTestimonial.save', 'uses' => 'TestimonialController@saveTestimonial'));
        Route::get('university-testimonial-manager/edit-testimonial/{id}/{uni_id}', array('as' => 'UniversityTestimonial.edit', 'uses' => 'TestimonialController@editTestimonial'));
        Route::post('university-testimonial-manager/edit-testimonial/{id}/{uni_id}', array('as' => 'UniversityTestimonial.update', 'uses' => 'TestimonialController@updateTestimonial'));
        Route::get('university-testimonial-manager/update-status/{id}/{status}/{uni_id}', array('as' => 'UniversityTestimonial.status', 'uses' => 'TestimonialController@updateTestimonialStatus'));
        Route::get('university-testimonial-manager/delete-testimonial/{id}/{uni_id}', array('as' => 'UniversityTestimonial.delete', 'uses' => 'TestimonialController@deleteTestimonial'));
        Route::delete('university-testimonial-manager/delete-testimonial/{id}/{uni_id}', array('as' => 'UniversityTestimonial.delete', 'TestimonialController@deleteTestimonial'));
        Route::any('university-testimonial-manager/multiple-action/{uni_id}', array('as' => 'UniversityTestimonial.Multipleaction', 'uses' => 'TestimonialController@performMultipleAction'));
        Route::any('university-testimonial-manager/view/{id}/{uni_id}', array('as' => 'UniversityTestimonial.view', 'uses' => 'TestimonialController@viewTestimonial'));

    });

});