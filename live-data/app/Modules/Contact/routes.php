<?php
/*
|--------------------------------------------------------------------------
| Contact Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Contact module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
*/

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Contact\Controllers\Front'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']), function() {
		Route::get('/contact-us',  array('as' => 'Contact.add','uses'=>'ContactController@add'));
		Route::any('/contact/save',  array('as' => 'Contact.savedata','uses'=>'ContactController@save'));
	});
});



Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Contact\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::any('/contact-manager',array('as'=>'Contact.index','uses'=>'ContactController@listContact'));
		Route::get('contact-manager/view-contact/{id}',array('as'=>'Contact.view','uses'=>'ContactController@viewContact'));
		Route::get('contact-manager/delete-contact/{id}',array('as'=>'Contact.delete','uses'=>'ContactController@deleteContact'));
		Route::any('/contact-manager/reply-to-user/{id}',array('as'=>'Contact.reply','uses'=>'ContactController@replyToUser'));
		Route::any('contact-manager/reply-contact/{id}',array('as'=>'Contact.reply','uses'=>'ContactController@replyContact'));
	});
});
