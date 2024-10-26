<?php
/*
|--------------------------------------------------------------------------
| Permission Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Permission module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Permission\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('permission',array('as'=>'Permission.index','uses'=>'PermissionController@listPermission'));
		Route::get('permission/add/{type?}',array('as'=>'Permission.add','uses'=>'PermissionController@addPermission'));
		Route::post('permission/add',array('as'=>'Permission.save','uses'=>'PermissionController@storePermission'));
		Route::get('permission/edit/{id}/{type?}',array('as'=>'Permission.edit','uses'=>'PermissionController@editPermission'));
		Route::post('permission/update/',array('as'=>'Permission.update','uses'=>'PermissionController@updatePermission'));
		Route::get('permission/delete/{id}/{type?}',array('as'=>'Permission.delete','uses'=>'PermissionController@deletePermission'));
		Route::get('permission/send-credential/{user_id}',array('as'=>'Permission.sendCredential','uses'=>'PermissionController@sendCredential'));
		Route::get('permission/getmodueledata/{id}',array('as'=>'Permission.get_module','uses'=>'PermissionController@getModuleData'));
		Route::get('permission/editmodueledata/{id}',array('as'=>'Permission.edit_module','uses'=>'PermissionController@editModuleData'));
		Route::get('permission/updateActiveStatus/{id}/{status}',array('as'=>'Permission.updateActiveStatus','uses'=>'PermissionController@updateActiveStatus'));

	});

});
