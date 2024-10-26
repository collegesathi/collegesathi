<?php

namespace App\Modules\Survey\Controllers;

use App\Modules\Survey\Models\Survey;
use App\Http\Controllers\BaseController;
use App\Modules\Country\Models\State;
use CustomHelper;
use Redirect;
use Request;
use Session;
use View;

/**
 * Survey Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Survey
 */
class SurveyController extends BaseController
{

    public $model = 'Survey';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Survey page
     *
     * @param null
     *
     * @return view page.
     */
    public function listSurvey()
    {

        $DB = Survey::query();
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
                    } elseif ($fieldName == 'state') {
                        $DB->where('state', (int) $fieldValue);
                    }  else {
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
       
        $stateList = State::where('country_id', COUNTRY)->pluck('state_name', 'id')->toArray();
        return View::make("Survey::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order','stateList'));
    } // end listExpert()

    /**
     * Function for view viewSurvey
     * 
     * @param $Id as id of viewSurvey
     *
     * @return redirect page.
     */
    public function viewSurvey($id)
    {
        $result = Survey::with('getAllSurveyQuestionAnswer','getExpertName')->where('id', $id)->get()->first();

        return View::make('Survey::view', compact('result', 'id'));
    } //end viewExpert()

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
                    Survey::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Survey::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Survey::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()
} // end ExpertController()
