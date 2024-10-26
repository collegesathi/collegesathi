<?php 
/*
|--------------------------------------------------------------------------
| Dashboard Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Dashboard module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Dashboard\Controllers'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::any('/dashboard',array('as'=>'AdminDashBoard.index','uses'=>'DashBoardController@showdashboard'));
		Route::get('/myaccount',array('as'=>'Admin.account','uses'=>'DashBoardController@myaccount'));
		Route::post('/myaccount',array('as'=>'Admin.account_update','uses'=>'DashBoardController@myaccountUpdate'));
	});
});
