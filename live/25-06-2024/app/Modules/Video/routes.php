<?php
/*
|--------------------------------------------------------------------------
| Video Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Video module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Video\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']),function(){
		Route::get('/video/{slug?}',array('as' => 'Video.frontindex','uses'=>'VideoController@frontindex'));
        Route::any('/video-detail/{slug?}', array('as' => 'Video.videoview', 'uses' => 'VideoController@blogview'));
	});
});




Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Video\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        
		Route::any('/video-manager', 							array('as' => 'Video.index', 'uses' => 'VideoController@listVideo'));
        Route::get('video-manager/add-video', 					array('as' => 'Video.add', 'uses' => 'VideoController@addVideo'));
        Route::post('video-manager/add-video', 					array('as' => 'Video.save', 'uses' => 'VideoController@saveVideo'));
        Route::get('video-manager/edit-video/{id}', 			array('as' => 'Video.edit', 'uses' => 'VideoController@editVideo'));
        Route::post('video-manager/edit-video/{id}', 			array('as' => 'Video.update', 'uses' => 'VideoController@updateVideo'));
        Route::get('video-manager/update-status/{id}/{status}', array('as' => 'Video.status', 'uses' => 'VideoController@updateVideoStatus'));
        Route::get('video-manager/view/{id}', 					array('as' => 'Video.view', 'uses' => 'VideoController@viewVideo'));
        Route::any('video-manager/multiple-action', 			array('as' => 'Video.Multipleaction', 'uses' => 'VideoController@performMultipleAction'));


         
		Route::any('/university-video-manager/{uni_id}', 							 array('as' => 'UniversityVideo.index', 'uses' => 'VideoController@listVideo'));
        Route::get('university-video-manager/add-video/{uni_id}', 					 array('as' => 'UniversityVideo.add', 'uses' => 'VideoController@addVideo'));
        Route::post('university-video-manager/add-video/{uni_id}', 					 array('as' => 'UniversityVideo.save', 'uses' => 'VideoController@saveVideo'));
        Route::get('university-video-manager/edit-video/{id}/{uni_id}', 			 array('as' => 'UniversityVideo.edit', 'uses' => 'VideoController@editVideo'));
        Route::post('university-video-manager/edit-video/{id}/{uni_id}', 			 array('as' => 'UniversityVideo.update', 'uses' => 'VideoController@updateVideo'));
        Route::get('university-video-manager/update-status/{id}/{status}/{uni_id}',  array('as' => 'UniversityVideo.status', 'uses' => 'VideoController@updateVideoStatus'));
        Route::get('university-video-manager/view/{id}/{uni_id}', 					 array('as' => 'UniversityVideo.view', 'uses' => 'VideoController@viewVideo'));
        Route::any('university-video-manager/multiple-action/{uni_id}', 			 array('as' => 'UniversityVideo.Multipleaction', 'uses' => 'VideoController@performMultipleAction'));
    });
});