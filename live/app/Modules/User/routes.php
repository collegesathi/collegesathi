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


Route::group(array('namespace' => 'App\Modules\User\Controllers\Front'), function () {

  Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\GuestFront']), function () {
    Route::any('login/{redirecturl?}',             array('as' => 'User.login', 'uses' => 'UserController@login'));
    Route::any('forgot-password',         array('as' => 'User.forgotPassword', 'uses' => 'UserController@forgotPassword'));
    Route::any('reset-password/{validateStr}',   array('as' => 'User.resetPassword', 'uses' => 'UserController@resetPassword'));
    Route::get('signup',             array('as' => 'User.signup', 'uses' => 'UserController@signup'));
    Route::post('signup',             array('as' => 'User.user_signup', 'uses' => 'UserController@userSignup'));
    Route::any('verify-account/{validateStr?}', array('as' => 'User.verify_account', 'uses' => 'UserController@verifyAccount'));
    Route::get('social-sign-up/{provider}', ['as' => 'socialsignup', 'uses' => 'AuthController@redirectToProvider']);
    Route::get('social-sign-up/callback/{provider}', ['as' => 'socialsignupcallback', 'uses' => 'AuthController@handleProviderCallback']);
  });

  ###### For Auth users ######
  Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthFront']), function () {
    Route::get('/logout', array('as' => 'User.logout', 'uses' => 'UserController@logout'));
    Route::any('change-password', array('as' => 'User.change_password', 'uses' => 'UserController@changePassword'));
    Route::any('dashboard', array('as' => 'User.Dashboard', 'uses' => 'UserController@userDashboard'));
    Route::any('my-profile', array('as' => 'User.myProfile', 'uses' => 'UserController@myProfile'));
    Route::get('edit-profile', ['as' => 'User.editProfile', 'uses' => 'UserController@editProfile']);
    Route::any('update-profile', ['as' => 'User.updateProfile', 'uses' => 'UserController@updateProfile']);
  });
});


Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\User\Controllers'), function () {
  Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
    ###### For User ######
    Route::get('users', array('as' => 'User.index', 'uses' => 'UsersController@index'));
    Route::get('add-users', array('as' => 'User.add', 'uses' => 'UsersController@addUser'));
    Route::post('add-users', array('as' => 'User.save', 'uses' => 'UsersController@saveUser'));
    Route::get('users/edit-user/{id}', array('as' => 'User.edit', 'uses' => 'UsersController@editUser'));
    Route::post('users/edit-user/{id}', array('as' => 'User.update', 'uses' => 'UsersController@updateUser'));
    Route::get('view-user/{id}', array('as' => 'User.view', 'uses' => 'UsersController@viewUser'));
    Route::get('users/update-status/{id}/{status}', array('as' => 'User.status', 'uses' => 'UsersController@updateUserStatus'));
    Route::get('users/remove-image/{id}', array('as' => 'User.removeImage', 'uses' => 'UsersController@removeImage'));
    Route::get('user/delete-user/{id}', array('as' => 'User.delete', 'uses' => 'UsersController@deleteUser'));
    Route::get('users/send-credential/{id}', array('as' => 'User.send-credential', 'uses' => 'UsersController@sendCredential'));
    Route::get('users/verified-user/{id}', array('as' => 'User.verified_user', 'uses' => 'UsersController@verifiedUser'));
    Route::any('users/multiple-action', array('as' => 'User.Multipleaction', 'uses' => 'UsersController@performMultipleAction'));
    Route::get('users/email-verify-status/{id}/{status}', array('as' => 'User.emailVerify', 'uses' => 'UsersController@emailVerify'));
  });
});
