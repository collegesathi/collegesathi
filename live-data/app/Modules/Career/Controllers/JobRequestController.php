<?php
//CourseController
namespace App\Modules\Career\Controllers;

use App\Http\Controllers\BaseController;
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
class JobRequestController extends BaseController
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
