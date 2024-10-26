<?php
namespace App\Modules\Jobs\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Jobs\Models\Job;
use App\Modules\Jobs\Services\JobService;
use CustomHelper;
use Redirect;
use Request;
use Session;
use View;

/**
 * Jobs Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Jobs
 */
class JobsController extends BaseController
{

    public $model = 'Job';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all jobs
     *
     * @param null
     *
     * @return view page.
     */
    public function listJob()
    {
        $DB = Job::query();
        $DB->where('is_active', ACTIVE)->with(['jobType']);

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
                        $DB->where('is_active', (int) $fieldValue);
                    } else {
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


        $stateList 		= 	[];
        $cityList 		= 	[];

        $old_country 	= 	Request::old('country');
        $old_state 		=	Request::old('state');



		if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId   = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }

        return View::make("Jobs::Front.index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order','stateList','cityList','old_state'));
    } // end listJob()

    /**
     * Function for view Job
     *
     * @param $Id as id of Job
     *
     * @return redirect page.
     */
    public function viewJob($slug)
    {
       $result = Job::with('jobType')->where('is_active', ACTIVE)->where('slug', $slug)->first();

        if (empty($result)) {
            return Redirect::route("$this->model.listJob");
        }

        return View::make('Jobs::Front.view', compact('result', 'slug'));
    } //end viewJob()

    /**
     * Function for apply job
     * @param null
     * @return
     */
    public function applyJob()
    {
        $formData = Request::all();

        if (Request::isMethod('post')) {

            $attribute = array("from" => "front", "model" => $this->model, "type" => "add");
            $job = new JobService;
            $res = $job->applyJobValidateandSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) {
                $validator = $res['validator'];
                return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
            } else {
                if ($res['data']['status'] == 'success') {
                    Session::flash(SUCCESS, $res['data']['message']);
                    return response()->json(['status' => SUCCESS]);
                }
            }
        } else {
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.global.something_went_wrong')]);
        }
    }

} // end JobsController()
