<?php
namespace App\Modules\Contact\Services;

use App\Modules\Contact\Models\Contact;
use App\Services\SendMailService;
use config;
use CustomHelper;
use Request;
use ValidationHelper;
use Validator;

/**
 * Blog Service here
 *
 * Add your methods in the class below
 *
 */

class ContactService
{

    /**
     * ContactService::ContactValidateandSave()
     * @Description Function  for validation and save Blog
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function ContactValidateandSave($formData = array(), $attribute = array()){

        $message                = '';
        $response               = array();
        $errorsArray            = array();
        $status                 = ERROR;
        $response['status']     = ERROR;
        $mobile                 = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $msg                    = '';
        //used validation and validation message
        list($message, $validate) = self::getcontactValidation($formData);
        $validator = Validator::make($formData, $validate, $message);

		if(!$mobile){
			$recaptchaResponse = Request::input('g-recaptcha-response');
			$secret = env('GOOGLE_RECAPTCHA_SECRET');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse);
			$responseData = (array) json_decode($verifyResponse);

			if (!isset($responseData['success']) || empty($responseData['success'])) {
				$validator->after(function ($validator) {
					$validator->errors()->add("g-recaptcha-response", trans('front_messages.contact.recaptcha_error'));
				});
			}
		}

        if ($validator->fails()) {
            // pr($validator->errors()->toArray()); die;
            if ($mobile) {
                $errorsArray = $validator->errors()->toArray();
            } else {
                $res = array('data' => $response, 'validator' => $validator);
                return $res;
            }

        }else {

            $obj                                = new Contact;
            $obj->name                          = isset($formData['full_name']) ? $formData['full_name'] : "";
            $obj->email                         = isset($formData['email']) ? $formData['email'] : "";
            $obj->subject                       = isset($formData['subject']) ? $formData['subject'] : "";
            $obj->phone_number                  = isset($formData['phone_number']) ? $formData['phone_number'] : "";
            $obj->phone_number_with_dial_code   = isset($formData['phone_number_with_dial_code']) ? $formData['phone_number_with_dial_code'] : "";
            $obj->dial_code                     = isset($formData['dial_code']) ? $formData['dial_code'] : "";
            $obj->message                       = isset($formData['message']) ? $formData['message'] : "";


            $obj->university_id                   = isset($formData['university_id']) ? $formData['university_id'] : "";
            $obj->course_type                   = isset($formData['course_type']) ? $formData['course_type'] : "";
            $obj->state                         = isset($formData['state']) ? $formData['state'] : "" ;
            $obj->city                          = isset($formData['city']) ? $formData['city'] : "";

            if ($obj->save()) {
                $name           = isset($formData['full_name']) ? $formData['full_name'] : "";
                $email          = isset($formData['email']) ? $formData['email'] : "";
                $phone          = isset($formData['phone_number_with_dial_code']) ? $formData['phone_number_with_dial_code'] : "";
                $message        = isset($formData['message']) ? $formData['message'] : "";


                $university       = CustomHelper::getUniversiryNameById($formData['university_id']);

                $course_type       = isset($formData['course_type']) ? $formData['course_type'] : "";
                $course           = CustomHelper::getConfigValue('COURSE_TYPE.'.$course_type);
                $state            =CustomHelper::get_state_name($formData['state']);
                $city             = CustomHelper::get_city_name($formData['city']);



                $action         = "contact_us";
                $to             = config::get('Site.contact_email');
                $to_name        = config::get('Email.username');
                $site_signature = Config::get('Site.site_signature');
                $rep_Array      = array($name, $email, $phone, $message,$university,$course,$state,$city);
                $sendMail       = new SendMailService;
                $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                $status     = SUCCESS;
                $message    = trans("front_messages.global.contact_success");
            }

        }


        $response['status'] = $status;
        $response['errors'] = $errorsArray;
        $response['message'] = $message;
        $mobile = 0;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;

    } // end contactValidateandSave

    /**
     * front side contact us
     * ValidationHelper::getcontactValidation()
     * @param formData array
     * @param model
     * @return $validation message and validation
     * */
    public static function getcontactValidation($formData = array(), $attribute = array()){

        $message = array(
            'full_name.required'                        => trans('front_messages.contact.full_name.REQUIRED_ERROR'),
            'full_name.max'                             => trans('messages.contact_first_name.MAX_ERROR'),
            'email.required'                            => trans('messages.contact_email.REQUIRED_ERROR'),
            'email.email'                               => trans('messages.contact_email.VALID_REQUIRED_ERROR'),
            'email.max'                                 => trans('messages.contact_email.MAX_ERROR'),
            'phone_number_with_dial_code.required'      => trans('messages.phone.REQUIRED_ERROR'),
            'subject.required'                          => trans('messages.subject.REQUIRED_ERROR'),
            'subject.max'                               => trans('messages.subject.MAX_ERROR'),
            'message.required'                          => trans('front_messages.message.REQUIRED_ERROR'),
            'university_id.required'                    => trans('front_messages.university.REQUIRED_ERROR'),
            'course_type.required'                      => trans('messages.course_type.REQUIRED_ERROR'),
            'state.required'                            => trans('front_messages.state.REQUIRED_ERROR'),
            'city.required'                             => trans('messages.city.REQUIRED_ERROR'),
            'gender.required'                           => trans('front_messages.gender.REQUIRED_ERROR'),
        );

        $validate['full_name']                              = 'required|max:200';
        $validate['email']                                  = 'required|email|max:200';
        $validate['phone_number_with_dial_code']            = 'required';
        $validate['message']                                = 'required';
        $validate['university_id']                          = 'required';
        $validate['course_type']                            = 'required';
        $validate['state']                               = 'required';
        $validate['city']                                = 'required';

        /*define validation */
        return array($message, $validate);
    } //end getcontactValidation()

} // end ContactService class
