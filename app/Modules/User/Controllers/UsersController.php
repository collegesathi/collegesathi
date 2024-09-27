<?php
namespace App\Modules\User\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\User\Models\User;
use App\Modules\User\Services\UserService;
use App\Services\SendMailService;
use Auth, Config, CustomHelper, File, Hash, Input, Redirect, Request, Response, Session, URL, View;
use FieldsTypeCastingHelper;

/**
 * User Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/usermgmt
 */
class UsersController extends BaseController
{

    public $model = 'User';
    public $customerModel = 'User';

    public function __construct()
    {
        View::share('modelName', $this->model);
        View::share('customerModel', $this->customerModel);
    }


    /**
     * Function for display list of all Users
     *
     * @param null
     *
     * @return view page.
     */
    public function index()
    {
        $user_role_id = Auth::user()->user_role_id;
        $conditions = array();
        $heading = trans("messages.$this->customerModel.table_heading_index");
        $DB = User::query();
        $searchVariable = array();
        $inputGet = Request::Input();

        $date_range_picker = isset($inputGet['date_range_picker']) ? $inputGet['date_range_picker'] : '';
        $enableImportButtons = true;

        /*
         * seacrching on the basis of username and email
         * */
        $searchData = Request::Input();

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

            if (isset($searchData['download_csv'])) {
                unset($searchData['download_csv']);
            }

            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

			if (isset($searchData['date_range_picker'])) {
                unset($searchData['date_range_picker']);
            }


            if (isset($searchData['records_per_page'])) {
                $searchVariable = array_merge($searchVariable, array('records_per_page' => $searchData['records_per_page']));
                unset($searchData['records_per_page']);
            }

            $start_date = $end_date = '';

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'active') {
                        $DB->where('active', (int) $fieldValue);
                    } elseif ($fieldName == 'user_start_date') {
                        if (!empty(Request::get('user_start_date'))) {
                            $start_date = Request::get('user_start_date');
                        }
                    } elseif ($fieldName == 'user_end_date') {
                        if (!empty(Request::get('user_end_date'))) {
                            $end_date = Request::get('user_end_date');
                        }
                    } elseif ($fieldName == 'last_day') {
                        if (!empty($fieldValue)) {
                            $DB->where('created_at', '>', $fieldValue);
                        }
                    } elseif ($fieldName == 'current_day') {
                        if (!empty($fieldValue)) {
                            $DB->where('created_at', '<', $fieldValue);
                        }
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }

                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }

            if (!empty($start_date)) {
                $DB->whereDate('created_at', '>=', $start_date);
            }

            if (!empty($end_date)) {
				$DB->whereDate('created_at', '<=', $end_date);
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $recordPerPage = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $conditions[] = array('user_role_id', CUSTOMER_ROLE_ID);
        $conditions[] = array('is_deleted', NOT_DELETED);

        $DB->where($conditions)->orderBy($sortBy, $order);

        if (Request::get('download_csv') != '') {
            $result 		= $DB->get();
			$responseData 	= $this->downloadCSV($result);
            return Response::download($responseData['fileName'], $responseData['fileSuffix'], $responseData['headers']);

        } else {
            $result = $DB->paginate((int) $recordPerPage);

			return View::make("User::$this->customerModel.index", compact('recordPerPage',  'result', 'searchVariable', 'sortBy', 'order', 'heading', 'user_role_id', 'enableImportButtons', 'date_range_picker'));
        }
    } // end index()


    /**
     * Function for add User
     * @param null
     * @return view page.
     */
    public function addUser($organisation_id = 0)
    {
        $user_role_id = Auth::user()->user_role_id;

        $countryList = [];
        $stateList = [];
        $cityList = [];

		$dob 			= 	Request::old('dob');
        $old_country 	= 	Request::old('country');
        $old_state 		=	Request::old('state');

		if (empty($dob)) {
			$dob = CustomHelper::convert_timestamp_to_date_time(strtotime('-'.DATE_OF_BIRTH_MIN_AGE.' years'), DISPLAY_DATE_FORMAT_CALENDAR);
		}

        if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }
        if (!empty($old_country) && empty($old_state)) {
            $countryId = Request::old('country');
            $stateList = CustomHelper::getState($countryId);
        }
        $countryList = CustomHelper::getCountry();

        return View::make("User::$this->customerModel.add", compact('countryList', 'stateList', 'cityList', 'dob'));
    } //end addUser()


    /**
     * Function for save User
     * @param null
     * @return view page.
     */
    public function saveUser()
    {
        $formData = Request::all();
        $user_role_id = Auth::user()->user_role_id;
        if (!empty($formData)) {

			$form 		= 	ADMIN_ROLE_SLUG;
            $attribute 	= 	array("from" => $form, "model" => $this->model, "type" => "add");

			$user 		= 	new UserService;
            $res 		= 	$user->userValidateAndSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) { 

				if(isset($res['validator']) && !empty($res['validator'])){
				   $validator = $res['validator'];
				   return Redirect::back()->withErrors($validator)->withInput();
				}
				else if(isset($res['data']['message']) && !empty($res['data']['message'])){
				   Session::flash(ERROR, $res['data']['message']);
				   return Redirect::back()->withInput();
				}
                else {
					return Redirect::back()->withInput();
				}
            }
			else {
                Session::flash(SUCCESS, trans("messages.$this->customerModel.added_message"));
                return Redirect::route("$this->customerModel.index");
            }
        }
    } // end saveUser()


    /**
     * Function for display page for edit User
     * @param $userId as id of User
     * @return view page.
     */
    public function editUser($userId)
    {
        $heading = trans("messages.$this->customerModel.table_heading_edit");
        $user_role_id = Auth::user()->user_role_id;

        $countryList = [];
        $stateList = [];
        $cityList = [];

        $old_country = Request::old('country');
        $old_state = Request::old('state');

        if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }
        if (!empty($old_country) && empty($old_state)) {
            $countryId = Request::old('country');
            $stateList = CustomHelper::getState($countryId);
        }

        $countryList = CustomHelper::getCountry();
		  
        if ($userId) {

            $userDetails = User::find($userId);
            $country = isset($userDetails->country) ? $userDetails->country : '';
            $state = isset($userDetails->state) ? $userDetails->state : '';
            $city = isset($userDetails->city) ? $userDetails->city : '';
            $address_one = isset($userDetails->address_one) ? $userDetails->address_one : '';

			$dob	=	null;
			if(isset($userDetails->date_of_birth) && !empty($userDetails->date_of_birth)){
				$dob = CustomHelper::convert_timestamp_to_date_time($userDetails->date_of_birth, DISPLAY_DATE_FORMAT_CALENDAR);
			}

            if (!empty(Request::old() != null)) {
                $userDetails->phone = Request::Old('phone');
                $country = Request::old('country');
                $state = Request::old('state');
                $city = Request::old('city');
            }

            if (!empty($country)) {
                $stateList = CustomHelper::getState($country);
            }

            if (!empty($country) && !empty($state)) {
                list($stateList, $cityList) = CustomHelper::getStateCityList($country, $state);
            }

            return View::make("User::$this->customerModel.edit", compact('address_one', 'country', 'state', 'city', 'userDetails', 'heading', 'countryList', 'stateList', 'cityList', 'dob'));
        }
    } // end editUser()


    /**
     * Function for update User detail
     * @param $userId as id of User
     * @return redirect page.
     */
    public function updateUser($userId = 0, $organisation_id = 0)
    {
        $formData 		= 	Request::all();
        $user_role_id 	= 	Auth::user()->user_role_id;
        $form 			= 	ADMIN_ROLE_SLUG;

        if (!empty($formData)) {
            $form 		= 	ADMIN_ROLE_SLUG;
            $attribute 	= 	array("from" => $form, "model" => $this->model, "type" => "edit", "user_id" => $userId);

			$user 	= 	new UserService;
            $res 	= 	$user->userValidateAndSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) {
				if(isset($res['validator']) && !empty($res['validator'])){
				   $validator = $res['validator'];
				   return Redirect::back()->withErrors($validator)->withInput();
				}
				else if(isset($res['data']['message']) && !empty($res['data']['message'])){
				   Session::flash(ERROR, $res['data']['message']);
				   return Redirect::back()->withInput();
				}
                else {
					return Redirect::back()->withInput();
				}
            }
			else {
                Session::flash(SUCCESS, trans("messages.$this->customerModel.updated_message"));
                return Redirect::route("$this->customerModel.index");
            }
        }
    } // end updateUser()


    /**
     * Function for display User detail
     *
     * @param $userId     as id of User
     *
     * @return view page.
     */
    public function viewUser($userId = 0)
    {
        $conditions = array();
        $conditions[] = array('id', $userId);

        if ($userId) {
            $userDetails = User::where($conditions)->first();
            return View::make("User::$this->customerModel.view", compact('userDetails'));
        }
    } // end viewUser()


    /**
     * Function for update User status
     *
     * @param $userId as id of User
     * @param $userStatus as status of User
     *
     * @return redirect page.
     */
    public function updateUserStatus($userId = 0, $userStatus = 0)
    {
        $conditions = array();
        if (!empty($userId)) {
            /* organisation user */
            $conditions[] = array('id', $userId);

            $userInfo = User::where($conditions)->firstOrFail();
            $userInfo->active = (int) $userStatus;
            $userInfo->save();

            if ($userStatus == ACTIVE) {
                $message = trans('messages.admin.system.login_activated_successfully');
            } else {
                $message = trans('messages.admin.system.login_deactivated_successfully');
            }
            Session::flash(SUCCESS, $message);

        } else {
            Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));

        }
        return Redirect::route("$this->customerModel.index");
    } // end updateUserStatus()


    /**
     * Function for remove profile image
     *
     * @param $userId as id of organisation
     *
     * @return redirect page.
     **/
    public function removeImage($userId = 0)
    {
        $userService = new UserService;
        $res = $userService->removeProfileImage($userId);

        if ($res['data']['status'] == ERROR) {
            Session::flash(ERROR, $res['data']['message']);
        } else {
            Session::flash(SUCCESS, $res['data']['message']);
        }

        return Redirect::route("$this->customerModel.edit", [$userId]);

    } // end removeImage()


    /**
     * Function for mark a User as deleted
     * @param $userId as id of User
     * @return redirect page.
     */
    public function deleteUser($userId = 0)
    {
        $conditions = array();
        $logginUserId = Auth::user()->id;
        $logginUserRoleId = Auth::user()->user_role_id;

        $obj = User::where($conditions)->findOrFail($userId);
        $obj->email = DELETE_PREFIX . $obj->email;
        $obj->phone = DELETE_PREFIX . $obj->phone;
        $obj->is_deleted = IS_DELETED;
        $obj->deleted_by = $logginUserId;
        $obj->save();

        //User::where('id',$userId)->delete();
        Session::flash(SUCCESS, trans("messages.$this->customerModel.deleted_message"));

        return Redirect::route("$this->customerModel.index");
    } // end deleteUser()


    /**
     * Function for send credential to User
     * @param $id as id of Users
     * @return redirect page.
     */
    public function sendCredential($id)
    {
        $password = CustomHelper::randomPassword(8); //genrate randome password
        //update password
        $obj = User::find($id);
        $obj->password = Hash::make($password);
        $obj->save();

        //send credentails mail
        $email = $obj->email;
        $full_name = $obj->full_name;
        $to_name = $full_name;
        $to = $email;
        $route_url = URL::to('login');
        $click_link = $route_url;
        $rep_Array = array($full_name, $email, $password, $click_link, $route_url);
        $action = "send_login_credentials";

        $sendMail = new SendMailService;
        $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

        Session::flash(SUCCESS, trans("messages.$this->model.sent_login_credentials_success"));
        return Redirect::route("$this->customerModel.index");
    } //end sendCredential()


	/**
     * Function for email Verify
     *
     * @param $userId as id of User
     * @param
     *
     * @return redirect page.
     */
    public function emailVerify($userId = 0)
    {
		$conditions = array();
		if (!empty($userId)) {
			$conditions = array('id' => $userId);
			$userInfo = User::where($conditions)->firstOrFail();

			if($userInfo){
				$userInfo->is_verified = ACTIVE;
				if($userInfo->save()){
					$message = trans('messages.admin.system.email_verified_successfully');
					Session::flash(SUCCESS, $message);
					return Redirect::route("$this->customerModel.index");
				}
			}
		} 
		else {
			Session::flash(ERROR, trans("messages.global.something_went_wrong_msg"));
		}
		
		return Redirect::route("$this->customerModel.index");
    } // end updateUserStatus()

	
	/**
     * Function for download csv
     *
     * @param null
     *
     * @return dowmload csv.
     */
    public function downloadCSV($UserData = array()){
        $getNewUserData = array();
        if (isset($UserData) && !empty($UserData)) {
            $getNewUserData = $UserData->toArray();
        }

        /**This code are used for export the csv **/
        $filename = CSV_EXPORT_ROOT_PATH."user_list.csv";
        $handle = fopen($filename, 'w+');

        $fieldArray = array('First Name', 'Last Name', 'Full Name', 'Email', 'Phone Number');

        fputcsv($handle, $fieldArray);
        if (isset($getNewUserData) && !empty($getNewUserData)) {
            foreach ($getNewUserData as $row) {

                $valueArray = array($row['first_name'], $row['last_name'], $row['full_name'], $row['email'], $row['phone']);

                fputcsv($handle, $valueArray);
            }
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $responseArray['fileName'] = $filename;
        $responseArray['headers'] = $headers;
        $responseArray['fileSuffix'] = "user_list.csv";
        return $responseArray;

    } // End downloadCSV()


    /**
     * Function for delete,active,deactive User
     *
     * @param $userId as id of Users
     *
     * @return redirect page.
     */
    public function performMultipleAction($userId = 0){
        $conditions = array();
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            $action_log_type = '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {

                if ($actionType == 'active') {
                    $action_log_type = ACTIVE_ACTION;
                    User::whereIn('id', Request::get('ids'))->where($conditions)->update(array('active' => (int) ACTIVE));
                } elseif ($actionType == 'inactive') {
                    $action_log_type = DEACTIVE_ACTION;
                    User::whereIn('id', Request::get('ids'))->where($conditions)->update(array('active' => (int) INACTIVE));
                } elseif ($actionType == 'verified') {
                    $action_log_type = VERIFY_ACTION;
                    User::whereIn('id', Request::get('ids'))->where($conditions)->update(
                        array(
                            "is_verified" => FieldsTypeCastingHelper::typeCastVerifiedField(IS_VERIFIED),
                            "is_mobile_verified" => FieldsTypeCastingHelper::typeCastVerifiedField(IS_VERIFIED),
                            "mobile_verification_code_time" => INACTIVE,
                            "mobile_verification_code" => '',
                        ));
                }

                $userIds = Request::get('ids');

                Session::flash(SUCCESS, trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()
 
} //end UsersController