<?php
namespace App\Modules\AccessRoles\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\AccessRoles\Models\AccessRoles;
use App\Modules\AdminModules\Models\AdminModules;
use Auth,DB,Hash,Request,Mail,Redirect,Response,Session,URL,View,Config,Validator,File;

/**
* AccessRolesController class
*
* Add your methods in the class below
*
* This file will render views from views/admin/AccessRoles
*/
class AccessRolesController extends BaseController {

	public $model	= 'AccessRoles';

	public function __construct(){
		
		parent::__construct();
		View::share('modelName',$this->model);
	}

	/**
	* Function for Listing all Roles
	*
	* @param null
	*
	* @return View page
	*/
	public function listRoles(){

        $searchVariable = array();
        $inputGet       = Request::all();
		
        if(Request::get('records_per_page')!=''){
			$searchVariable	= array_merge($searchVariable,array('records_per_page' => Request::get('records_per_page')));
		}
		
		$recordPerPagePagination = (Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page");

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';
		$result = AccessRoles::where('id','!=',SUPER_ADMIN_ROLE_ID)->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        return  view("AccessRoles::index",compact('sortBy','order','result','searchVariable'));
		
	}//End listRoles



	/**
	* Function for Adding new roles
	*
	* @param null
	*
	* @return View page
	*/
	public function addRole(){
		$parentList 	= AdminModules::where('parent_id', PARENT_ID)->where('is_active',ACTIVE)
						->orderBy('module_order', 'asc')->with('children')->get()->toArray();
						
		return View::make("AccessRoles::add", compact('parentList'));
	}//End addRole()



	/**
	* Function for Saving Roles
	*
	* @param NULL
	*
	* @return Listing Page
	*/
	public function storeRole(){
		
		$validator = Validator::make(Request::all(), [
			'role' 		=> 'required|unique:admin_roles,role',
			'module' 	=> 'required'
		]);
		if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$roles 				= new AccessRoles;
		$roles->role 		= ucwords(Request::get('role'));
		$roles->jsondata  	= json_encode(Request::get('module'));
		$roles->save();
		Session::flash('success', trans("messages.$this->model.added_message"));
		return Redirect::route("$this->model.index");
	}//End storeRole()



	/**
	* Method for Edit Access Role
	*
	* @param $id as Role id
	*
	* @return View Page
	*/
	public function editRole($id){

		$parentList 	= AdminModules::where('parent_id', PARENT_ID)->where('is_active',ACTIVE)
						->orderBy('module_order', 'asc')->with('children')->get()->toArray();
		
						
		$roleData 		= AccessRoles::findOrfail($id)->toArray();
	
		return View::make("AccessRoles::edit", compact('parentList', 'roleData'));
	}//End editRole



	/**
	* Method for Update Roles
	*
	* @param $id as role id
	*
	* @return Listing Page
	*/
	public function updateRole(){
		
		$id = Request::get('id');
		$validator = Validator::make(Request::all(), [
			'id' 	=> 'required',
			'role' 	=> 'required|unique:admin_roles,role,'.$id.',id',
			'module'=> 'required'
		]);

		if($validator->fails()){
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$roles 				= AccessRoles::findOrfail($id);
		$roles->role 		= ucfirst(Request::get('role'));
		$roles->jsondata	= json_encode(Request::get('module'));
		$roles->update();
		Session::flash('success', trans("messages.$this->model.updated_message"));
		return Redirect::route("$this->model.index");
	}//End updateRole()
	
}//End AccessRolesController class
