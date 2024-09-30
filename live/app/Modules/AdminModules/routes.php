<?php 

/*
|--------------------------------------------------------------------------
| AdminModules Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the AdminModules module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\AdminModules\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::any('modules',array('as'=>'AdminModules.index','uses'=>'AdminModulesController@listModules'));
		Route::get('modules/add',array('as'=>'AdminModules.add','uses'=>'AdminModulesController@addModule'));
		Route::post('modules/add',array('as'=>'AdminModules.add','uses'=>'AdminModulesController@storeModule'));
		Route::get('modules/edit/{id}',array('as'=>'AdminModules.edit','uses'=>'AdminModulesController@editModule'));
		Route::post('modules/update',array('as'=>'AdminModules.update','uses'=>'AdminModulesController@updateModule'));
		Route::get('modules/delete/{id}',array('as'=>'AdminModules.delete','uses'=>'AdminModulesController@deleteModule'));
		Route::get('modules/status/{id}',array('as'=>'AdminModules.status','uses'=>'AdminModulesController@statusModule'));
		Route::get('modules/change-order',array('as'=>'AdminModules.changeOrder','uses'=>'AdminModulesController@changeOrder'));
	});
});
