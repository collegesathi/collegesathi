<?php
namespace App\Modules\Block\Services;
use App\Modules\Block\Models\Block;
use CustomHelper;
use Auth, View, Config, Cache, DB, Input, Request, Response;
/**
 * block Serivces
 *
 * Add your methods in the class below
 *
 * This file will render data from api 
 */
class BlockService {

    public $model = 'Block';

    public function __construct() {
        View::share('modelName', $this->model);
    }
 
	/**
     * Function to display Block page on website
     *
     * @param slug as slug of Block page
     *
     * @return view page
     */
    public function showBlock($formData) {
		$status = ERROR;
		$message = '';
		$response = array();
		if(!empty($formData)){
			
			$result = CustomHelper::Blockdetail();
			
			if(!empty($result)){
				$response['data'] 		= $result;
				$status 				= SUCCESS;
			}else{
				$message =  trans("front_messages.global.front_wrong_link");
			}
		}else{
			$message =  trans("front_messages.global.front_wrong_link");
		}
       
        $response['status'] 	= $status;
        $response['message'] 	= $message;
        $mobile	=	0;	
		if(isset($formData['mobil_req']) && $formData['mobil_req']){ 
				$mobile	=	1;	
		}	
		$res = array('data'=> $response,'mobile_req'=>$mobile);
		return	$res;
    }//end showCms()
	
}//BlockService end