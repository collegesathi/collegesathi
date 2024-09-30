<?php
include app_path() . '/global_constants.php';

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');

    return "Cache cleared successfully";
});


/* CRON ROUTES */
Route::get('/cron/send-temp-emails', array('as' => 'Cron.sendTempEmails', 'uses' => 'App\Http\Controllers\CronController@sendTempEmails'));



Route::group(array('middleware' => 'App\Http\Middleware\GuestFront'), function () {
 ##### FOR AJAX GET STATE AND CITY LIST
    Route::any('/get-states-by-country', array('as' => 'getStates.by_country', 'uses' => 'App\Http\Controllers\AjaxdataController@getStates'));
    Route::any('/get-cities-by-state', array('as' => 'getCity.by_state', 'uses' => 'App\Http\Controllers\AjaxdataController@getCities'));



});



/* ADMIN ROUTES */
Route::group(array('prefix' => ADMIN_ROUTE_PREFIX), function () {
    Route::group(array('middleware' => 'App\Http\Middleware\GuestAdmin'), function () {
        Route::any('/', array('as' => 'login-admin', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@login'));
        Route::any('/login', array('as' => 'login', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@login'));
        Route::get('/forget_password', array('as' => 'Admin.forget_password', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@forgetPassword'));
        Route::get('/reset_password/{validstring}', array('as' => 'Admin.reset_password', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@resetPassword'));
        Route::post('/send_password', array('as' => 'Admin.send_password', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@sendPassword'));
        Route::post('/save_password', array('as' => 'Admin.save_password', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@resetPasswordSave'));

    });

    Route::group(array('middleware' => 'App\Http\Middleware\AuthAdmin'), function () {
        Route::get('/logout', array('as' => 'logout', 'uses' => 'App\Http\Controllers\admin\AdminLoginController@logout'));
        Route::any('ajaxdata/get_states', array('as' => 'AdminAjax.getStates', 'uses' => 'App\Http\Controllers\admin\AjaxdataController@getStates'));
        Route::any('ajaxdata/get_cities', array('as' => 'AdminAjax.getCities', 'uses' => 'App\Http\Controllers\admin\AjaxdataController@getCities'));
        Route::any('ajaxdata/get_subcategories', array('as' => 'AdminAjax.SubCategory', 'uses' => 'App\Http\Controllers\admin\AjaxdataController@getSubCategoryList'));
    });
});
