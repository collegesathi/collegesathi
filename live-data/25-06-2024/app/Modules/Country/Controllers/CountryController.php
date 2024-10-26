<?php
namespace App\Modules\Country\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Country\Models\City;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Models\State;
use App\Modules\User\Models\User;

use Config;
use CustomHelper;
use File;
use Input;
use Redirect;
use Request;
use Response;
use Session;
use ValidationHelper;
use Validator;
use View;

/**
 * LocationController
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Location
 */

class CountryController extends BaseController
{
    /**
     * function for list all coutries
     *
     * @param  null
     *
     * @return view page
     */
    public function countryList()
    {
        $DB = Country::query();
        $searchVariable = array();
        $inputGet = Request::Input();

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

             
            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);

                if ($fieldValue != '') {
                    if ($fieldName == 'module') {
                        $DB->where("key_value", 'like', '%' . $fieldValue . '%');
                    } elseif ($fieldName == 'active') {
                        $DB->where('status', (int) $fieldValue);
                    } elseif ($fieldName == 'country_code') {
                        $DB->where('country_code', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'country_name';
        $order = (Request::get('order')) ? Request::get('order') : 'ASC';
        $result = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
		
		$yesNoList				=	Config::get("GLOBAL_YES_NO");
		
        return View::make('Country::index', compact('sortBy', 'order',  'result', 'searchVariable', 'recordPerPagePagination',  'yesNoList'));
    } // end countryList()


    /**
     * function for display add country
     *
     * @param  null
     *
     * @return view page
     */
    public function addCountry()
    {
        return View::make('Country::add_country');
    } // end addCountry()


    /**
     * function for save added country
     *
     * @param  null
     *
     * @return view page
     */
    public function saveCountry()
    {
        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getCountryValidation($thisData);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $obj                      = new Country;
            $obj->country_name        = ucfirst(Request::get('country_name'));
            $obj->slug                = CustomHelper::getSlug(Request::get('country_name'), 'slug', 'Country');
            $obj->country_iso_code    = strtoupper(Request::get('country_iso_code'));
            $obj->country_code        = Request::get('country_code');
            $obj->status              = (int) Request::get('country_status');

            if ($obj->save()) { 
                Session::flash('success', trans("messages.Country.added_message"));  
            }
			
			return Redirect::route("Country.index");
        }

    } //end saveCountry()


    /**
     * function for display edit text page
     *
     * @param  $modelId as country id
     *
     * @return view page
     */
    public function editCountry($modelId = 0)
    {
        $model = Country::find($modelId);
 
        if (Request::Old() != null) {
            $model->country_name = Request::Old('country_name');
            $model->country_iso_code = Request::Old('country_iso_code');
            $model->country_code = Request::Old('country_code');
            $model->post_codes = Request::Old('post_codes'); 
        }

        return View::make('Country::edit_country', compact( 'model'));
    } //end editCountry()


    /**
     * function for update country
     *
     * @param $modelId as country id
     *
     * @return view page
     */
    public function updateCountry($modelId = 0)
    {
        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getCountryValidation($thisData, $modelId);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
 
            $obj                    = Country::find($modelId);
            $oldImage               = $obj->flag_name;

            $newName                = !empty(Request::get('country_name')) ? Request::get('country_name') : "";
            $obj->country_name      = !empty(Request::get('country_name')) ? ucfirst(Request::get('country_name')) : "";
            $obj->country_iso_code  = !empty(Request::get('country_iso_code')) ? strtoupper(Request::get('country_iso_code')) : "";
            $obj->country_code      = !empty(Request::get('country_code')) ? Request::get('country_code') : "";
             
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-country-image.' . $extension;
                if (Request::file('image')->move(COUNTRY_FLAG_PATH, $fileName)) {
                    $obj->flag_name = $fileName;

                    if (file_exists(COUNTRY_FLAG_PATH . $oldImage)) {
                        @unlink(COUNTRY_FLAG_PATH . $oldImage);
                    }
                }
            }

            if($obj->save()){
				Session::flash('success', trans("messages.Country.updated_message"));
            }

            
            return Redirect::route('Country.index');
        }
    } //end updateCountry()


    /**
     * function for update country status
     *
     * @param $modelId as country id $modelStatus as model status
     *
     * @return view page
     */
    public function updateCountryStatus($modelId = 0, $modelStatus = 0)
    {

        if ($modelStatus == INACTIVE) {
            $userCountryCount = User::where('country', $modelId)->count();
            if ($userCountryCount == 0) {

                Country::where('id', '=', $modelId)->update(array(
                    'status' => (int) INACTIVE,
                ));

                State::where('country_id', $modelId)->update(array(
                    'status' => (int) $modelStatus,
                ));

                City::where('country_id', $modelId)->update(array(
                    'status' => (int) $modelStatus,
                ));

            } else {
                Session::flash('error', trans("messages.Country.not_updated"));
                return Redirect::route("Country.index");
            }
        } else {
            Country::where('id', '=', $modelId)->update(array(
                'status' => (int) $modelStatus,
            ));
        }
        Session::flash('success', trans("messages.Country.status_updated_message"));

        return Redirect::route("Country.index");
    } //end updateCountryStatus()


    /**
     * function for update default status of country
     *
     * @param $modelId as country id
     *
     * @return view page
     */
    public function markAsDefault($modelId = 0)
    {
        Country::query()->update(array(
            'is_default' => 0,
        ));
        $model = Country::find($modelId);
        $model->is_default = 1;
        $model->save();
        Session::flash('success', trans("messages.Country.status_updated_message"));
        return Redirect::route("Country.index");
    } //end markAsDefault()


    /**
     * Function for delete, active and inactive multiple country
     *
     * @param null
     *
     * @return response.
     */
    public function performMultipleActionOnCountry()
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';

            if (!empty($actionType) && !empty(Request::get('ids'))) {

                if ($actionType == 'active') {
                    Country::whereIn('id', Request::get('ids'))->update(array(
                        'status' => ACTIVE,
                    ));

                    Session::flash('success', trans("messages.global.action_performed_message"));
                } elseif ($actionType == 'inactive') {

                    foreach (Request::get('ids') as $key => $val) {
                        $user_count = User::where('country', $val)->count();
                        if ($user_count == 0) {
                            $defaultStatus = Country::where('id', $val)->where('is_default', ACTIVE)->first();

                            if (empty($defaultStatus)) {
                                Country::where('id', '=', $val)->update(array(
                                    'status' => INACTIVE,
                                ));
                                State::where('country_id', $val)->update(array(
                                    'status' => INACTIVE,
                                ));
                                City::where('country_id', $val)->update(array(
                                    'status' => INACTIVE,
                                ));

                            }
                            Session::flash('success', trans("messages.global.action_performed_message"));
                        } else {
                            Session::flash('error', trans("messages.Country.not_updated"));
                        }
                    }
                } elseif ($actionType == 'delete') {
                    Country::whereIn('id', Request::get('ids'))->delete();
                    Session::flash('success', trans("messages.global.action_performed_message"));
                }
            }
        }
    } //end performMultipleActionOnCountry()



    /**
     * function for list all states
     *
     * @param  null
     *
     * @return view page
     */
    public function stateList($countryId)
    {
        $countryName = Country::where('id', $countryId)->first();
 
        $DB = State::with('countryName')->where('country_id', $countryId);

        $searchVariable = array();
        $inputGet = Request::Input();

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

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'module') {
                        $DB->where("key_value", 'like', '%' . $fieldValue . '%');
                    } else if ($fieldName == 'status') {
                        $DB->where('status', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $result = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);

        return View::make('Country::state_index', compact('sortBy', 'order',  'result', 'searchVariable', 'countryId', 'recordPerPagePagination', 'countryName'));
    } // end stateList()


    /**
     * function for display add state
     *
     * @param  $countryId as id of country id
     *
     * @return view page
     */
    public function addState($countryId)
    {
        $model = Country::find($countryId);
        $countryList = Country::pluck('country_name', 'id')->toArray();

        $countryName = Country::where('id', $countryId)->first(); 

        $newCountryId = $countryId;
        if (Request::Old()) {
            $newCountryId = Request::Old('country_name');
        }

        return View::make('Country::add_state', compact( 'countryId', 'countryList', 'newCountryId', 'model', 'countryName'));
    } // end addState()


    /**
     * function for save added country
     *
     * @param  null
     *
     * @return view page
     */
    public function saveState($countryId = 0)
    {

        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getStateValidation($thisData);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $countryData = Country::find($countryId);

            $obj = new State;
            $obj->country_id = $countryId;
            $obj->state_name = Request::get('state_name');
            $obj->state_code = Request::get('state_code');
            $obj->slug = CustomHelper::getSlug(Request::get('state_name'), 'slug', 'State', 'Country');
            $obj->status = (int) Request::get('state_status');
            if ($obj->save()) {
                Session::flash('success', trans("messages.State.added_message"));
                return Redirect::route("State.index", $countryId);
            }
        }
    } //end saveState()


    /**
     * function for display edit page of state
     *
     * @param  $countryId as country id
     * @param stateId as  id of state
     *
     * @return view page
     */
    public function editState($countryId = 0, $stateId = 0)
    {
        $model = State::where('id', $stateId)->with('countryName')->first();

        $countryList = Country::pluck('country_name', 'id')->toArray();

        $countryIdNew = '';

        if (Request::Old() != null) {

            $model->state_name = Request::Old('state_name');
            $model->state_code = Request::Old('state_code');

        } else {
            $countryIdNew = $countryId;

        }
		
		$countryName = Country::where('id', $countryId)->first(); 
		
        return View::make('Country::edit_state', compact(  'model', 'countryId', 'countryList', 'countryIdNew', 'countryName'));
    } //end editState()


    /**
     * function for update state
     *
     * @param $countryId as country id
     * @param $stateId as is of state
     *
     * @return view page
     */
    public function updateState($countryId = 0, $stateId = 0)
    {
        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getStateValidation($thisData, $stateId);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj = State::find($stateId);
            $newName = Request::get('state_name');
            $obj->state_name = Request::get('state_name');
            $obj->state_code = Request::get('state_code');
            $obj->save();
            $country = Country::find($countryId);

            Session::flash('success', trans("messages.State.updated_message"));
            return Redirect::route("State.index", $countryId);
        }
    } //end updateState()


    /**
     * function for update state status
     *
     * @param $stateId as state id $stateStatus as state status
     *
     * @return view page
     */
    public function updateStateStatus($stateId = 0, $stateStatus = 0)
    {

        if ($stateStatus == INACTIVE) {
            $userStateCount = User::where('state', $stateId)->count();
            if ($userStateCount == 0) {
                State::where('id', $stateId)->update(array(
                    'status' => (int) INACTIVE,
                ));

                City::where('state_id', $stateId)->update(array(
                    'status' => (int) $stateStatus,
                ));

                Session::flash('success', trans("messages.State.status_updated_message"));

            } else {
                Session::flash('error', trans("messages.State.not_updated"));
                return Redirect::back();
            }
        } else {
            State::where('id', '=', $stateId)->update(array(
                'status' => (int) ACTIVE,
            ));

            Session::flash('success', trans("messages.State.status_updated_message"));
        }

        return Redirect::back();
    } //end updateStateStatus()


    /**
     * function for delete state
     *
     * @param $stateId as id of state
     *
     * @return view page
     */

    public function deleteState($stateId = 0)
    {
        $userStateCount = User::where('region', $stateId)->count();

        if ($userStateCount <= 0) {
            $model = State::find($stateId);
            $userCityCount = User::where('city', $stateId)->count();
            City::where('state_id', $stateId)->delete();
            $model->delete();
            Session::flash('success', trans("messages.State.deleted_message"));
        } else {
            Session::flash('error', trans("messages.State.not_deleted"));
        }
        return Redirect::back();
    } //end deleteState()


    /**
     * Function for delete,active and inactive multiple states
     *
     * @param null
     *
     * @return response.
     */
    public function performMultipleActionOnState()
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'active') {
                    State::whereIn('id', Request::get('ids'))->update(array(
                        'status' => ACTIVE,
                    ));

                    Session::flash('success', trans("messages.global.action_performed_message"));
                } elseif ($actionType == 'inactive') {
                    foreach (Request::get('ids') as $key => $val) {

                        /* selected states assigned users*/
                        $user_count = User::where('state', $val)->count();

                        if ($user_count == 0) {
                            State::whereIn('id', Request::get('ids'))->update(array(
                                'status' => INACTIVE,
                            ));

                            $cityList = City::where('state_id', $val)->pluck('id');
                            foreach ($cityList as $cityKey => $cityVal) {
                                City::where('state_id', $val)->update(array(
                                    'status' => INACTIVE,
                                ));
                            }
                            Session::flash('success', trans("messages.global.action_performed_message"));
                        } else {
                            Session::flash('error', trans("messages.State.not_updated"));
                        }
                    }
                } elseif ($actionType == 'delete') {
                    foreach (Request::get('ids') as $key => $val) {
                        /* selected states assigned users*/
                        $user_count = User::where('state', $val)->count();
                        if ($user_count == 0) {

                            $cityDeactivateCount = 0;
                            $cityList = City::where('state_id', $val)->pluck('id');
                            $totalCityCount = count($cityList);
                            foreach ($cityList as $cityKey => $cityVal) {
                                City::where('id', $cityVal)->delete();
                                $cityDeactivateCount++;

                            }

                            if ($cityDeactivateCount == $totalCityCount) {
                                State::where('id', $val)->delete();
                            }
                            Session::flash('success', trans("messages.global.action_performed_message"));
                        } else {
                            Session::flash('error', trans("messages.State.not_deleted"));
                        }
                    }
                    Session::flash('success', trans("messages.global.action_performed_message"));
                }

            }
        }
    } //end performMultipleActionOnState()


    /**
     * function for list all cities
     *
     * @param  stateId as id of state
     *
     * @return view page
     */
    public function cityList($stateId)
    {
        //$data = State::with('countryName')->where('id', $stateId)->select('id', 'country_id', 'country_name')->first();
        $data = State::with('countryName')->where('id', $stateId)->first();
 
        $DB = City::with('countryName', 'stateName')->where('state_id', $stateId);
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
                if ($fieldValue != '') {
                    if ($fieldName == 'module') {
                        $DB->where("key_value", 'like', '%' . $fieldValue . '%');
                    } elseif ($fieldName == 'status') {
                        $DB->where('status', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                    $searchVariable = array_merge($searchVariable, array(
                        $fieldName => $fieldValue,
                    ));
                }
            }
        }

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $result = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        $countryId = $data->country_id;
        return View::make('Country::city_index', compact('sortBy', 'order',   'result', 'searchVariable', 'stateId', 'countryId', 'recordPerPagePagination', 'data'));
    } // end CityList()

    /**
     * function for display add state
     *
     * @param  $stateId as id of state
     *
     * @return view page
     */
    public function addCity($stateId)
    {
        $result = State::with('countryName')->where('id', $stateId)->first();

        $countryId = $result->country_id;
        $countryList = Country::pluck('country_name', 'id')->toArray();
        $stateListList = State::where('country_id', $countryId)->pluck('state_name', 'id')->toArray();

        if (!empty(Request::Old())) {
            $fieldStateId = Request::Old('state_id');
        } else {
            $fieldStateId = $stateId;
        }

        $newCountryId = $countryId;
        if (Request::Old()) {
            $newCountryId = Request::Old('country_name');
        }

        return View::make('Country::add_city', compact( 'stateId', 'countryList', 'countryId', 'stateListList', 'fieldStateId', 'newCountryId', 'result'));
    } // end addState()

    /**
     * function for save added city
     *
     * @param  null
     *
     * @return view page
     */
    public function saveCity($stateId)
    {

        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getCityValidation($thisData);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $result = State::with('countryName')->where('id', $stateId)->select('id', 'country_id', 'state_name')->first();

            $obj = new City;
            $obj->country_id = $result->country_id;
            $obj->state_id = $stateId;
            $obj->city_name = Request::get('city_name');
            $obj->slug = CustomHelper::getSlug(Request::get('city_name'), 'slug', 'City', 'Country');
            $obj->status = (int) Request::get('city_status');

            if ($obj->save()) {
                Session::flash('success', trans("messages.City.added_message"));
                return Redirect::route("City.index", $stateId);
            }
        }

    } //end saveCity()

    /**
     * function for display edit city page
     *
     * @param  $cityId as id of city
     * @param $stateId as id of state
     *
     * @return view page
     */

    public function editCity($stateId = 0, $cityId = 0)
    {
        $stateData = State::with('countryName')->where('id', $stateId)->first();
		
		$model = City::with('countryName', 'stateName')->where('id', $cityId)->first();
        $countryId = $model->country_id;
        $countryList = Country::pluck('country_name', 'id')->toArray();
        $stateListList = State::where('country_id', $countryId)->pluck('state_name', 'id')->toArray();

         
        if (Request::Old() != null) {
            $model->city_name = Request::Old('city_name');
            $fieldStateId = Request::Old('state_id');
        } else {
            $fieldStateId = $stateId;
        }

        if (Request::Old() != null) {
            $countryIdNew = Request::Old('country_id');
        } else {
            $countryIdNew = $countryId;
        }

        return View::make('Country::edit_city', compact(  'model', 'cityId', 'countryId', 'countryList', 'stateId', 'fieldStateId', 'stateListList', 'countryIdNew', 'stateData'));
    } //end editCity()

    /**
     * function for update city
     *
     * @param $stateId as state id
     * @param $cityId as city id
     *
     * @return view page
     */
    public function updateCity($stateId = 0, $cityId = 0)
    {
        $thisData = Request::all();

        list($errMessage, $validate) = ValidationHelper::getCityValidation($thisData, $cityId);
        $validator = Validator::make($thisData, $validate, $errMessage);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj = City::find($cityId);

            $obj->city_name = Request::get('city_name');

            $obj->save();

            Session::flash('success', trans("messages.City.updated_message"));
            return Redirect::route('City.index', $stateId);
        }
    } //end updateCity()

    /**
     * function for update city status
     *
     * @param $cityId as id of city
     * @param $cityStatus as status of city
     *
     * @return view page
     */
    public function updateCityStatus($cityId = 0, $cityStatus = 0)
    {

        if ($cityStatus == INACTIVE) {
            $userCityCount = User::where('city', $cityId)->count();
            if ($userCityCount <= 0) {
                City::where('id', '=', $cityId)->update(array(
                    'status' => (int) INACTIVE,
                ));

                Session::flash('success', trans("messages.City.status_updated_message"));
            } else {
                Session::flash('error', trans("messages.City.not_updated"));
            }
        } else {

            City::where('id', '=', $cityId)->update(array(
                'status' => (int) ACTIVE,
            ));

            Session::flash('success', trans("messages.City.status_updated_message"));
        }

        return Redirect::back();
    } //end updateCityStatus()

    /**
     * function for delete city
     *
     * @param $cityId as city id
     *
     * @return view page
     */
    public function deleteCity($cityId = 0)
    {
        $userCityCount = User::where('city', $cityId)->count();

        if ($userCityCount <= 0) {
            $model = City::find($cityId);
            $model->delete();
            Session::flash('flash_notice', trans("messages.City.deleted_message"));
        } else {
            Session::flash('error', trans("messages.City.not_deleted"));
        }
        return Redirect::back();

    } //end deleteCity()

    /**
     * Function for delete,active and inactive multiple cities
     *
     * @param null
     *
     * @return response.
     */
    public function performMultipleActionOnCity()
    {

        if (Request::ajax()) {

            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'active') {
                    City::whereIn('id', Request::get('ids'))->update(array(
                        'status' => ACTIVE,
                    ));

                } elseif ($actionType == 'inactive') {
                    foreach (Request::get('ids') as $key => $val) {
                        $user_count = User::where('city', $val)->count();
                        if ($user_count == 0) {
                            City::where('id', '=', $val)->update(array(
                                'status' => INACTIVE,
                            ));

                        }
                    }
                } elseif ($actionType == 'delete') {
                    foreach (Request::get('ids') as $key => $val) {
                        $user_count = User::where('city', $val)->count();
                        if ($user_count == 0) {
                            City::where('id', '=', $val)->delete();
                        }
                    }
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleActionOnCity()

     

     

     

} //end LocationController class
// managing Hub
