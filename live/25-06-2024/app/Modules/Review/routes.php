<?php
/*
|--------------------------------------------------------------------------
| Review Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Review module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Review\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']),function(){

		/*Route::get('/review/{slug?}',array('as' => 'Review.frontindex','uses'=>'ReviewController@frontindex'));
        Route::any('/review-detail/{slug?}', array('as' => 'Review.reviewview', 'uses' => 'ReviewController@blogview'));*/
	});
});





Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Review\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

		Route::any('/review-manager', 							    array('as' => 'Review.index', 'uses' => 'ReviewController@listReview'));
        Route::get('review-manager/update-status/{id}/{status}', 	array('as' => 'Review.status', 'uses' => 'ReviewController@updateReviewStatus'));
        Route::get('review-manager/view/{id}', 					    array('as' => 'Review.view', 'uses' => 'ReviewController@viewReview'));
        Route::any('review-manager/multiple-action', 				array('as' => 'Review.Multipleaction', 'uses' => 'ReviewController@performMultipleAction'));

        Route::any('review-manager/update-review-status',          array('as' => 'Review.review_status',       'uses' => 'ReviewController@reviewstatus'));
    });
});
