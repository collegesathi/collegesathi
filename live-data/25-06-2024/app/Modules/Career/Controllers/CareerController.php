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





    public function jobRequests($type = null,$career_id = null)
    {
        $DB = ApplyJob::query();


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

        if(isset($career_id) && !empty($career_id)){
            $DB->where("career_id", $career_id);
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");
    
        $job_type = Config::get('JOB_TYPE');
        $queryString = Request::getQueryString();

        if($type == EXPORT_TYPE){
            $model = $DB->orderBy($sortBy, $order)->get();
            $responseData = $this->exportJobRequests($model);
            return Response::download($responseData['fileName'], $responseData['fileSuffix'], $responseData['headers']);
        }else{
            $model = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        }
        
        return View::make("$this->model::job_requests_index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','job_type','career_id','type','queryString'));
    }





    public function viewJobRequest($type = null, $id = null, $career_id = null)
    {
        $jobRequest = ApplyJob::find($id)->toArray();
        
        return View::make("$this->model::view_job_request", compact('jobRequest','career_id','type'));
    }




    public function downloadCV($id = null, $file = null)
    {
        $cvFile = ApplyJob::where('id',$id)->where('upload_cv',$file)->get()->first()->toArray();
        $filePath = APPLY_CAREER_CV_ROOT_PATH;
        $fileNameWithPath = $filePath . $cvFile['upload_cv'];
        if (file_exists($fileNameWithPath)) {
            return Response::download($fileNameWithPath);
        } else{
            Session::flash('error', trans("messages.$this->model.file_not_exists"));
            return Redirect::route("$this->model.view_job_request",[LIST_TYPE, $id]);
        }
    }




    public function exportJobRequests($model)
    {
        $getNewData = array();
        if (isset($model) && !empty($model)) {
            $getNewData = $model->toArray();
        }

        /**This code are used for export the csv **/
        $filename = WEBSITE_UPLOADS_ROOT_PATH ."/job_applications.csv";
        $handle   = fopen($filename, 'w+');
        $fieldArray = array('Full Name','Email Address','Mobile Number','Job Position','Description');
        fputcsv($handle, $fieldArray);
        if (isset($getNewData) && !empty($getNewData)) {
            foreach ($getNewData as $obj) {
                $full_name            = !empty($obj['full_name']) ?  $obj['full_name'] : "";
                $email_address            = !empty($obj['email_address']) ?  $obj['email_address'] : "";
                $mobile_number            = !empty($obj['mobile_number']) ?  $obj['mobile_number'] : "";
                $job_position            = !empty($obj['job_position']) ?  $obj['job_position'] : "";
                $description            = !empty($obj['description']) ?  $obj['description'] : "";
                $valueArray = array($full_name,$email_address,$mobile_number,$job_position,$description);
                fputcsv($handle, $valueArray);
            }
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $responseArray['fileName'] = $filename;
        $responseArray['headers'] = $headers;
        $responseArray['fileSuffix'] = "job_applications.csv";
        return $responseArray;
    }
    
}
