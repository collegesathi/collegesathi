<?php
namespace App\Modules\Country\Services;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Models\State;
use App\Modules\Country\Models\City;
use CustomHelper,Auth,View,Config,Cache,DB,Input,Request,Response;
/**
 * block Serivces
 *
 * Add your methods in the class below
 *
 * This file will render data from api 
 */
class CountryService {

    public $model = 'Country';

    public function __construct() {
		
        View::share('modelName', $this->model);
    }


    /**
     * Function to get country list
     *
     * @return view page
     */
    public function getCountryList($formData, $attr=array()){
        $mobile				  = (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$countryList          = Country::where('status',(string)ACTIVE)->select("id","country_name")->orderBy('country_name', 'ASC')->get()->toArray();
		
		
		$countryArray = array();
		if(!empty($countryList))
		{
			foreach($countryList as $key=>$record)
			{
				$countryArray[$key]['id'] 		= 	isset($record['id']) ? $record['id'] : "";
				$countryArray[$key]['value'] 	= 	isset($record['country_name']) ? $record['country_name'] : "";
			}
		}
		$responseData               = array();
		$responseData['result'] 	= $countryArray;
		$responseData['status'] 	= SUCCESS;	
		$res = array('data'=> $responseData,'mobile_req'=>$mobile);
		return	$res;

	} // End getCountryList()


    /**
     * Function to get state list
     *
     * @return view page
     */
    public function getStateList($formData,$attr=array()){
        $mobile				  = (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
        $countryId            = isset($formData['country_id'])? $formData['country_id'] : '';
		$stateList            = State::where('country_id',$countryId)->where('status',(string)ACTIVE)->select("id","state_name")->orderBy('state_name', 'ASC')->get()->toArray();
        $stateArray            = array();
		if(!empty($stateList))
		{
			foreach($stateList as $key=>$record)
			{
				$stateArray[$key]['id']    	= 	isset($record['id']) ? $record['id'] : "";
				$stateArray[$key]['value'] 	= 	isset($record['state_name']) ? $record['state_name'] : "";
			}
		}
		$responseData               = array();
		$responseData['result'] 	= $stateArray;
		$responseData['status'] 	= SUCCESS;	
		$res = array('data'=> $responseData,'mobile_req'=>$mobile);
		return	$res;

	} // End getStateList()
    
	
	/**
     * Function to get city list
     *
     * @return view page
     */
    public function getCityList($formData,$attr=array()){
        $mobile			= 	(isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
        $countryId		= 	isset($formData['country_id'])? $formData['country_id'] : '';
        $stateId 		= 	isset($formData['state_id'])? $formData['state_id'] : '';
		$cityList		= 	City::where('country_id',$countryId)->where('state_id',$stateId)->where('status',(string)ACTIVE)->select("id","city_name")->orderBy('city_name', 'ASC')->get()->toArray();
        $cityArray            = array();
		if(!empty($cityList))
		{
			foreach($cityList as $key=>$record)
			{
				$cityArray[$key]['id']    	= 	isset($record['id']) ? $record['id'] : "";
				$cityArray[$key]['value'] 	= 	isset($record['city_name']) ? $record['city_name'] : "";
			}
		}
		$responseData               = array();
		$responseData['result'] 	= $cityArray;
		$responseData['status'] 	= SUCCESS;	
		$res = array('data'=> $responseData,'mobile_req'=>$mobile);
		return	$res;

	} // End getCityList()



	/**
     * Function to get state list
     *
     * @return view page
     */
    public function getActiveBankList($formData,$attr=array()){
        $mobile				  = (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
        $countryId            = isset($formData['country_id'])? $formData['country_id'] : '';
		$bankList             = CustomHelper::getActiveBankList($countryId);
        $bankArray            = array();
		if(!empty($bankList))
		{

			$count = 0 ;
			foreach($bankList as $key=>$record)
			{ 
				$bankArray[$count]['id']    	= 	$key;
				$bankArray[$count]['value'] 	= 	$record;
				$count++;
			}
		}
		$responseData               = array();
		$responseData['result'] 	= $bankArray;
		$responseData['status'] 	= SUCCESS;	
		$res = array('data'=> $responseData,'mobile_req'=>$mobile);
		return	$res;

	} // End getStateList()



	/**
     * Function to get country list
     *
     * @return view page
     */
    public function getActiveCurrencieCountryList($formData, $attr=array()){
        $mobile				  = (isset($attr['from']) &&($attr['from'] =='mobile')) ?ACTIVE: INACTIVE;
		$countryList          = Country::whereHas('Currency', function($q){  
			$q->where('is_active', ACTIVE); 
		})->where('status',(string)ACTIVE)->select("id","country_name")->orderBy('country_name', 'ASC')->get()->toArray();
		
		
		$countryArray = array();
		if(!empty($countryList))
		{
			foreach($countryList as $key=>$record)
			{
				$countryArray[$key]['id'] 		= 	isset($record['id']) ? $record['id'] : "";
				$countryArray[$key]['value'] 	= 	isset($record['country_name']) ? $record['country_name'] : "";
			}
		}
		$responseData               = array();
		$responseData['result'] 	= $countryArray;
		$responseData['status'] 	= SUCCESS;	
		$res = array('data'=> $responseData,'mobile_req'=>$mobile);
		return	$res;

	} // End getCountryList()
    
}
