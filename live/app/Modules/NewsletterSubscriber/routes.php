<?php
/*
|--------------------------------------------------------------------------
| User Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the User module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\NewsletterSubscriber\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        Route::get('/news-letter-subscribers', array('as' => 'NewsletterSubscriber.index', 'uses' => 'NewsletterSubscriberController@newsletterSubscriberlist'));
        Route::get('/news-letter-subscribers-delete/{id}', array('as' => 'NewsletterSubscriber.delete', 'uses' => 'NewsletterSubscriberController@delete'));

    });
});
Route::group(array('prefix' => '', 'namespace' => 'App\Modules\NewsletterSubscriber\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\GuestFront']), function () {
        Route::post('news-letter-subscribe', array('as' => 'NewsletterSubscriber.subscribe', 'uses' => 'NewsletterSubscriberController@subscribe'));
        Route::get('news-letter-unsubscribe/{string} ', array('as' => 'NewsletterSubscriber.unSubscribe', 'uses' => 'NewsletterSubscriberController@unSubscribe'));
    });
});
