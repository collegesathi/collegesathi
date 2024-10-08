<?php
/*
|--------------------------------------------------------------------------
| User Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the User module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Specialization\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

        //Blog manager  module  routing start here
        Route::any('/specialization', array('as' => 'Specialization.index', 'uses' => 'SpecializationController@index'));

        Route::get('specialization/add-trend', array('as' => 'Specialization.add', 'uses' => 'SpecializationController@addBlog'));
        Route::post('specialization/add-trend', array('as' => 'Specialization.save', 'uses' => 'SpecializationController@saveBlog'));
        Route::get('specialization/edit-blog/{id}', array('as' => 'Specialization.edit', 'uses' => 'SpecializationController@editBlog'));
        Route::post('specialization/edit-blog/{id}', array('as' => 'Specialization.update', 'uses' => 'SpecializationController@updateBlog'));
        Route::get('specialization/update-status/{id}/{status}', array('as' => 'Specialization.status', 'uses' => 'SpecializationController@updateBlogStatus'));
        Route::any('specialization/delete-blog/{id}', array('as' => 'Specialization.delete', 'uses' => 'SpecializationController@deleteBlog'));
        Route::post('specialization/multiple-action', array('as' => 'Specialization.Multipleaction', 'uses' => 'SpecializationController@performMultipleAction'));
        Route::get('/specialization/view/{id}', array('as' => 'Specialization.view', 'uses' => 'SpecializationController@viewBlog'));
        Route::get('specialization/remove-image/{id}/{image_type}', array('as' => 'Specialization.removeImage', 'uses' => 'SpecializationController@removeImage'));
        Route::get('specialization/featured-update-status/{id}/{status}',array('as'=>'Specialization.featured','uses'=>'SpecializationController@updateFeaturedStatus'));




        //University Blog manager  module  routing start here
        Route::any('/university-specialization/{uni_id}', array('as' => 'UniversitySpecialization.index', 'uses' => 'SpecializationController@index'));
        Route::get('university-specialization/add-blog/{uni_id}', array('as' => 'UniversitySpecialization.add', 'uses' => 'SpecializationController@addBlog'));
        Route::post('university-specialization/add-blog/{uni_id}', array('as' => 'UniversitySpecialization.save', 'uses' => 'SpecializationController@saveBlog'));
        Route::get('university-specialization/edit-blog/{id}/{uni_id}', array('as' => 'UniversitySpecialization.edit', 'uses' => 'SpecializationController@editBlog'));
        Route::post('university-specialization/edit-blog/{id}/{uni_id}', array('as' => 'UniversitySpecialization.update', 'uses' => 'SpecializationController@updateBlog'));
        Route::get('university-specialization/update-status/{id}/{status}/{uni_id}', array('as' => 'UniversitySpecialization.status', 'uses' => 'SpecializationController@updateBlogStatus'));
        Route::any('university-specialization/delete-blog/{id}/{uni_id}', array('as' => 'UniversitySpecialization.delete', 'uses' => 'SpecializationController@deleteBlog'));
        Route::post('university-specialization/multiple-action/{uni_id}', array('as' => 'UniversitySpecialization.Multipleaction', 'uses' => 'SpecializationController@performMultipleAction'));
        Route::get('university-specialization/view/{id}/{uni_id}', array('as' => 'UniversitySpecialization.view', 'uses' => 'SpecializationController@viewBlog'));
        Route::get('university-specialization/remove-image/{id}/{image_type}/{uni_id}', array('as' => 'UniversitySpecialization.removeImage', 'uses' => 'SpecializationController@removeImage'));




    });
});

Route::group(array('prefix' => '', 'namespace' => 'App\Modules\Specialization\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\GuestFront']), function () {
        Route::get('/specialization', array('as' => 'Specialization.frontIndex', 'uses' => 'SpecializationController@index'));
        Route::any('/specialization/detail/{slug}', array('as' => 'Specialization.postView', 'uses' => 'SpecializationController@viewBlog'));
        Route::any('/specialization-load-more', array('as' => 'Specialization.blogLoadMore', 'uses' => 'SpecializationController@blogLoadMore')); 
    });
});
