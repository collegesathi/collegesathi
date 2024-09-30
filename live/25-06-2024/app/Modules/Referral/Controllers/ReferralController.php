<?php
//CourseController
namespace App\Modules\Referral\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Referral\Models\Referral;
use Config;
use Request;
use Response;
use View;




class ReferralController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'Referral';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index($type = null)
    {
        $DB = Referral::with('getRefereeCityName','getReferenceCityName');

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
            $responseData = $this->exportReferralRequests($model);
            return Response::download($responseData['fileName'], $responseData['fileSuffix'], $responseData['headers']);
        }
		else{
            $model = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        }
        
        return View::make("$this->model::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','type','queryString'));
    }





    public function exportReferralRequests($model)
    {
        $getNewData = array();
        if (isset($model) && !empty($model)) {
            $getNewData = $model->toArray();
        }
        
        /**This code are used for export the csv **/
        $filename = WEBSITE_UPLOADS_ROOT_PATH ."/referrals_list.csv";
        $handle   = fopen($filename, 'w+');
        $fieldArray = array('Referee Name','Referee Email','Referee Phone','Referee City', 'Reference Name','Reference Email','Reference Phone','Reference City');
        fputcsv($handle, $fieldArray);
        if (isset($getNewData) && !empty($getNewData)) {
            foreach ($getNewData as $obj) {
                $referee_name            = !empty($obj['referee_name']) ?  $obj['referee_name'] : "";
                $referee_phone            = !empty($obj['referee_phone']) ?  $obj['referee_phone'] : "";
                $referee_email            = !empty($obj['referee_email']) ?  $obj['referee_email'] : "";
                $referee_city            = !empty($obj['get_referee_city_name']) ?  $obj['get_referee_city_name']['city_name'] : "";
                $reference_name            = !empty($obj['reference_name']) ?  $obj['reference_name'] : "";
                $reference_phone            = !empty($obj['reference_phone']) ?  $obj['reference_phone'] : "";
                $reference_email            = !empty($obj['reference_email']) ?  $obj['reference_email'] : "";
                $reference_city            = !empty($obj['get_reference_city_name']) ?  $obj['get_reference_city_name']['city_name'] : "";

                $valueArray = array($referee_name,$referee_phone,$referee_email,$referee_city,$reference_name,$reference_phone,$reference_email,$reference_city);
                fputcsv($handle, $valueArray);
            }
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $responseArray['fileName'] = $filename;
        $responseArray['headers'] = $headers;
        $responseArray['fileSuffix'] = "referrals_list.csv";
        return $responseArray;
    }


    
    
}
