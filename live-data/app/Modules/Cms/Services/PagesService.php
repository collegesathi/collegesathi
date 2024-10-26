<?php
namespace App\Modules\Cms\Services;
use App\Modules\Cms\Models\Cms;
use Auth, View, Config, Cache, DB, Input, Request, Response;
/**
 * Pages Serivces
 *
 * Add your methods in the class below
 *
 * This file will render data from api 
 */
class PagesService {

    public $model = 'Pages';

    public function __construct() {
        View::share('modelName', $this->model);
    }

    /**
     * Function to display cms page on website
     *
     * @param slug as slug of cms page
     *
     * @return view page
     */
    public function showCms($formData) {
		
		$status = ERROR;
		$message = '';
		$response = array();
		if(!empty($formData)){
			$result = Cms::/* with('descriptionData')-> */where('slug', $formData['slug'])->where('is_active', ACTIVE)->first();
			if(!empty($result)){
				$response['result'] 	= $result->toArray();
				$status 				= SUCCESS;
			}else{
				$message = trans('front_messages.global.something_went_wrong') ;
			}
		}else{
			$message =  trans('front_messages.global.something_went_wrong') ;
		}
       
        $response['status'] 	= $status;
        $response['message'] 	= $message;
        $mobile	=	0;	
		if(isset($formData['mobile_req']) && $formData['mobile_req']){ 
				$mobile	=	1;	
		}	
		$res = array('data'=> $response, 'mobile_req'=>$mobile);
		return	$res;
        
      
    }//end showCms()
    
}//PagesController end