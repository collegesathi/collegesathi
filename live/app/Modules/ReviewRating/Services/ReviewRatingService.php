<?php
namespace App\Modules\ReviewRating\Services;

use App\Modules\ReviewRating\Models\ChildReport;
use App\Modules\ReviewRating\Models\ReviewRating;
use App\Services\SendMailService;
use auth;
use Config;
use CustomHelper;
use Input;
use Request;
use Session;
use ValidationHelper;
use Validator;

/**
 * ReviewRatingService service here
 * Add your methods in the class below
 */

class ReviewRatingService
{

    /**
     * ReviewRatingService:reviewRatingSave()
     * @Description Function  for save reviewRatingSave
     * @param $formData  as form data
     * @param $attribute as other values
     * @return $validation message and validation
     * */
    public static function reviewRatingSave($formData = array(), $attributes = array())
    {
        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }
        
        // pr($formData); die;
        $errorsArray = array();
        $message = '';
        $response = array();
        $response['status'] = ERROR;
        $type = '';
        $from = $attributes['from'];
        
        list($message, $validate) = ValidationHelper::reviewRatingValidation($formData, $attributes);
        $validator = Validator::make($formData, $validate, $message);
        
        if ($validator->fails()) {
            $errorsArray = $validator->errors()->toArray();
            $response['errors'] = $errorsArray;
            
            if ($mobile) {
                $res = array('data' => $response, 'errors' => $errorsArray, 'mobile_req' => $mobile);
            } else {
                $res = array('data' => $response, 'validator' => $validator);
            }
            
            return $res;
        } else {
            if ($from == ADMIN_ROLE_SLUG) {
                $reviewRating = ReviewRating::where('user_id', $formData['user_id'])->first();
                
                if (!empty($reviewRating)) {
                    $reviewRating->rating = $formData['score'];
                    $reviewRating->review_message = $formData['review_message'];
                    $reviewRating->save();
                    
                    $response['status'] = SUCCESS;
                    $response['message'] = trans("front_messages.rating_has_been_successfully_added_message");
                }
            } else {
                $type = 'add';
                $isAllowReviewAndRating = CustomHelper::isAllowReviewAndRating($formData['user_id'],$formData['university_id']);
               
                if ($isAllowReviewAndRating) {
                    $reviewRating = new ReviewRating;
                    $reviewRating->user_id = $formData['user_id'];
                    $reviewRating->university_id = $formData['university_id'];
                   
                    $reviewRating->is_approved = REQPENDING;
                    $reviewRating->status = ACTIVE;
                    $reviewRating->rating = $formData['score'];
                    $reviewRating->review_message = nl2br($formData['review_message']);

                    if ($reviewRating->save()) {

                        $user_name = CustomHelper::getUserNameByUserId($reviewRating->user_id);
                        $universityName = CustomHelper::getUniversiryNameById($reviewRating->university_id);
                        // $universityName = CustomHelper::getFieldValueByFieldName($reviewRating->university_id, 'id','University','title');
                        // pr($universityName);die;

                        $ratings = $reviewRating->rating;
                        /*send notification to admin */
                        // $attribute = array();
                        // $rep_Array_for_notification = array($user_name);
                        // $action = 'review_ratings_approval';
                        // $type = CustomHelper::getConfigValue('NOTIFICATION_TYPE.review-rating-approval-request');
                        // $attribute['sender_id'] = $reviewRating->student_id;
                        // $attribute['reciver_id'] = ADMIN_ID;

                        // CustomHelper::saveNotificationActivity($rep_Array_for_notification, $action, $type, $attribute);
                        // /*send notification to admin */

                        // /* send mail to admin */
                        $action = "review_ratings_approval_for_admin";
                        $rep_Array = array($user_name, $universityName);
                        $sendMail = new SendMailService;
                        $to             = config::get('Site.contact_email');
                        $to_name        = config::get('Email.username');
                        $sendMail->callSendMail($to,$to_name,$rep_Array,$action);
                        // /* send mail to admin */

                        $response['status'] = SUCCESS;
                        $response['message'] = trans("front_messages.rating_has_been_successfully_added_message");
                    } else {
                        $response['message'] = trans("front_messages.global.something_went_wrong");
                    }
                } else {
                    $response['message'] = trans("front_messages.you_have_already_submitted_a_review_rating");
                }
            }
    
        }
     

        if ($mobile) {
            $response['errors'] = $errorsArray;
            $res = array('data' => $response, 'mobile_req' => $mobile);
        } else {
            $res = array('data' => $response, 'validator' => $validator, 'mobile_req' => $mobile);
        }

        // pr($res); die;
        return $res;

        //return $response;
    } //reviewRatingSave()

    /**
     * ReviewRatingService:reviewRatingListing()
     * @Description Function  for save reviewRatingListing
     * @param $formData  as form data
     * @param $attribute as other values
     * @return response
     * */
    public static function getReviewRating($formData = array(), $attributes = array())
    {

        $status = ERROR;
        $conditions = array();
        $DB = ReviewRating::with(['tutorDetail', 'studentDetail', 'WiziqClass' => function ($query) {$query->with(['subjects']);}]);
        $searchVariable = array();

        if (($formData && isset($formData['display'])) || isset($formData['page'])) {
            $searchData = Input::get();

            unset($searchData['display']);
            unset($searchData['_token']);

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }
            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);

                if ($fieldValue != '') {
                    if ($fieldName == 'active') {
                        $DB->where('status', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));

            }
        }

        if (isset($formData['records_per_page']) && $formData['records_per_page'] != '') {
            $searchVariable = array_merge($searchVariable, array('records_per_page' => $formData['records_per_page']));
        }

        $sortBy = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
        $order = (isset($formData['order'])) ? $formData['order'] : 'DESC';
        $recordPerPage = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        if ($attributes['user_role_id'] == TUTOR_ROLE_ID) {
            $DB->where('is_approved', REQAPPROVE)->where('status', ACTIVE)->where('tutor_id', $attributes['user_id']);
            $response['viewFolder'] = "ReviewRating::Front.Tutor.reviewRatingList";
        } elseif ($attributes['user_role_id'] == STUDENT_ROLE_ID) {

            $DB->/* where('is_approved', REQAPPROVE)-> */where('status', ACTIVE)->where('student_id', $attributes['user_id']);
            $response['viewFolder'] = "ReviewRating::Front.Student.reviewRatingList";
        }

        $model = $DB->where('status', ACTIVE)->orderBy($sortBy, $order)->paginate((int) $recordPerPage);

        $status = SUCCESS;

        $response['sort_by'] = $sortBy;
        $response['order'] = $order;
        $response['searchVariable'] = $searchVariable;
        $response['result'] = $model;
        $response['status'] = $status;

        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }

        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }

    /**
     * ReviewRatingService:reviewRatingSave()
     * @Description Function  for save reviewRatingSave
     * @param $formData  as form data
     * @param $attribute as other values
     * @return $validation message and validation
     * */
    public static function reviewRatingSave__($formData = array(), $attributes = array())
    {

        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }

        $message = '';
        $response = array();
        $response['status'] = ERROR;
        $type = '';
        $from = $attributes['from'];

        list($message, $validate) = ValidationHelper::reviewRatingValidation($formData, $attributes);
        $validator = Validator::make($formData, $validate, $message);

        if ($validator->fails()) {
            $res = array('data' => $response, 'validator' => $validator, 'mobile_req' => $mobile);
            return $res;
        } else {

            $reviewRating = ReviewRating::where('session_id', $formData['session_id'])->where('student_id', $formData['student_id'])->first();

            if (empty($reviewRating)) {
                $type = "add";
                $reviewRating = new ReviewRating;
                $reviewRating->student_id = $formData['student_id'];
                $reviewRating->tutor_id = $formData['tutor_id'];
                $reviewRating->session_id = $formData['session_id'];
                $reviewRating->wiziq_session_student_id = isset($formData['wiziq_session_student_id']) ? $formData['wiziq_session_student_id'] : 0;
                $reviewRating->is_approved = REQPENDING;
            }
            $reviewRating->status = ACTIVE;
            $reviewRating->rating = $formData['score'];
            $reviewRating->review_message = $formData['review_message'];
            $reviewRating->save();

            if ($type == "add") {
                $student_name = CustomHelper::getUserNameByUserId($reviewRating->student_id);
                $tutor_name = CustomHelper::getUserNameByUserId($reviewRating->tutor_id);

                $ratings = $reviewRating->rating;
                /*send notification to admin */
                $attribute = array();
                $rep_Array_for_notification = array($student_name, $tutor_name);
                $action = 'review_ratings_approval';
                $type = CustomHelper::getConfigValue('NOTIFICATION_TYPE.review-rating-approval-request');
                $attribute['sender_id'] = $reviewRating->student_id;
                $attribute['reciver_id'] = ADMIN_ID;

                CustomHelper::saveNotificationActivity($rep_Array_for_notification, $action, $type, $attribute);
                /*send notification to admin */

                /* send mail to admin */
                $action = "review_ratings_approval_for_admin";
                $rep_Array = array($student_name, $tutor_name, $ratings);
                $sendMail = new SendMailService;
                $to = Config::get('Site.email');
                $to_name = Config::get('Site.name_display_in_emails');
                $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                /* send mail to admin */
            }
            $response['status'] = SUCCESS;
            $response['message'] = trans("front_messages.rating_has_been_successfully_added_message");

        }

        $res = array('data' => $response, 'validator' => $validator, 'mobile_req' => $mobile);
        return $res;


    } //reviewRatingSave()

    /**
     * WiziqSessionService::childReportValidateAndSave()
     * @Description Function  for validation validate and save wiziq Session Request
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function childReportValidateAndSave($formData = array(), $attribute = array())
    {
        $message = '';
        $response = array();
        $response['status'] = ERROR;
        $msg = '';
        $errorsArray = [];

        $childId = isset($formData['child_id']) ? $formData['child_id'] : '';

        $type = isset($attribute['type']) ? $attribute['type'] : 'add';
        $from = isset($attribute['from']) ? $attribute['from'] : 'front';

        list($message, $validate) = self::childReportValidate($attribute);
        $validator = Validator::make($formData, $validate, $message);

        if ($validator->fails()) {
            $errorsArray = $validator->errors()->toArray();
            $response['errors'] = $errorsArray;
            $response['message'] = '';
            $res = array('data' => $response, 'validator' => $validator);
            return $res;
        }

        $userDetails = CustomHelper::getUserDetailByChildId($childId);
        $childName = CustomHelper::getUserNameByUserId($childId);

        $childReportData = ChildReport::where('wiziq_class_slots', $formData['wiziq_class_slots'])->where('child_id', $childId)->count();

        if ($childReportData > 0) {
            $response['message'] = trans("front_messages.global.already_send_child_report");
            $res = array('data' => $response, 'validator' => $validator);
            return $res;
        } else {

            $ChildReport = new ChildReport;
            $ChildReport->wiziq_class_id = $formData['wiziq_class_id'];
            $ChildReport->wiziq_class_slots = $formData['wiziq_class_slots'];
            $ChildReport->child_id = $childId;
            $ChildReport->user_id = $userDetails->id;
            $ChildReport->tutor_id = $formData['tutor_id'];
            $ChildReport->rating = $formData['score'];
            $ChildReport->description = nl2br($formData['description']);

            if ($ChildReport->save()) {

                /* Email To User*/
                $userName = $userDetails->full_name;
                $tutorName = Auth::user()->full_name;
                $childName = $childName;
                $rating = $ChildReport->rating;
                $description = $ChildReport->description;
                $action = "child_report";
                $to = $userDetails->email;
                $to_name = $userDetails->full_name;

                $rep_Array = array($userName, $tutorName, $childName, $rating, $description);

                $sendMail = new SendMailService;
                $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                /* Email To User*/

                /* send mail to admin */
                // $action = "child_report";
                $rep_Array = array($userName, $tutorName, $childName, $rating, $description);
                $sendMail = new SendMailService;
                $to = Config::get('Site.admin_email');
                $to_name = Config::get('Site.name_display_in_emails');

                $sendMail->callSendMail($to, $to_name, $rep_Array, $action);
                /* send mail to admin */

                $response['status'] = SUCCESS;
                $response['message'] = '';
                $response['result'] = $ChildReport;
                $response['message'] = trans("front_messages.global.child_report_send_success");

                $res = array('data' => $response, 'validator' => $validator);
                return $res;
            }

        }

        $res = array('data' => $response, 'validator' => $validator);
        return $res;
    } // end childReportValidateAndSave()

/**
 * WiziqSessionService::childReportValidate()
 * @Description Function  for validation validate
 * @param $formData as form data
 * @param $attribute as other attribute
 * @return $validation message and validation
 **/
    public static function childReportValidate($attribute = array())
    {

        /*define validation message*/
        $message = array(
            'child_id.required' => trans('messages.child_id.REQUIRED_ERROR'),
            'score.required' => trans('messages.score.REQUIRED_ERROR'),
            'description.required' => trans('messages.description.REQUIRED_ERROR'),
        );

        $from = isset($attribute['from']) ? $attribute['from'] : 'front';

        $validate['child_id'] = 'required';
        $validate['score'] = 'required';
        $validate['description'] = 'required';

        return array($message, $validate);

    } //end childReportValidate()

    /**
     * ReviewRatingService:reviewRatingListing()
     * @Description Function  for save reviewRatingListing
     * @param $formData  as form data
     * @param $attribute as other values
     * @return response
     * */
    public static function getChildReport($formData = array(), $attributes = array()){
        $status = ERROR;
        $conditions = array();
        $DB = ChildReport::with(['tutorDetail', 'childDetail', 'WiziqClass' => function ($query) {$query->with(['subjects']);}]);

		$userRoleId = (isset($attributes['user_role_id']) && $attributes['user_role_id'] != '') ? $attributes['user_role_id'] : NULL;

        if (($userRoleId == TUTOR_ROLE_ID) && !empty($attributes['user_id'])) {
            $DB->where('tutor_id', $attributes['user_id']);
        }
		else if (($userRoleId == STUDENT_ROLE_ID) && !empty($attributes['user_id'])) {
            $DB->where('user_id', $attributes['user_id']);
        }

        $searchVariable = array();

        $sortBy = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
        $order = (isset($formData['order'])) ? $formData['order'] : 'DESC';
        $recordPerPage = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPage);

        $status = SUCCESS;

        $response['sort_by'] = $sortBy;
        $response['order'] = $order;
        $response['searchVariable'] = $searchVariable;
        $response['result'] = $model;
        $response['status'] = $status;

        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }

        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }

    /**
     * ReviewRatingService:allRetingReview()
     * @Description Function  for save allRetingReview
     * @param $formData  as form data
     * @param $attribute as other values
     * @return response
     * */
    public static function allRetingReview($formData = array(), $attributes = array())
    {

        $status = ERROR;

        $DB = ReviewRating::with(['tutorDetail', 'studentDetail', 'WiziqClass' => function ($query) {$query->with(['subjects']);}]);

        $type = (isset($formData['type'])) ? $formData['type'] : 0;
        $slug = (isset($formData['slug'])) ? $formData['slug'] : '';

        $sortBy = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
        $order = (isset($formData['order'])) ? $formData['order'] : 'DESC';
        $recordPerPage = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        $model = $DB->where('status', ACTIVE)->orderBy($sortBy, $order)->paginate((int) $recordPerPage);

        $status = SUCCESS;

        $response['sort_by'] = $sortBy;
        $response['order'] = $order;
        $response['result'] = $model;
        $response['status'] = $status;

        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }

        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    } // end allRetingReview

} // end ReviewRatingService
