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


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\TextSetting\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('text-setting/{type}',array('as'=>'TextSetting.index','uses'=>'TextSettingController@textList'));
		Route::get('text-setting/add-new-text/{type}',array('as'=>'TextSetting.add','uses'=>'TextSettingController@addText'));
		Route::any('text-setting/save-new-text/{type}',array('as'=>'TextSetting.save','uses'=>'TextSettingController@saveText'));
		Route::any('text-setting/edit-new-text/{type}/{id}',array('as'=>'TextSetting.edit','uses'=>'TextSettingController@editText'));
		Route::any('text-setting/update-new-text/{type}/{id}',array('as'=>'TextSetting.update','uses'=>'TextSettingController@updateText'));
		Route::any('text-setting/delete-text/{type}/{id}',array('as'=>'TextSetting.delete','uses'=>'TextSettingController@deleteText'));


		Route::get('js-text-setting',array('as'=>'JsTextSetting.index','uses'=>'JsTextSettingController@index'));

	});

});
