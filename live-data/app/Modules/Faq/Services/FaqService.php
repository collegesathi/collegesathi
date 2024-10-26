<?php
namespace App\Modules\Faq\Services;
use App\Modules\Faq\Models\Faq;
use CustomHelper;
use Auth, View, Config, Cache, DB, Input, Request, Response;
/**
 * block Serivces
 *
 * Add your methods in the class below
 *
 * This file will render data from api 
 */
class FaqService {

    public $model = 'Faq';

    public function __construct() {
        View::share('modelName', $this->model);
    }

	/**
     * Function to display Block slider and webinar detail page on website
     *
     * @param slug as slug of Block page
     *
     * @return view page
     */
    public function showFaq($formData) {
		
		$response = array();
		
		$response['faq_data'] 		= CustomHelper::Faqdetail();
		
        $response['status'] 	= SUCCESS;
        $mobile	=	0;	
		if(isset($formData['mobil_req']) && $formData['mobil_req']){ 
				$mobile	=	1;	
		}	
		$res = array('data'=> $response,'mobile_req'=>$mobile);
		return	$res;
    }//end showCms()
    
}

//HomeService end
