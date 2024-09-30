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

Route::group(array('namespace' => 'App\Modules\ReviewRating\Controllers\Front'), function () {
	Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthFront']), function () {
		Route::any('add-review-rating', array('as' => 'ReviewRating.review_rating', 'uses' => 'ReviewRatingController@reviewRating'));
	});
});
Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\ReviewRating\Controllers'), function () {
	Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
		Route::get('/reviews-ratings/{type?}', array('as' => 'ReviewRating.index', 'uses' => 'ReviewRatingController@index'));
		Route::get('reviews-ratings/approve/{type?}/{id}/{status}', array('as' => 'ReviewRating.approveReviewRating', 'uses' => 'ReviewRatingController@approveReviewRating'));
		Route::get('reviews-ratings/update-status/{type?}/{id}/{status}', array('as' => 'ReviewRating.updateStatus', 'uses' => 'ReviewRatingController@updateStatus'));
		Route::get('reviews-ratings/view/{type?}/{id}', array('as' => 'ReviewRating.view', 'uses' => 'ReviewRatingController@view'));
		Route::get('reviews-ratings/delete/{type?}/{id}', array('as' => 'ReviewRating.delete', 'uses' => 'ReviewRatingController@deleteReviewRating'));
	});
});
