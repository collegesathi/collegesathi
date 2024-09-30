<?php
namespace App\Modules\University\Controllers;
use App\Modules\University\Models\UniversityApplication;
use App\Http\Controllers\BaseController;
use Config;
use Request;
use View;

/**
 * UniversityApplication Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/UniversityApplication
 */

class UniversityApplicationController extends BaseController
{

    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'UniversityApplication';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    public function listUniversityApplication($uni_id = null)
    {

        if($uni_id != null){
            $DB = UniversityApplication::query();
            $DB->where('uni_id', $uni_id)->with(['university']);
        }else{
            $DB = UniversityApplication::query();
        }
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
                    if ($fieldName == 'active') {
                        $DB->where('is_active', (int) $fieldValue);
                    } 
                    elseif ($fieldName == 'course') {
                        $DB->where('course', (int) $fieldValue);
                    }
                    elseif ($fieldName == 'university_name') {
                        $DB->whereHas('university', function($q) use ($fieldValue){
                            $q->where('title', 'like', '%' . $fieldValue . '%');
                        });
                    }
                    elseif ($fieldName == 'state') {
                        $DB->whereHas('stateName', function($q) use ($fieldValue){
                            $q->where('state_name', 'like', '%' . $fieldValue . '%');
                        });
                    }
                    elseif ($fieldName == 'city') {
                        $DB->whereHas('cityName', function($q) use ($fieldValue){
                            $q->where('city_name', 'like', '%' . $fieldValue . '%');
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
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        $activeCount = $DB->where('is_active', ACTIVE)->get()->count();

        return View::make("University::applicationindex", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'activeCount','uni_id'));

    } // end listTeam()

    public function viewUniversityApplication($id,$uni_id = null)
    {
        $result = UniversityApplication::findOrFail($id);

        return View::make('University::universityview', compact('result', 'id','uni_id'));
    }
   
}
