<?php 
/*
|--------------------------------------------------------------------------
| EmailLog Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the EmailLog module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\EmailLog\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/email-logs',array('as'=>'EmailLog.index','uses'=>'EmailLogController@listEmail'));
		Route::any('/email-logs/email_details',array('as'=>'EmailLog.detail','uses'=>'EmailLogController@EmailDetail'));
	});

});
