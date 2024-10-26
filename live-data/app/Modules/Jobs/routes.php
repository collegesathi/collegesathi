<?php
/*
|--------------------------------------------------------------------------
| Jobs Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Jobs module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */
Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Jobs\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

		Route::any('/jobs-manager', 							array('as' => 'Job.index', 			'uses' => 'JobsController@listJob'));
        Route::get('jobs-manager/add-job', 						array('as' => 'Job.add', 			'uses' => 'JobsController@addJob'));
        Route::post('jobs-manager/add-job', 					array('as' => 'Job.save', 			'uses' => 'JobsController@saveJob'));
        Route::get('jobs-manager/edit-job/{id}', 				array('as' => 'Job.edit', 			'uses' => 'JobsController@editJob'));
        Route::post('jobs-manager/edit-job/{id}', 				array('as' => 'Job.update', 		'uses' => 'JobsController@updateJob'));
        Route::get('jobs-manager/update-status/{id}/{status}', 	array('as' => 'Job.status', 		'uses' => 'JobsController@updateJobStatus'));
        Route::get('jobs-manager/view/{id}', 					array('as' => 'Job.view', 			'uses' => 'JobsController@viewJob'));
        Route::any('jobs-manager/multiple-action', 				array('as' => 'Job.Multipleaction',	'uses' => 'JobsController@performMultipleAction'));

		Route::any('/job-applications/{job_id?}', 			array('as' => 'Job.jobApplications', 		'uses' => 'JobsController@jobApplications'));
		Route::any('/view-job-application/{app_id}', 		array('as' => 'Job.viewJobApplication', 	'uses' => 'JobsController@viewJobApplication'));
		Route::get('/delete-job-application/{app_id}', 		array('as' => 'Job.deleteJobApplication', 	'uses' => 'JobsController@deleteJobApplication'));
		Route::any('/download_resume/{app_id}', 			array('as' => 'Job.downloadResume', 		'uses' => 'JobsController@downloadResume'));

	});
});




Route::group(array('namespace' => 'App\Modules\Jobs\Controllers\Front'), function () {


    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {

        Route::get('careers', 		array('as' => 'Job.listJob', 'uses' => 'JobsController@listJob'));
        Route::get('career/{slug}', array('as' => 'Job.viewJob', 'uses' => 'JobsController@viewJob'));
        Route::post('apply-job', array('as' => 'Job.applyJob', 'uses' => 'JobsController@applyJob'));
	});


});
