<?php
namespace App\Modules\User\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Appointment\Models\UserWallet;
use App\Modules\Appointment\Models\UserWalletLog;
use App\Modules\User\Models\User;
use App\Modules\User\Services\UserService;
use Auth;
use Config;
use CustomHelper;
use Redirect;
use Request;
use Route;
use Session;
use ValidationHelper;
use View;

/**
 * UserController class
 *
 * Add your methods in the class below
 */
class UserController extends BaseController
{

    public $model = 'User';


    public function __construct(){
        View::share('modelName', $this->model);
    }


    /**
     * Function to login page
     *
     * @param null
     *
     * @return view page
     */
    public function login(){

        if (Request::has('rediret')) {
            $redirect_to = Request::query('rediret');
            Session::put('redirect_to', $redirect_to);
        }
        $message            = '';
        $metaTitle          = Config::get('Site.meta_title');
        $metaDescriptions   = Config::get('Site.meta_description');
        $metaKeywords       = Config::get('Site.meta_keywords');
        $pageTitle          = Config::get('Site.title');
        $current_route      = Route::current()->getName();
        if (!Auth::user()) {
            $formData = Request::all();
            if (Auth::check()) {
                return Redirect::route('home.index');
            }
			$redirectUrl    =   isset($formData['return_url']) ? $formData['return_url'] : NULL;
            if (Request::isMethod('post')) {
                $attribute      = array("from" => "front", "model" => $this->model);
                $userService    = new UserService;
                $res            = $userService->login($formData, $attribute, $this->model);
                if ((isset($res['data']['status']) && $res['data']['status'] == ERROR) || (isset($res['status']) && $res['status'] == ERROR)) {
                    if (isset($res['data']['message'])) {
                        $message = $res['data']['message'];
                    } else {
                        if (isset($res['message'])) {
                            $message = $res['message'];
                        } else {
                            $message = $res['data']['errors']['email'][0];
                        }
                    }
                    if (Request::ajax()) {
                        return response()->json(['status' => ERROR, 'message' => $message]);
                    } else {
                        if (isset($res['data']['errors']) && !empty($res['data']['errors'])) {
                            return Redirect::back()->withErrors($res['data']['errors'])->withInput();
                        }
                        Session::flash(ERROR, $message);
                        return Redirect::back();
                    }
                } elseif ((isset($res['data']['status']) && $res['data']['status'] == SUCCESS) || (isset($res['status']) && $res['status'] == SUCCESS)) {
                    $redirect_url = (isset($res['data']['returnUrl']) && !empty($res['data']['returnUrl'])) ? $res['data']['returnUrl'] : route('home.index');
                    $message = (isset($res['data']['message']) && !empty($res['data']['message'])) ? $res['data']['message'] : null;
                    if (Request::ajax()) {
                        return response()->json(['status' => SUCCESS, 'url' => $redirect_url, 'message' => $message]);
                    } else {
                        Session::flash(SUCCESS, $message);
                        return redirect($redirect_url);
                    }
                }
            } else {
                return View::make('User::Front.login', compact('pageTitle', 'current_route', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'redirectUrl'));
            }
        } else {
            Session::flash(ERROR, trans("front_messages.login.ALREADY_LOGIN"));
            return Redirect::route('home.index');
        }
    } //end login()


    /**
     * UserController::forgotPassword()
     * function for forgot password / call when user submit forgot password form
     * @param null
     * @return void()
     */
    public function forgotPassword()
    {
        
        if (!Auth::user()) {
            $metaTitle = Config::get('Site.meta_title');
            $metaDescriptions = Config::get('Site.meta_description');
            $metaKeywords = Config::get('Site.meta_keywords');
            $pageTitle = Config::get('Site.title');
            $current_route = Route::current()->getName();
            if (Request::isMethod('post')) {
                $formData = Request::all();
                $attribute = array('model' => $this->model, 'from' => 'front');
                $userService = new UserService;
                $response = $userService->userForgetPassword($formData, $attribute); 

                if ($response['data']['status'] == ERROR) {

                    if (isset($response['data']['message'])) {
                        $message = $response['data']['message'];
                    } else {
                        if (isset($response['message'])) {
                            $message = $response['message'];
                        } else {
                            $message = $response['data']['errors']['email'][0];
                        }
                    }

                    $errors = array();
                    if (isset($response['data']['errors']) && !empty($response['data']['errors'])) {
                        $errors = $response['data']['errors'];
                    }

                    if (Request::ajax()) {
                        if (isset($response['data']['from'])) {
                            if ($response['data']['from'] = 'email') {
                                Session::flash(SUCCESS, $message);
                            }
                            return response()->json(['status' => $response['data']['webStatus'], 'from' => $response['data']['from'], 'message' => $message, 'errors' => $errors]);
                        } else {
                            return response()->json(['status' => $response['data']['webStatus'], 'message' => $message, 'errors' => $errors]);
                        }
                    } else {
                        if (isset($response['data']['errors']) && !empty($response['data']['errors'])) {
                            return Redirect::back()->withErrors($response['data']['errors'])->withInput();
                        }
                        Session::flash(ERROR, $message);
                        return Redirect::back();
                    }
                } else {
                    if ($response['data']['status'] == 'success_message') {
                        Session::flash('flash_notice', $response['data']['message']);
                    }
                    return response()->json($response['data']);

                }
            } else {
                return View::make('User::Front.forgot_password', compact('pageTitle', 'current_route', 'metaTitle', 'metaDescriptions', 'metaKeywords'));
            }
        } else {
            return Redirect::route('home.index');
        }
    }

    /**
     * UserController::resetPassword()
     * function for reset password
     * @param $validateStr
     * @return void()
     */
    public function resetPassword($validateStr = "")
    {
        $metaTitle = Config::get('Site.meta_title');
        $metaDescriptions = Config::get('Site.meta_description');
        $metaKeywords = Config::get('Site.meta_keywords');
        $pageTitle = Config::get('Site.title');
        $current_route = Route::current()->getName();
        if (Request::isMethod('post')) {
            $formData = Request::all();
            $formData['validate_string'] = $validateStr;
            $userDetails = User::where('forgot_password_validate_string', $validateStr)->where('is_deleted', INACTIVE)->first();
            if (empty($userDetails)) {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }
            $attribute = array('model' => $this->model, 'from' => 'front');
            $userService = new UserService;
            $res = $userService->userResetPasswordValidationAndSave($formData, $attribute);

            if ($res['data']['status'] == ERROR) {
                if (isset($res['data']['errors']) && !empty($res['data']['errors'])) {
                    $res = $res['data'];
                } else {
                    $res['message'] = $res['data']['message'];
                }

                return response()->json($res);
            } else {
                if ($res['data']['status'] == 'success') {
                    $redirect_url = route('home.index');
                }
                Session::flash(SUCCESS, $res['data']['message']);
                return response()->json(['status' => SUCCESS, 'url' => $redirect_url]);
            }
        } else {
            if ($validateStr == "") {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }

            $userDetails = User::where('forgot_password_validate_string', $validateStr)->where('is_deleted', INACTIVE)->first();
            if (empty($userDetails)) {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }

            return View::make('User::Front.reset_password', compact('pageTitle', 'current_route', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'validateStr'));
        }
    }


	/**
     * Function to signup page
     *
     * @param null
     *
     * @return view page
     */
    public function signup(){

        if (Auth::user()){
            return Redirect::route('home.index');
        }
        $metaTitle          = Config::get('Site.meta_title');
        $metaDescriptions   = Config::get('Site.meta_description');
        $metaKeywords       = Config::get('Site.meta_keywords');
        $pageTitle          = Config::get('Site.title');
        $current_route      = Route::current()->getName();
        return View::make('User::Front.signup', compact('pageTitle','current_route', 'metaTitle', 'metaDescriptions', 'metaKeywords'));
    } //end signup()


	/**
     * UserController::userSignup()
     * Function for user signup
     * @param null
     * @return view page.
     */
    public function userSignup(){

        if (!Auth::user()) {
            if (Request::isMethod('post')) {
                $formData = Request::all();
                if (!empty($formData)) {
                    $formData['is_verified'] = INACTIVE;
                    $attribute = array(
                        "from" => "front",
                        "model" => $this->model,
                        "type" => "add",
                        "user_role_id" => CUSTOMER_ROLE_ID,
                        "user_role_slug" => CUSTOMER_ROLE_SLUG,
                    );
                    $UserService = new UserService;
                    $res         = $UserService->userValidateAndSave($formData, $attribute, $this->model);
                    if ($res['data']['status'] == ERROR) {   
						if (Request::ajax()) {
							if(isset($res['validator'])){
								$validator = $res['validator'];
								return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
							}
							if (isset($res['data']['message']) && ($res['data']['message'] != '')) {
								return response()->json(['status' => ERROR, 'message' => $res['data']['message']]);
							}
                        }else {
                            $validator = $res['validator'];
                            return Redirect::back()->withErrors($validator)->withInput();
                        }
                    }else {

                        $redirect_url 	= (isset($res['data']['returnUrl']) && !empty($res['data']['returnUrl'])) ? $res['data']['returnUrl'] : route('home.index');
                        $message 		= (isset($res['data']['message']) && !empty($res['data']['message'])) ? $res['data']['message'] : null;
                        if (Request::ajax()) {
                            Session::flash(SUCCESS, $message);
                            return response()->json(['status' => SUCCESS, 'url' => $redirect_url, 'message' => $message]);
                        }else {
                            Session::flash(SUCCESS, $message);
                            return redirect($redirect_url);
                        }
                    }
                }
            }
            Session::flash(ERROR, trans('front_messages.sorry_you_are_using_wrong_link'));
            return redirect("home.index");
        }
		else {
            Session::flash(ERROR, trans("front_messages.login.ALREADY_LOGIN"));
            return redirect()->route("home.index");
        }
    } //end studentSignup()


	/**
     * UserController::verifyEmail()
     * function for verify email
     * @param $validateStr
     * @return void()
     */
    public function verifyAccount($validateStr = ""){
        if ($validateStr == "") {
            Session::flash(ERROR, trans("front_messages.global.invalid_access"));
            return Redirect::route("home.index");
        }
        $formData["validateString"] = $validateStr;
        $userService = new UserService;
        $res         = $userService->userEmailVerification($formData);
        if ($res['status'] == ERROR) {
            Session::flash(ERROR, $res['data']['message']);
            return Redirect::route("home.index");
        } else {
            Session::flash(SUCCESS, trans("front_messages.user.email_verified_success_message"));
            return redirect()->route("home.index");
        }
    } // End verifyAccount()



	/**
     * UserController::userDashboard()
     * function for show consultant dashboard
     * @param null
     * @return veiw
     */
    public function userDashboard()
    {
        $userId = Auth::user()->id;
        $user_role_id = Auth::user()->user_role_id;
        $userDetails = User::where('id', $userId)->firstOrFail();
        $current_route = Route::current()->getName();

        $pageName = 'Dashboard';
        $pageTitle = 'Dashboard';

        return View::make("User::Front.dashboard", compact('pageTitle', 'pageName', 'current_route', 'userDetails'));

    } // end consultantDashboard()


    /**
     * UserController::myProfile()
     * Function for User profile
     * @param null
     * @return view page or redirect .
     **/
    public function myProfile()
    {
        $userId = Auth::user()->id;
        $userDetails = User::with(['countryName', 'stateName', 'cityName'])->find($userId);

        $pageTitle = trans("front_messages.global.my_profile");

        return View::make("User::Front.my_profile", compact('pageTitle', 'userDetails'));

    } // end myProfile()


    /**
     * UserController::editProfile()
     * function for edit profile
     * @param null
     * @return Front.edit_profile
     */
    public function editProfile(){

        $metaTitle          =   Config::get('Site.meta_title');
        $metaDescriptions   =   Config::get('Site.meta_description');
        $metaKeywords       =   Config::get('Site.meta_keywords');
        $pageTitle          =   Config::get('Site.title');
        $current_route      =   Route::current()->getName();
        $slug               =   Auth::user()->slug;
        $formData["slug"]   =   $slug;
        $attribute          =   array("from" => "front", "model" => $this->model, "type" => "add");
        $userDetails        =   User::findOrFail(Auth::user()->id);
        return View::make('User::Front.edit_profile', compact('pageTitle', 'metaTitle', 'metaDescriptions', 'metaKeywords','userDetails'  ));

    }


    /**
     * Function for  updateProfile
     * @param $userId as id of user
     * @return redirect page.
     */
    public function updateProfile()
    {
        $formData = Request::all();
        if (!empty($formData)) {
            $userId = Auth::user()->id;
            $attribute = array("from" => "front", "model" => $this->model, "type" => "edit", "user_id" => $userId);
            $UserService =  new UserService;
            $res         =  $UserService->userValidateAndSave($formData, $attribute);
            if ($res['data']['status'] == ERROR) {
                if (isset($res['validator']) && !empty($res['validator'])) {
                    $validator = $res['validator'];
                    return Redirect::back()->withErrors($validator)->withInput();
                } else {
                    $message = $res['data']['message'];
                    $redirect_url = route('User.editProfile');
                    Session::flash(ERROR, $message);
                    return Redirect::route('User.editProfile');
                }
            } else {
                if ($res['data']['status'] == 'success') {
                    $redirect_url = route('User.editProfile');
                }
                Session::flash(SUCCESS, trans('front_messages.global.profile_updated_success'));
                return Redirect::route('User.editProfile');
            }
        }
    } // end updateUser()


    /**
     * UserController::logout()
     * Function for logout users
     * @param null
     * @return rerirect page.
     */
    public function logout()
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $fullname = User::where('id', $userId)->pluck('full_name')->first();
            $msg = trans("front_messages.LOGOUT_SUCCESSFULLY", ['username' => ucfirst($fullname)]);
            Auth::logout();
            Session::flash(SUCCESS, $msg);
        }
        return Redirect::route("home.index");
    }


	/**
	 * Function for mark a User as deleted
	 * @param $userId as id of User
	 * @return redirect page.
	 */
    public function deleteAccount()
    {

        if (Auth::check()) {
            $conditions = array();
            $logginUserId = Auth::user()->id;
            $logginUserRoleId = Auth::user()->user_role_id;

            $obj = User::where($conditions)->findOrFail($logginUserId);
            $obj->email = DELETE_PREFIX . $obj->email;
            $obj->phone = DELETE_PREFIX . $obj->phone;
            $obj->is_deleted = IS_DELETED;
            $obj->deleted_by = $logginUserId;
            $obj->save();

            Auth::logout();
            Session::flash(SUCCESS, trans("messages.$this->model.deleted_message"));
        }
        return Redirect::route("home.index");
    } // end deleteUser()


    /**
     * Function for display change passwaord page
     * @param null
     * @return view - User.change_password
     */
    public function changePassword()
    {
        $userId = Auth::user()->id;
        if (Request::isMethod('post')) {
            $formData    = Request::all();
            $userService = new UserService;
            $res         = $userService->userChangePasswordValidationAndSave($formData);
            if ($res['data']['status'] == ERROR) {
                if (isset($res['data']['errors']) && !empty($res['data']['errors'])) {
                    return response()->json(['status' => ERROR, 'errors' => $res['data']['errors']]);
                } else {
                    return response()->json(['status' => ERROR, 'message' => $res['data']['message']]);
                }
                return response()->json($res);
            } else {
                if ($res['data']['status'] == 'success') {
                    Auth::logout();
                    $redirect_url = route('home.index');
                }
                Session::flash(SUCCESS, $res['data']['message']);
                return response()->json(['status' => SUCCESS, 'url' => $redirect_url]);
            }
        } else {
            return View::make("User::Front.change_password");
        }
    }






























	/**
	 * Function for update profile image
	 * @param null
	 * @return null
	 */
    public function updateProfileImage()
    {
        $formData = Request::all();
        $from = 'front';
        $type = 'edit';
        $model = 'User';
        $userId = Auth::user()->id;
        $attributes = array('type' => $type, 'model' => $model, 'from' => $from, 'userId' => $userId);

        $userService = new UserService;
        $response = $userService->userProfileImageValidateSave($formData, $attributes);

        if ($response['data']['status'] == 'error') {
            $res = array();
            $res['error'] = 1;
            $res['msg'] = $response['data']['validator']->errors()->all();
            echo json_encode($res);
            die;
        } else {
            $root_path = USER_PROFILE_IMAGE_ROOT_PATH;
            $http_path = USER_PROFILE_IMAGE_URL;
            $attribute = array();
            $type = 'user';
            $attribute['alt'] = 'user-profile';
            $attribute['class'] = "userProfileImage";
            $attribute['width'] = "172";
            $attribute['height'] = "172";
            $attribute['cropratio'] = "1:1";
            $attribute['zc'] = "1";
            $image_name = isset($response['data']['newImage']) ? $response['data']['newImage'] : '';
            $newImageHtml = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);

            $res = array();
            $res['error'] = 0;
            $res['msg'] = trans('front_messages.profile_image_update_success_message');
            $res['img'] = "" . $newImageHtml . "";
            echo json_encode($res);
        }
    }

    /**
     * UserController::forgetPasswordOTPMobile()
     * Method for used open forgot password otp model box
     * Open popup for otp, after user submit forgot password with mobile number.
     * @param as validateStr
     * @return json resonse
     */
    public function forgetPasswordOTPMobile()
    {
        if (Request::isMethod('post')) {
            $formData = Request::all();
            if (!empty($formData)) {
                $userDetails = User::where('slug', $formData['slug'])->where('active', ACTIVE)->first();
                if (!empty($userDetails)) {
                    $validateStr = $userDetails->forgot_password_validate_string;
                    return response()->json(['status' => SUCCESS, 'view' => view::make("User::Front.forgetPassword.otp_modal_box", compact('validateStr', 'userDetails'))->render()]);
                }
            }
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.global.something_went_wrong')]);
        }
    }

    /**
     * Function for resend ForgetPassword OTP
     *
     * @param null
     *
     * @return response
     */
    public function resendForgetPasswordOTPverificationUrl()
    {
        if (Request::ajax()) {
            $res = array();
            $formData = Request::all();
            $attribute = array('from' => 'front');
            $userService = new UserService;
            $response = $userService->resendForgetOTPverification($formData, $attribute);
            $res['status'] = $response['data']['status'];
            $res['msg'] = $response['data']['message'];
            $res['resend_time'] = $response['data']['resend_time'];
            $res['current_time'] = $response['data']['current_time'];
            return response()->json($res);
        }
    } //end resendForgetOTPverificationUrl()

    /**
     * Function for submitForgetVerificationPhoneOtp
     * Submit OTP after forgot password.
     * @param null
     *
     * @return response
     */
    public function submitForgetVerificationPhoneOtp()
    {
        if (Request::ajax()) {
            $formData = Request::all();
            $attribute = array('from' => 'front');
            $userService = new UserService;
            $response = $userService->submitForgetVerificationPhoneOtp($formData, $attribute);
            if (isset($response['data']) && !empty($response['data'])) {
                if ($response['data']['status'] == ERROR) {
                    $res['status'] = $response['data']['status'];
                    $res['errors'] = $response['data']['errors'];

                } elseif ($response['data']['status'] == SUCCESS) {
                    $res['message'] = $response['data']['message'];
                    $res['status'] = $response['data']['status'];
                    $res['url'] = route('User.resetForgetPasswordModal', $response['data']['validate_string']);

                }
            }
            return response()->json($res);
        }
    } //end submitForgetVerificationPhoneOtp()

    /**
     * UserController::resetForgetPasswordModal()
     * function : open reset password popup.
     * @param $validate_string as string validate
     * @return void
     */
    public function resetForgetPasswordModal($validate_string = null)
    {
        if ($validate_string) {
            $userData = User::where('forgot_password_validate_string', $validate_string)->first();
            if (!empty($userData)) {
                if (Request::isMethod('post')) {
                    return response()->json(['status' => SUCCESS, 'view' => View::make('User::Front.forgetPassword.reset_password_modal', compact('validate_string'))->render()]);
                } else {
                    return View::make('User::Front.forgetPassword.on_load_reset_password_modal', compact('validate_string'));
                }
            }
            return Redirect::route('home.index')->with(ERROR, trans('front_messages.sorry_you_are_using_wrong_link'));
        } else {
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.sorry_you_are_using_wrong_link')]);
        }
    }

    /**
     * UserController::saveresetForgetPasswordModal()
     * function for Used to reset password
     * @param $validate_string as string validate
     * @return void
     */
    public function saveresetForgetPasswordModal()
    {
        if (Request::isMethod('post')) {
            $formData = Request::all();
            $res = array();
            $attribute = array('model' => $this->model, 'from' => 'front');
            $userService = new UserService;
            $response = $userService->userResetPasswordValidationAndSave($formData, $attribute);

            if ($response['data']['status'] == ERROR) {
                if (isset($response['data']['errors']) && !empty($response['data']['errors'])) {
                    $res = $response['data'];
                } else {
                    $res['status'] = ERROR;
                    $res['message'] = $response['data']['message'];
                    $res['errors'] = '';
                }
            } else {
                //reset password mail to user
                if (!empty($response['data']['user_data']['email'])) {
                    $to = $response['data']['user_data']['email'];
                    $to_name = $response['data']['user_data']['full_name'];
                    $action = "reset_password";
                    $rep_Array = array($to_name);
                    $this->callSendMail($to, $to_name, $rep_Array, $action);
                }
                Session::flash('flash_notice', $response['data']['message']);
                $res['status'] = SUCCESS;
                $res['url'] = route('home.index');
            }
            return response()->json($res);
        } else {
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.sorry_you_are_using_wrong_link')]);
        }
    }

    /**
     * Function for update phone number
     *
     * @param null
     *
     * @return response.
     */
    public function updatePhone()
    {
        if (Request::ajax()) {
            $formData = Request::all();
            $response = array();

            if (isset($formData['phone']) && !empty($formData['phone'])) {
                $attributes['from'] = 'front';
                $attributes['user_id'] = Auth::user()->id;
                $attributes['user_role_slug'] = Auth::user()->user_role_slug;

                $userService = new UserService;
                $response = $userService->updatePhone($formData, $attributes);

                if (isset($response['data']['updateOrgMobile']) && ($response['data']['updateOrgMobile'] == true)) {
                    Session::flash(SUCCESS, $response['data']['message']);
                }
            } else {
                $response['data']['status'] = ERROR;
                $response['data']['message'] = trans("front_messages.phone.VALID_ERROR");
            }

            return response()->json($response['data']);
        }
    } //end updatePhone

    /**
     * Function for resendTempPhoneOtp
     *
     * @param null
     *
     * @return response
     */
    public function resendTempPhoneOtp()
    {
        if (Request::ajax()) {
            $formData = Request::all();
            $attributes['from'] = 'front';
            $attributes['user_id'] = Auth::user()->id;
            $userService = new UserService;
            $response = $userService->resendTempPhoneOtp($formData, $attributes);
            return response()->json($response['data']);

        }
    } //end resendTempPhoneOtp()

    /**
     * Function for submitTempPhoneOtp
     *
     * @param null
     *
     * @return response
     */
    public function submitTempPhoneOtp()
    {
        if (Request::ajax()) {
            $formData = Request::all();
            $attributes = array();
            $userService = new UserService;
            $response = $userService->submitTempPhoneOtp($formData, $attributes);
            if ($response['data']['status'] == SUCCESS) {
                Session::flash(SUCCESS, $response['data']['message']);
            }
            return response()->json($response['data']);

        }
    } //end submitTempPhoneOtp()

    /**
     * UserController::accountVerification()
     * User will reach here after registration for mobile number verifications
     * @param null
     * @return veiw
     */
    public function accountVerificationAfterSignup()
    {
        $userId = Auth::user()->id;
        $userDetails = User::where('id', $userId)->firstOrFail();
        $current_route = Route::current()->getName();
        $pageName = 'Account Verification';
        return View::make("User::Front.account_verification_after_signup", compact('userDetails', 'pageName', 'current_route'));

    } // end accountVerificationAfterSignup()

    /**
     * Function for update original phone number just after registration on verification page.
     *
     * @param null
     *
     * @return response.
     */
    public function updateOriginalPhone()
    {
        if (Request::ajax()) {
            $formData = Request::all();

            $response = array();
            if (isset($formData['phone']) && !empty($formData['phone'])) {
                $attributes['from'] = 'front';
                $attributes['user_id'] = Auth::user()->id;
                $attributes['user_role_slug'] = Auth::user()->user_role_slug;
                $userService = new UserService;
                $response = $userService->updateOriginalPhone($formData, $attributes);
            } else {
                $response['data']['status'] = ERROR;
                $response['data']['message'] = trans("front_messages.phone.VALID_ERROR");
            }

            return response()->json($response['data']);
        }
    } //end updateOriginalPhone

    /**
     * Function for submit OTP number for mobile verification just after registration on verification page.
     *
     * @param null
     *
     * @return response
     */
    public function submitVerificationPhoneOtp()
    {
        if (Request::ajax()) {
            $formData = Request::all();
            $attributes = array();

            $response = ValidationHelper::submitOtpValidateAndSave($formData, $attributes);

            if ($response['status'] == ERROR) {
                $res['status'] = ERROR;
                $res['errors'] = $response['validator'];

            } elseif ($response['status'] == SUCCESS) {
                Session::flash(SUCCESS, trans("front_messages.phone_otp_update_success"));

                $user_role_id = Auth::user()->user_role_id;

                if ($user_role_id == CONSULTANT_ROLE_ID) {
                    $redirect_url = route("Consultant.consultantDashboard");
                } elseif ($user_role_id == CUSTOMER_ROLE_ID) {
                    $redirect_url = route("User.userDashboard");
                } else {
                    $redirect_url = route("home.index");
                }

                $res['url'] = $redirect_url;
                $res['status'] = SUCCESS;
            }
            return response()->json($res);

        }
    } //end submitVerificationPhoneOtp()

    /**
     * Function is used for resend OTP on mobile just after registration on verification page.
     * @param null
     * @return response
     */
    public function resendOTPverificationUrl()
    {
        if (Request::ajax()) {
            $userDetails = array();
            if (Auth::user()) {
                $loginUserId = Auth::user()->id;
                $userDetails = User::where('id', $loginUserId)->first();
            } else {
                $formData = Input::all();
                $slug = $formData['slug'];
                $userDetails = User::where('id', $slug)->first();
            }

            $otp_number = CustomHelper::generateVerificationCode();
            $resend_time = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
            $forgot_time = CustomHelper::convert_date_to_timestamp(FORGOT_OTP_TIME);
            $currentTime = CustomHelper::getCurrentTime();
            $mobile_no = $userDetails->phone;

            User::where('id', $userDetails->id)->update(['mobile_verification_code' => $otp_number, 'mobile_verification_code_time' => $forgot_time, 'resend_otp_time' => $resend_time]);

            // Send OTP sms to user
            if (!empty($mobile_no)) {
                CustomHelper::_SendOtp('account_verification', $mobile_no, $otp_number);
            }

            $res['status'] = SUCCESS;
            $res['msg'] = trans("front_messages.phone_otp_resend_success");
            $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($resend_time);
            $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($currentTime);
            return response()->json($res);
        }
    } //end resendOTPverificationUrl()


    /**
     * Function for resend Email Verification Link.
     *
     * @param null
     *
     * @return response
     */
    public function resendEmailVerificationLink($user_slug = null)
    {
        if ($user_slug != null) {
            $userDetails = User::where('slug', $user_slug)->first();
            $loginUserId = $userDetails['id'];
        } else {
            $loginUserId = Auth::user()->id;
        }

        $formData = array();
        $attribute = array("from" => "front", "model" => $this->model, "user_id" => $loginUserId);
        $response = UserService::UserRecentEmail($formData, $attribute);

        if ($response['data']['status'] == SUCCESS) {
            Session::flash(SUCCESS, trans("front_messages.resend_verifylink_message"));
        } else {
            Session::flash(ERROR, trans("front_messages.sorry_you_are_using_wrong_link"));
        }
        return redirect()->back();
    } //end resendEmailVerificationLink()

    /**
     * UserController::resendOtp()
     * function for resend otp
     * @param $validateStr as validate String
     * @param $slug as form page slug (like :forget password by mobile)
     * @return mail
     */
    public function resendOtp($validateStr = 'NULL', $slug = '')
    {
        $formData['validate_string'] = $validateStr;
        $formData['page_name'] = $slug;
        $attribute = array('model' => $this->model, 'from' => 'front');

        $userService = new UserService;
        $response = $userService->userResendOtp($formData, $attribute);

        if ($response['data']['status'] == ERROR) {
            return Redirect::route('home.index')->with(ERROR, trans('front_messages.sorry_you_are_using_wrong_link'));
        } else {
            Session::flash('flash_notice', trans("front_messages.send_otp_success"));
            if ($slug == "account_verify") {
                return Redirect::route('User.verify_account', $validateStr);
            } else {
                return Redirect::route('User.forgotPasswordVerify', $validateStr);
            }
        }
    }

    /**
     * UserController::forgotPasswordOTPVerify()
     * function for verify forgot password otp
     * @param $validateStr
     * @return void()
     */
    public function forgotPasswordOTPVerify($validateStr = "")
    {

        $metaTitle = Config::get('Site.meta_title');
        $metaDescriptions = Config::get('Site.meta_description');
        $metaKeywords = Config::get('Site.meta_keywords');

        $pageTitle = Config::get('Site.title');
        $current_route = Route::current()->getName();
        if (Request::isMethod('post')) {
            $formData = Request::all();
            $formData['validate_string'] = $validateStr;
            $userDetails = User::where('forgot_password_validate_string', $validateStr)->where('is_deleted', INACTIVE)->first();
            if (empty($userDetails)) {

            }
            $attribute = array('model' => $this->model, 'from' => 'front');
            $userService = new UserService;
            $res = $userService->userVerifyOtp($formData, $attribute);
            if ($res['data']['status'] == ERROR) {
                if (isset($res['validator']) && !empty($res['validator'])) {
                    $validator = $res['validator'];
                    return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
                } else {
                    $validateString = $res['data']['validateString'];
                    $redirect_url = route('User.forgotPasswordVerify', $validateString);
                    Session::flash(ERROR, trans('front_messages.otp_has_been_expired'));
                    return response()->json(['status' => SUCCESS, 'url' => $redirect_url]);
                }
            } else {
                $validateString = $res['data']['validate_string'];
                if ($res['data']['status'] == 'success') {
                    $redirect_url = route('User.resetPassword', $validateString);
                }
                Session::flash(SUCCESS, trans('front_messages.otp_verified_successfull'));
                return response()->json(['status' => SUCCESS, 'url' => $redirect_url]);
            }

        } else {
            if ($validateStr == "") {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }
            $userDetails = User::where('forgot_password_validate_string', $validateStr)->where('is_deleted', INACTIVE)->first();
            if (empty($userDetails)) {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }

            return View::make('User::Front.forgot_password_otp', compact('pageTitle', 'current_route', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'validateStr'));
        }

    } //end forgotPasswordOTPVerify

    /**
     * UserController::verifyEmail()
     * function for verify email
     * @param $validateStr
     * @return void()
     */
    public function verifyEmail($validateStr = "")
    {
        if ($validateStr == "") {
            Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
            return Redirect::route("home.index");
        }
        $userDetails = User::where('validate_string', $validateStr)->get()->toArray();

        if (empty($userDetails)) {
            Session::flash(ERROR, trans("front_messages.link_already_used"));
            return Redirect::route("home.index");
        }

        User::where('validate_string', $validateStr)->update(array(
            'is_verified' => IS_VERIFIED,
            'verification_code' => '',
            'verification_code_time' => '',
            'resend_otp_time' => '',
            'validate_string' => "",
        ));
        Session::flash(SUCCESS, trans("front_messages.your_account_has_been_verified_now_login_with_login_credentials"));
        return Redirect::route("User.login");

    }

    /**
     * function for send verifylink again
     *
     * @param validateStr as validate str
     *
     * @param fromPage as page slug
     *
     * @return mail
     */
    public function resendLink($validateStr = null, $fromPage = null)
    {

        if (!empty($validateStr)) {
            $userInfo = User::where('validate_string', $validateStr)->where('is_verified', INACTIVE)->first();
            if (empty($userInfo)) {
                Session::flash('error', trans("Invalid Url"));
                return Redirect::route("home.index");
            }

            if (!empty($userInfo)) {
                //mail to new registered user
                $to = $userInfo->email;
                $to_name = ucwords($userInfo->full_name);
                $full_name = $to_name;
                $route_url = route('User.verifyEmail', $validateStr);
                $link = $route_url;

                $click_link = '<a href="' . $route_url . '" target="_blank">Click here</a>';
                $action = "account_verification";
                $rep_Array = array($full_name, $click_link);
                $this->callSendMail($to, $to_name, $rep_Array, $action);

                Session::flash('flash_notice', trans("front_messages.email_varification_link_has_been_sent_on_your_email"));

                if (!empty($fromPage)) {
                    return Redirect::route("home.index");
                } else {
                    return Redirect::route("User.login");
                }
            }
        }
    } //end resendLink()

    /**
     * Function for thank you page
     *
     * @param slug as cms page slug
     *
     * @return view - pages.cms_page
     */
    public function thankYou($validateStr = "")
    {

        //echo $slug;die;
        if ($validateStr != "") {
            $userDetails = User::where('email_validate_string', $validateStr)->where('is_verified', NOT_VERIFIED)->first();
            if (!empty($userDetails)) {
                $result = CustomHelper::getCmsPage('thank-you');

                $userEmail = ($userDetails->email) ? $userDetails->email : "";
                if ($result) {
                    $pageTitle = $result['name'];
                    $metaTitle = $result['meta_title'];
                    $metaDescriptions = $result['meta_description'];
                    $metaKeywords = $result['meta_keywords'];

                    ### breadcrumb Start ###
                    $pages[trans('front_messages.global.breadcrumbs_home')] = route('home.index');
                    $breadcrumb = array('pages' => $pages, 'active' => $result['name']);
                    $pageHeadTitle = $result['title'];
                    ### breadcrumb End ###

                    return View::make("User::Front.thank_you_page", compact('result', 'breadcrumb', 'pageHeadTitle', 'pageTitle', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'validateStr', 'userEmail'));
                } else {
                    Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                    return Redirect::route("home.index");
                }
            } else {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }
        } else {
            Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
            return Redirect::route("home.index");
        }
    } // end cmsPages()

    /**
     * Function for accountExists
     *
     * @param validateStr as user email
     *
     * @return view
     */
    public function accountExists($validateStr = "")
    {

        //echo $slug;die;
        if ($validateStr != "") {
            $email = base64_decode($validateStr);

            $userDetails = User::where('email', $email)->get()->first();
            if (!empty($userDetails)) {

                $userEmail = ($userDetails->email) ? $userDetails->email : "";

                $metaTitle = Config::get('Site.meta_title');
                $metaDescriptions = Config::get('Site.meta_description');
                $metaKeywords = Config::get('Site.meta_keywords');
                $pageTitle = Config::get('Site.title');

                ### breadcrumb Start ###
                $pages[trans('front_messages.global.breadcrumbs_home')] = route('home.index');

                $pageHeadTitle = Config::get('Site.title');
                ### breadcrumb End ###

                return View::make("User::Front.account_exists", compact('pageHeadTitle', 'pageTitle', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'validateStr', 'userEmail'));

            } else {
                Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
                return Redirect::route("home.index");
            }
        } else {
            Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
            return Redirect::route("home.index");
        }
    } // end accountExists()

    /**
     * Function for get list of states
     *
     * @param null
     *
     * @return list of states(select box).
     */
    public function getStates()
    {

        if (Request::ajax() && Request::Input()) {
            $countryId = Request::get('country_id');
            $stateList = CustomHelper::getStateList($countryId);
            $cityList = array();
            return response()->json([
                'html' => View::make("elements.get_state", compact('stateList'))->render(),
                'cityHtml' => View::make("elements.get_city", compact('cityList'))->render(),
            ]);
        }
    } // end getStates()

    /**
     * Function for get list of cities
     *
     * @param null
     *
     * @return list of cities(select box).
     */
    public function getCities()
    {
        if (Request::ajax() && Request::Input()) {
            $countryId = Request::get('country_id');
            $stateId = Request::get('state_id');
            $cityList = CustomHelper::getCityList($countryId, $stateId);

            return response()->json([
                'html' => View::make("elements.get_city", compact('cityList'))->render(),
            ]);
        }
    } // end getCities()

/**
 * Function for walletLogs
 *
 * @param
 *
 * @return view
 */
    public function userWalletLogs()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;

            $pageTitle = $pageTitle = trans("front_messages.global.wallet_Logs");

            $attribute['user_id'] = $userId;
            $formData['sortBy'] = 'id';
            $formData['order'] = 'DESC';

            $userService = new UserService;
            $response = $userService->getwalletLogs($formData, $attribute);

            if ($response['data']['status'] == SUCCESS) {
                $result = $response['data']['model'];
                $wallet_balance = $response['data']['wallet_balance'];

            }
            return View::make("User::Front.user.wallet_log_list", compact('pageTitle', 'wallet_balance', 'result'));
        } else {
            Session::flash(ERROR, trans("front_messages.INVALID_ACCESS"));
            return Redirect::route("home.index");
        }
    } // end walletLogs()

    /**
     * Function for save withdrawalAmount
     * @param null
     * @return view page.
     */
    public function withdrawalAmount(Request $request)
    {

        $userId = Auth::user()->id;

        $userWalletData = UserWallet::where('user_id', $userId)->first();
        if ($userWalletData) {

            if ($userWalletData->status == WITHDRAWAL_INPROCESS) {
                $response['status'] = ERROR;
                $response['message'] = trans("front_messages.global.already_withdrawal_amount_in_process_message");
                return response()->json($response);
            }

            $userWalletData->withdrawal_request_amount = $userWalletData->balance_amount;

            $userWalletData->status = WITHDRAWAL_INPROCESS;
            if ($userWalletData->save()) {

                $object = new UserWalletLog();
                $object->user_id = $userId;
                $object->credit_amount = INACTIVE;
                $object->user_refund_id = INACTIVE;
                $object->debit_amount = $userWalletData->balance_amount;
                $object->appointment_id = INACTIVE;
                $object->appointment_request_id = INACTIVE;
                $object->is_withdrawal = ACTIVE;
                $object->payment_getway_transaction_id = null;
                $object->payment_getway_response = null;
                $object->notes = trans("front_messages.global.withdrawal_amount_in_process_note");
                $object->status = WITHDRAWAL_INPROCESS;
                if ($object->save()) {
                    $response['status'] = SUCCESS;
                    $response['message'] = trans("front_messages.global.withdrawal_amount_in_process_message");
                    return response()->json($response);
                }
            }

        }

    } // End withdrawalAmount()


	/**
     * Function for download download Document
     *
     * @param $Id as id of JobApplication
     *
     * @return redirect page.
     */
    public function downloadDocument($id ,$name ,$value){
		$result = User::where('id',$id)->where($name,$value)->first();

		$downloadPath	=	USER_DOCUMENT_IMAGE_ROOT_PATH;
		$fileName		=	isset($result[$name]) ? $result[$name] : "";
		$filePath		=	USER_DOCUMENT_IMAGE_ROOT_PATH.$fileName;

		if(!empty($fileName) && file_exists($filePath)){
			return response()->download($filePath);
		}
		else {
			Session::flash(ERROR, trans("messages.$this->model.document_not_exists"));
			return Redirect::route("$this->model.edit", $id);
		}
	} //end downloadDocument()


  /**
     * Function for display change passwaord page
     * @param null
     * @return view - User.referPromocode
     */
    public function referPromocode()
    {
        $userId = Auth::user()->id;

        if (Request::isMethod('post')) {
            $formData = Request::all();
            $userService = new UserService;

            $formData['referral_code'] =Auth::user()->my_referrer_code;

            $res = $userService->referPromocodeValidationAndSave($formData);

            if ($res['data']['status'] == ERROR) {
                if (isset($res['data']['errors']) && !empty($res['data']['errors'])) {
                    return response()->json(['status' => ERROR, 'errors' => $res['data']['errors']]);
                } else {
                    return response()->json(['status' => ERROR, 'message' => $res['data']['message']]);
                }
                return response()->json($res);
            } else {
                Session::flash(SUCCESS, $res['data']['message']);
                return response()->json(['status' => SUCCESS]);
            }
        }
    }





} // end UserController class
