<?php
/*
|--------------------------------------------------------------------------
| Block Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Block module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(array('prefix'=>'','namespace'=>'App\Modules\EnquireNow\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']), function() {
		Route::any('/enquire-now',array('as' => 'EnquireNow.enquireNow','uses'=>'EnquireNowController@enquireNow'));
	});
});

Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\EnquireNow\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/enquiries',array('as'=>'EnquireNow.index','uses'=>'EnquireNowController@index'));
	});

});
