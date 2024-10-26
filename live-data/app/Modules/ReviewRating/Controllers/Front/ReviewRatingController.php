<?php
namespace App\Modules\ReviewRating\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\ReviewRating\Models\ReviewRating;
use App\Modules\ReviewRating\Services\ReviewRatingService;
use App\Modules\User\Models\User;
use App\Modules\WiziqClass\Models\StudentWiziqClassSlot;
use App\Modules\WiziqClass\Models\WiziqClassSlot;
use Auth;
use Breadcrumb;
use Redirect;
use Request;
use Session;
use View;

/**
 * ReviewRatingController
 * Add your methods in the class below
 */
class ReviewRatingController extends BaseController
{

    public $model = 'ReviewRating';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for save review rating
     *
     * @param null
     *
     * @return response.
     */
    public function reviewRating()
    {
        if (Request::isMethod('post')) {

            $thisData = Request::all();

            $userId = Auth::user()->id;
            $from = 'front';

            if (!empty($thisData) && Auth::user()) {
                if (isset($userId) && !empty($userId)) {
                
                    $attributes = array('from' => $from);
                    $formData = [
                        'user_id' => $userId,
                        'university_id' => $thisData['university_id'],
                        'score' => isset($thisData['score']) ? $thisData['score'] : null,
                        'review_message' => isset($thisData['review_message']) ? $thisData['review_message'] : null,
                    ];

                    $reviewRatingService = new ReviewRatingService;
                    $response = $reviewRatingService->reviewRatingSave($formData, $attributes);
                    // pr($response);die;

                    if ($response['data']['status'] == ERROR) {
                        if (isset($response['data']['message']) && !empty($response['data']['message'])) {
                            Session::flash(ERROR, $response['data']['message']);
                            return response()->json(['status' => 'errormessage']);
                        } elseif (!empty($response['validator'])) {
                            return response()->json(['status' => ERROR, 'errors' => $response['validator']->errors()->toArray()]);
                        }
                    } else {
                        Session::put('review_message',trans("front_messages.rating_has_been_successfully_added_message"));
                        Session::save();
                        return array('status' => SUCCESS);
                    }
                } else {
                    Session::flash(ERROR, trans("front_messages.global.something_went_wrong"));
                    return array('status' => 'errormessage');
                }
            }

            Session::flash(ERROR, trans("front_messages.global.something_went_wrong"));
            return array('status' => 'errormessage');
        }
    } // end reviewRating()

    /**
     * Function for show review and rating list
     *
     * @param null
     *
     * @return response.
     */
    public function reviewRatingList()
    {
        $userRoleId = Auth::user()->user_role_id;
        ### Breadcrumb Start ###
        if ($userRoleId == STUDENT_ROLE_ID) {
            Breadcrumb::addBreadcrumb(trans("front_messages.global.breadcrumbs_dashboard"), route('Student.studentDashboard'));
        } else {
            Breadcrumb::addBreadcrumb(trans("front_messages.global.breadcrumbs_dashboard"), route('Tutor.tutorDashboard'));
        }
        Breadcrumb::addBreadcrumb(trans("front_messages.$this->model.review_rating"), 'javascript:void(0);');
        $breadcrumbs = Breadcrumb::generate();
        ### Breadcrumb End ###

        $ReviewRatingService = new ReviewRatingService;
        $formData = array();
        $attribute = array();
        $result = array();
        $searchVariable = array();
        $sort_by = array();

        $formData['order'] = Request::get('order');

        $userOrganisationId = Auth::user()->organisation_id;

        $userId = Auth::user()->id;

        $attribute['user_role_id'] = $userRoleId;
        $attribute['user_id'] = $userId;

        $response = $ReviewRatingService->getReviewRating($formData, $attribute);

        if ($response['data']['status'] == SUCCESS) {
            $searchVariable = $response['data']['searchVariable'];
            $sortBy = $response['data']['sort_by'];
            $order = $response['data']['order'];
            $model = $response['data']['result'];
            $viewFolder = $response['data']['viewFolder'];
        }

        $pageTitle = trans("front_messages.title.my_reviews");

        return View::make('ReviewRating::Front.reviewRatingList', compact('pageTitle', 'breadcrumbs', 'model', 'searchVariable', 'sortBy', 'order', 'userRoleId', 'userOrganisationId'));
    } // end reviewRatingList()

    /**
     * Function for delete reviews and ratings
     *
     * @param $id as id of user_review
     *
     * @return redirect page.
     */
    public function deleteReviewsAndRatings($id)
    {
        $user_id = (isset(Auth::user()->id) && (Auth::user()->id != '')) ? Auth::user()->id : '';
        $ratingDetail = array();
        if (!empty($user_id) && !empty($id)) {

            $ratingDetail = ReviewRating::where('is_approved', REQPENDING)->where('student_id', $user_id)->where('id', $id)->first();
            if (!empty($ratingDetail)) {
                if ($ratingDetail->delete()) {
                    Session::flash('flash_notice', trans("front_messages.reviewrating.review_delete_success"));
                }
            } else {
                Session::flash('error', trans('front_messages.Sorry_you_are_allow_delete_review'));
            }
        } else {
            Session::flash('error', trans('front_messages.Sorry_you_are_allow_delete_review'));
        }

        return Redirect::back();
    } // end deleteReviewsAndRatings()

    /**
     * Function for view Rating
     *
     * @param $ratingId as id of user
     *
     * @return redirect page.
     */
    public function viewReviewRating($modelId)
    {
        $result = ReviewRating::with(['tutorDetail', 'studentDetail'])->findOrFail($modelId);
        return View::make("ReviewRating::Front.view", compact('breadcrumbs', 'result'));
    } //reviewAndRatingDetails()

    /**
     * Function to display website retingReview page
     *
     * @param null
     *
     * @return view page
     */
    public function allRetingReview($type = 0, $slug = null)
    {

        $ReviewRatingService = new ReviewRatingService;
        $formData = array();
        $attribute = array();
        $result = array();
        $searchVariable = array();
        $sort_by = array();

        $formData['type'] = Request::get('type');
        $formData['slug'] = Request::get('slug');

        $response = $ReviewRatingService->allRetingReview($formData, $attribute);

        if ($response['data']['status'] == SUCCESS) {
            $sortBy = $response['data']['sort_by'];
            $order = $response['data']['order'];
            $result = $response['data']['result'];

        }

        $pageTitle = trans("front_messages.title.all_rating_review");



        return View::make('ReviewRating::Front.all_reting_review', compact('result', 'pageTitle'));
    } //end allRetingReview()

/**
 * Function for get createRepoerChild
 * @param null
 * @return null
 */
    public function createChildReport()
    {

        $tutor_id = Auth::user()->id;
        $message = '';
        $formData = Request::all();
        $formData['tutor_id'] = $tutor_id;

        $attribute = array();

        $ReviewRatingService = new ReviewRatingService;
        $res = $ReviewRatingService->childReportValidateAndSave($formData, $attribute);

        if ($res['data']['status'] == ERROR) {
            $validator = $res['validator'];
            $message = $res['data']['message'];
			Session::flash(ERROR, $message);
            return response()->json(['status' => ERROR, 'message' => $message, 'errors' => $validator->errors()]);
        } else {
			$message = $res['data']['message'];
			Session::flash(SUCCESS, $message);
            return response()->json(['status' => SUCCESS, 'message' => $message]);
        }

    }

/**
 * Function for show myChildReport list
 *
 * @param null
 *
 * @return response.
 */
    public function myChildReport()
    {

        $ReviewRatingService = new ReviewRatingService;
        $formData = array();
        $attribute = array();
        $result = array();
        $searchVariable = array();
        $sort_by = array();

        $userId 	=	Auth::user()->id;
        $userRoleId =	Auth::user()->user_role_id;

        $attribute['user_id'] 		= $userId;
        $attribute['user_role_id']	= $userRoleId;

        $response = $ReviewRatingService->getChildReport($formData, $attribute);

        if ($response['data']['status'] == SUCCESS) {
            $searchVariable = $response['data']['searchVariable'];
            $sortBy = $response['data']['sort_by'];
            $order = $response['data']['order'];
            $model = $response['data']['result'];
        }

        $pageTitle = trans("front_messages.title.my_child_list");

        return View::make('ReviewRating::Front.student_child_report_List', compact('pageTitle', 'model', 'searchVariable', 'sortBy', 'order', 'userRoleId'));
    } // end myChildReport()

/**
 * Function for get getChildList
 * @param null
 * @return null
 */
    public function getChildList($slot_id = null)
    {

        $userRoleId = Auth::user()->user_role_id;

        $data[] = "<option value=''>" . trans('messages.global.please_select_child') . "<option>";

        if ($userRoleId == STUDENT_ROLE_ID) {
            $childIds = StudentWiziqClassSlot::where('id', $slot_id)->pluck('child_id')->toArray();
        } else {
            $childIds = StudentWiziqClassSlot::where('wiziq_class_slot_id', $slot_id)->pluck('child_id')->toArray();
        }

        $childIdsArray = implode($childIds, ',');

        $childList = User::whereIn('id', $childIds)->where('active', ACTIVE)->pluck('full_name', 'id')->toArray();

        foreach ($childList as $key => $childValue) {
            $data[] = "<option value='" . $key . "'>" . $childValue . "<option>";
        }

        return response()->json(['status' => SUCCESS, 'childList' => $data]);

    } //end getChildList()

} // end ReviewRatingController
