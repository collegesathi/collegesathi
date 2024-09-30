<?php
namespace App\Modules\EmailLog\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\EmailLog\Models\EmailLog;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,Redirect,Request,Response,Session,URL,View,Validator;
/**
 * Base Controller
 *
 * Add your methods in the class below
 *
 * This is the base controller called everytime on every request
 */
 
class  EmailLogController extends BaseController {
	
	/*
	 * Function for display email detail from database   
	 *
	 * @param null
	 *
	 * @return view page. 
	 */	
	public $model	=	'EmailLog';
	
	public function __construct() {
		
		View::share('modelName',$this->model);
	}
	
	public function listEmail(){
		
		$DB				=	EmailLog::query();

		$searchVariable	=	array(); 
		$inputGet		=	Request::all();
		
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

            foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue)){
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
        }


		$recordPerPagePagination			=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page"); 
		
		$sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
	    $order  = (Request::get('order')) ? Request::get('order')   : 'DESC';
		
	    
		$model	= $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);	
		return  View::make("EmailLog::index",compact('recordPerPagePagination','model','searchVariable', 'sortBy','order'));
	}//end listEmail()
		
/*
 * Function for dispaly email details on popup   
 *
 * @param $id as mail id 
 *
 * @return view page. 
 */
	public function EmailDetail($modelId=0){
		if(Request::ajax()){   
			$modelId	=	Request::get('sliderId');
			$model	= EmailLog::where('id',$modelId)->get();
			return View::make("EmailLog::popup",compact('model'));
		}
	}// end EmailDetail()
	
}// end EmailLogsController
