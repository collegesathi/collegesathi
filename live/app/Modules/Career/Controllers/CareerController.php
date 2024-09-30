<?php
//CourseController
namespace App\Modules\Career\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Career\Models\Career;
use Config;
use Redirect;
use Request;
use Response;
use Session;
use Validator;
use View;
use App\Modules\Career\Models\ApplyJob;

/**
 * UniversityApplication Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/UniversityApplication
 */
class CareerController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'Career';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index()
    {

        $DB = Career::with('getTotalApplications');

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
                    if ($fieldName == 'is_active') {
                        $DB->where('is_active', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);

        $job_type = Config::get('JOB_TYPE');

        return View::make("$this->model::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','job_type'));
    }



    public function addCareer()
    {
        $job_type = Config::get('JOB_TYPE');
        return View::make("$this->model::add", compact('job_type'));
    }


    public function saveCareer()
    {
        $thisData = Request::all();

        $validator = Validator::make(
            $thisData,
            array(
                'job_title'             => 'required',
                'job_type'              => 'required',
                'skill'                 => 'required',
                'education'             => 'required',
                'work_experience'       => 'required',
                'work_location'         => 'required',
                'description'           => 'required',
            ),
            array(
                'job_title.required'        => trans('messages.career.job_title_error'),
                'job_type.required'         => trans('messages.career.job_type_error'),
                'skill.required'            => trans('messages.career.skill_error'),
                'education.required'        => trans('messages.career.education_error'),
                'work_experience.required'  => trans('messages.career.work_experience_error'),
                'work_location.required'    => trans('messages.career.work_location_error'),
                'description.required'      => trans('messages.career.description_error')
            ),
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj     =  new Career;
            $obj->is_active   = (int)ACTIVE;
            $obj->job_title = isset($thisData['job_title']) && !empty($thisData['job_title']) ? $thisData['job_title'] : "";
            $obj->job_type = isset($thisData['job_type']) && !empty($thisData['job_type']) ? $thisData['job_type'] : "";
            $obj->skill = isset($thisData['skill']) && !empty($thisData['skill']) ? $thisData['skill'] : "";
            $obj->education = isset($thisData['education']) && !empty($thisData['education']) ? $thisData['education'] : "";
            $obj->work_experience = isset($thisData['work_experience']) && !empty($thisData['work_experience']) ? $thisData['work_experience'] : "";
            $obj->work_location = isset($thisData['work_location']) && !empty($thisData['work_location']) ? $thisData['work_location'] : "";
            $obj->description = isset($thisData['description']) && !empty($thisData['description']) ? $thisData['description'] : "";
            $obj->save();

            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.index");
        }
    }


    public function editCareer($id = null)
    {
        $result = Career::find($id);
        $job_type = Config::get('JOB_TYPE');
        return View::make("$this->model::edit", compact('result', 'job_type', 'id'));
    }



    public function updateCareer()
    {
        $thisData = Request::all();
        
        $obj = Career::findorFail($thisData['id']);

        $validator = Validator::make(
            $thisData,
            array(
                'job_title'             => 'required',
                'job_type'              => 'required',
                'skill'                 => 'required',
                'education'             => 'required',
                'work_experience'       => 'required',
                'work_location'         => 'required',
                'description'           => 'required',
            ),
            array(
                'job_title.required'        => trans('messages.career.job_title_error'),
                'job_type.required'         => trans('messages.career.job_type_error'),
                'skill.required'            => trans('messages.career.skill_error'),
                'education.required'        => trans('messages.career.education_error'),
                'work_experience.required'  => trans('messages.career.work_experience_error'),
                'work_location.required'    => trans('messages.career.work_location_error'),
                'description.required'      => trans('messages.career.description_error')
            ),
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj->job_title = isset($thisData['job_title']) && !empty($thisData['job_title']) ? $thisData['job_title'] : "";
            $obj->job_type = isset($thisData['job_type']) && !empty($thisData['job_type']) ? $thisData['job_type'] : "";
            $obj->skill = isset($thisData['skill']) && !empty($thisData['skill']) ? $thisData['skill'] : "";
            $obj->education = isset($thisData['education']) && !empty($thisData['education']) ? $thisData['education'] : "";
            $obj->work_experience = isset($thisData['work_experience']) && !empty($thisData['work_experience']) ? $thisData['work_experience'] : "";
            $obj->work_location = isset($thisData['work_location']) && !empty($thisData['work_location']) ? $thisData['work_location'] : "";
            $obj->description = isset($thisData['description']) && !empty($thisData['description']) ? $thisData['description'] : "";

            $obj->save();

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    }



    public function statusCareer($id = null, $status = null)
    {
        Career::where('id', '=', $id)->update(array('is_active' => (int) $status));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
    }



    public function viewCareer($id = null)
    {
        $career = Career::find($id)->toArray();
        
        return View::make("$this->model::view", compact('career', 'id'));
    }

}
