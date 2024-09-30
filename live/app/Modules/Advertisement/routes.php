<?php
/*
|--------------------------------------------------------------------------
| Advertisement Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Advertisement module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Advertisement\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']),function(){

		/*Route::get('/advertisement/{slug?}',array('as' => 'Advertisement.frontindex','uses'=>'AdvertisementController@frontindex'));
        Route::any('/advertisement-detail/{slug?}', array('as' => 'Advertisement.advertisementview', 'uses' => 'AdvertisementController@blogview'));*/
	});
});





Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Advertisement\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

		Route::any('/advertisement-manager', 							    array('as' => 'Advertisement.index', 'uses' => 'AdvertisementController@listAdvertisement'));
        Route::get('advertisement-manager/add-advertisement', 				array('as' => 'Advertisement.add', 'uses' => 'AdvertisementController@addAdvertisement'));
        Route::post('advertisement-manager/add-advertisement', 				array('as' => 'Advertisement.save', 'uses' => 'AdvertisementController@saveAdvertisement'));
        Route::get('advertisement-manager/edit-advertisement/{id}', 		array('as' => 'Advertisement.edit', 'uses' => 'AdvertisementController@editAdvertisement'));
        Route::post('advertisement-manager/edit-advertisement/{id}', 		array('as' => 'Advertisement.update', 'uses' => 'AdvertisementController@updateAdvertisement'));
        Route::get('advertisement-manager/update-status/{id}/{status}', 	array('as' => 'Advertisement.status', 'uses' => 'AdvertisementController@updateAdvertisementStatus'));
        Route::get('advertisement-manager/view/{id}', 					    array('as' => 'Advertisement.view', 'uses' => 'AdvertisementController@viewAdvertisement'));
        Route::any('advertisement-manager/multiple-action', 				array('as' => 'Advertisement.Multipleaction', 'uses' => 'AdvertisementController@performMultipleAction'));
    });
});
