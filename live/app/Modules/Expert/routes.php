<?php
/*
|--------------------------------------------------------------------------
| Expert Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Expert module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Expert\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']),function(){

		/*Route::get('/expert/{slug?}',array('as' => 'Expert.frontindex','uses'=>'ExpertController@frontindex'));
        Route::any('/expert-detail/{slug?}', array('as' => 'Expert.expertview', 'uses' => 'ExpertController@blogview'));*/
	});
});





Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Expert\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

		Route::any('/expert-manager', 							    array('as' => 'Expert.index', 'uses' => 'ExpertController@listExpert'));
        Route::get('expert-manager/add-expert', 					array('as' => 'Expert.add', 'uses' => 'ExpertController@addExpert'));
        Route::post('expert-manager/add-expert', 					array('as' => 'Expert.save', 'uses' => 'ExpertController@saveExpert'));
        Route::get('expert-manager/edit-expert/{id}', 				array('as' => 'Expert.edit', 'uses' => 'ExpertController@editExpert'));
        Route::post('expert-manager/edit-expert/{id}', 				array('as' => 'Expert.update', 'uses' => 'ExpertController@updateExpert'));
        Route::get('expert-manager/update-status/{id}/{status}', 	array('as' => 'Expert.status', 'uses' => 'ExpertController@updateExpertStatus'));
        Route::get('expert-manager/view/{id}', 					    array('as' => 'Expert.view', 'uses' => 'ExpertController@viewExpert'));
        Route::any('expert-manager/multiple-action', 				array('as' => 'Expert.Multipleaction', 'uses' => 'ExpertController@performMultipleAction'));
    });
});
