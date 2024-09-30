<?php
namespace App\Modules\Scholarship\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Scholarship\Models\ScholarshipRequest;
use Config;
use Request;
use Response;
use View;




class ScholarshipController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'Scholarship';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index($type = null)
    {

        $DB = ScholarshipRequest::with('getCityName');

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

        $queryString = Request::getQueryString();

        if($type == EXPORT_TYPE){
            $model = $DB->orderBy($sortBy, $order)->get();
            $responseData = $this->exportScholarshipRequests($model);
            return Response::download($responseData['fileName'], $responseData['fileSuffix'], $responseData['headers']);
        }
        else{
            $model = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        }
        
        return View::make("$this->model::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','queryString','type'));
    }






    public function exportScholarshipRequests($model)
    {
        $getNewData = array();
        if (isset($model) && !empty($model)) {
            $getNewData = $model->toArray();
        }
        
        /**This code are used for export the csv **/
        $filename = WEBSITE_UPLOADS_ROOT_PATH ."/scholarship_list.csv";
        $handle   = fopen($filename, 'w+');
        $fieldArray = array('Full Name','Email','Phone','Course','City');
        fputcsv($handle, $fieldArray);
        if (isset($getNewData) && !empty($getNewData)) {
            foreach ($getNewData as $obj) {
                $full_name            = !empty($obj['full_name']) ?  $obj['full_name'] : "";
                $email            = !empty($obj['email']) ?  $obj['email'] : "";
                $phone            = !empty($obj['phone']) ?  $obj['phone'] : "";
                $course            = !empty($obj['course']) ?  $obj['course'] : "";
                $city            = !empty($obj['get_city_name']) ?  $obj['get_city_name']['city_name'] : "";
                $valueArray = array($full_name,$email,$phone,$course,$city);
                fputcsv($handle, $valueArray);
            }
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $responseArray['fileName'] = $filename;
        $responseArray['headers'] = $headers;
        $responseArray['fileSuffix'] = "scholarship_list.csv";
        return $responseArray;
    }


    
    
}
