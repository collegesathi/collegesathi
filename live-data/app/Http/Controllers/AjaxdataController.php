<?php
namespace App\Http\Controllers;


use Input, View, Config, Request, Session, Auth, CustomHelper;


/**
 * AjaxdataController Controller
 */
class AjaxdataController extends BaseController {


	/**
     * Function for get list of states
     *
     * @param null
     * 
     * @return html data. 
     */
    public function getStates() {
        $country_id 	= Request::get('country_id');
        $stateFieldName = Request::get('state_field_name');
        $cityFieldName 	= Request::get('city_field_name');
        $cityDiv 		= Request::get('cityDiv');
        $formId 		= Request::get('formId');
        $classname		= Request::get('classname');
     
        $stateList 		= CustomHelper::getStateList($country_id);
 
        if(! empty(Request::get('section_name'))) {
            $sectionName = Request::get('section_name');

            return view::make('elements.get_state_by_country', compact('country_id', 'stateList', 'stateFieldName', 'cityFieldName', 'cityDiv', 'formId', 'sectionName', 'classname'));
        }  
        else {
            return view::make('elements.get_state_by_country', compact('country_id', 'stateList', 'stateFieldName', 'cityFieldName', 'cityDiv', 'formId', 'classname'));
        }
    }
	
	
	/**
     * Function for get list of cities
     *
     * @param null
     * 
     * @return html data. 
     */
    public function getCities() {
        $country_id 	= Request::get('country_id');
        $state_id 		= Request::get('state_id');
        $cityFieldName 	= Request::get('city_field_name');
        $cityDiv 		= Request::get('cityDiv');
        $formId 		= Request::get('formId');
		$classname		= Request::get('classname');
        $citylist 		= CustomHelper::getCityList($country_id, $state_id);
		
        return view::make('elements.get_city_by_state', compact('state_id', 'citylist', 'cityFieldName', 'classname'));
    }
   
	
}// end AjaxdataController class
