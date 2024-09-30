<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use App\Model\Cms;
#use App\Model\DataResponse;
use App\Model\Userlogin;
use App\Modules\User\Services\UserService;
use App\Modules\RecipientUser\Services\RecipientUserService;
use App\Modules\Country\Services\CountryService;
use App\Modules\Faq\Services\FaqService;
use App\Modules\Cms\Services\PagesService;
use App\User;
use App\Modules\Contact\Services\ContactService;
use Config,LoginValidationHelper,CustomHelper,DB,Request,JWTAuth,Mail,Auth,RatingValidationHelper,Response;
use App\Modules\DropDown\Services\DropDownService;
use App\Modules\Notification\Services\NotificationService;
use App\Modules\Transactions\Services\TransactionService;
use App\Modules\Jobs\Services\JobService;
use App\Modules\Transactions\Models\Transaction;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Modules\UserBalanceAmountLog\Services\UserBalanceAmountLogService; 


class ApiController extends BaseController
{

    public function __construct() {

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400'); // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }


	}


    public function index(\Illuminate\Http\Request $request) {
	
        $api_referrer = $request->header('api-request-referrer');
        $inputRequest = Request::all();
        $mobile_req = (!empty($api_referrer) && ($api_referrer == 'web')) ? 0 : 1;
        $mobile_req = 1;
        if ($mobile_req) {
            if (isset($inputRequest['req'])) {
                $baseDecode = base64_decode($inputRequest['req']);
                $decordedData = json_decode($baseDecode, true);
            } else {
                $res = ['status' => false, 'message' => "Invalid Api."];
                $enc_data = $this->api_output($res);
                echo $enc_data;
                exit;
            }
            $method_name  = $decordedData['method_name'];
            $device_id    = $decordedData['device_id'];
            $device_token = $decordedData['device_token'];
            $device_type  = $decordedData['device_type'];
            $formData     = $decordedData['data'];
        }else {
            $method_name = $inputRequest['method_name'];
            $formData    = $inputRequest;
        }

        $formData['mobile_req']   = $mobile_req;
        $formData['device_id']    = $device_id;
        $formData['device_token'] = $device_token;
        $formData['device_type']  = $device_type;
		$user_slug	              =	isset($formData['slug']) ? $formData['slug']:"";
		$user_data                =	array();
		if(!empty($user_slug)){
			$user_data = CustomHelper::getUserIdBySlug($user_slug);
            if(empty($user_data)){
                $res = ['status' => false, 'is_logout' => 1, 'message' => "Invalid Api."];
                $enc_data = $this->api_output($res);
                echo $enc_data; exit;
            }
			if(!empty($user_data)){
				/* CustomHelper::updateUserLastActivity($user_data['_id']); */
			}
		}
		$formData['loggedInUserData']	=	$user_data;

		$debug = false;
		if(Request::has('debug') && (Request::post('debug') || Request::post('debug'))) {
			$debug = true;
		}

		 

        switch ($method_name) {

			case 'getJobList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getJobList","data":{}}*/
                $response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $jobService         		= 	new JobService;
                $response                   = 	$jobService->list($formData, $attribute);

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;
			
			case 'getCountryList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getCountryList","data":{}}*/
                $response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $countryService         	= 	new CountryService;
                $response                   = 	$countryService->getCountryList($formData, $attribute);

				$response['data']['national_id_countries']	= 	Config::get("NATIONAL_ID_COUNTRY");
				$response['data']['dl_passport_countries']	= 	Config::get("DL_PASSPORT_COUNTRY");

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getStateList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getStateList","data":{"country_id":"101"}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $countryService         	= 	new CountryService;
                $response                   = 	$countryService->getStateList($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'getCityList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getCityList","data":{"country_id":"101","state_id":"4014"}}*/
                $response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $countryService        		= 	new CountryService;
                $response                   = 	$countryService->getCityList($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'getVerificationTypeList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getVerificationTypeList","data":{}}*/
                $response['data']['status']   			= 	SUCCESS;
                $verificationType          				= 	Config::get("VERIFICATION_TYPE_DROPDOWN");
                $response['data']['verificationType']  	= 	CustomHelper::getArrayFormat($verificationType,'id','value');
                $response['mobile_req']       			= 	ACTIVE;
                $response['data']['message']  			= 	'';
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


			case 'reasonForSendList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"reasonForSendList","data":{}}*/
                $response['data']['status']   			= 	SUCCESS;
                $reasonForSendList          			= 	CustomHelper::getMasterDropdown('sending-reason');
                $response['data']['result']  			= 	$reasonForSendList;
                $response['mobile_req']       			= 	ACTIVE;
                $response['data']['message']  			= 	'';
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


			/*
			case 'forgotPassword':	{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"forgotPassword","data":{"email":"mbs@mailinator.com"}}
                $response               = array();
                $formData['mobile_req'] = 'api';
                $model                  = 'User';
                $attribute              = array('model' => $model,'from'=>'mobile');
                $userService            = new UserService;
                $response               = $userService->userForgetPassword($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;
			*/


			case 'resetPasswordSave': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"resetPasswordSave","data":{"validate_string":"2cd5e95a1373a64fae1f56b5a2587c6c", "password":"System@123","confirm_password":"System@123"}}*/
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model, 'from' => $from);
                $userService                = new UserService;
                $response                   = $userService->userResetPasswordValidationAndSave($formData,$attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'changePassword': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"changePassword","data":{"slug":"mohammed-sameer-4", "old_password":"System@1234", "new_password":"System@123", "confirm_password":"System@123"}}*/
                $response                   = 	array();
                $from                       = 	'mobile';
                $model                      = 	'User';
                $attribute                  = 	array('model' => $model, 'from' => $from);
				$userId                     = 	isset($fomrData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';

                $formData['mobile_req']     = 	'api';
                $formData['user_id']     	= 	$userId;

				$userService                = 	new UserService;
                $response                   = 	$userService->userChangePasswordValidationAndSave($formData,$attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'login': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"login","data":{"email":"user11111@mailinator.com", "password":"System@123"}} */
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model, 'from' => $from,'type'=>'api');
                $userService                = new UserService;
                $response                   = $userService->login($formData, $attribute);
				$response['data']['profile_image_url']	= 	USER_PROFILE_IMAGE_URL;
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'biometric': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"biometric","data":{"slug":"customer-mailinator"}} */
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attribute                  =  array('model' => $model, 'from' => $from,'type'=>'api',"user_id" => $userId, 'biometric' => true);
                $userService                = new UserService;
                $response                   = $userService->login($formData, $attribute);
				$response['data']['profile_image_url']	= 	USER_PROFILE_IMAGE_URL;
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'logout': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"logout","data":{"slug":"mohammed-sameer-4"}} */
                $response                   = array();
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model,'from'=>'mobile');
                $userService                = new UserService;
                $response                   = $userService->userLogout($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'signUp':
				/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"signUp","data":{"first_name":"Mohammed", "last_name":"Sameer", "email":"sameer07@mailinator.com", "dial_code":"+91", "phone":"9829829825", "verification_type":"passport", "passport_driving_no":"passport789456", "country":"101", "state":"4014", "city":"133596", "address_one":"Salasar bus stand, sikar", "password":"System@123","confirm_password":"System@123"}} */
                $formData['mobile_req'] = 'api';
                $model                  = 'User';
                $attributes             = array('from'=>'mobile',"type" => "add",'model' => $model);

                if (Request::hasFile('passport_image')) {
                    $file   = Request::file('passport_image');
                    $formData['passport_image'] = $file;
                }
                if (Request::hasFile('dl_image_1')) {
                    $file   = Request::file('dl_image_1');
                    $formData['dl_image_1'] = $file;
                }
                if (Request::hasFile('dl_image_2')) {
                    $file   = Request::file('dl_image_2');
                    $formData['dl_image_2'] = $file;
                }

				if (Request::hasFile('national_id')) {
                    $file   = Request::file('national_id');
                    $formData['national_id'] = $file;
                }

				if (Request::hasFile('upload_document')) {
                    $file   = Request::file('upload_document');
                    $formData['upload_document'] = $file;
                }

				if (Request::hasFile('upload_selfie')) {
                    $file   = Request::file('upload_selfie');
                    $formData['upload_selfie'] = $file;
                }

                $userService            = new UserService;
                $response               = $userService->userValidateAndSave($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'getUserProfileData': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getUserProfileData","data":{"slug":"mohammed-sameer-5"}}*/
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model, 'from' => $from);
                $userService                = new UserService;
                $response                   = $userService->getUserProfileData($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'updateUserProfileData': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"updateUserProfileData","data":{ "slug":"mohammed-sameer-4", "first_name":"", "last_name":"", "country":"", "state":"", "city":"", "address_one":"", "zip_code":""}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'User';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model,'from' => $from, "user_id" => $userId, "type" => "edit");

				if (Request::hasFile('passport_image')) {
                    $file   = Request::file('passport_image');
                    $formData['passport_image'] = $file;
                }
                if (Request::hasFile('dl_image_1')) {
                    $file   = Request::file('dl_image_1');
                    $formData['dl_image_1'] = $file;
                }
                if (Request::hasFile('dl_image_2')) {
                    $file   = Request::file('dl_image_2');
                    $formData['dl_image_2'] = $file;
                }

				if (Request::hasFile('national_id')) {
                    $file   = Request::file('national_id');
                    $formData['national_id'] = $file;
                }

				if (Request::hasFile('upload_document')) {
                    $file   = Request::file('upload_document');
                    $formData['upload_document'] = $file;
                }

				$userService                = 	new UserService;
                $response                   = 	$userService->userValidateAndSave($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'updateProfileImage': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"updateProfileImage","data":{"slug":"mohammed-sameer-5"}} */
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attribute                  = array('model' => $model, 'from' => $from, "userId" => $userId);
                if (Request::hasFile('image')) {
                    $file   = Request::file('image');
                    $formData['image'] = $file;
                }
                $userService                = new UserService;
                $response                   = $userService->userProfileImageValidateSave($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'saveRecipientUser':
				/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"saveRecipientUser","data":{  "slug":"customer-mailinator", "recipient_name":"Recipient Nameupdated", "email":"recipient001@mailinator.com", "dial_code":"+91", "phone":"9829829825", "country":"101", "state":"4014", "city":"132203", "address":"Salasar bus stand, sikar", "zip_code":"332001","account_number":"7894561230","bank_name":"7894561230","iban_code":"7894561230","bic_code":"7894561230","swift_code":"7894561230"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'User';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
				$formData['user_id']     	= 	$userId;

				if(isset($formData['recipient_user_id']) && !empty($formData['recipient_user_id'])){
					$attributes['type']     				= 	'edit';
					$attributes['recipient_user_id']     	= 	$formData['recipient_user_id'];
				}

				$recipientUserService		= 	new RecipientUserService;
                $response                   = 	$recipientUserService->recipientUserValidateandSave($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


			case 'recipientUserList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"recipientUserList","data":{"slug":"customer-mailinator"}} {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"recipientUserList","data":{"slug":"mohammed-sameer-4", "recipient_name":"recipient_name6", "email":"email7"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'User';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
				$formData['user_id']     	= 	$userId;
				$conditionArray				=	array();

				if(isset($formData['email'])){
					$conditionArray[] =  ['email', 'LIKE', '%'.$formData["email"].'%'];
                }

				if(isset($formData['recipient_name'])){
					$conditionArray[] =  ['recipient_name', 'LIKE', '%'.$formData["recipient_name"].'%'];
                }

				if(isset($formData['phone'])){
					$conditionArray[] =  ['phone', 'LIKE', '%'.$formData["phone"].'%'];
                }

				$attributes['conditions']  	= 	$conditionArray;

				$recipientUserService		= 	new RecipientUserService;
                $response                   = 	$recipientUserService->recipientUserList($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'deleteRecipientUser':
				/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"deleteRecipientUser","data":{"slug":"customer-mailinator","recipient_user_id":"5"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'RecipientUser';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
				$formData['user_id']     	= 	$userId;
                $formData['recipient_user_id'] = isset($formData['recipient_user_id']) ? $formData['recipient_user_id'] : '';

				$recipientUserService		= 	new RecipientUserService;
                $response                   = 	$recipientUserService->deleteRecipientUser($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;



			case 'getFaqList':
                /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getFaqList","data":{}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $faqService         		= 	new FaqService;
                $response                   = 	$faqService->showFaq($formData);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'showCms': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"showCms","data":{"slug":"about-us"}}*/
                $formData['mobile_req']     = 'api';
                $model                      = 'Cms';
                $response                   = array();
                $from                       = 'mobile';
                $formData['slug']           = isset($formData['cms_slug']) ? $formData['cms_slug'] : '';
                $attribute                  = array('model' => $model, 'from' => $from);
                $pagesService               = new PagesService;
                $response                   = $pagesService->showCms($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
			break;

			case 'getCurrencyConversion': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getCurrencyConversion","data":{"initial_amount":"1000", "source_currency":"EUR", "required_currency":"INR"}}*/
                $formData['mobile_req']     = 	'api';
                $response                   = 	array();
                $response['data']        	= 	CustomHelper::getCurrencyConversion($formData);
				$response['mobile_req']   	= 	ACTIVE;
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
			break;

            case 'currencyListWithFlag':
				/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"currencyListWithFlag","data":{}}*/
                $formData['mobile_req']	= 	'api';
                $response				= 	array();

				if(isset($formData['from_country']) && ($formData['from_country'])){
					$response	= 	CustomHelper::allCurrencyListWithFlag($formData);
				}
				else {
					$response	=	CustomHelper::currencyListWithFlag($formData);
				}

                $response['data']['receiver']['id']	            = FIRST_CURRENCY_ID;
                $response['data']['receiver']['currency']   	= FIRST_CURRENCY_CODE;
                $response['data']['receiver']['flag_name']	    = FIRST_COUNTRY_FLAG;
                $response['data']['receiver']['country_name']	= FIRST_CURRENCY_NAME;


                $clientCountryData                            =  CustomHelper::getClientCountryApi();
                $response['data']['sender']['id']             =  !empty($clientCountryData['firstCurrencyId']) ? $clientCountryData['firstCurrencyId'] : FIRST_CURRENCY_ID;
                $response['data']['sender']['currency']       =  !empty($clientCountryData['firstCurrencyCode']) ? $clientCountryData['firstCurrencyCode'] : FIRST_CURRENCY_CODE;
                $response['data']['sender']['country_name']   =  !empty($clientCountryData['firstCountryName']) ? $clientCountryData['firstCountryName'] : FIRST_CURRENCY_NAME;
                $response['data']['sender']['flag_name']      =  !empty($clientCountryData['firstCountryFlagName']) ? $clientCountryData['firstCountryFlagName'] : FIRST_COUNTRY_FLAG;

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
			break;


			case 'allCurrencyListWithFlag':
				/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"allCurrencyListWithFlag","data":{}}*/
                $formData['mobile_req']	= 	'api';
                $response				= 	array();
                $response				= 	CustomHelper::allCurrencyListWithFlag($formData);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
			break;

			case 'saveContact': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"saveContact","data":{"first_name":"Mohammed", "last_name":"Sameer", "email":"sameer07@mailinator.com",  "mobile":"9829829825", "subject":"This is a test subject", "comment":"This is a test comments"}} */
                $formData['mobile_req']     = 'api';
                $model                      = 'Contact';
                $response                   = array();
                $from                       = 'mobile';
                $attribute                  = array('model' => $model, 'from' => $from);
                $contactService             = new ContactService;
                $response                   = $contactService->contactValidateAndSave($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'forgotPassword': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"forgotPassword","data":{"email":"mbs@mailinator.com"}}*/
                $response               = array();
                $formData['mobile_req'] = 'api';
                $model                  = 'User';
                $attribute              = array('model' => $model,'from'=>'mobile');
                $userService            = new UserService;
                $response               = $userService->userForgetPasswordForMobileApp($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'verifyOtp': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"verifyOtp","data":{"validate_string":"bffa130a04a0dba115c7b1c7a1ddb05e", "page_name":"account_verify"}}*/
                $response                   = array();
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model,'from'=>'mobile');
                $userService                = new UserService;
                $page_name		            = isset($formData['page_name'])?$formData['page_name']:'account_verify';

                switch ($page_name) {
                case 'forgot_password':
                    $response                   = $userService->userVerifyOtpForMobileApp($formData, $attribute);
                break;
                case 'email_verify':
                    $response                   = $userService->userTempEmailVerifyOtp($formData, $attribute);
                break;
                case 'phone_number_verify':
                    $response                   = $userService->userTempMobileVerifyOtp($formData, $attribute);
                break;

                default:
                    $response                   = $userService->userVerifyOtpForMobileApp($formData, $attribute);
                }
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'resendOtp':  /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"resendOtp","data":{"validate_string":"1cba7e1ea9b427db9ea73ffaf8c9d4e1", "page_name":"account_verify"}}*/
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
                $attribute                  = array('model' => $model, 'from' => $from);
                $userService                = new UserService;
                $response                   = $userService->userResendOtpForMobileApp($formData,$attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


            case 'getJobList':
                /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getJobList","data":{}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $jobService         		= 	new JobService;
                $response                   = 	$jobService->list($formData);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getJobDetail':
                /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getJobDetail","data":{"slug":"job-002"}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $jobService         		= 	new JobService;
                $response                   = 	$jobService->jobDetail($formData);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'saveApplyJob':
                /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"saveApplyJob","data":{"job_id":"2","first_name":"rajesh","last_name":"Kumar","email":"user1011@mailinator.com","phone_number":"9828081651","father_name":"F Name","qualification":"MCA","specifications":"Test","skills":"HTML","experience":"2 Year"}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 'api';

				if (Request::hasFile('resume')) {
                    $resume   = Request::file('resume');
                    $formData['resume'] = $resume;
                }

				$model                      = 'JobApplication';
                $from                       = 'mobile';
                $attribute                  =  array('model' => $model, 'from' => $from);
                $jobService         		= 	new JobService;
                $response                  = 	$jobService->applyJobValidateandSave($formData,$attribute);

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'deleteUserAccount':
                /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"deleteUserAccount","data":{"slug":"team-raj-1"}}*/
				$response                   = array();
                $from                       = 'mobile';
                $model                      = 'User';
                $formData['mobile_req']     = 'api';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $userRoleId                 = 	isset($formData['loggedInUserData']['user_role_id']) ? $formData['loggedInUserData']['user_role_id'] : '';

                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
                $attributes['user_role_id'] = $userRoleId;
                $userService                = new UserService;
                $response                   = $userService->deleteUserAccount($formData,$attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getMyTransactionHistory': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getMyTransactionHistory","data":{"slug":"customer-mailinator","recipient_id":"2","transaction_id":"","sortBy":"id","order":"DESC"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'Transaction';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $userRoleId                 = 	isset($formData['loggedInUserData']['user_role_id']) ? $formData['loggedInUserData']['user_role_id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
                $attributes['user_role_id'] = $userRoleId;
				$transactionService		= 	new TransactionService;
                $response                   = 	$transactionService->getTransactions($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


            case 'getRecentActivity': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getRecentActivity","data":{"slug":"customer-mailinator"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $formData['get_recent_activity'] = true;
                $model                      = 	'Transaction';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $userRoleId                 = 	isset($formData['loggedInUserData']['user_role_id']) ? $formData['loggedInUserData']['user_role_id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);
                $attributes['user_role_id'] = $userRoleId;
				$transactionService		= 	new TransactionService;
                $response                   = 	$transactionService->getTransactions($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getTransactionDetail': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getTransactionDetail","data":{"slug":"customer-mailinator","transaction_id":"1"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'Transaction';
                $userId                     = 	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from , 'user_id'=> $userId);

				$transactionService			= 	new TransactionService;
                $response                   = 	$transactionService->getTransactionDetail($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'getFinalAmount': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getFinalAmount","data":{"slug":"customer-mailinator", "sent_amount":"5000", "sent_currency_code":"INR", "recipient_id":"41"}} */
                $response                   			= 	array();
                $from                       			= 	'mobile';
                $formData['mobile_req']    		 		= 	'api';
                $formData['site_transaction_charge']	= 	Config::get('Site.site_transaction_charges');

				$model                      = 	'User';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model,'from' => $from, "user_id" => $userId);
                $transactionService 		= 	new TransactionService;
                $response                   = 	$transactionService->getFinalAmount($formData, $attributes);

				$res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

			case 'moneyTransfer':
			/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"moneyTransfer","data":{"slug":"customer-mailinator", "sent_amount":"5000", "sent_currency_code":"INR", "from_country_code":"INR", "received_amount":"315.07", "received_currency_code":"BRL", "received_country_code":"BRL", "recipient_id":"41", "reason_for_send":"8", "source_country_id":"8", "received_country_id":"8","coupon_code":"SV9A5HNH","discounttype":"percentage","discount":"50","max_discount_allowed":"10" }} */

			/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"moneyTransfer","data":{"slug":"customer-mailinator", "sent_amount":"5000", "sent_currency_code":"INR", "from_country_code":"INR", "received_amount":"315.07", "received_currency_code":"BRL", "received_country_code":"BRL", "recipient_id":"41", "payment_gateway_type":"stripe", "stripeToken":"abcdefghijklmnopqrstuvwxyz0123456789", "source_country_id":"8", "received_country_id":"8","coupon_code":"SV9A5HNH","discounttype":"percentage","discount":"50","max_discount_allowed":"10"}} */

			/* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"moneyTransfer","data":{"slug":"customer-mailinator", "sent_amount":"5000", "sent_currency_code":"INR", "from_country_code":"INR", "received_amount":"315.07", "received_currency_code":"BRL", "received_country_code":"BRL", "recipient_id":"41", "payment_gateway_type":"payid", "description":"abcdefghijklmnopqrstuvwxyz0123456789", "source_country_id":"8", "received_country_id":"8","coupon_code":"SV9A5HNH","discounttype":"percentage","discount":"50","max_discount_allowed":"10"}} */

                $response                   			= 	array();
                $from                       			= 	'mobile';
                $formData['mobile_req']    		 		= 	'api';
                $formData['site_transaction_charge']	= 	Config::get('Site.site_transaction_charges');
                $formData['user_ip']					= 	ip2long($_SERVER['REMOTE_ADDR']);


				$model                      = 	'User';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('model' => $model,'from' => $from, "user_id" => $userId, "type" => "edit");
                $transactionService 		= 	new TransactionService;
                $response                   = 	$transactionService->moneyTransfer($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getTransactionResponce': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getTransactionResponce","data":{"token":"xbaTFyvOAFvy0IVdTNNeeZqagzLT0Adp"}} */
                $response                   = 	array();
                $from                       = 	'mobile';
                $formData['mobile_req']     = 	'api';
                $model                      = 	'Transaction';
                $token                     = 	isset($formData['token']) ? $formData['token'] : '';
                $attributes                 = 	array('model' => $model , 'from' => $from );

				$transactionService			= 	new TransactionService;
                $result                     =  $transactionService->getTransactionResponce($token);
                if(empty($result['ErrorCode'])){
                    $response['data']['result']     = 	$result;
                    $response['data']['status']     =   SUCCESS;
                }
                else{
                    $response['data']['result']     = 	$result;
                    $response['data']['status']     =   ERROR;
                }
                $response['mobile_req'] = ACTIVE;


                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getPayidBankDetails': 	/*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getPayidBankDetails","data":{}} */
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $response['mobile_req']     = ACTIVE;
                $response['data']['result']['bank']             = Config::get('Site.bank');
                $response['data']['result']['account_name']     = Config::get('Site.account_name');
                $response['data']['result']['bsb']              = Config::get('Site.bsb');
                $response['data']['result']['account_number']   = Config::get('Site.account_number');
                $response['data']['result']['payid']            = Config::get('Site.payid');
                $response['data']['result']['message']          = trans('front_messages.Transactions.please_use_the_transaction_id_as_your_reference_number_when_making_payment');
                $response['data']['status'] = SUCCESS;

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getActiveBankList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getActiveBankList","data":{"country_id":"24"}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $countryService         	= 	new CountryService;
                $response                   = 	$countryService->getActiveBankList($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;

            case 'getActiveCurrencieCountryList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getActiveCurrencieCountryList","data":{}}*/
				$response                   = 	array();
                $formData['mobile_req']     = 	'api';
                $attribute                  = 	array('from'=>'mobile');
                $countryService         	= 	new CountryService;
                $response                   = 	$countryService->getActiveCurrencieCountryList($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;



            case 'checkBeneficiaryCurrency': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"checkBeneficiaryCurrency","data":{"slug":"customer-mailinator","receive_currency_code":"INR", "recipient_id":"111"}} */
                $response                   			= 	array();
                $from                       			= 	'mobile';
                $formData['mobile_req']    		 		= 	'api';

                $userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attributes                 = 	array('from' => $from,"user_id" => $userId);
                $transactionService 		= 	new TransactionService;
                $response                   = 	$transactionService->checkBeneficiaryCurrency($formData, $attributes);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


            case 'deleteApprovedUserDocument': /* {"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"deleteApprovedUserDocument","data":{"slug":"vaishu-sonekar"}} */
                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $model                      = 'User';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';
                $attribute                  =  array('model' => $model, 'from' => $from, "user_id" => $userId);

                $userService                = new UserService;
                $response                   = $userService->deleteApprovedUserDocument($formData, $attribute);
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


            case 'applyCoupon': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"applyCoupon","data":{"slug":"customertwo-mailinator","coupon_code":"SV9A5HNH"}}*/

                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';

                $formData['user_id']         = $userId	;
                $reasoneApplyCoupon          = 	CustomHelper::applyCoupon($formData);
                $response	     = 	$reasoneApplyCoupon;
                $response['mobile_req']      = 	ACTIVE;

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;



            case 'displayPriceAfterCouponApplied': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"displayPriceAfterCouponApplied","data":{"site_transaction_charge":"10"}}*/

                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
                $reasoneDisplayPriceForWithCouponApplied  = 	CustomHelper::displayPriceForPlanWithCouponApplied();
                $response['data']['result']  			= 	$reasoneDisplayPriceForWithCouponApplied;
                $response['mobile_req']       			= 	ACTIVE;
                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;


			case 'referralSetting': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"referralSetting","data":{"slug":"customertwo-mailinator"}}*/
                $formData['mobile_req']     = 	'api';
                $response                   = 	array();

                $my_referrer_code        = isset($formData['loggedInUserData']['my_referrer_code']) ? $formData['loggedInUserData']['my_referrer_code'] : '';
                $share_link = route('User.signup', ['code'=>$my_referrer_code]);

                $minimum_amount_transfered_value   = number_format(Config::get('Site.minimum_amount_transfered_value'), 2, '.', '');
                $referrer_amount                   = number_format(Config::get('Site.referrer_amount'), 2, '.', '');



				$response['data']['result']['title']	            				= 	"This is a title";
                $response['data']['result']['description']   						= 	"This is a description";
                $response['data']['result']['minimum_amount_transfered_value']		= 	number_format(Config::get('Site.minimum_amount_transfered_value'), 2, '.', '');
                $response['data']['result']['referrer_amount']						= 	number_format(Config::get('Site.referrer_amount'), 2, '.', '');
                $response['data']['result']['currency_code']						= 	Config::get('Site.currencyCode');
                $response['data']['result']['my_referrer_code']						= 	$my_referrer_code;
                $response['data']['result']['share_text']					     	= 	trans("messages.global.use_my_referral_code_invite_a_friend",['referral_code'=>$my_referrer_code,'minimum_amount_transfered_value'=>$minimum_amount_transfered_value,'referrer_amount'=>$referrer_amount,'share_link'=>$share_link]);
				$response['data']['status']   										= 	SUCCESS;
				$response['data']['message']  										= 	"";
				$response['mobile_req']     										= 	ACTIVE;

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
			break;



            case 'getUserBalanceAmountLog': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getUserBalanceAmountLog","data":{"slug":"customertwo-mailinator"}}*/

                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';

                $formData['user_id']         = $userId	;

                $userBalanceAmountLogService  = new UserBalanceAmountLogService;
                $response                     = $userBalanceAmountLogService->list($formData);

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;




            case 'getPushNotificationList': /*{"device_type":"android","device_id":"","device_token":"","api_type":"mobile","method_name":"getPushNotificationList","data":{"slug":"customertwo-mailinator"}}*/

                $response                   = array();
                $from                       = 'mobile';
                $formData['mobile_req']     = 'api';
				$userId						=	isset($formData['loggedInUserData']['id']) ? $formData['loggedInUserData']['id'] : '';

                $formData['user_id']        = $userId;
                $notificationService        = new NotificationService;
                $response                   = $notificationService->getPushNotificationList($formData);

                $res = $this->returnOutput($response['data'], $response['mobile_req']);
            break;




            default:
                $res = $this->returnOutput(array(), $mobile_req);
        }

        if ($mobile_req) {
            $enc_data = $this->api_output($res);
            echo $enc_data;
            exit;
        } else {
            return $res;
        }
    }// end index()





    public function returnOutput($response, $mobile) {

        if ($mobile) {
            if (isset($response['errors']) && !empty($response['errors'])) {

				/* THIS IS ONLY FOR KID SIGNUP METHOD, IF PARENT EMAIL-EMAIL IS NOT EXISTS IN OUR DATABASE. */
				if(count($response['errors']) == 1){
					if (isset($response['errors']['parent_email'][0]) && ($response['errors']['parent_email'][0] == trans('messages.parent_email.CHECK_ERROR'))) {
						$response['parent_email_not_exists']	= 1;
					}
				}
				/* THIS IS ONLY FOR KID SIGNUP METHOD, IF PARENT EMAIL-EMAIL IS NOT EXISTS IN OUR DATABASE. */

				$response['message'] = '';

                if (is_array($response['errors'])) {
                    $counter = 0;
                    foreach ($response['errors'] as $key => $error) {
                        if ($counter > 0) {
                            $response['message'] .= "\n";
                        } else {
                            $counter++;
                        }

                        $response['message'] .= $error[0];
                    }
                } else {
                    $response['message'] = $response['errors'];
                }
                unset($response['errors']);
            }

            return $response;
        } else {
            return response()->json(['data' => $response]);
        }
    }

    public function api_output($data = []) {

        if(Request::has('debug') && (Request::post('debug') || Request::post('debug'))) {
           /* return print_r($data);*/

           return json_encode($data);
       }

        $res = response()->json($data);
        return $enc_data = base64_encode(utf8_encode(json_encode($data)));
    }

}
