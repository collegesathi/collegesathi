<?php 
/*
|--------------------------------------------------------------------------
| Setting Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Setting module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Setting\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		### setting manager  routing
		Route::any('/settings',array('as'=>'Setting.index','uses'=>'SettingController@listSetting'));
		Route::get('/settings/add-setting',array('as'=>'Setting.add','uses'=>'SettingController@addSetting'));
		Route::post('/settings/add-setting',array('as'=>'Setting.save','uses'=>'SettingController@saveSetting'));
		Route::get('/settings/edit-setting/{id}',array('as'=>'Setting.edit','uses'=>'SettingController@editSetting'));
		Route::post('/settings/edit-setting/{id}',array('as'=>'Setting.update','uses'=>'SettingController@updateSetting'));
		Route::get('/settings/prefix/{slug}',array('as'=>'Setting.prefix_index','uses'=>'SettingController@prefix'));
		Route::post('/settings/prefix/{slug}',array('as'=>'Setting.prefix_update','uses'=>'SettingController@updatePrefix'));
		Route::any('/settings/delete-setting/{id}',array('as'=>'Setting.delete','uses'=>'SettingController@deleteSetting'));
	});

});
