<?php
namespace App\Modules\University\Services;

use App\Modules\University\Models\University;
use App\Modules\University\Models\UniversityApplication;
use App\Services\SendMailService;
use CustomHelper;
use config;
use Validator;

/**
 * University Service
 *
 * Add your methods in the class below
 *
 * This file will render data from api
 */
class UniversityService
{
    /**
     * UniversityService::applyUniversityValidateandSave()
     * @Description Function  for validation and save Job
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function applyUniversityValidateandSave($formData = array(), $attribute = array(),$model = null)
    {
        $message = 	'';
        $status = null;
        $response = array();
        $errorsArray = array();
        $response['status'] = ERROR;
        $msg = "";
        $mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $type = isset($attribute['type']) ? $attribute['type'] : 'add';

        list($validate, $message) = self::getApplyUniversityValidation($formData, $attribute);

        $validator = Validator::make($formData, $validate, $message);  

        if ($validator->fails()) {
            if ($mobile) {
                $errorsArray = $validator->errors()->toArray();
            } else {
                $errorsArray = $validator->errors()->toArray();
                $res = array('data' => $response, 'validator' => $validator);
                return $res;
            }
        } else {


            $uni_id              = isset($formData['uni_id']) ? $formData['uni_id'] : null;
            $gender              = isset($formData['gender']) ? $formData['gender'] : null;
            $name                = isset($formData['full_name']) ? $formData['full_name'] : null;
            $date_of_birth       = isset($formData['dob']) ? $formData['dob'] : null;
            $email               = isset($formData['email']) ? $formData['email'] : null;
            $phone_number        = isset($formData['phone_number']) ? $formData['phone_number'] : null;
            $course_type         = isset($formData['course_type']) ? $formData['course_type'] : null;
            $state               = isset($formData['state']) ? $formData['state'] : null;
            $city                = isset($formData['city']) ? $formData['city'] : null;


            $obj = new UniversityApplication;
            $obj->uni_id         = $uni_id;
            $obj->gender         = $gender;
            $obj->name           = $name;
            $obj->date_of_birth           = $date_of_birth;
            $obj->email          = $email ;
            $obj->phone   = $phone_number ;
            $obj->course             = $course_type;
            $obj->state              = $state;
            $obj->city               =  $city;
            $obj->is_active          =  (int) ACTIVE;

            if ($obj->save()) {

                if ($type == 'add') {

                    $universityDetails  = University::findorFail($uni_id);
                    $positionName = isset($universityDetails->title) ? $universityDetails->title : "";

                    /*send email to admin */
                    $action 		= 	"job_position_alert";

                    $to = config::get('Site.job_application_email');
                    $to_name = "Admin";
                    $rep_Array = array($name,$date_of_birth, $positionName, $email, $course_type, $state, $city);

                  //  $sendMail = new SendMailService;
                   // $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                $response['status'] = SUCCESS;
                $msg = trans("front_messages.global.university_application_success");

                }
            } else {
                $response['status'] = ERROR;
                $msg = trans("front_messages.global.university_application_fail");
            }

        }

        $response['message'] = $msg;
        $response['errors'] = $errorsArray;
        $mobile = 0;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        $res = array('data' => $response, 'mobile_req' => $mobile);


        return $res;

    } // end applyUniversityValidateandSave

/**
 * UniversityService::getApplyUniversityValidation()
 * @Description Function  for validation Job
 * @param $formData,$attribute
 * @return $validation message and validation
 **/
    public static function getApplyUniversityValidation($formData = array(), $attribute = array())
    {
        $message = array(
            'gender.required'      => trans('front_messages.gender.REQUIRED_ERROR'),
            'full_name.required' => trans('front_messages.full_name.REQUIRED_ERROR'),
            'full_name.max' => trans('front_messages.full_name.MAX_ERROR'),
            'email.required' => trans('front_messages.email.REQUIRED_ERROR'),
            'email.email' => trans('front_messages.email.VALID_REQUIRED_ERROR'),
            'email.max' => trans('front_messages.email.MAX_ERROR'),
            'dob.required'      => trans('front_messages.dob.REQUIRED_ERROR'),
            'state.required'      => trans('front_messages.state.REQUIRED_ERROR'),
            'city.required'      => trans('front_messages.city.REQUIRED_ERROR'),
            'phone.required'      => trans('front_messages.phone_number_with_dial_code.REQUIRED_ERROR'),
            'course_type.required' => trans('messages.course_type.REQUIRE_ERROR'),
        );

        $validate = array(
            'gender'     => 'required',
            'full_name' => 'required|max:200',
            'email'     => 'required|email|max:200',
            'phone'     => 'required',
            'dob'     => 'required',
            'state'     => 'required',
            'city'     => 'required',
            'course_type' => 'required',
            
        );


        return array($validate, $message);
    }

}

//PagesController end