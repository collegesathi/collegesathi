<?php
namespace App\Modules\Permission\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\Permission\Models\Permission;
use App\Modules\AccessRoles\Models\AccessRoles;
use App\Modules\User\Models\User;
use App\Modules\AdminModules\Models\AdminModules;
use App\Services\SendMailService;
use CustomHelper;
use Config,Input,Hash,Redirect,Request,Session,View,Validator;

/**
 * PermissionController Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Permission
 */

class PermissionController extends BaseController {
public $model	=	'Permission';
	public function __construct() {
		parent::__construct();

		View::share('modelName',$this->model);
	}

	/**
	* Function for display list of Permissions
	*
	* @param null
	*
	* @return view page
	*/
	public function listPermission(){
		$DB					=	Permission::query();
		$searchVariable		=	array();
		$inputGet       	=   Request::all();


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

            foreach($searchData as $fieldName => $fieldValue){
				$fieldValue =   trim($fieldValue);
				if(!empty($fieldValue)){
					if(($fieldName == 'full_name') || ($fieldName == 'email')){
						$userIds = User::where($fieldName,'like','%'.$fieldValue.'%')->pluck('id')->toArray();

						$DB->whereIn('user_id',$userIds);
					}elseif($fieldName == 'role'){

						$DB->where('role_id',$fieldValue);
					}else{
						$DB->where($fieldName,'like','%'.$fieldValue.'%');

					}
				}
				$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
			}
        }




		$sortBy 		= 	(Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
	    $order  		= 	(Request::get('order')) ? Request::get('order')   : 'DESC';
	    $recordPerPage	=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):CustomHelper::getConfigValue("Reading.records_per_page");
		$model 			= 	$DB->with('user','role')->where('role_id','!=',SUPER_ADMIN_ROLE_ID)->orderBy($sortBy, $order)->paginate((int)$recordPerPage);
		$role 			= 	AccessRoles::where('id','!=',SUPER_ADMIN_ROLE_ID)->pluck('role','id')->all();

		return  View::make("Permission::index",compact('recordPerPage', 'model','searchVariable','sortBy','order','role','recordPerPage'));
	}// End listPermission()

	/**
	* Function for display page for addPermission
	*
	* @param null
	*
	* @return view page
	*/
	public function addPermission(){
		 
		$role 	= AccessRoles::pluck('role','id')->all();

		return  View::make("Permission::add",compact('role'));
	} // End addPermission()

	/**
	* Function for save permission
	*
	* @param null
	*
	* @return redirect page
	*/
	public function storePermission(){

		$messages	= array(
			'role_id.required' 	=> trans("messages.$this->model.role_required"),
			'password.regex'  	=> trans('messages.' . $this->model . '.password_help_message'),
		);
		$validator 	= Validator::make(Request::all(),
			array(
				'role_id'				=> 'required',
				'first_name' 			=> 'required',
				'last_name' 			=> 'required',
				'email' 				=> 'required|email|unique:users,email',
				'password'				=> 'required|regex:'.PASSWORD_REGX,
				'confirm_password'  	=> 'required|same:password',
				'module'				=> 'required',
			),$messages
		);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}
		
		$obj 						=  new User;
		$obj->is_mobile_verified	=  IS_VERIFIED;
		$obj->user_role_id			=  SUB_ADMIN_ROLE_ID;
		$obj->user_role_slug		=  SUB_ADMIN_ROLE_SLUG;
		$obj->email 				=  Request::get('email');
		$obj->first_name 			=  ucwords(Request::get('first_name'));
		$obj->last_name 			=  ucwords(Request::get('last_name'));
		$obj->full_name 			=  CustomHelper::getFullName(Request::get('first_name'), Request::get('last_name'));
		$obj->slug	 				=  CustomHelper::getSlug($obj->full_name,'slug','User','User');
		$obj->password	 			=  Hash::make(Request::get('password'));
		$obj->is_verified			=  IS_VERIFIED;
		$obj->active				=  ACTIVE;
		$obj->is_approved			=  ACTIVE;
		$obj->is_deleted			=  NOT_DELETED;
		$validateString				=  md5(time() . Request::get('email'));
		$obj->validate_string		=  $validateString;
		if($obj->save()){

			$permission = new Permission;
			$permission->role_id 	= Request::get('role_id');
			$permission->user_id 	= $obj->id;
			$permission->jsondata 	= json_encode(Request::get('module'));
			$permission->save();
		}

		Session::flash('success', trans("messages.$this->model.added_message"));
		return Redirect::route("$this->model.index");
	}// End storePermission()

	/**
	* Function for display page for edit Permission
	*
	* @param $id as id of Permission
	*
	* @return edit page
	*/
	public function editPermission($id=null){
		$model 		= Permission::findorFail($id);
		$role 		= AccessRoles::pluck('role','id')->all();

		return  View::make("Permission::edit",compact('role','model'));
	} // End editPermission()

	/**
	* Function for update Permission
	*
	* @param null
	*
	* @return redirect to listing page
	*/
	public function updatePermission(){

		$id 		= Request::get('id');

		$userId 	= Request::get('user_id');

		$messages	= array(
			'role_id.required' 	=> trans("messages.$this->model.role_required")
		);
		$validator 	= Validator::make(Request::all(),
			array(
				'id'					=> 'required',
				'user_id'				=> 'required',
				'role_id'				=> 'required',
				'first_name' 			=> 'required',
				'last_name' 			=> 'required',
				'module'				=> 'required',
			),$messages
		);
		if ($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$obj 					=  User::find($userId);
		$obj->first_name 		=  ucwords(Request::get('first_name'));
		$obj->last_name 		=  ucwords(Request::get('last_name'));
		$obj->full_name 		=  CustomHelper::getFullName(Request::get('first_name'), Request::get('last_name'));
		$obj->user_role_id		=  SUB_ADMIN_ROLE_ID;
		$obj->update();

		$permission 			= Permission::find($id);
		$permission->role_id  	= Request::get('role_id');
		$permission->user_id  	= Request::get('user_id');
		$permission->jsondata 	= json_encode(Request::get('module'));
		$permission->update();

		Session::flash('success', trans("messages.$this->model.updated_message"));
		return Redirect::route("$this->model.index");
	}// End updatePermission()

	/**
	* Function for delete Permission
	*
	* @param $id as id of Permission
	*
	* @return redirect listing page.
	*/
	public function deletePermission($id){

		$model 			= Permission::findorFail($id);
		$email   		= User::where('id','=',$model->user_id)->pluck('email')->first();
	    $updatedEmail 	= $model->user_id.'_deleted_'.$email;
	    $userModel  	= User::where('id',$model->user_id)->update(array('is_deleted'=>NOT_DELETED, 'email'=>$updatedEmail));

		$model->delete();
		Session::flash('success', trans("messages.$this->model.deleted_message"));
		return Redirect::route("$this->model.index");
	}// End deletePermission()

	/**
	* Function for send credential to admin user
	*
	* @param $id as id of admin user
	*
	* @return redirect page.
	*/
	public function sendCredential($id){
		$obj			= User::findorFail($id);
		$settingsEmail 	= Config::get('Site.email');
		$full_name		= $obj->full_name;
		$email			= $obj->email;
		$password		= CustomHelper::randomPassword(8);
		$obj->password	= Hash::make($password);
		$obj->save();


		$action 		= "send_login_credentials";
		$route_url      = route('login');
		$click_link   	= $route_url;
		$rep_Array 		= array($full_name,$email,$password,$click_link,$route_url);
		$to				= $email;
		$to_name		= $full_name;
		
		$sendMail	= 	new SendMailService;
		$sendMail->callSendMail($to,$to_name,$rep_Array,$action);

		Session::flash('success', trans("messages.$this->model.sent_login_credentials_success"));
		return Redirect::back();
	}//end sendCredential()

	/**
	* Function for getting module data
	*
	* @param $id as Admin module Id
	*
	* @return module data html
	*/
	public function getModuleData($id=NULL){
		if($id != SUPER_ADMIN_ROLE_ID){
			if(!empty($id) && $id != ''){
				$menus = AdminModules::where('parent_id', PARENT_ID)
						->where('is_active',ACTIVE)
						->orderBy('module_order', 'asc')
						->with('children')
						->get()
						->toArray();
				$roleData = AccessRoles::find($id);
				$module = json_decode($roleData->jsondata, true);
				return View::make("Permission::module_data",compact('menus','module'));
			}
		}
	}//End getModuleData()

	/**
	* Function for edit module data
	*
	* @param $id as Admin module Id
	*
	* @return module datat html
	*/
	public function editModuleData($id = NULL){
		if(!empty($id) && $id != ''){
			$menus = AdminModules::where('parent_id', PARENT_ID)
					->where('is_active',ACTIVE)
					->orderBy('module_order', 'asc')
					->with('children')
					->get()
					->toArray();
			$roleData = Permission::find($id);
			$module = json_decode($roleData->jsondata, true);
			return View::make("Permission::module_data",compact('menus','module'));
		}
	} // End editModuleData


	/**
     * Function for update Document status
     * @param $user as id
     * @param $status as status to be update
     * @return redirect page.
     */
	public function updateActiveStatus($userId=0, $status){

        User::where('id', '=', $userId)->update(array('active' => (int)$status));

        if($status == ACTIVE){
			$msg = trans("messages.$this->model.activate_msg");
		}else{
			$msg = trans("messages.$this->model.deactivate_msg");
		}

        Session::flash('success', $msg);
        return Redirect::route("$this->model.index");
    } // end updateStatus()



}// end PermissionController
