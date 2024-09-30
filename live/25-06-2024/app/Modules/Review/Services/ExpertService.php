<?php
namespace App\Modules\Expert\Services;

use App\Modules\Expert\Models\ExpertEnquiry;

use App\Modules\User\Models\User;
use App\Services\SendMailService;
use Auth;
use Config;
use CustomHelper;
use DB;
use Request;
use ValidationHelper;
use Validator;

/**
 * ExpertService here
 *
 * Add your methods in the class below
 *
 */

class ExpertService
{

/**
     * JobService::consultNowValidateAndSave()
     * @Description Function  for validation and save Job
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function consultNowValidateAndSave($formData = array(), $attribute = array(),$model = null)
    {
        $message = 	'';
        $status = null;
        $response = array();
        $errorsArray = array();
        $response['status'] = ERROR;
        $msg = "";
        $mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $type = isset($attribute['type']) ? $attribute['type'] : 'add';

        list($validate, $message) = self::getConsultNowValidate($formData, $attribute);

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


            $expert_id         = isset($formData['consult_id']) ? $formData['consult_id'] : null;
            $first_name     = isset($formData['first_name']) ? ucfirst($formData['first_name']) : null;
            $last_name      = isset($formData['last_name']) ? $formData['last_name'] : null;
            $email          = isset($formData['email']) ? $formData['email'] : null;
            $phone_number   = isset($formData['phone_number']) ? $formData['phone_number'] : null;

            $dial_code   = isset($formData['dial_code']) ? $formData['dial_code'] : null;
            $phone_number_with_dial_code   = isset($formData['phone_number_with_dial_code']) ? $formData['phone_number_with_dial_code'] : null;

            $state           = isset($formData['state']) ? $formData['state'] : null;
            $city            = isset($formData['city']) ? $formData['city'] : null;


            $obj = new ExpertEnquiry;
            $obj->expert_id         = $expert_id;
            $obj->first_name     = $first_name;
            $obj->last_name      =  $last_name;
            $obj->full_name      = $first_name . " " . $last_name;
            $obj->email          =  $email ;
            $obj->phone_number   = $phone_number ;

            $obj->dial_code   = $dial_code ;
            $obj->phone_number_with_dial_code   = $phone_number_with_dial_code ;

            $obj->state              = $state;
            $obj->city               =  $city;
            $obj->message        = isset($formData['message']) ? $formData['message'] : null;

            if ($obj->save()) {

                if ($type == 'add') {

                  /*  $jobDetails  = Job::findorFail($job_id);
                     $positionName = isset($jobDetails->title) ? $jobDetails->title : "";

                    $action 		= 	"job_position_alert";

                    $to = config::get('Site.job_application_email');
                    $to_name = "Admin";
                    $rep_Array = array($first_name, $last_name, $positionName, $email, $linkedin_profile, $course_type, $state, $city,$message);

                    $sendMail = new SendMailService;
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                  */
                $response['status'] = SUCCESS;
                $msg = trans("front_messages.global.expert_enquiries_success");

                }
            } else {
                $response['status'] = ERROR;
                $msg = trans("front_messages.global.expert_enquiries_fail");
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

    } // end ConsultNowValidate

/**
 * JobService::getJobValidation()
 * @Description Function  for validation Job
 * @param $formData,$attribute
 * @return $validation message and validation
 **/
    public static function getConsultNowValidate($formData = array(), $attribute = array())
    {
        $message = array(
            'consult_id.required' => trans('messages.consult_id.REQUIRE_ERROR'),
            'first_name.required' => trans('messages.first_name.REQUIRE_ERROR'),
            'last_name.required' => trans('messages.last_name.REQUIRE_ERROR'),
            'email.required' => trans('messages.email.REQUIRE_ERROR'),
            'email.email' => trans('messages.email.REQUIRE_ERROR_VALID_EMAIL'),
            'phone_number.required' => trans('messages.phone_number.REQUIRE_ERROR'),
            'phone_number.integer' => trans('messages.phone_number.VALID_ERROR'),
            'state.required' => trans('messages.state.REQUIRE_ERROR'),
            'city.required' => trans('messages.city.REQUIRE_ERROR'),
            'message.required' => trans('messages.message.REQUIRE_ERROR'),

        );

        $validate = array(
            'consult_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|integer',
            'state' => 'required',
            'city' => 'required',
            'message' => 'required',
        );


        return array($validate, $message);
    }
} // end ExpertService class
