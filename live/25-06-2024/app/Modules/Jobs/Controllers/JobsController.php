<?php
namespace App\Modules\Jobs\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Jobs\Models\Job;
use App\Modules\Jobs\Models\JobApplication;
use App\Modules\Jobs\Services\JobService;
use CustomHelper;
use Redirect;
use Request;
use Session;
use Validator;
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


    public function __construct(){
        View::share('modelName', $this->model);
    }


    /**
     * Function for display all jobs
     *
     * @param null
     *
     * @return view page.
     */
    public function listJob(){

        $DB = Job::query();
		$DB->with(['jobType']);
		$DB->withCount('JobApplications as total_applications');

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

        return View::make("Jobs::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order'));
    } // end listJob()


    /**
     * Function for display page for add new Job
     *
     * @param null
     *
     * @return view page.
     */
    public function addJob(){

		$jobTypeList	=	CustomHelper::getMasterDropdown('job_types');
        $experienceList	=	CustomHelper::getMasterDropdown('experience');

        return View::make("Jobs::add", compact('jobTypeList','experienceList'));
    } //end addJob()


	/**
	 * Function for save Job
	 *
	 * @param null
	 *
	 * @return redirect page.
	 */
    public function saveJob(){
        $formData = Request::all();
        if (!empty($formData)) {
            $attribute = array("from" => "admin", "model" => $this->model, "type" => "add");
            $job = new JobService;
            $res = $job->jobValidateandSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == 'error') {
                $validator = $res['validator'];
                return Redirect::back()->withErrors($validator)->withInput();
            }
			else {
                Session::flash('success', trans("messages.$this->model.added_message"));
                return Redirect::route("$this->model.index");
            }
        }
    }


    /**
     * Function for display page for edit Job
     *
     * @param $Id ad id of Job
     *
     * @return view page.
     */
    public function editJob($modelId){
        $result 		= 	Job::findorFail($modelId);
		$jobTypeList	=	CustomHelper::getMasterDropdown('job_types');
        $experienceList	=	CustomHelper::getMasterDropdown('experience');

        return View::make("Jobs::edit", compact('experienceList', 'result', 'jobTypeList'));

    } // end editJob()


	/**
	 * Function for save Job
	 *
	 * @param null
	 *
	 * @return redirect page.
	 */
    public function updateJob($id){
        $formData = Request::all();
        if (!empty($formData)) {
            $attribute = array("from" => "admin", "type" => "edit", "model" => $this->model, "job_id" => $id);
			$job = new JobService;
            $res = $job->jobValidateandSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) {
                $validator = $res['validator'];
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                Session::flash('success', trans("messages.$this->model.updated_message"));
                return Redirect::route("$this->model.index");
            }
        }
    }


    /**
     * Function for view Job
     *
     * @param $Id as id of Job
     *
     * @return redirect page.
     */
    public function viewJob($id){


        $result = Job::with(['jobType','experienceName'])->withCount('JobApplications as total_applications')->findOrFail($id);

        return View::make('Jobs::view', compact('result', 'id'));
    } //end viewJob()


    /**
     * Function for update Job status
     *
     * @param $modelId as id of Job
     * @param $modelStatus as status of Job
     *
     * @return redirect page.
     */
    public function updateJobStatus($modelId = 0, $modelStatus = 0){
        Job::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
    } // end updateJobStatus()


    /**
     * Function for delete,active or deactivate multiple Jobs
     *
     * @param null
     *
     * @return view page.
     */
    public function performMultipleAction(){
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'delete') {
                    Job::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Job::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Job::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()


	/**
     * Function for display all job Applications
     *
     * @param null
     *
     * @return view page.
     */
    public function jobApplications($jobId = null){

		$jobDetail	=	Job::findOrFail($jobId);


        $DB = JobApplication::query();
		$DB->where('job_id', $jobId)->with(['job']);

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

        return View::make("Jobs::job_applications", compact('limit', 'model', 'searchVariable', 'sortBy', 'order', 'jobId'));
    } // end listJob()


	/**
     * Function for view Job Application
     *
     * @param $Id as id of JobApplication
     *
     * @return redirect page.
     */
    public function viewJobApplication($id){
		$result = JobApplication::with(['job','stateName','cityName'])->findOrFail($id);
		$jobDetail	=	Job::findOrFail($result->job_id);


        return View::make('Jobs::view_job_application', compact('result', 'id'));
    } //end viewJobApplication()


	/**
     * Function for delete Job Application
     *
     * @param $Id as id of Job Application
     *
     * @return redirect page.
     */
    public function deleteJobApplication($id = 0){
		$result 	= 	JobApplication::with('job')->findOrFail($id);
		$jobDetail	=	Job::findOrFail($result->job_id);

        if ($id) {
            JobApplication::where('id', $id)->delete();
            Session::flash('success', trans("messages.$this->model.application_deleted_message"));
        }
        return Redirect::route("$this->model.jobApplications", [$result->job_id]);
    } // end deleteJobApplication()


	/**
     * Function for download Resume Job Application
     *
     * @param $Id as id of JobApplication
     *
     * @return redirect page.
     */
    public function downloadResume($id){
		$result = JobApplication::findOrFail($id);

		$downloadPath	=	RESUME_ROOT_PATH;
		$fileName		=	$result->resume;
		$filePath		=	RESUME_ROOT_PATH.$fileName;

		if(!empty($result->resume) && file_exists($filePath)){
			return response()->download($filePath);
		}
		else {
			Session::flash('success', trans("messages.$this->model.resume_not_exists"));
			return Redirect::route("$this->model.viewJobApplication", $id);
		}
	} //end downloadResume()


} // end JobsController()
