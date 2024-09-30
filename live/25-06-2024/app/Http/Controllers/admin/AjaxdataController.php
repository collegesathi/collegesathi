<?php
namespace App\Http\Controllers\admin;

use CustomHelper;
use App\Http\Controllers\BaseController;
use Request, View;

/**
 * Ajaxdata Controller
 *
 * Add your methods in the class below
 *
 * These methods are used in ajax call
 */

class AjaxdataController extends BaseController {

	/**
	 * Function for get list of states
	 *
	 * @param null
	 *
	 * @return list of states(select box).
	 */
	public function getStates(Request $request){

		if(Request::ajax() && Request::Input()){
			$countryId	=	Request::get('country_id');
			$stateList	=	CustomHelper::getStateList($countryId);
			$cityList	=	array();
			return response()->json([
				'html' 		=> View::make("admin.elements.get_state",compact('stateList'))->render(),
				'cityHtml'	=> View::make("admin.elements.get_city",compact('cityList'))->render()
			]);
		}
	}// end getStates()

 
	/**
	 * Function for get list of cities
	 *
	 * @param null
	 *
	 * @return list of cities(select box).
	 */
	public function getCities(Request $request){
		if(Request::ajax() && Request::Input()){
			$countryId	=	Request::get('country_id');
			$stateId	=	Request::get('state_id');
			$cityList	=	CustomHelper::getCityList($countryId,$stateId);

			return response()->json([
				'html'	=> View::make("admin.elements.get_city",compact('cityList'))->render()
			]);
		}
	}// end getCities()


	/**
	 * Function for get list of SubCategory
	 *
	 * @param null
	 *
	 * @return list of SubCategory(select box).
	 */
	public function getSubCategoryList(Request $request){
		if(Request::ajax() && Request::Input()){
			$categoryId				=	Request::get('category_id');
			$subcategoryConditions	=	array('is_active'=>(int)ACTIVE,'parent_id'=>$categoryId);
			$subcategoryList		=	CustomHelper::getCategoryList($subcategoryConditions);
			return response()->json([
				'html'	=> View::make("admin.elements.get_sub_category",compact('subcategoryList'))->render()
			]);
		}
	}// end getSubCategoryList()
 
}// end AjaxdataController class
