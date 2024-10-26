<?php
namespace App\Modules\Review\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Review\Models\Review;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Session;
use Validator;
use View;

/**
 * ReviewController 
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Review
 */
class ReviewController extends BaseController
{

    public $model = 'Review';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Review page
     *
     * @param null
     *
     * @return view page.
     */
    public function listReview()
    {
        $DB = Review::query();
        $searchVariable = array();
        $inputGet = Request::all();

        if (Request::all()) {
            $searchData = Request::all();
            $searchVariable = Request::all();

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
                    if ($fieldName == 'active') {
                        $DB->where('is_status', (int) $fieldValue);
                    }
                    elseif ($fieldName == 'university_name') {
                        $DB->whereHas('universityreview', function($q) use ($fieldValue){
                            $q->where('title', 'like', '%' . $fieldValue . '%');
                        });
                    }
                     else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $limit = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : CustomHelper::getConfigValue("Reading.records_per_page");
        $model = $DB->orderBy($sortBy, $order)->paginate((int) $limit);

        return View::make("Review::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order'));
    } // end listAdvertisement()


    /**
     * Function for view viewAdvertisement
     *
     * @param $Id as id of viewExpert
     *
     * @return redirect page.
     */
    public function viewReview($id)
    {
        $result = Review::findOrFail($id);

        return View::make('Review::view', compact('result', 'id'));
    } //end viewExpert()

    /**
     * Function for update Expert page status
     *
     * @param $modelId as id of Expert page
     * @param $modelStatus as status of Expert page
     *
     * @return redirect page.
     */
    public function updateReviewStatus($modelId = 0, $modelStatus = 0)
    {
        Review::where('id', '=', $modelId)->update(array('is_status' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
    } // end updateExpertStatus()

    /**
     * Function for delete,active or deactivate multiple Expert
     *
     * @param null
     *
     * @return view page.
     */
    public function performMultipleAction()
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'delete') {
                    Review::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Review::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Review::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

    public function reviewstatus()
    {
        $response = array();
        $response['status'] = ERROR;

            $formData = Request::all();
            if(!empty($formData)){
                $id                     = isset($formData['id']) ? $formData['id'] : null;
                $application_action     = isset($formData['application_action']) ? $formData['application_action'] : null;
                $reason                 = isset($formData['reason']) ? $formData['reason'] : null;

                    $message = array(
                        'reason.required' => trans('messages.reason.REQUIRE_ERROR'),
                        'reason.max' => trans('messages.reason.REASON_MAX_ERROR', ['max' => MESSAGE_LENGTH]),
                    );
                    /*define validation */
                    $validate = array(
                        'reason' => 'required|max:' . MESSAGE_LENGTH,
                    );

                $validator = Validator::make($formData, $validate, $message);
                if ($validator->fails()) {
                    $response['errors'] = $validator->errors()->toArray();
                } else {

                    $obj = Review::findOrFail($id);

                    $obj->rejected_reason    = isset($reason) ? $reason  : null;
                    $obj->is_status          = (int)REJECT;
                    $obj->save();

                    Session::flash('success', trans("messages.global.review_status_update_success_message"));
                    $response['status'] = SUCCESS;
                }
            }else {
                Session::flash(ERROR, trans("messages.$this->model.file_not_exists"));
                return Redirect::route("$this->model.index");
            }

           return response()->json($response);


    }

} // end ExpertController()
