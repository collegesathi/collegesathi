<?php
namespace App\Modules\DropDown\Services;
use App\Modules\DropDown\Models\DropDown;
use CustomHelper;
use Auth,
	View,
    Config,
    Cache,
    DB,
    Input,
    Request,
    Response;
/**
 * block Serivces   
 *
 * Add your methods in the class below
 *
 * This file will render data from api 
 */
class DropDownService {

    public $model = 'DropDown';

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
     
    public function showDropDown($formData) {
		
		$response = array();
		$response['countryList'] 		= 	CustomHelper::getCountry(); 
		$response['grades'] 			= CustomHelper::getMasterDropdown('grades');
		$response['curriculum'] 		= CustomHelper::getMasterDropdown('curriculum');
		$response['area_of_expertise'] 	= CustomHelper::getMasterDropdown('area_of_expertise');
		$response['language'] 			= CustomHelper::getMasterDropdown('language');
        
		$resData						=	array();

        $mobile	=	0;	
        
		if(isset($formData['mobil_req']) && $formData['mobil_req']){
			$response['time_zones'] 		= Config::get('TIME_ZONE');
			foreach($response as $key=>$val){
				$i =	0;
				foreach($val as $subKey=>$subVal){
					$resData[$key][$i]['key']	=	$subKey;
					$resData[$key][$i]['value']	=	$subVal;
					$i++;
				}
			}
			$mobile	=	1;	
		}else{
			$resData	=	$response;
		}
        $resData['status'] 			= SUCCESS;
		
		$res = array('data'=> $resData,'mobile_req'=>$mobile);
		return	$res;
    }
    
    
    
   /**
	* SubjectService::getStateByCountry()
	* @param $formData as form data
	* @param $attribute as other attribute
	* @return $res
	**/
	public function getStateByCountry($formData = array(),$attribute = array()){
		
		$status 		= 	ERROR;
		$countryId		=	isset($formData['countryId'])?$formData['countryId']:'';
	
			
			$stateDetails	=	CustomHelper::getStateList($countryId);
			$resData['status']	 = SUCCESS;
			$response['state']		= $stateDetails;
			
			foreach($response as $key=>$val){
				$i =	0;
				foreach($val as $subKey=>$subVal){
					$resData[$key][$i]['key']	=	$subKey;
					$resData[$key][$i]['value']	=	$subVal;
					$i++;
				}
			}
			
			$mobile				=	0;
			if(isset($formData['mobil_req']) && $formData['mobil_req']){ 
				$mobile	=	1;	
			}	
			$res= array('data'=> $resData,'mobile_req'=>$mobile);
			return $res;
		
		
		
		}
		
		
	/**
	* SubjectService::getCityByCountry()
	* @param $formData as form data
	* @param $attribute as other attribute
	* @return $res
	**/
	public function getCityByState($formData = array(),$attribute = array()){
		
		$status 		= 	ERROR;
		$countryId		=	isset($formData['countryId'])?$formData['countryId']:'';
		$stateId		=	isset($formData['stateId'])?$formData['stateId']:'';
	
			
			$stateDetails	=	CustomHelper::getCityList($countryId,$stateId);
			$resData['status']	 = SUCCESS;
			$response['city']		= $stateDetails;
			
			foreach($response as $key=>$val){
				$i =	0;
				foreach($val as $subKey=>$subVal){
					$resData[$key][$i]['key']	=	$subKey;
					$resData[$key][$i]['value']	=	$subVal;
					$i++;
				}
			}
			
			$mobile				=	0;
			if(isset($formData['mobil_req']) && $formData['mobil_req']){ 
				$mobile	=	1;	
			}	
			$res= array('data'=> $resData,'mobile_req'=>$mobile);
			return $res;
		
		
		
		}	
		
		
     
    
}
