<?php
//CourseController
namespace App\Modules\EnquireNow\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\EnquireNow\Models\EnquireNow;
use Config;
use Redirect;
use Request;
use Response;
use Session;
use Validator;
use View;
use App\Modules\Career\Models\ApplyJob;

/**
 * EnquireNow Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/UniversityApplication
 */
class EnquireNowController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'EnquireNow';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index()
    {

        $DB = EnquireNow::with('countryName','stateName','cityName');

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

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        // pr($model->toArray());die;
        return View::make("$this->model::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable'));
    }



}
