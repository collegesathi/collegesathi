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
Route::group(array('namespace' => 'App\Modules\Referral\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
        Route::any('referrals', array('as' => 'Referral.form', 'uses' => 'ReferralController@index'));
        Route::post('add-referral-details',array('as'=>'Referral.add_referal_details','uses'=>'ReferralController@addReferralDetails'));
    });
});




Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Referral\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/referral/{type}',array('as'=>'Referral.index','uses'=>'ReferralController@index'));
	});

});
