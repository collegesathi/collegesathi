<?php
namespace App\Modules\EnquireNow\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\EnquireNow\Models\EnquireNow;
use  Auth, CustomHelper, View, Config, Session, Request,CURLFILE;
use Validator,Route;
use App\Services\SendMailService;

/**
 * HomeController class
 */
class EnquireNowController extends BaseController
{

    public $model = 'EnquireNow';

    public function __construct(){
        View::share('modelName', $this->model);
    }


    public function enquireNow(){
        $formData = Request::all();
        $formData['phone_number_with_dial_code'] = '+91'. $formData['phone_number'] ;
        $formData['dial_code'] = '+91' ;
     
        $currentRouteName = Request::get('current_route');

        if (Request::ajax()) {
            $validator = Validator::make(
                $formData,
                array(
                    'gender'     => 'required',
                    'full_name' => 'required|max:200',
                    'email'     => 'required|email|max:200',
                    'phone_number_with_dial_code'     => 'required',
                    'dob'     => 'required',
                    'state'     => 'required',
                    'city'     => 'required',
                ),
                array(
                    'gender.required'      => trans('front_messages.city.REQUIRED_ERROR'),
                    'full_name.required' => trans('front_messages.full_name.REQUIRED_ERROR'),
                    'full_name.max' => trans('front_messages.full_name.MAX_ERROR'),
                    'email.required' => trans('front_messages.email.REQUIRED_ERROR'),
                    'email.email' => trans('front_messages.email.VALID_REQUIRED_ERROR'),
                    'email.max' => trans('front_messages.email.MAX_ERROR'),
                    'dob.required'      => trans('front_messages.dob.REQUIRED_ERROR'),
                    'state.required'      => trans('front_messages.state.REQUIRED_ERROR'),
                    'city.required'      => trans('front_messages.city.REQUIRED_ERROR'),
                    'phone_number_with_dial_code.required'      => trans('front_messages.phone_number_with_dial_code.REQUIRED_ERROR'),
                )
            );
			
			
			$recaptchaResponse = Request::input('g-recaptcha-response');
			$secret = env('GOOGLE_RECAPTCHA_SECRET');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse);
			
                $responseData = (array) json_decode($verifyResponse);

			// if (!isset($responseData['success']) || empty($responseData['success'])) {
			// 	$validator->after(function ($validator) {
			// 		$validator->errors()->add("g-recaptcha-response", trans('front_messages.contact.recaptcha_error'));
			// 	});
			// }

            if ($validator->fails()) {
            
            
                return array('status' => "error", 'errors' => $validator->errors()->toArray());
            }
            else {          
                $model = new EnquireNow;
                $model->full_name = $formData['full_name'];
                $model->gender = $formData['gender'];
                $model->email = $formData['email'];
                $model->phone_number = '91'.$formData['phone_number'];
                $model->dial_code = $formData['dial_code'];
                $model->phone_number_with_dial_code = $formData['phone_number_with_dial_code'];
                $model->otp_veryfy = $formData['otp_veryfy'];
                $model->dob = $formData['dob'];
                $model->country = $formData['country'];
                $model->state = $formData['state'];
                $model->city = $formData['city'];
                if($model->save()){
                  
                    $name           = isset($formData['full_name']) ? $formData['full_name'] : "";
                    $email          = isset($formData['email']) ? $formData['email'] : "";
                    $phone          = isset($formData['phone_number_with_dial_code']) ? $formData['phone_number_with_dial_code'] : "";
                   
                    $action         = "enquiry";
                    $to             = config::get('Site.contact_email');
                    $to_name        = config::get('Email.username');
                    $rep_Array      = array($name, $email, $phone);
                    
                    $sendMail       = new SendMailService;
                   
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                  
                    if($currentRouteName != ''){
                      
                        Session::put('enquiry_message',trans("front_messages.enquiry.success_message"));
                      
                        Session::save();
                       
                    } 
                  
                    Session::flash(SUCCESS, trans('front_messages.enquiry.success_message'));
                    return array('status' => SUCCESS);
                }
               
         }
        }
    }

} // end HomeController class
