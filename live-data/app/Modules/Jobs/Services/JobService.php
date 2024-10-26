<?php
namespace App\Modules\Jobs\Services;

use App\Modules\Jobs\Models\Job;
use App\Modules\Jobs\Models\JobApplication;
use App\Services\SendMailService;
use CustomHelper;
use config;
use Validator;

/**
 * Job Service here
 *
 * Add your methods in the class below
 *
 */

class JobService
{
    /**
     * JobService::jobValidateandSave()
     * @Description Function  for validation and save Job
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function jobValidateandSave($formData = array(), $attribute = array())
    {

        $status = null;
        $response = array();
        $errorsArray = array();
        $response['status'] = ERROR;

        $mobile = (isset($formData['mobil_req']) && $formData['mobil_req']) ? ACTIVE : INACTIVE;
        $type = isset($attribute['type']) ? $attribute['type'] : 'add';

        list($validate, $message) = self::getJobValidation($formData, $attribute);

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
            if ($type == 'add') {
                $obj = new Job;
                $obj->slug = CustomHelper::getSlug($formData['title'], 'slug', 'Job', 'Jobs');
            } else {
                $obj = Job::findorFail($attribute['job_id']);
            }

            $obj->title                = isset($formData['title']) ? $formData['title'] : null;
            $obj->department           = isset($formData['department']) ? $formData['department'] : null;
            $obj->job_type             = isset($formData['job_type']) ? $formData['job_type'] : null;
            $obj->experience           = isset($formData['experience']) ? $formData['experience'] : null;
            $obj->location             = isset($formData['location']) ? $formData['location'] : null;
            $obj->job_responsibilities = isset($formData['job_responsibilities']) ? $formData['job_responsibilities'] : null;
            $obj->qualification       = isset($formData['qualification']) ? $formData['qualification'] : null;

            $obj->is_active = (int) ACTIVE;
            $obj->save();

            $response['status'] = SUCCESS;
        }

        $response['errors'] = $errorsArray;
        $mobile = 0;

        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }

        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;

    } // end BlogValidateandSave

    /**
     * JobService::getJobValidation()
     * @Description Function  for validation Job
     * @param $formData,$attribute
     * @return $validation message and validation
     **/
    public static function getJobValidation($formData = array(), $attribute = array())
    {
        $message = array(
            'title.required' => trans('messages.title.REQUIRE_ERROR'),
            'title.max' => trans('messages.title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
            'department.required' => trans('messages.department.REQUIRE_ERROR'),

            'experience.required' => trans('messages.experience.REQUIRE_ERROR'),
            'experience.max' => trans('messages.experience.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
            'job_type.required' => trans('messages.job_type.REQUIRE_ERROR'),
            'location.required' => trans('messages.location.REQUIRE_ERROR'),
            'location.max' => trans('messages.location.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),

            'job_responsibilities.required' => trans('messages.job_responsibilities.REQUIRE_ERROR'),
            'qualification.required' => trans('messages.qualification.REQUIRE_ERROR'),
        );

        $validate = array(
            'title'           => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
            'department'        => 'required',
            'experience'      => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
            'job_type'        => 'required',
            'location'        => 'required|max:' . CMS_PAGE_TITLE_LIMIT,

            'job_responsibilities'        => 'required',
            'qualification'               => 'required',
        );

        return array($validate, $message);
    }

    /**
     * JobService::applyJobValidateandSave()
     * @Description Function  for validation and save Job
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function applyJobValidateandSave($formData = array(), $attribute = array(),$model = null)
    {
        $message = 	'';
        $status = null;
        $response = array();
        $errorsArray = array();
        $response['status'] = ERROR;
        $msg = "";
        $mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $type = isset($attribute['type']) ? $attribute['type'] : 'add';

        list($validate, $message) = self::getApplyJobValidation($formData, $attribute);

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


            $job_id         = isset($formData['job_id']) ? $formData['job_id'] : null;
            $first_name     = isset($formData['first_name']) ? ucfirst($formData['first_name']) : null;
            $last_name      = isset($formData['last_name']) ? $formData['last_name'] : null;
            $email          = isset($formData['email']) ? $formData['email'] : null;
            $phone_number   = isset($formData['phone_number']) ? $formData['phone_number'] : null;
            $linkedin_profile    = isset($formData['linkedin_profile']) ? $formData['linkedin_profile'] : null;
            $course_type     = isset($formData['course_type']) ? $formData['course_type'] : null;
            $state           = isset($formData['state']) ? $formData['state'] : null;
            $city            = isset($formData['city']) ? $formData['city'] : null;


            $obj = new JobApplication;
            $obj->job_id         = $job_id;
            $obj->first_name     = $first_name;
            $obj->last_name      =  $last_name;
            $obj->full_name      = $first_name . " " . $last_name;
            $obj->email          =  $email ;
            $obj->phone_number   = $phone_number ;

            $obj->linkedin_profile   = $linkedin_profile ;
            $obj->specifications     = $course_type;
            $obj->state              = $state;
            $obj->city               =  $city;
            $obj->message        = isset($formData['message']) ? $formData['message'] : null;

            if (isset($formData['resume']) && !empty($formData['resume'])) {
                $extension = $formData['resume']->getClientOriginalExtension();
                $fileName = time() . '-resume.' . $extension;
                if ($formData['resume']->move(RESUME_ROOT_PATH, $fileName)) {
                    $obj->resume = $fileName;
                }
            }
            if ($obj->save()) {

                if ($type == 'add') {

                    $jobDetails  = Job::findorFail($job_id);
                     $positionName = isset($jobDetails->title) ? $jobDetails->title : "";

                    /*send email to admin */
                    $action 		= 	"job_position_alert";

                    $to = config::get('Site.job_application_email');
                    $to_name = "Admin";
                    $rep_Array = array($first_name, $last_name, $positionName, $email, $linkedin_profile, $course_type, $state, $city,$message);

                  //  $sendMail = new SendMailService;
                   // $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                $response['status'] = SUCCESS;
                $msg = trans("front_messages.global.job_application_success");

                }
            } else {
                $response['status'] = ERROR;
                $msg = trans("front_messages.global.job_application_fail");
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

    } // end applyJobValidateandSave

/**
 * JobService::getJobValidation()
 * @Description Function  for validation Job
 * @param $formData,$attribute
 * @return $validation message and validation
 **/
    public static function getApplyJobValidation($formData = array(), $attribute = array())
    {
        $message = array(
            'job_id.required' => trans('messages.job_id.REQUIRE_ERROR'),
            'first_name.required' => trans('messages.first_name.REQUIRE_ERROR'),
            'last_name.required' => trans('messages.last_name.REQUIRE_ERROR'),
            'email.required' => trans('messages.email.REQUIRE_ERROR'),
            'email.email' => trans('messages.email.REQUIRE_ERROR_VALID_EMAIL'),
            'phone_number.required' => trans('messages.phone_number.REQUIRE_ERROR'),
            'phone_number.integer' => trans('messages.phone_number.VALID_ERROR'),
            'linkedin_profile.required' => trans('messages.linkedin_profile.REQUIRE_ERROR'),
            'course_type.required' => trans('messages.course_type.REQUIRE_ERROR'),
            'state.required' => trans('messages.state.REQUIRE_ERROR'),
            'city.required' => trans('messages.city.REQUIRE_ERROR'),
            'message.required' => trans('messages.message.REQUIRE_ERROR'),
            'resume.required' => trans('messages.resume.REQUIRE_ERROR'),
            'resume.mimes' => trans('messages.resume.VALID_ERROR', ['valid_extensions' => RESUME_EXTENSION]),
            'resume.max' => trans('messages.resume.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),

        );

        $validate = array(
            'job_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|integer',
            'linkedin_profile' => 'required',
            'course_type' => 'required',
            'state' => 'required',
            'city' => 'required',
            'message' => 'required',
            'resume' => 'required|mimes:' . RESUME_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024),
        );


        return array($validate, $message);
    }


    /**
     * Function for get list of jobs
     *
     * @param $formData as a form Data
     * @param $attr as other attributes
     *
     * @return rerirect page.
     */
    function list($formData, $attr = array()) {
        $DB 		= 	array();
        $message 	= 	"";
        $sortBy 	= 	isset($formData['sortBy']) ? $formData['sortBy'] : 'created_at';
        $order 		= 	isset($formData['order']) ? $formData['order'] : 'DESC';
        $limit 		= 	isset($formData['records_per_page']) ? $formData['records_per_page'] :  CustomHelper::getConfigValue("Reading.records_per_page");

        $DB = Job::query();
        $DB->where('is_active', ACTIVE)->with(['jobType']);

        $DB->orderBy($sortBy, $order);
        $mobile = INACTIVE;

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $limit);

        if (isset($formData['mobile_req']) && !empty($formData['mobile_req'])) {
            $mobile 					= 	ACTIVE;
            $recordPerPagePagination 	= 	Config::get("Reading.records_per_page");
            $response['result'] 		= 	$model;
            $response['status'] 		= 	"success";
            $response['message'] 		= 	$message;

			if (empty($response['result'])) {
                $message = trans("messages.global.no_record_found_message");
                $response['message'] = $message;
                $res = array('data' => $response, 'mobile_req' => $mobile);
                return $res;
            }

            $res = array('data' => $response, 'mobile_req' => $mobile);
            return $res;
        }
		else {

            return $DB;
        }
    } //end jobs()


   /**
     * Function for get list of jobs
     *
     * @param $formData as a form Data
     * @param $attr as other attributes
     *
     * @return rerirect page.
     */
    function jobDetail($formData, $attr = array()) {

        $slug 		= 	isset($formData['slug']) ? $formData['slug'] : '';

        $result = Job::with('jobType')->where('is_active', ACTIVE)->where('slug', $slug)->first();

        $response['result'] 		= 	$result;
        $response['status'] 		= 	SUCCESS;

        if (isset($formData['mobile_req']) && !empty($formData['mobile_req'])) {
            $mobile 					= 	ACTIVE;
        }


		$res = array('data' => $response, 'mobile_req' => $mobile);
            return $res;
    } //end jobs()


} // end JobService class
