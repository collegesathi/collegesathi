<?php
include app_path() . '/global_constants.php';

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // For session management
use App\Modules\EnquireNow\Models\EnquireNow;
use App\Services\SendMailService;
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

/* formpage */
Route::get('/university-page', function () {
    return view('formPage');
})->name('formPage');

Route::post('/submit-form', function (Request $request) {
    // Validate and process form data
    $validatedData = $request->validate([
        'fullName' => 'required|string|max:255',
        'gender' => 'required|string',
        'email' => 'required|email',
        'mobileNumber' => 'required|numeric',
        'dob' => 'required|date',
        'state' => 'required|string',
        'city' => 'required|string',       
    ]);

    // Create an instance of the EnquireNow model
    $model = new EnquireNow();
    $model->full_name = $validatedData['fullName'];
    $model->gender = $validatedData['gender'];
    $model->email = $validatedData['email'];
    $model->phone_number = '+91'.$request->input('mobileNumber'); // Add country code
    $model->dial_code = $request->input('dial_code', '+91'); // Default to +91 if not provided
    $model->phone_number_with_dial_code = $model->phone_number; // Adjust as needed
    $model->dob = $validatedData['dob'];
    $model->country = $request->input('country'); // Ensure this input is sent from the form
    $model->state = $validatedData['state'];
    $model->city = '142095';//$validatedData['city'];

    // Save the model and send email if successful
    if ($model->save()) {
        // Prepare email details
        $name = $validatedData['fullName'];
        $email = $validatedData['email'];
        $phone = $model->phone_number; // You can use phone_number_with_dial_code if required

        $action = "enquiry";
        $to = Config::get('Site.contact_email');
        $to_name = Config::get('Email.username');
        $rep_Array = [$name, $email, $phone];

        // Send email
        $sendMail = new SendMailService();
        $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

       
        Session::flash('We have received your request successfully. We will contact you as soon as possible.');
       
        return redirect()->route('University.listing');
    }    
    return redirect()->back()->withErrors(['error' => 'There was an error saving your data.']);
})->name('submitForm');

/* end formpage */
