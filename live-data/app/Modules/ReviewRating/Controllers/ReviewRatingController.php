<?php
namespace App\Modules\ReviewRating\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\ReviewRating\Models\ReviewRating;
use App\Modules\University\Models\University;
use Config;
use Request;
use Response,Redirect,Session;
use View,CustomHelper;
use App\Services\SendMailService;




class ReviewRatingController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'ReviewRating';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index($type = null)
    {
        $DB = ReviewRating::with('getUserDetails','getUniversityDetails');

        $searchVariable = array();
        $inputGet = Request::Input();

        if (Request::Input()) {
            $searchData = Request::Input();
            $searchVariable = Request::Input();

            if (isset($searchData['display'])) {
                unset($searchData['display']);
            }
            if (isset($searchData['_token'])) {
                unset($searchData['_token']);
            }
            if (isset($searchData['sortBy'])) {
                unset($searchData['sortBy']);
            }
            if (isset($searchData['order'])) {
                unset($searchData['order']);
            }
            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);

                if ($fieldValue != '') {
                    $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        if ($type == 'pending') {
            $DB->where('is_approved', REQPENDING);
        }
        

        $rating_list = Config::get('RATING_LIST');
        $model = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        $universityDropdown = University::where('is_active',ACTIVE)->pluck('title','id')->toArray();

        // pr($universityDropdown);die;
        return View::make("$this->model::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','type','rating_list', 'universityDropdown'));
    }





    public function approveReviewRating($type = REQPENDING, $modelId = 0, $status = 0)
    {
        if (!empty($modelId)) {
            $reviewRating = ReviewRating::with('getUserDetails')->where('is_approved', '<>', REQAPPROVE)->findOrFail($modelId);
            $user_email = $reviewRating->getUserDetails->email;
            // pr($reviewRating->toArray());die;
            if (!empty($reviewRating)) {
                $reviewRating->is_approved = (int) $status;
                $reviewRating->save();
                $avgReviewRating = CustomHelper::avgReviewRating($reviewRating->university_id);
                // pr($avgReviewRating);die;

                $attributes['university_id'] = $reviewRating->university_id;
                $attributes['avg_rating'] = $avgReviewRating;
                $universityData = CustomHelper::updateUserAvgReviewRating($attributes);
                /* send mail to admin */
                if (!empty($universityData)) {
                    $action = "review_ratings_approved_by_admin";
                    $university_name = $universityData->title;
                    $user_name = CustomHelper::getUserNameByUserId($reviewRating->user_id);
                    $rep_Array = array($user_name, $university_name);
                    $to = $user_email;
                    $to_name = config::get('Email.username');
                    $sendMail = new SendMailService;

                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                    Session::flash(SUCCESS, trans('messages.ReviewRating.approved_msg'));
                }
            } else {
                Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));
            }
        } else {
            Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));

        }
        return Redirect::route("$this->model.index", [$type]);
    }
    




    public function updateStatus($type = REQPENDING, $modelId = 0, $status = 0)
    {

        if (!empty($modelId)) {
            $reviewRating = ReviewRating::findOrFail($modelId);
            $reviewRating->status = (int) $status;
            $reviewRating->save();
            Session::flash('success', trans("messages.global.status_updated_message"));
        } else {
            Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));

        }
        return Redirect::route("$this->model.index", [$type]);
    }






    public function view($type = REQPENDING, $modelId)
    {
        
        $result = ReviewRating::with(['getUserDetails','getUniversityDetails'])->findOrFail($modelId);
        // pr($result->toArray());die;

        return View::make("$this->model::view", compact( 'result', 'type'));
    }





    public function deleteReviewRating($type = REQPENDING, $modelId = INACTIVE)
    {
        if (!empty($modelId)) {
            $reviewRating = ReviewRating::findOrFail($modelId);
            if($reviewRating->delete()){
                $avgReviewRating = CustomHelper::avgReviewRating($reviewRating->university_id);
                $attributes = array();
                $attributes['university_id'] = $reviewRating->university_id;
                $attributes['avg_rating'] = $avgReviewRating;
                CustomHelper::updateUserAvgReviewRating($attributes);
            }

            Session::flash(SUCCESS, trans("messages.$this->model.deleted_message"));
        } else {
            Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));

        }
        return Redirect::route("$this->model.index", [$type]);
    }
    
}
