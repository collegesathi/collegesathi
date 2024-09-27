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


Route::group(array('prefix'=>'','namespace'=>'App\Modules\Home\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']), function() {
		Route::get('/', array('as' => 'home.index','uses'=>'HomeController@index'));
		Route::any('/read-more-testimonials',array('as' => 'Home.readMore','uses'=>'HomeController@readMoreTestimonial'));
		Route::get('generate-sitemap', array('as' => 'home.generateSitemap','uses'=>'HomeController@generateSitemap'));
	});
});

