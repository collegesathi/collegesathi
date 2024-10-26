<?php
/*
|--------------------------------------------------------------------------
| AccessRoles Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the AccessRoles module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\AccessRoles\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::any('access-roles',array('as'=>'AccessRoles.index','uses'=>'AccessRolesController@listRoles'));
		Route::get('access-roles/add',array('as'=>'AccessRoles.add','uses'=>'AccessRolesController@addRole'));
		Route::post('access-roles/add',array('as'=>'AccessRoles.add','uses'=>'AccessRolesController@storeRole'));
		Route::get('access-roles/edit/{id}',array('as'=>'AccessRoles.edit','uses'=>'AccessRolesController@editRole'));
		Route::post('access-roles/update',array('as'=>'AccessRoles.update','uses'=>'AccessRolesController@updateRole'));
	});

});
