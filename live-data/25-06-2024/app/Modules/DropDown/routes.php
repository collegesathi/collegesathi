<?php 
/*
|--------------------------------------------------------------------------
| DropDown Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the DropDown module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\DropDown\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('dropdown-manager/add-dropdown/{type}',array('as'=>'DropDown.add','uses'=>'DropDownController@addDropDown'));
		Route::post('dropdown-manager/add-dropdown/{type}',array('as'=>'DropDown.save','uses'=>'DropDownController@saveDropDown'));
		Route::get('dropdown-manager/edit-dropdown/{id}/{type}',array('as'=>'DropDown.edit','uses'=>'DropDownController@editDropDown'));
		Route::post('dropdown-manager/edit-dropdown/{id}/{type}',array('as'=>'DropDown.update','uses'=>'DropDownController@updateDropDown'));
		Route::any('dropdown-manager/delete-dropdown/{id}/{type}',array('as'=>'DropDown.delete','uses'=>'DropDownController@deleteDropDown'));
		Route::any('/dropdown-manager/{type}',array('as'=>'DropDown.index','uses'=>'DropDownController@listDropDown'));
		Route::get('dropdown-manager/update-status/{id}/{status}/{type}',array('as'=>'DropDown.status','uses'=>'DropDownController@updateDropDownStatus'));
		Route::any('/dropdown-manager-action/multiple-action',array('as'=>'DropDown.Multipleaction','uses'=>'DropDownController@performMultipleAction'));
	});  
    
});
