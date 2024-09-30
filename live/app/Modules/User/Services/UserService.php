<?php
namespace App\Modules\User\Services;

use App\Modules\User\Models\User;
use App\Services\SendMailService;
use Auth;
use Config;
use CustomHelper;
use File;
use Hash;
use Redirect;
use Request;
use Session;
use ValidationHelper;
use Validator;
use View;
use JWTAuth;
use CURLFILE;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Modules\Country\Models\Country;

/**
 * user service here
 *
 * Add your methods in the class below
 *
 * This file will render views\admin\login
 */

class UserService
{

    /**
     * UserService::userValidateAndSave()
     * @Description Function  for validation validate and save customer
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function userValidateAndSave($formData = array(), $attribute = array()){

        $message 			= 	'';
        $response 			= 	array();
        $errorsArray 		= 	array();
        $response['status'] = 	ERROR;
        $mobile 			= 	(isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $msg 				= 	'';
        /* used validation and validation message */
        list($message, $validate) = self::userSignupValidation($formData, $attribute);
        $validator = Validator::make($formData, $validate, $message);
        if ($validator->fails()) {
            if ($mobile) {
                $errorsArray = $validator->errors()->toArray();
            } else {
                $res = array('data' => $response, 'validator' => $validator);
                return $res;
            }
        }else {
            $userId 		= 	isset($attribute['user_id']) ? $attribute['user_id'] : '';
            $user_role_id 	= 	isset($attribute['user_role_id']) ? $attribute['user_role_id'] : 0;
            $type 			= 	isset($attribute['type']) ? $attribute['type'] : 'add';
            $from 			= 	isset($attribute['from']) ? $attribute['from'] : '';
            $userDetail 	= 	CustomHelper::getUserDetail(['id'=>$userId]);
            $firstName      =   isset($formData['first_name']) ? $formData['first_name'] : "";
            $lastName       =   isset($formData['last_name']) ? $formData['last_name'] : "";
            $fullName 		= 	CustomHelper::getFullName($firstName, $lastName);
            $validateString =   '';
			$obj            =   ($type == 'add') ? new User : User::findOrFail($userId);
            $msg            =   ($type == 'add') ? trans('front_messages.user_registration_success') : trans('front_messages.profile_update.success');
            if ($type == 'add') {
                $registered_by = 0;
                if (Auth::user()) {
                    $registered_by = Auth::user()->id;
                }
                if (isset($formData['email'])) {
                    $obj->email = $formData['email'];
                }
                $obj->slug 				= 	CustomHelper::getSlug($fullName, 'slug', 'User');
                $obj->registered_by 	= 	$registered_by;
                $obj->user_role_id 		= 	CUSTOMER_ROLE_ID;
                $obj->user_role_slug 	= 	CUSTOMER_ROLE_SLUG;
                $obj->is_deleted 		= 	INACTIVE;
                $obj->block 			= 	UNBLOCK;
                $obj->active 			= 	ACTIVE;
                $validateString 		= 	isset($formData['email']) && !empty($formData['email']) ? CustomHelper::getValidateString($formData['email']) : "";
                $obj->validate_string 	= 	$validateString;
                if (in_array($from, [ADMIN_ROLE_SLUG])) {
                    $obj->is_verified					= 	ACTIVE;
                    $obj->is_mobile_verified 			= 	ACTIVE;
                    $obj->mobile_verification_code_time = 	INACTIVE;
                    $obj->resend_otp_time 				= 	INACTIVE;
                    $obj->mobile_verification_code 		= 	'';
                    $obj->is_approved 					= 	ACTIVE;
                }else {
                    if (isset($formData['email']) && !empty($formData['email'])) {
                        $validateString					= CustomHelper::getValidateString($formData['email']);
                        $obj->email_validate_string 	= $validateString;
                    }
                    $obj->is_verified 					= 	INACTIVE;
                    $obj->is_mobile_verified 			= 	ACTIVE;
					$obj->mobile_verification_code_time = 	INACTIVE;
					$obj->is_approved 					= 	ACTIVE;
                }
            }
			$phone_number 	= '';
			$phone 			= '';
			$dial_code 		= '';
			if (isset($formData['dial_code']) && !empty($formData['dial_code'])) {
				$dial_code = isset($formData['dial_code']) ? $formData['dial_code'] : '';
			}
			if (isset($formData['phone']) && !empty($formData['phone']) && isset($formData['dial_code']) && !empty($formData['dial_code'])) {
				if (isset($formData['mobile_req']) && $formData['mobile_req']) {
					$phone 			= 	$formData['dial_code'] . $formData['phone'];
					$phone_number 	=	$formData['phone'];
				}else {
					$phone 			= 	isset($formData['phone']) ? $formData['phone'] : '';
					$phone_number 	= 	str_replace($formData['dial_code'], "", $formData['phone']);
				}
			}
			$obj->phone 		    = 	$phone;
			$obj->dial_code 	    = 	$dial_code;
			$obj->phone_number 	    = 	$phone_number;
			$obj->email 		    = 	!empty($formData['email']) ? $formData['email'] : '';
			$obj->full_name 	    = 	$fullName;
			$obj->first_name 	    = 	$formData['first_name'];
            $obj->last_name 	    = 	$formData['last_name'];
            $obj->password 		    = 	!empty($formData['password']) ? Hash::make($formData['password']) : $obj->password;
			##########################
			$obj->device_token	    =  isset($formData['device_token']) ? $formData['device_token'] : '';
			$obj->device_id		    =  isset($formData['device_id']) ? $formData['device_id'] : '';
			$obj->device_type	    =  isset($formData['device_type']) ? $formData['device_type'] : '';

           

			if (isset($formData['image']) && !empty($formData['image'])) {
				$extension = $formData['image']->getClientOriginalExtension();
				$fileName = time() . '-user-image.' . $extension;
				if ($type == 'edit') {
					$image = $obj->image;
					@unlink(USER_PROFILE_IMAGE_ROOT_PATH . $image);
				}
				if ($formData['image']->move(USER_PROFILE_IMAGE_ROOT_PATH, $fileName)) {
					$obj->image = $fileName;
				}
			}
			if($obj->save()){
				$userId = $obj->id;
				if ($type == 'add') {
					//mail email and password to new registered user
					$to_name 	= 	$fullName;
					$to 		= 	$obj->email;
					$full_name 	= 	$to_name;
					if (in_array($from, [ADMIN_ROLE_SLUG])) {
						$action 		= 	"user_registration";
						$password 		=	$formData['password'];
						$route_url 		= 	route('User.login');
						$click_link 	= 	'<a href="' . $route_url . '" target="_blank">Click here</a>';
						$site_signature = 	Config::get('Site.email_signature');
						$rep_Array 		= 	array($full_name, $to, $password, $click_link, $route_url, $site_signature);
						$sendMail	= 	new SendMailService;
						$sendMail->callSendMail($to, $to_name, $rep_Array, $action); 
					}else {
                        /**Send mail to user for email verification*/
                        $action 			= "user_account_verification";
                        $validateString 	= $obj->email_validate_string;
                        $route_url 			= route('User.verify_account', $validateString);
                        $click_link 		= '<a href="' . $route_url . '" target="_blank">Click here</a>';
                        $rep_Array 			= array($full_name, $click_link, $route_url);
                        $sendMail = new SendMailService;
                        $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                        /* Send mail to user for email verification **/
          
					}
				}
				$response['status'] 		=	SUCCESS;
				$response['userId'] 		= 	$userId;
				$response['message'] 		=	$msg;
				$response['slug'] 			= 	$obj->slug;
				$response['validateString'] = 	$validateString;
				$response['otp'] 			=  	$obj->email_verification_code;
		    }
        }
        $response['errors'] = $errorsArray;
        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


    /**
     * ValidationHelper::userSignupValidation()
     * @Description Function for validation user signup
     * @param null
     * @return $validation message and validation
     **/
    public static function userSignupValidation($formData = array(), $attribute = array()){

        $userId     =   isset($attribute['user_id']) ? $attribute['user_id'] : '';
        $type       =   isset($attribute['type']) ? $attribute['type'] : '';
        $from       =   isset($attribute['from']) ? $attribute['from'] : '';
        $userDetail	=   CustomHelper::getUserDetail(['id'=>$userId]);
        $ext_text 	=	str_replace(",", ", ", IMAGE_EXTENSION);
        $userSlug 	= 	CUSTOMER_ROLE_SLUG;
        $message = array(
            'first_name.required'       => trans('messages.first_name.REQUIRED_ERROR'),
            'first_name.regex'          => trans('messages.first_name.VALID_ERROR'),
            'last_name.required'        => trans('messages.last_name.REQUIRED_ERROR'),
            'email.required'            => trans('messages.email.REQUIRED_ERROR'),
            'email.email'               => trans('messages.email.VALID_EMAIL_ERROR'),
            'email.unique'              => trans('messages.email.UNIQUE_EMAIL_ERROR'),
            'email.check_email'         => trans('messages.email.VALID_EMAIL_ERROR'),
            'password.required'         => trans('messages.password.REQUIRED_ERROR'),
            'password.min'              => trans('messages.global.password_help_message'),
            'password.regex'            => trans('messages.global.password_help_message'),
            'confirm_password.required' => trans('messages.confirm_password.REQUIRED_ERROR'),
            'confirm_password.same'     => trans('messages.confirm_password.MATCH_ERROR'),
            'phone.required'            => trans('messages.phone.REQUIRED_ERROR'),
            'phone.unique'              => trans('messages.phone.UNIQUE_ERROR'),
            'phone.valid_mobile_number' => trans('messages.phone.REQUIRED_ERROR'),
            'image.required'            => trans('messages.image.REQUIRED_ERROR'),
            'user_termsncond.required'  => trans('front_messages.global.ERROR_ACCEPT_TERMS_CONDITION'),
            'image.mimes'               => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => $ext_text]),
            'image.max'                 => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE]),
            'email.check_unique_email'  => trans('messages.email.UNIQUE_EMAIL_ERROR'),
            'phone.check_unique_phones' => trans('messages.phone.UNIQUE_ERROR'),
        );

        /*define validation */
        $validate = array(
            'first_name'    => 'required|max:200',
            'last_name'    => 'required|max:200',
            'email'         => 'required|max:200',
            'phone'         => 'required|valid_mobile_number',
        );
        if (($type == 'add') && ($from == 'front' || $from == 'mobile'))
		{
            $validate['password']         = 'required|regex:' . PASSWORD_REGX;
            $validate['confirm_password'] = 'required|same:password';
            $validate['email']            = 'required|max:200|check_email|check_unique_email:' . $userSlug;
            $validate['phone']            = 'required|valid_mobile_number|check_unique_phones:' . $userSlug;

        }else if (($type == 'edit') && ($from == 'front' || $from == 'mobile')) {
            $validate['image'] 			= 	'mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE * 1024);

        }else if (($type == 'add') && ($from == 'admin')) {
            $validate['password']                      = 'required|regex:' . PASSWORD_REGX;
            $validate['confirm_password']              = 'required|same:password';
            $validate['email']                         = 'required|max:200|check_email|check_unique_email:' . $userSlug;
            $validate['phone']                         = 'required|valid_mobile_number|check_unique_phones:' . $userSlug;
            $validate['image']                         = 'mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE * 1024);

        }else if (($type == 'edit') && ($from == 'admin')) {

            if (!empty(trim($formData['password'])) || !empty(trim($formData['confirm_password']))) {
                $validate['password']         = 'regex:' . PASSWORD_REGX;
                $validate['confirm_password'] = 'same:password';
            }
            if (array_key_exists("phone", $formData)) {
                $validate['phone'] = 'required|valid_mobile_number|check_unique_phones:' . $userSlug . ',' . $userId;
            }
            if (array_key_exists("email", $formData)) {
                $validate['email'] = 'required|max:200|check_email|check_unique_email:' . $userSlug . ',' . $userId;
            }
            $validate['image'] = 'mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE * 1024);
        }
        /*define validation */
        return array($message, $validate);
    }


	/**
     * UserService:: Login()
     * @function for login in site
     * @Used in overAll System
     * @param $form data as credential
     * @param $attribute as attribute array
     * @return response array */
    public static function login($formData = array(), $attribute = array())
    {
        $errorsArray 	= array();
        $userdata 		= array();
        $response 		= array();
        $type 			= isset($attribute['type']) ? $attribute['type'] : "add";
        $biometric		= isset($attribute['biometric']) ? $attribute['biometric'] : false;
        $status 		= ERROR;
        $message 		= '';
        list($errMessage, $validate) = ValidationHelper::getLoginValidation($formData);
        $validator = Validator::make($formData, $validate, $errMessage);

        // Check Validation
        if ($validator->fails() && (!$biometric)) {
            $errorsArray = $validator->errors()->toArray();
        } else {
				$authAttempt	=	false;
				if(!$biometric){
					$userdata = array(
						'email'     => $formData['email'],
						'password'  => $formData['password']
					);
					$authAttempt			=	Auth::attempt($userdata);
					$incorrectLoginMessage 	= 	trans("front_messages.Login.incorrect_credential");
				} else {
					$user_id				= 	isset($attribute['user_id']) ? $attribute['user_id'] : false;
					$device_token   		= 	isset($formData['device_token']) ? $formData['device_token'] : '';
					$incorrectLoginMessage 	= 	trans("messages.dashboard.you_are_not_authorized_to_access_this_location");
					$userdata 		        = 	User::where('id',$user_id)->where('device_token',$device_token)->first();
					if(!empty($userdata)){
						$authAttempt	    =	Auth::loginUsingId($userdata->id);
					}
				}
            if ($authAttempt) {
                if (Auth::check() && (in_array(Auth::user()->user_role_id, [CUSTOMER_ROLE_ID]))) {
                    $fullname 		=   Auth::user()->full_name;
                    $firstName 		=   Auth::user()->first_name;
					$userDataArray 	=   Auth::user()->toArray();
                    $image          =   isset($userDataArray['image']) ? $userDataArray['image'] : '';
                    $image_full_path = '';
                    if ($image) {
                        $image_full_path = USER_PROFILE_IMAGE_URL . $image;
                    }
                    $userDataArray['image_url'] = $image_full_path;
                    /**Check user is deleted */
                    if (array_key_exists("user_role_id", $formData)) {
                        if (Auth::check() && Auth::user()->user_role_id != $formData['user_role_id']) {
                            Auth::logout();
                            if ($type == 'api') {
                                $message = trans("messages.dashboard.you_are_not_authorized_to_access_this_location");
                            } else {
                                return ['status' => ERROR, 'message' => trans("messages.dashboard.you_are_not_authorized_to_access_this_location")];
                            }
                        }
                    }
                    /**Check user is blocked */
                    if (Auth::check() && Auth::user()->block == BLOCK) {
                        Auth::logout();
                        if ($type == 'api') {
							$response['user_data'] 	= 	$userDataArray;
                            $message 				= 	trans("messages.login.account_blocked");
                        } else {
                            return ['status' => ERROR, 'message' => trans("messages.login.account_blocked")];
                        }
                    }
                    /**Check user is inactive */
                    if (Auth::check() && Auth::user()->active == INACTIVE) {
                        Auth::logout();
                        if ($type == 'api') {
							$response['user_data'] 	= 	$userDataArray;
                            $message 				= 	trans("messages.login.account_deactive");
                        } else {
                            return ['status' => ERROR, 'message' => trans("messages.login.account_deactive")];
                        }
                    }
					/**Check user is inactive */
                    if (Auth::check() && Auth::user()->is_verified == INACTIVE) {

						$validateString	=   Auth::user()->validate_string;
						$full_name		=   Auth::user()->full_name;
						$useremail      =	Auth::user()->email;
						Auth::logout();
                        if ($type == 'api') {
							$response['user_data'] 	            = 	$userDataArray;
							$resendFormData['validate_string']	=	$validateString;
							$resendFormData['page_name']		=	'account_verify';
                            $message                            = 	trans("front_messages.email_not_verified_for_app");
							self::userResendOtpForMobileApp($resendFormData);
                            
							if (isset($formData['mobile_req']) && $formData['mobile_req']) {
								$status	= 	SUCCESS;
							}
						} else {
                                /* mail to registered user */
                               /* $to				= 	$useremail;
                                $to_name		= 	ucwords($full_name);
                                $full_name		=	$to_name;
                                $route_url      =  	route('User.verify_account',$validateString);
                                $link 			=   $route_url;
                                $click_link 	= '<a href="'.$route_url.'" target="_blank">Click here</a>';
                                $action 		= 	"resend_account_verification";
                                $rep_Array 		= 	array($full_name,$click_link,$route_url);
                                $sendMail = new SendMailService;
						        $sendMail->callSendMail($to, $to_name, $rep_Array, $action);*/
                            return ['status' => ERROR, 'message' => trans("front_messages.email_not_verified")];
                        }
                    }

                    /**Check user is deleted */
                    if (Auth::check() && Auth::user()->is_deleted == IS_DELETE) {
                        Auth::logout();
                        if ($type == 'api') {
							$response['user_data'] 	= 	$userDataArray;
                            $message 				= 	trans("messages.login.account_deleted");
                        } else {
                            return ['status' => ERROR, 'message' => trans("messages.login.account_deleted")];
                        }
                    }
                    if (Auth::check()) {
                        if (isset($attribute['login_from']) && ($attribute['login_from'] == 'user_signup')) {
                            if (Auth::user()->user_role_id == CUSTOMER_ROLE_ID) {
                                $msg = trans("front_messages.user_registration_success");
                            } else {
                                $msg = trans("front_messages.user_registration_success");
                            }
                        } else {
                            if (Auth::user()->is_mobile_verified == NOT_VERIFIED) {
                                $msg = trans("front_messages.Login.user_success", ['user_name' => ucfirst($firstName)]);
                            } else {
                                $msg = trans("front_messages.Login.user_success", ['user_name' => ucfirst($firstName)]);
                            }
                        }

                        if ($type == 'api') {

                            $userData 	= Auth::user()->toArray();
                            $image 		= isset($userData['image']) ? $userData['image'] : '';
                            $image_full_path = '';
                            if ($image) {
                                $image_full_path = USER_PROFILE_IMAGE_URL . $image;
                            }
                            $userData['image_url']      = $image_full_path;
                            $userData['date_of_birth']  = !empty($userData['date_of_birth']) ? date(DISPLAY_DATE_FORMAT, $userData['date_of_birth']) : '';
                            $userData['phone']          = str_replace($userData['dial_code'], "", $userData['phone']);
                            $response['user_data']      = $userData;

							if ($biometric){
								$userLoggedInData	= 	Auth::user();
								$token				= 	JWTAuth::fromUser($userLoggedInData);
							} else {
								$token	= 	JWTAuth::attempt($userdata);
							}
							$response['user_data']['token']	= 	$token;
                            $status                         =   SUCCESS;
                            $message                        =   $msg;
                            $userdata                       =   Auth::user()->toArray();
                            if (isset($formData['remember']) && !empty($formData['remember'])) {
								$rememberData['user_email']     = $userdata['email'];
								$rememberData['user_remember']  = $formData['remember'];
								setcookie('remember_user', json_encode($rememberData), time() + (86400 * 30));
							} else {
								setcookie('remember_user', '', time() - (86400 - 30));
							}
							// update device token and device id
							if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
								$obj               = User::findOrFail(Auth::user()->id);
								$obj->device_token = isset($formData['device_token']) ? $formData['device_token'] : '';
								$obj->device_id    = isset($formData['device_id']) ? $formData['device_id'] : '';
								$obj->device_type  = isset($formData['device_type']) ? $formData['device_type'] : '';
								$obj->save();
							}
                            
                        } else {
                            Session::flash(SUCCESS, $msg);
                            $userdata = Auth::user()->toArray();
							if (isset($formData['remember']) && !empty($formData['remember'])) {
								$rememberData['user_email']     = $userdata['email'];
								$rememberData['user_remember']  = $formData['remember'];
								setcookie('remember_user', json_encode($rememberData), time() + (86400 * 30));
							} else {
								setcookie('remember_user', '', time() - (86400 - 30));
							}
                            if (!empty($formData['return_url'])) {
                                return ['status' => SUCCESS, 'returnUrl' => $formData['return_url']];
                            } else {
                                return ['status' => SUCCESS];
                            }
                        }
                    } else {

                    }
                } else {
                    if (Auth::check()) {
                        Auth::logout();
                    }
                    if ($type == 'api') {
                        $message = trans("messages.dashboard.you_are_not_authorized_to_access_this_location");
                    } else {
                        return ['status' => ERROR, 'message' => trans("messages.dashboard.you_are_not_authorized_to_access_this_location")];
                    }
                }
            } else {
                if ($type == 'api') {
                    $message = $incorrectLoginMessage;
                } elseif ($type == 'front') {
                    $message = $incorrectLoginMessage;
                } else {
                    return ['status' => ERROR, 'message' => $incorrectLoginMessage];
                }
            }
        }

        $response['status']     = $status;
        $response['errors']     = $errorsArray;
        $response['returnUrl']  = (isset($formData['return_url']) && !empty($formData['return_url'])) ? $formData['return_url'] : '';
        $mobile = 0;
        if (isset($message) && $message != "") {
            $response['message'] = $message;
        }
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
            if (isset($message)) {
                $response['message'] = $message;
            }
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


	/**
	 * Function for User logout
	 *
	 * @param null
	 *
	 * @return rerirect page.
	 */
	public function userLogout($formData,$attr=array(),$model="User",$deviceData= array()){
		$mobile				    = (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
        $formData['user_id']    = isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
		$message 			    = '';
		$response		     	= array();
		$response['status']     = ERROR;
		$response['message']	= trans('messages.forgot.invalid_access');
		$userId			    	= isset($formData['user_id'])?$formData['user_id']:'';
		$obj        			= User::where('id',$userId)->first();
		if(!empty($obj)){
			$response['status']	    = SUCCESS;
			$response['message']	= trans("messages.User.logout_message");
		}

		if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
			$res = array('data'=> $response,'mobile_req'=>$mobile);
		}else{
			$res = array('data'=> $response,);
		}
		return	$res;
	}//end userLogout()


	/**
     * UserService:: userForgetPassword()
     * @function for user Forget Password
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userForgetPassword($formData = array(), $attribute = array())
    {
        $response                    =  array();
        $from                        = $attribute['from'];
        $errorsArray                 = array();
        $status                      = ERROR; 
        $webStatus                   = ERROR;
        $message                     = '';
        $response                    = array();
        list($errMessage, $validate) = ValidationHelper::getForgotPasswordValidation($formData, $attribute);
        $validator                   = Validator::make($formData, $validate, $errMessage);
        // Check Validation
        if ($validator->fails()) {
            $errorsArray = $validator->errors()->toArray();
        } else {
            $userSlug = !empty($formData['user_type']) ? $formData['user_type'] : CUSTOMER_ROLE_SLUG;
            if (is_numeric($formData['email'])) {
                $first_character = substr($formData['email'], 0, 1);
                if ($first_character == '+') {
                    $userDetail = User::where('phone', $formData['email'])->where('user_role_slug', $userSlug)->first();
                } else {
                    $userDetail = User::where('phone_number', $formData['email'])->where('user_role_slug', $userSlug)->first();
                }
                if (!empty($userDetail)) {
                    if ($userDetail->active == ACTIVE) {
                        $phone              = $userDetail->phone;
                        $otp_number         = CustomHelper::generate_verification_code();
                        $validate_string    = md5(time() . $userDetail->email . $userSlug);
                        $resend_time        = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
                        User::where('phone', $phone)->where('user_role_slug', $userSlug)->update(array(
                            'forgot_password_validate_string' => $validate_string,
                            'mobile_verification_code' => $otp_number,
                            'mobile_verification_code_time' => $resend_time,
                            'resend_otp_time' => $resend_time,
                        ));
                        $status             = SUCCESS;
                        $webStatus          = SUCCESS;
                        $response['slug']   = $userDetail->slug;
                        // Send OTP sms to user
                        $OTP        = $otp_number;
                        $mobile_no  = $phone;
                        CustomHelper::_SendOtp('resend_otp', $mobile_no, $OTP);
                        $message                        = trans('front_messages.verify_mobile_number');
                        $response['from']               = 'phone';
                        $currentTime                    = CustomHelper::getCurrentTime();
                        $response['resend_time']        = CustomHelper::convert_timestamp_to_date_for_otp($resend_time);
                        $response['current_time']       = CustomHelper::convert_timestamp_to_date_for_otp($currentTime);
                        $response['validate_string']    = $validate_string;
                    } else {
                        /*$message     =     trans('front_messages.login.account_not_verify');*/
                        $message = trans('front_messages.login.account_not_active');
                        $status = ERROR;
                        $webStatus = ERROR;
                    }
                } else {
                    $message = trans('front_messages.global.phone_number_not_registered_with_us');
                    $status = ERROR;
                    $webStatus = SUCCESS;

                }
            } else {
                $userDetail = User::where('email', $formData['email'])->where('user_role_slug', $userSlug)->first();
                if (!empty($userDetail)) {
                    $email = $userDetail->email;
                    if ($userDetail->active == ACTIVE) {
                        if ($userDetail->is_deleted == INACTIVE) {
                            $forgot_password_validate_string = md5(time() . $userDetail->email . $userSlug);

                            User::where('email', $email)->where('user_role_slug', $userSlug)->update(array('forgot_password_validate_string' => $forgot_password_validate_string));
                            $status             = SUCCESS;
                            $webStatus          = SUCCESS;
                            $response['slug']   = $userDetail->slug;

                            //forgot password mail to user
                            $to = $email;
                            $to_name = ucwords($userDetail->full_name);
                            $full_name = $to_name;
                            $route_url = route('User.resetPassword', $forgot_password_validate_string);
                            $varify_link = $route_url;
                            $action = "forgot_password";
                            $rep_Array = array($full_name, $varify_link, $route_url);

                            $sendMail = new SendMailService;
                            $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                            $message = trans('front_messages.forgot_password_email_mobile_not_found_one') . ' ' . $formData['email'] . '. ' . trans('front_messages.forgot_password_email_not_found_two');
                            $response['from'] = 'email';
                            Session::flash(SUCCESS, $message);
                            //forgot password mail to user
                        } else {
                            $message = trans('front_messages.Login.account_deleted');
                            $status = ERROR;
                        }
                    } else {
                        /*$message     = trans('front_messages.login.account_not_verify');*/
                        $message = trans('front_messages.login.account_not_active');
                        $status = ERROR;
                    }

                } else {
                    $message = trans('front_messages.global.email_id_not_registered_with_us');
                    $response['from'] = 'email';
                    $status = ERROR;
                    $webStatus = ERROR;
                }
            }
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $response['errors'] = $errorsArray;
        $mobile = 0;
        if (isset($message) && $message != "") {
            $response['message'] = $message;
        }
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
            if (isset($message)) {
                $response['message'] = $message;
            }
        } else {
            $response['webStatus'] = $webStatus;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


	/**
     * UserService:: userResetPasswordValidationAndSave()
     * @function for user Reset Password Validation And Save
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userResetPasswordValidationAndSave($formData = array(), $attribute = array())
    {
        $response                   = array();
        $errosArray                 = array();
        $message                    = '';
        $status                     = ERROR;
        $from                       = $attribute['from'];
        list($message, $validate)   = ValidationHelper::getResetPasswordValidation();
        $validator                  = Validator::make($formData, $validate, $message);
        // Check Validation
        if ($validator->fails()) {
            $errosArray = $validator->errors()->toArray();
        } else {
            $newPassword        = $formData['password'];
            $newPassword        = Hash::make($newPassword);
            $validate_string    = $formData['validate_string'];
            $userInfo           = User::where('forgot_password_validate_string', $validate_string)->first();
            if (isset($userInfo) && !empty($userInfo)) {
                User::where('forgot_password_validate_string', $validate_string)->update(array(
                    'password' => $newPassword,
                    'forgot_password_validate_string' => null,
                ));
                $response['user_data']['userRoleId']    = $userInfo->user_role_id;
                $response['user_data']['email']         = $userInfo->email;
                $response['user_data']['full_name']     = ucwords($userInfo->full_name);
                $status                                 = SUCCESS;
                $message                                = trans('front_messages.reset_password_success');
            } else {
                $status     = ERROR;
                $message    = trans('front_messages.sorry_you_are_using_wrong_link');
            }
        }
        $response['status']     = $status;
        $response['message']    = $message;
        $response['errors']     = $errosArray;
        $mobile                 = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


	 /**
     * UserService::userChangePassword()
     * @param formData
     * @param model
     * @return $validation message and validation
     * */
    public static function userChangePasswordValidationAndSave($formData = array(), $attribute = array())
    {
        $response                   = array();
        $errosArray                 = array();
        $message                    = '';
        $status                     = ERROR;
        list($message, $validate)   = ValidationHelper::getUserChangePasswordValidation();
        $validator                  = Validator::make($formData, $validate, $message);
        // Check Validation
        if ($validator->fails()) {
            $errosArray = $validator->errors()->toArray();
        } else {
            //update code
            $user_id            = isset($formData['user_id']) ? $formData['user_id'] : Auth::user()->id;
            $userInfo           = User::find($user_id);
            $old_password       = strip_tags($formData['old_password']);
            $password           = strip_tags($formData['new_password']);
            $confirm_password   = strip_tags($formData['confirm_password']);
            if (!Hash::check($old_password, $userInfo->password)) {
                $status  = ERROR;
                $message = trans('front_messages.old_password_incorrect');
            } else {
                $userInfo->password = Hash::make($password);
                $userInfo->save();
                $status     = SUCCESS;
                $message    = trans('front_messages.reset_password_success');
            }
        }
        $response['status']  = $status;
        $response['message'] = $message;
        $response['errors']  = $errosArray;
        $mobile              = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


	/**
	 * Function for save getUserProfileData
	 *
	 * @param null
	 *
	 * @return rerirect page.
	 */
    /*
	public function getUserProfileData($formData,$attr=array(),$model="User",$deviceData= array())
	{
		$mobile			    =   (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$message 			= 	'';
		$response			=	array();
		$result			    =	array();
		$response['status']	=	SUCCESS;
		$slug        	    = 	isset($formData['slug']) ? $formData['slug'] : '';
		$userData = array();
		if($slug != '')
		{
			$userData = User::with(['cityName'])->where('slug',$slug)->first();

			if(!empty($userData)){
				$result['slug']                     =   $userData->slug;
                $result['first_name']   	         =  $userData->first_name;
                $result['last_name']            	 =  $userData->last_name;
				$result['full_name']   	            =   $userData->full_name;
				$result['email']                   	= 	$userData->email;
				$result['phone_number']            	= 	isset($userData->phone_number)?$userData->phone_number:'';
				$result['dial_code']               	= 	isset($userData->dial_code)?$userData->dial_code:'';
				$result['validate_string']         	= 	isset($userData->validate_string)?$userData->validate_string:'';
				$result['image_url']               	= 	USER_PROFILE_IMAGE_URL.$userData->image;
				$result['resizable_url']           	= 	WEBSITE_IMG_FILE_URL . '?image=' . USER_PROFILE_IMAGE_URL.$userData->image;
				$result['country']                 	= 	isset($userData->country) ? $userData->country : '';
				$result['state']                   	= 	isset($userData->state) ? $userData->state : '';
				$result['city']                   	= 	isset($userData->city) ? $userData->city : '';
				$result['is_email_verified']       	= 	isset($userData->is_email_verified) ? $userData->is_email_verified : '';
				$result['country_name']         	= 	isset($userData->countryName->country_name) ? $userData->countryName->country_name : '';
				$result['state_name']              	= 	isset($userData->stateName->state_name) ? $userData->stateName->state_name : '';
				$result['city_name']              	= 	isset($userData->cityName->city_name) ? $userData->cityName->city_name : '';
				$result['address_one']              = 	isset($userData->address_one) ? $userData->address_one : '';
				$result['nationality_country']     	= 	isset($userData->nationality_country) ? $userData->nationality_country : '';
				$result['nationality_country_name']  = 	isset($userData->nationalityCountryName->country_name) ? $userData->nationalityCountryName->country_name : '';
				$result['is_selfie_verify']      	= 	isset($userData->is_selfie_verify ) ? $userData->is_selfie_verify  : REQPENDING;



                $result['verification_type']     	= 	isset($userData->verification_type) ? $userData->verification_type : '';
                $result['verification_value']     	= 	isset($userData->verification_type) ?  Config::get("VERIFICATION_TYPE_DROPDOWN." .$userData->verification_type) : '';
				$result['passport_driving_no']    	= 	isset($userData->passport_driving_no) ? $userData->passport_driving_no : '';

                $result['zip_code']             	= 	isset($userData->zip_code) ? $userData->zip_code : '';



                $result['dl_image_1']               =   $userData->dl_image_1;
                $result['dl_image_2']               = 	$userData->dl_image_2;
                $result['passport_image']           = 	$userData->passport_image;
                $result['national_id']            	= 	$userData->national_id;
                $result['upload_document']        	= 	$userData->upload_document;
                $result['upload_selfie']        	= 	$userData->upload_selfie;

                $result['is_document_verify']       = 	isset($userData->is_document_verify) ? $userData->is_document_verify : INACTIVE;
                $result['is_document_deleted']      = 	isset($userData->is_document_deleted) ? $userData->is_document_deleted : INACTIVE;

				$result['dob']	=	null;
				if(isset($userData->date_of_birth) && !empty($userData->date_of_birth)){
					$result['dob'] = CustomHelper::convert_timestamp_to_date_time($userData->date_of_birth, DISPLAY_DATE_FORMAT_CALENDAR);
				}

                $result['document_base_url']        	= 	USER_DOCUMENT_IMAGE_URL;
				$result['document_verify_note']        	= 	trans("front_messages.User.user_change_profile_data_after_document_verify");
			}
		}
		$response['result'] = $result;
		if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
			$res = array('data'=> $response,'mobile_req'=>$mobile);
		}else{
			$res = array('data'=> $response,);
		}
		return	$res;
	}*/
    //end getUserProfileData()


	/**
     * UserService::userProfileImageValidateSave()
     * @param formData  array
     * @param attributes array
     * @return response
     **/
    public static function userProfileImageValidateSave($formData = array(), $attributes = array())
    {
        $status = ERROR;
		$errorsArray = array();
        $response = array();
		$mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $type = isset($attributes['type']) ? $attributes['type'] : '';
        $from = $attributes['from'];
        $userId = $attributes['userId'];
        list($message, $validate) = ValidationHelper::getUserImageValidation($formData, $attributes);
        $validator = Validator::make(Request::all(), $validate, $message);

        // Check Validation
        if ($validator->fails()) {
            if ($mobile) {
                $errorsArray = $validator->errors()->toArray();
            }
			else {
                $res = array('status' => $status, 'validator' => $validator);
                return $res;
            }
        }
		else {
			// code for image update
			$old_image = User::where('id', $userId)->pluck('image');

			$extension = $formData['image']->getClientOriginalExtension();
			$fileName = time() . '-user-image.' . $extension;

			if ($formData['image']->move(USER_PROFILE_IMAGE_ROOT_PATH, $fileName)) {
				$newImage = $fileName;
			}
			if (!empty($old_image)) {
				@unlink(USER_PROFILE_IMAGE_ROOT_PATH . $old_image);
			}
			User::where('id', $userId)->update(array('image' => $newImage));

			$response = array('data' => array('newImage' => $newImage, 'newImagePath' => USER_PROFILE_IMAGE_URL . $newImage, 'status' => SUCCESS, 'message' => trans('front_messages.global.profile_image_uploaded_successfully')));

           $status 				= 	SUCCESS;
           $response['message'] =  	trans('front_messages.global.profile_image_uploaded_successfully');
        }

        $response['errors'] = $errorsArray;
		$response['status'] = $status;

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

		$res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    } //end userProfileImageValidateSave()


    /**
     * function for userForgetPassword()
     * @function for user Forget Password
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userForgetPasswordForMobileApp($formData = array(), $attribute = array())
	{
		$mobile				    = (isset($attribute['from']) &&($attribute['from'] =='mobile')) ?ACTIVE: INACTIVE;
        $response 		        = array();
        $from 			        = $attribute['from'];
        $errorsArray 	        = array();
        $status 		        = ERROR;
        $message		        =  '';
		$response 		        = array();
		$response['status'] 	= ERROR;

        list($errMessage, $validate) = ValidationHelper::getForgotPasswordValidation($formData, $attribute);
        $validator = Validator::make($formData, $validate, $errMessage);
        // Check Validation
        if ($validator->fails()) {
           if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
				$response['errors'] =   $validator->errors()->toArray();
				$res = array('data'=> $response,'mobile_req'=>$mobile);
			}
			else{
				$res = array('data'=> $response,'validator'=>$validator);
			}
			return	$res;
        }
		else{
			$email		     		=	isset($formData['email']) ? strtolower($formData['email']) :'';
			$userDetail             =   User::where('email', $email)->first();
			if (!empty($userDetail))
			{
				$slug               = isset($userDetail->slug) ? $userDetail->slug : "";
				if ($userDetail->active == ACTIVE && $userDetail->is_verified == ACTIVE ){
					if ($userDetail->is_deleted == INACTIVE) {
						$forgot_password_validate_string  = md5($userDetail->email);
						$otp					          =	CustomHelper::generate_verification_code();
						$otpValidTime					  =	CustomHelper::convert_date_to_timestamp(OTP_VALID_TIME);
						$resendOTPTime					  =	CustomHelper::convert_date_to_timestamp(OTP_VALID_TIME);
						$forgot_verification_code_time	  = $otpValidTime;
						$forgot_resend_otp_time			  = $resendOTPTime;

						User::where('slug', $slug)->update(array('forgot_password_validate_string' => $forgot_password_validate_string,'forgot_password_verification_code'=>$otp,"forgot_verification_code_time"=>$forgot_verification_code_time,"forgot_resend_otp_time"=>$forgot_resend_otp_time));

						$status 			= SUCCESS;
						$response['slug'] 	= $userDetail->slug;
						//forgot password mail to user
						$signature = Config::get("Site.email_signature");
						$to 			= $userDetail->email;
						$to_name 		= ucwords($userDetail->first_name);
						$full_name 		= $to_name;
						$action 		= "forgot_password_app";
						$rep_Array 		= array($full_name, $otp,$signature);

						$sendMail = new SendMailService;
						$sendMail->callSendMail($to, $to_name, $rep_Array, $action);

						$msg            = trans("messages.front.forgot_password_message_on_email");

						$response['status']				 =	SUCCESS;
						$response['message']		 	 =	$msg;
						$response['validate_string']	 = 	$forgot_password_validate_string;
						$response['otp']	 		     = 	$otp;

						$res	=	array('data'=> $response,'mobile_req'=>$mobile);
						return $res;
					}
					else {
						$data['status']			    = ERROR;
						$data['message']			= trans('messages.Login.account_deleted');
						if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
							$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
						}
						else{
							$res = array('status' => ERROR, 'data' => $data);
						}
						return $res;
					}
				}
				else {
					$data['status']			=	ERROR;
					$data['message']		=	trans('messages.login.account_not_verify');
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
					}
					else{
						$res = array('status' => ERROR, 'data' => $data);
					}
					return $res;
				}
			}
			else {
				$data['status']			=	ERROR;
				$data['message']		=	trans('messages.forgot.forgot_password_message');
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
				}
				else{
					$res = array('status' => ERROR, 'data' => $data);
				}
				return $res;
			}
		}
    } // End userForgetPassword()


    /**
     * userVerifyOtp()
     * @function for userVerifyOtp User
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userVerifyOtpForMobileApp($formData = array(), $attribute = array())
	{
		$mobile				=	(isset($attribute['from']) &&($attribute['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$response			=	array();
		$response['status'] =   ERROR;
		$currentTime		=	CustomHelper::getCurrentTime();

        if (!empty($formData)) {

			$validate_string = isset($formData['validate_string'])?$formData['validate_string']:'';
			$page_name		 =	isset($formData['page_name'])?$formData['page_name']:'account_verify';

			if($page_name == 'forgot_password'){
				$userDetails = User::where('forgot_password_validate_string', $validate_string)->first();
			}
			else{
				$userDetails = User::where('validate_string', $validate_string)->first();
			}

			if(empty($userDetails)){
				$response['message']	= 	trans('messages.forgot.invalid_access');
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$res = array('status' => ERROR, 'data' => $response,'mobile_req'=>$mobile);
				}
				else{
					$res = array('status' => ERROR, 'data' => $response);
				}
				return $res;
			}

            $from 		= 	$attribute['from'];
            $model 		= 	isset($attribute['model'])?$attribute['model']:'';


			list($message, $validate) 	= 	ValidationHelper::getOtpVerificationValidation($formData, $attribute);
            $validator = Validator::make($formData, $validate, $message);

			if ($validator->fails()) {
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$response['errors'] =   $validator->errors()->toArray();
					$res = array('data'=> $response,'validator'=>$validator,'mobile_req'=>$mobile);
				}
				else{
					$res = array('data'=> $response,'validator'=>$validator);
				}
				return	$res;
            }
			else {

				$validate_string = isset($formData['validate_string'])?$formData['validate_string']:'';
				if($page_name == 'forgot_password'){
					$verification_code_time = $userDetails['forgot_verification_code_time'];
				}
				else{
					$verification_code_time = $userDetails['verification_code_time'];
				}
				if ($verification_code_time < $currentTime){
					$data['message'] 		= 	trans("messages.front.otp_expired");
					$data['validateString']	= 	$validate_string;
					$data['page_name']		= 	$page_name;
					$data['status']			=	ERROR;
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
					}
					else{
						$res = array('status' => ERROR, 'data' => $data);
					}
					return $res;
				}
				else{

					if($page_name == 'forgot_password'){
						User::where('forgot_password_validate_string', $validate_string)->update(array(
							'forgot_password_verification_code' => NULL,
							'forgot_verification_code_time'=>NULL,
							'forgot_resend_otp_time'=>NULL
						));

						$msg = trans("messages.front.otp_verified");

					}
					else{
						User::where('validate_string', $validate_string)->update(array(
							'is_email_verified' => IS_VERIFIED,
							'is_verified' => IS_VERIFIED,
							'email_verification_code' => NULL,
							'verification_code_time' => NULL,
							'resend_otp_time' => NULL,

						));
						$msg = trans("messages.front.otp_verified_account_verify");
					}

					$data['message'] 		                = $msg;
					$data['status']			                = SUCCESS;
					$data['page_name']		                = $page_name;
					$data['userData']	                    = $userDetails;

					/** GENERATE TOKEN **/
					Auth::loginUsingId($userDetails['id']);
					$userLoggedInData 			= 	Auth::user();
					$data['userData']['token']	= 	JWTAuth::fromUser($userLoggedInData);
					/** GENERATE TOKEN **/

					$data['validate_string']            	= $validate_string;
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg,'mobile_req'=>$mobile);
					}
					else{
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg);
					}
					return $res;
				}
			}
        }
		else {
            $data['message'] = trans("messages.otp_error_message");
            $data['msg_type'] = ERROR;
            $response = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
            return $response;
        }
    } // End userVerifyOtp()


	/**
     * userResendOtpForMobileApp()
     * @function for resend otp
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userResendOtpForMobileApp($formData = array(), $attribute = array())
	{
		$mobile				    = (isset($attribute['from']) &&($attribute['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$response				= array();
		$response['status'] 	= ERROR;

        if (!empty($formData['validate_string']))
		{
			$validateString 		= 	$formData['validate_string'];
			$validateStringField 	= 	'';

			if(isset($formData['page_name']) && $formData['page_name'] == "account_verify"){
				$validateStringField = 'validate_string';
			}
			else if(isset($formData['page_name']) && $formData['page_name'] == "forgot_password"){
				$validateStringField = 'forgot_password_validate_string';
			}
			else if(isset($formData['page_name']) && $formData['page_name'] == "email_verify"){
				$validateStringField = 'validate_string';
			}

			$userInfo = User::where($validateStringField, $formData['validate_string'])->get()->first();

            if (!empty($userInfo))
			{
				$otpValidTime		=	CustomHelper::convert_date_to_timestamp(OTP_VALID_TIME);
				$resendOTPTime		=	CustomHelper::convert_date_to_timestamp(OTP_VALID_TIME);
				$otpCode			=	CustomHelper::generate_verification_code();

				if(isset($formData['page_name']) && $formData['page_name'] == "account_verify"){
					$userInfo->verification_code_time		=  	$otpValidTime;
					$userInfo->resend_otp_time				=  	$resendOTPTime;
					$userInfo->email_verification_code     	=  	$otpCode;
					$userInfo->device_type 	                =   isset($formData['device_type'])?$formData['device_type']:null;
					$userInfo->save();
					$otp									=	$otpCode;
				}
				else if(isset($formData['page_name']) && $formData['page_name'] == "forgot_password"){
					$userInfo->forgot_verification_code_time		=  	$otpValidTime;
					$userInfo->forgot_resend_otp_time				=  	$resendOTPTime;
					$userInfo->forgot_password_verification_code    =  	$otpCode;
					$userInfo->device_type 	                        =   isset($formData['device_type'])?$formData['device_type']:null;
					$userInfo->save();
					$otp											=	$otpCode;
				}
				else if(isset($formData['page_name']) && $formData['page_name'] == "email_verify"){
					$userInfo->verification_code_time		=  	$otpValidTime;
					$userInfo->resend_otp_time				=  	$resendOTPTime;
					$userInfo->email_verification_code     	=  	$otpCode;
					$userInfo->device_type 	                =   isset($formData['device_type'])?$formData['device_type']:null;
					$userInfo->save();
					$otp									=	$otpCode;

				}

				if(($formData['page_name'] == "forgot_password")||($formData['page_name'] == 'account_verify') ||($formData['page_name'] == 'email_verify') ){
					//Re Send OTP mail to user
					if (!empty($userInfo->email)) {
						$to_name 		= ucwords($userInfo->first_name);
						$to				= $userInfo->email;
						$full_name 		= $to_name;
						$otp 			= $otp;
						$action 		= "resend_otp";
						$rep_Array 		= array($full_name,$otp);

						$sendMail = new SendMailService;
						$sendMail->callSendMail($to, $to_name, $rep_Array, $action);

						/** Send Otp to particular user **/
						$response['message']	=	trans("messages.front.email_otp_resend_successfully");
					}
				}

                $response['status']		    = SUCCESS;
                $response['otp']		    = $otp;
                $response['validateString']	= $validateString;
            }
        }
		if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
			$res = array('status' => SUCCESS, 'data' => $response,'mobile_req'=>$mobile);
		}else{
			$res = array('status' => SUCCESS, 'data' => $response);
		}
		return $res;
    } // End userResendOtp()


	/**
     * UserService:: userEmailVerification()
     * @function for user email verification
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userEmailVerification($formData = array(), $attribute = array()){

        if (isset($formData['validateString']) && !empty($formData['validateString']) && $formData['validateString'] != null) {
            $userInfo = User::where('email_validate_string', $formData['validateString'])->first();
            if (isset($userInfo) && !empty($userInfo)) {
                $is_verified = $userInfo->is_verified;
                if (isset($is_verified) && $is_verified == ACTIVE) {
                    $data['user_role_id']   = $userInfo->user_role_id;
                    $data['message']        = trans('front_messages.user.already_verified');
                    $data['status']         = ERROR;
                    $response               = array('status' => ERROR, 'data' => $data);
                    return $response;
                } else {
                    User::where('email_validate_string', '=', $formData['validateString'])->update(array('is_verified' => ACTIVE, 'is_email_verified' => ACTIVE, 'email_validate_string' => null));
                    $data['user_role_id']   = $userInfo->user_role_id;
                    $data['email']          = $userInfo->email;
                    $data['full_name']      = ucwords($userInfo->full_name);
                    $data['status']         = SUCCESS;
                    $response               = array('status' => SUCCESS, 'data' => $data);
                    return $response;
                }
            } else {
                $data['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
                $data['status'] = ERROR;
                $response       = array('status' => ERROR, 'data' => $data);
                return $response;
            }
        } else {
            $data['message']    = trans('front_messages.sorry_you_are_using_wrong_link');
            $data['status']     = ERROR;
            $response           = array('status' => ERROR, 'data' => $data);
            return $response;
        }
    }


	/**
     * UserService::userChangePassword()
     * @param formData
     * @param model
     * @return $validation message and validation
     * */
    public static function deleteUserAccount($formData = array(),$attributes = array())
	{
        $userId		         =	isset($attributes['user_id'])?$attributes['user_id']:'';
        $logginUserId		 =	isset($attributes['user_role_id'])?$attributes['user_role_id']:'';

        $response = array();
        $message = '';
        $status = ERROR;

        $obj = User::findOrFail($userId);
        if($obj){
			$obj->email = DELETE_PREFIX . $obj->email;
			$obj->phone = DELETE_PREFIX . $obj->phone;
			$obj->is_deleted = IS_DELETED;
			$obj->deleted_by =$logginUserId;
			if($obj->save()){
				$status = SUCCESS;
				$message = trans("messages.User.deleted_message");
			}
		}

        $response['message'] = $message;
        $response['status'] = $status;
        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }






























































































	/**
     * userTempEmailVerifyOtp()
     * @function for userTempEmailVerifyOtp User
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userTempEmailVerifyOtp($formData = array(), $attribute = array()) {
		$mobile				=	(isset($attribute['from']) &&($attribute['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$response			=	array();
		$response['status'] =   ERROR;
		$currentTime		=	CustomHelper::getCurrentTime();
        if (!empty($formData)) {
			$validate_string = isset($formData['validate_string'])?$formData['validate_string']:'';
			$userDetails = User::where('validate_string', $validate_string)->select('id', 'email_verification_code', 'verification_code_time','temp_email')->first();
			if(empty($userDetails)){
				$response['message'] 		= 	trans('Invalid Access.');
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$res = array('status' => ERROR, 'data' => $response,'mobile_req'=>$mobile);
				}else{
					$res = array('status' => ERROR, 'data' => $response);
				}
				return $res;
			}

			list($message, $validate) 	= 	ValidationHelper::getOtpVerificationValidation($formData, $attribute);
            $validator = Validator::make($formData, $validate, $message);
			if ($validator->fails()) {
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$response['errors'] =   $validator->errors()->toArray();
					$res = array('data'=> $response,'validator'=>$validator,'mobile_req'=>$mobile);
				}else{
					$res = array('data'=> $response,'validator'=>$validator);
				}
				return	$res;
            }else {
				$validate_string = isset($formData['validate_string'])?$formData['validate_string']:'';
				$userDetails = User::where('validate_string', $validate_string)->first()->toArray();
				$verification_code_time = $userDetails['verification_code_time'];
				if ($verification_code_time < $currentTime) {
					$data['message'] 		            = trans("messages.front.otp_expired");
					$data['userData']['validateString']	= $validate_string;
					$data['page_name']		            = $page_name;
					$data['status']			            = ERROR;
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
					}else{
						$res = array('status' => ERROR, 'data' => $data);
					}
					return $res;
				}else{
					if($userDetails['user_role_slug'] == ADULTS){
						User::where('parent_email', $userDetails['email'])->update(array(
							'parent_email' => $userDetails['temp_email'],
						));
					}

					User::where('validate_string', $validate_string)->update(array(
						'is_email_verified' => ACTIVE,
						'email_verification_code' => '',
						'verification_code_time' => '',
						'resend_otp_time' => '',
						'email' => $userDetails['temp_email'],
					));

					$msg = trans("messages.front.otp_temp_email_verified");
					$data['message'] 		                = $msg;
					$data['userData']['validate_string']	= $validate_string;
					$data['status']			                = SUCCESS;
					$data['userData']	                    = $userDetails;
					if(!empty($userDetails['date_of_birth'])){
						$data['userData']['date_of_birth']           = CustomHelper::showDate($userDetails['date_of_birth'],DISPLAY_CALENDAR_DATE_FORMAT);
					}
					if(!empty($userDetails['date_of_aniversary'])){
						$data['userData']['date_of_aniversary']      =  CustomHelper::showDate($userDetails['date_of_aniversary'],DISPLAY_CALENDAR_DATE_FORMAT);
					}
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg,'mobile_req'=>$mobile);
					}else{
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg);
					}
					return $res;
				}
			}
        }else {
            $data['message']  = trans("messages.otp_error_message");
            $data['msg_type'] = ERROR;
			$data['status']	  = ERROR;
            $response = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
            return $response;
        }

    } // End userTempEmailVerifyOtp()


	/**
     * userTempMobileVerifyOtp()
     * @function for userTempMobileVerifyOtp User
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userTempMobileVerifyOtp($formData = array(), $attribute = array()) {
		$mobile				=	(isset($attribute['from']) &&($attribute['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$response			=	array();
		$response['status'] =   ERROR;
		$currentTime		=	CustomHelper::getCurrentTime();
        if (!empty($formData)) {
			$mobile_validate_string = isset($formData['validate_string'])?$formData['validate_string']:'';
			$userDetails = User::where('mobile_validate_string', $mobile_validate_string)->first();


			if(empty($userDetails)){
				$response['message'] 		= 	trans('Invalid Access.');
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$res = array('status' => ERROR, 'data' => $response,'mobile_req'=>$mobile);
				}else{
					$res = array('status' => ERROR, 'data' => $response);
				}
				return $res;
			}

			list($message, $validate) 	= 	ValidationHelper::getMobileOtpVerificationValidation($formData, $attribute);
            $validator = Validator::make($formData, $validate, $message);
			if ($validator->fails()) {
				if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
					$response['errors'] =   $validator->errors()->toArray();
					$res = array('data'=> $response,'validator'=>$validator,'mobile_req'=>$mobile);
				}else{
					$res = array('data'=> $response,'validator'=>$validator);
				}
				return	$res;
            }else {
				$verification_code_time = $userDetails['verification_code_time'];
				if ($verification_code_time < $currentTime) {
					$data['message'] 		                    = trans("messages.front.otp_expired");
					$data['userData']['mobile_validate_string']	= $mobile_validate_string;
					$data['status']			                    = ERROR;
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
					}else{
						$res = array('status' => ERROR, 'data' => $data);
					}
					return $res;
				}else{
					User::where('mobile_validate_string', $mobile_validate_string)->update(array(
						'is_mobile_verified'            => ACTIVE,
						'is_temp_phone_number_verified' => ACTIVE,
						'mobile_verification_code'      => '',
						'verification_code_time'        => '',
						'resend_otp_time'               => '',
						'phone_number'                  => $userDetails['phone_number'],
					));
					$msg = trans("messages.front.otp_temp_mobile_verified");
					$data['message'] 		                    = $msg;
					$data['userData']['mobile_validate_string']	= $mobile_validate_string;
					$data['status']			                    = SUCCESS;
					if(isset($formData['mobile_req']) &&  !empty($formData['mobile_req'])){
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg,'mobile_req'=>$mobile);
					}else{
						$res = array('status' => SUCCESS, 'data' => $data,'message'=>$msg);
					}
					return $res;
				}
			}
        }else {
            $data['message']  = trans("messages.otp_error_message");
            $data['msg_type'] = ERROR;
			$data['status']	  = ERROR;
            $response = array('status' => ERROR, 'data' => $data,'mobile_req'=>$mobile);
            return $response;
        }

    } // End userTempEmailVerifyOtp()


    /**
     * Function for resend Forget Password OTP
     *
     * @param null
     *
     * @return response
     */
    public function resendForgetOTPverification($formData = array(), $attribute = array())
    {
        $response = array();
        $from = (isset($attribute['from']) && !empty($attribute['from'])) ? $attribute['from'] : 'front';
        $errorsArray = array();
        $status = ERROR;
        $message = '';
        $response = array();

        if (!empty($formData)) {

            $slug = $formData['slug'];
            $userDetails = User::where('slug', $slug)->first();

            $otp_number = CustomHelper::generateVerificationCode();
            $resend_time = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
            $forgot_time = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
            $currentTime = CustomHelper::getCurrentTime();
            $mobile_no = $userDetails->phone;

            User::where('id', $userDetails->id)->update(['mobile_verification_code' => $otp_number, 'mobile_verification_code_time' => $forgot_time, 'resend_otp_time' => $resend_time]);

            // Send OTP sms to user
            if (!empty($mobile_no)) {
                CustomHelper::_SendOtp('account_verification', $mobile_no, $otp_number);
            }

            $response['status'] = SUCCESS;
            $response['message'] = trans("front_messages.phone_otp_resend_success");
            $response['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($resend_time);
            $response['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($currentTime);
        }

        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    } //end resendForgetOTPverification()

    /**
     * Function for submitForgetVerificationPhoneOtp
     *
     * @param null
     *
     * @return response
     */
    public function submitForgetVerificationPhoneOtp($formData = array(), $attribute = array())
    {
        $response = array();
        $from = $attribute['from'];
        $errorsArray = array();
        $status = ERROR;
        $message = '';
        $resAll = array();

        if (!empty($formData)) {
            $userData = User::where('forgot_password_validate_string', $formData['otp_verify_invisible_slug'])->first();
            if (!empty($userData)) {
                $formData['user_id'] = $userData->id;
                $attributes = array();
                $response = ValidationHelper::submitOtpValidateAndSave($formData, $attributes);
                if ($response['status'] == ERROR) {
                    $resAll['status'] = ERROR;
                    $resAll['errors'] = $response['validator'];

                } elseif ($response['status'] == SUCCESS) {
                    $resAll['message'] = trans("front_messages.phone_otp_update_success");
                    $resAll['status'] = SUCCESS;
                    $resAll['validate_string'] = $userData->forgot_password_validate_string;
                }
            } else {
                $resAll['status'] = ERROR;
                $resAll['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
            }
        }

        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $resAll, 'mobile_req' => $mobile);
        return $res;
    } //end submitForgetVerificationPhoneOtp()

    /**
     * UserService:: updatePhone()
     * @function for updatePhone
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function updatePhone($formData = array(), $attribute = array())
    {
        $res = array();
        if (!empty($formData)) {
            $user = !empty($attribute['user_id']) ? CustomHelper::getLoginUserData($attribute['user_id']) : array();
            $user_role_id = isset($user['user_role_id']) ? $user['user_role_id'] : 0;

            $attribute['user'] = $user;
            $response = ValidationHelper::mobileUpdateAndSave($formData, $attribute);
            if (!empty($response)) {
                if ($response['status'] == ERROR) {
                    $res['status'] = ERROR;
                    $validation = $response['validator']->errors()->toArray();
                    $res['message'] = isset($validation['phone']) ? $validation['phone'][0] : '';
                } else {
                    if ($response['status'] == 'not_updated') {
                        $res['status'] = 'not_updated';
                        $res['message'] = trans("front_messages.phone_number_already_registered_with_your_account");
                    } else {
                        $res['status'] = SUCCESS;

                        if (isset($response['data']['updateOrgMobile']) && ($response['data']['updateOrgMobile'])) {
                            $res['message'] = trans("front_messages.original_phone_update_success");
                        } else {
                            $res['message'] = trans("front_messages.global.enter_opt_received_on_mobile_no");
                        }

                        $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['resend_time']);
                        $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['current_time']);
                        $res['updateOrgMobile'] = isset($response['data']['updateOrgMobile']) ? $response['data']['updateOrgMobile'] : false;
                    }
                }
            }

        }

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);

        return $resData;

    }

    /**
     * UserService:: resendTempPhoneOtp()
     * @function for resendTempPhoneOtp
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function resendTempPhoneOtp($formData = array(), $attribute = array())
    {
        $res = array();
        $res['status'] = ERROR;
        $loginUserId = $attribute['user_id'];
        $userDetails = CustomHelper::getLoginUserData($loginUserId);
        if (!empty($userDetails)) {

            $otp_number = CustomHelper::generateVerificationCode();
            $resend_time = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
            $forgot_time = CustomHelper::convert_date_to_timestamp(FORGOT_OTP_TIME);
            $currentTime = CustomHelper::getCurrentTime();
            $mobile_no = $userDetails['temp_phone'];

            User::where('id', $loginUserId)->update(['mobile_verification_code' => $otp_number, 'mobile_verification_code_time' => $forgot_time, 'resend_otp_time' => $resend_time]);

            // Send OTP sms to user
            if (!empty($mobile_no)) {
                CustomHelper::_SendOtp('account_verification', $mobile_no, $otp_number);
            }

            $res['status'] = SUCCESS;
            $res['message'] = trans("front_messages.phone_otp_resend_success");
            $res['msg'] = trans("front_messages.phone_otp_resend_success");
            $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($resend_time);
            $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($currentTime);
        } else {
            $res['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
            $res['msg'] = trans('front_messages.sorry_you_are_using_wrong_link');
        }
        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);

        return $resData;
    }

    /**
     * UserService:: submitTempPhoneOtp()
     * @function for submitTempPhoneOtp
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function submitTempPhoneOtp($formData = array(), $attribute = array())
    {
        $res = array();
        $response = ValidationHelper::submitOtpValidateAndSave($formData, $attribute);
        if ($response['status'] == ERROR) {
            $res['status'] = ERROR;
            $res['errors'] = $response['validator'];

        } elseif ($response['status'] == SUCCESS) {
            $res['status'] = SUCCESS;
            $res['message'] = trans("front_messages.phone_number_update_success");
        }
        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);
        return $resData;
    }

    /**
     * UserService:: updateOriginalPhone()
     * @function for updatePhone
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function updateOriginalPhone($formData = array(), $attribute = array())
    {
        $res = array();
        if (!empty($formData)) {

            $user = !empty($attribute['user_id']) ? CustomHelper::getLoginUserData($attribute['user_id']) : array();
            $user_role_id = isset($user->user_role_id) ? $user->user_role_id : 0;

            $attribute['user'] = $user;
            $response = ValidationHelper::originalMobileValidateAndSave($formData, $attribute);
            if (!empty($response)) {
                if ($response['status'] == ERROR) {
                    $res['status'] = ERROR;
                    $validation = $response['validator']->errors()->toArray();
                    $res['message'] = isset($validation['phone']) ? $validation['phone'][0] : '';
                } else {
                    if ($response['status'] == 'not_updated') {
                        $res['status'] = 'not_updated';
                        $res['message'] = trans("front_messages.phone_number_already_registered_with_your_account");
                    } else {
                        $res['status'] = SUCCESS;
                        $res['message'] = trans("front_messages.org_phone_update_success");
                        $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['resend_time']);
                        $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['current_time']);
                    }
                }
            }
        }

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        $resData = array('data' => $res, 'mobile_req' => $mobile);
        return $resData;

    }


    /**
     * UserService:: userResendEmail()
     * @function for resend Email
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function UserRecentEmail($formData = array(), $attribute = array())
    {

        $response = array();
        $response['status'] = ERROR;
        $loginUserId = $attribute['user_id'];
        $userDetails = CustomHelper::getLoginUserData($loginUserId);

        if (!empty($userDetails)) {
            $email = $userDetails['email'];
            $validateString = CustomHelper::getValidateString($email);

            User::where('id', $loginUserId)->update(array('email_validate_string' => $validateString));
            $full_name = CustomHelper::getFullName($userDetails['first_name'], $userDetails['last_name']);

            /**Send mail to user for email verification **/
          /*  $to_name = $full_name;
            $to = $email;
            $action = "resend_account_verification";
            $validateString = $validateString;
            $route_url = route('User.verify_account', $validateString);
            $click_link = '<a href="' . $route_url . '" target="_blank">Click here</a>';
            $otp = isset($userDetails['mobile_verification_code']) ? $userDetails['mobile_verification_code'] : '';
            $rep_Array = array($full_name, $click_link, $route_url);
            $sendMail = new SendMailService;
            $sendMail->callSendMail($to, $to_name, $rep_Array, $action);*/
            /**Send mail to user for email verification **/
            $response['message'] = trans("front_messages.resend_verifylink_message");
            $response['status'] = SUCCESS;
        } else {
            $response['message'] = trans("front_messages.sorry_you_are_using_wrong_link");
        }

        //return redirect()->back();

        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


    /**
     * UserService:: updateEmail()
     * @function for updateEmail
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function updateEmail($formData = array(), $attribute = array())
    {

        $res = array();
        if (!empty($formData)) {

            $user = !empty($attribute['user_id']) ? CustomHelper::getLoginUserData($attribute['user_id']) : array();

            /**Student and tutor of an organization cant update his email address */
            $organisation_id = isset($user['organisation_id']) ? $user['organisation_id'] : 0;
            $user_role_id = isset($user['user_role_id']) ? $user['user_role_id'] : 0;
            if (($organisation_id > 0) && in_array($user_role_id, [CUSTOMER_ROLE_ID, CONSULTANT_ROLE_ID])) {
                $res['status'] = 'not_updated';
                $res['message'] = trans("front_messages.you_can_not_change_your_email");
            }

            $attributes['from'] = 'front';
            $attributes['user'] = $user;
            $attributes['email'] = isset($attribute['email']) ? $attribute['email'] : '';

            $response = UserValidationHelper::emalUpdateAndSave($formData, $attributes);

            if (!empty($response)) {
                if ($response['status'] == ERROR) {
                    $res['status'] = ERROR;
                    $validation = $response['validator']->errors()->toArray();
                    $res['message'] = isset($validation['email']) ? $validation['email'][0] : '';
                } else {
                    if ($response['status'] == 'not_updated') {
                        $res['status'] = 'not_updated';
                        $res['message'] = trans("front_messages.email_already_registered_with_your_account");
                    } else {
                        $res['message'] = trans("front_messages.resend_verifylink_message");
                        $res['status'] = SUCCESS;
                    }
                }
            }
        }

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);
        return $resData;

    }

    /**
     * UserService:: resendTempEmailVerificationLink()
     * @function for resendTempEmailVerificationLink
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function resendTempEmailVerificationLink($formData = array(), $attribute = array())
    {

        $res = array();
        $status = ERROR;

        $loginUserId = $attribute['user_id'];
        $userDetails = CustomHelper::getLoginUserData($loginUserId);

        if (!empty($userDetails)) {

            $email = $userDetails['temp_email'];
            $validateString = CustomHelper::getValidateString($email);
            User::where('id', $loginUserId)->update(array('temp_email_validate_string' => $validateString));
            $full_name = CustomHelper::getFullName($userDetails['first_name'], $userDetails['last_name']);
            /**Send mail to user for email verification **/
            $to_name = $full_name;
            $to = $email;
            $action = "resend_account_verification";
            $validateString = $validateString;
            $route_url = route('User.newEmailVerify', $validateString);
            $click_link = '<a href="' . $route_url . '" target="_blank">Click here</a>';
            $otp = isset($userDetails['mobile_verification_code']) ? $userDetails['mobile_verification_code'] : '';

            $rep_Array = array($full_name, $click_link, $route_url, $otp);
            $sendMail = new SendMailService;
            $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
            /**Send mail to user for email verification **/
            $status = SUCCESS;
            $res['message'] = trans("front_messages.resend_verifylink_message");
        }
        $res['status'] = $status;

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);

        return $resData;
    }

    /**
     * UserService:: userTempEmailVerification()
     * @function for user temp email verification
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userTempEmailVerification($formData = array(), $attribute = array())
    {

        if (isset($formData['validateString']) && !empty($formData['validateString']) && $formData['validateString'] != null) {
            $userInfo = User::where('temp_email_validate_string', $formData['validateString'])->first();

            if (isset($userInfo) && !empty($userInfo)) {
                User::where('temp_email_validate_string', '=', $formData['validateString'])
                    ->update(array(
                        'is_verified' => ACTIVE,
                        'temp_email_validate_string' => null,
                        'email' => $userInfo['temp_email'],
                        'temp_email' => null,
                    ));

                $response = array('status' => SUCCESS);
                $data['message'] = trans('front_messages.user.email_verified_success_message');

            } else {
                $data['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
                $data['msg_type'] = ERROR;
                $response = array('status' => ERROR, 'data' => $data);

            }
        } else {
            $data['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
            $data['msg_type'] = ERROR;
            $response = array('status' => ERROR, 'data' => $data);
        }

        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $response, 'mobile_req' => $mobile);

        return $resData;
    }

    /**
     * UserService:: updatePhone()
     * @function for updatePhone
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function updatePhone__($formData = array(), $attribute = array())
    {
        $res = array();
        if (!empty($formData)) {
            $user = !empty($attribute['user_id']) ? CustomHelper::getLoginUserData($attribute['user_id']) : array();

            /**Student and tutor of an organization cant update mobile number */
            $organisation_id = isset($user['organisation_id']) ? $user['organisation_id'] : 0;
            $user_role_id = isset($user['user_role_id']) ? $user['user_role_id'] : 0;
            if (($organisation_id > 0) && in_array($user_role_id, [CUSTOMER_ROLE_ID, CONSULTANT_ROLE_ID])) {
                $res['status'] = 'not_updated';
                $res['message'] = trans("front_messages.you_can_not_change_your_mobile_number");

            } else {
                $attribute['user'] = $user;
                $response = UserValidationHelper::mobileUpdateAndSave($formData, $attribute);
                if (!empty($response)) {
                    if ($response['status'] == ERROR) {
                        $res['status'] = ERROR;
                        $validation = $response['validator']->errors()->toArray();
                        $res['message'] = isset($validation['phone']) ? $validation['phone'][0] : '';
                    } else {
                        if ($response['status'] == 'not_updated') {
                            $res['status'] = 'not_updated';
                            //$res['message']         =   trans("front_messages.phone_number_already_registered_with_your_account");
                        } else {
                            $res['status'] = SUCCESS;
                            $res['message'] = trans("front_messages.phone_update_success");
                            $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['resend_time']);
                            $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($response['data']['current_time']);
                        }
                    }
                }
            }
        }

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);

        return $resData;

    }

    /**
     * UserService:: resendTempPhoneOtp()
     * @function for resendTempPhoneOtp
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function resendTempPhoneOtp__($formData = array(), $attribute = array())
    {
        $res = array();
        $res['status'] = ERROR;
        $loginUserId = $attribute['user_id'];
        $userDetails = CustomHelper::getLoginUserData($loginUserId);
        if (!empty($userDetails)) {
            $otp_number = CustomHelper::generateVerificationCode();
            $resend_time = CustomHelper::convert_date_to_timestamp(RESEND_OTP_TIME);
            $forgot_time = CustomHelper::convert_date_to_timestamp(FORGOT_OTP_TIME);
            $currentTime = CustomHelper::getCurrentTime();
            $mobile_no = $userDetails['temp_phone'];

            User::where('id', $loginUserId)->update(['mobile_verification_code' => $otp_number, 'mobile_verification_code_time' => $forgot_time, 'resend_otp_time' => $resend_time]);

            // Send OTP sms to user
            if (!empty($mobile_no)) {
                CustomHelper::_SendOtp('account_verification', $mobile_no, $otp_number);

                $to = $userDetails['email'];
                $to_name = $userDetails['full_name'];
                $full_name = $to_name;

                $action = "verify_phone_otp";

                $rep_Array = array($full_name, $otp_number);

                $sendMail = new SendMailService;
                $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

            }

            $res['status'] = SUCCESS;
            $res['message'] = trans("front_messages.phone_otp_resend_success");
            $res['msg'] = trans("front_messages.phone_otp_resend_success");
            $res['resend_time'] = CustomHelper::convert_timestamp_to_date_for_otp($resend_time);
            $res['current_time'] = CustomHelper::convert_timestamp_to_date_for_otp($currentTime);
        } else {
            $res['message'] = trans('front_messages.sorry_you_are_using_wrong_link');
            $res['msg'] = trans('front_messages.sorry_you_are_using_wrong_link');
        }
        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $resData = array('data' => $res, 'mobile_req' => $mobile);

        return $resData;
    }


    /**
     * UserService:: userVerifyOtp()
     * @function for resend Verification Link
     * @Used in overAll System
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array */
    public static function userVerifyOtp($formData = array(), $attribute = array())
    {
        $mobile = 0;
        $data['status'] = ERROR;
        $currentTime = CustomHelper::getCurrentTime();
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        if (!empty($formData)) {
            $pageSlug = isset($attribute['pageSlug']) ? $attribute['pageSlug'] : '';
            $from = $attribute['from'];
            $model = isset($attribute['model']) ? $attribute['model'] : '';

            //Check validation
            if (!empty($pageSlug)) {
                $formData['validateStr'] = $formData['otp_verify_invisible_slug'];
                list($message, $validate) = ValidationHelper::getOtpVerificationValidation($formData, $attribute, $pageSlug);
            } else {
                $formData['validateStr'] = $formData['otp_verify_invisible_slug'];
                list($message, $validate) = ValidationHelper::getOtpVerificationValidation($formData, $attribute);
            }

            $validator = Validator::make($formData, $validate, $message);
            if ($validator->fails()) {
                $data['message'] = trans('front_messages.otp_error_message');
                $response = array('data' => $data, 'validator' => $validator, 'mobile_req' => $mobile);
                return $response;
            } else {
                $validate_string = $formData['otp_verify_invisible_slug'];
                if (!empty($pageSlug)) {
                    $userDetails = User::where('forgot_password_validate_string', $validate_string)->select('id', 'mobile_verification_code', 'mobile_verification_code_time')->first()->toArray();
                } else {
                    $userDetails = User::where('mobile_validate_string', $validate_string)->select('id', 'mobile_verification_code', 'mobile_verification_code_time')->first()->toArray();
                }

                if ($userDetails['mobile_verification_code'] == $formData['otp_verify']) {
                    if ($userDetails['mobile_verification_code_time'] < $currentTime) {
                        $data['message'] = trans('front_messages.otp_expired_error');
                        $data['msg_type'] = ERROR;
                        $response = array('data' => $data, 'mobile_req' => $mobile);
                        return $response;

                    } else {
                        $msg = trans("front_messages.phone_otp_update_success");
                        Session::flash(SUCCESS, $msg);
                        if (!empty($pageSlug)) {
                            User::where('forgot_password_validate_string', $validate_string)->update(array(
                                'mobile_verification_code' => '',
                                'mobile_verification_code_time' => INACTIVE,
                                'resend_otp_time' => INACTIVE,
                                'forgot_password_validate_string' => null,
                            ));

                            $data['message'] = $msg;
                            $data['validateString'] = $validate_string;
                            $data['status'] = SUCCESS;
                            $data['userId'] = $userDetails['id'];

                            $response = array('data' => $data, 'message' => $msg, 'mobile_req' => $mobile);
                            return $response;
                        } else {
                            User::where('mobile_validate_string', $validate_string)->update(array(
                                'is_mobile_verified' => IS_VERIFIED,
                                'mobile_verification_code' => '',
                                'mobile_verification_code_time' => INACTIVE,
                                'resend_otp_time' => INACTIVE,
                                'mobile_validate_string' => null,
                            ));

                            $data['message'] = $msg;
                            $data['userDetails'] = $userDetails;
                            $data['validateString'] = $validate_string;
                            $data['status'] = SUCCESS;
                            $data['userId'] = $userDetails['id'];
                            $response = array('status' => SUCCESS, 'data' => $data, 'message' => $msg, 'mobile_req' => $mobile);
                            return $response;

                        }
                    }
                } else {
                    $data['message'] = trans('front_messages.otp_error_message');
                    $data['msg_type'] = ERROR;
                    $data['route'] = 'verify-otp';
                    $response = array('data' => $data, 'mobile_req' => $mobile);
                    return $response;

                }
            }
        } else {
            $data['message'] = trans("front_messages.otp_error_message");
            $data['msg_type'] = ERROR;
            $response = array('status' => ERROR, 'data' => $data, 'mobile_req' => $mobile);
            return $response;
        }

    }


    /**
     * UserService::removeProfileImage()
     * @param userId  int as user id
     * @return resData
     **/
    public static function removeProfileImage($userId = 0)
    {
        $status = ERROR;
        $message = trans("messages.global.something_went_wrong_msg");
        $userDetails = CustomHelper::getLoginUserData($userId);
        if (!empty($userDetails)) {
            User::where('id', $userId)->update(array('image' => null));
            $status = SUCCESS;
            $message = trans('messages.admin.system.image_removed_successfully');

            $image = $userDetails['image'];
            if (!empty($image) && file_exists(USER_PROFILE_IMAGE_ROOT_PATH . $image)) {
                @unlink(USER_PROFILE_IMAGE_ROOT_PATH . $image);
            }

        }

        $res['status'] = $status;
        $res['message'] = $message;

        $resData = array('data' => $res);
        return $resData;
    }

    /**
     * UserService:: checkfblogin()
     * @function for checkfblogin
     * @param $form data as form data
     * @param $attribute as attribute array
     * @return response array
     */
    public static function checkFbLogin($formData = array(), $attribute = array())
    {
        $status = ERROR;
        $fbId = $formData['facebook_id'];

        if ($fbId == '') {
            $response['status'] = ERROR;
            $response['message'] = trans('front_messages.global.something_went_wrong_msg');
        } else {

            $result = User::where('facebook_id', $fbId)->first();

            if (empty($result)) {
                $response['status'] = SUCCESS;
                $response['user_exist'] = INACTIVE;
                $response['message'] = trans('front_messages.global.please_complete_your_signup_process');
            } else {
                $fullname = $result['full_name'];
                $response['status'] = SUCCESS;
                $response['user_exist'] = ACTIVE;
                $response['user_data'] = $result;
                $response['message'] = trans("front_messages.Login.user_success", ['user_name' => ucfirst($fullname)]);
            }
        }

        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }



} // end UserService
