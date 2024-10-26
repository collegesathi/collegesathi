<?php
/*
|--------------------------------------------------------------------------
| Block Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Block module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(array('namespace' => 'App\Modules\Career\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
        Route::get('careers', array('as' => 'Career.list', 'uses' => 'CareerController@index'));
        Route::any('load-more-career-page', array('as' => 'Career.load_more_career_page', 'uses' => 'CareerController@loadMoreCareerPage'));
        Route::post('apply-career',array('as'=>'Career.apply_career_url','uses'=>'CareerController@applyCareer'));
    });
});




Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Career\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/career',array('as'=>'Career.index','uses'=>'CareerController@index'));
		Route::get('/add-career',array('as'=>'Career.add_career','uses'=>'CareerController@addCareer'));
        Route::post('/save-career',array('as'=>'Career.save_career','uses'=>'CareerController@saveCareer'));
        Route::get('/edit-career/{id}',array('as'=>'Career.edit_career','uses'=>'CareerController@editCareer'));
        Route::post('/update-career',array('as'=>'Career.update_career','uses'=>'CareerController@updateCareer'));
        Route::any('/update-career-status/{id}/{status}',array('as'=>'Career.status','uses'=>'CareerController@statusCareer'));
		Route::get('/view-career/{id}',array('as'=>'Career.view_career','uses'=>'CareerController@viewCareer'));

		Route::get('/job-requests/{type}/{career_id?}',array('as'=>'Career.job_requests','uses'=>'CareerController@jobRequests'));
        Route::get('/view-job-request/{type}/{id}/{career_id?}',array('as'=>'Career.view_job_request','uses'=>'CareerController@viewJobRequest'));
        Route::any('/download-cv-document/{id}/{file}',array('as'=>'Career.download_cv','uses'=>'CareerController@downloadCV'));
	});

});
