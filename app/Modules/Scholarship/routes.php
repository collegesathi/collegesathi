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
Route::group(array('namespace' => 'App\Modules\Scholarship\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
        Route::any('scholarship', array('as' => 'Scholarship.form', 'uses' => 'ScholarshipController@index'));
        Route::post('apply-scholarship',array('as'=>'Scholarship.apply_scholarship','uses'=>'ScholarshipController@applyScholarship'));
    });
});




Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Scholarship\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/scholarship-requests/{type}',array('as'=>'Scholarship.index','uses'=>'ScholarshipController@index'));
	});

});
