<?php
namespace App\Modules\AdminModules\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\AdminModules\Models\AdminModules;
use Illuminate\Support\Facades\Route;
use CustomHelper;
use Auth,Blade,Config,DB,File,Redirect,Request,Response,Session,URL,View,Validator;

/**
* AdminModulesController class
*
* Add your methods in the class below
*
* This file will render views from views/admin/AdminModules
*/
class AdminModulesController extends BaseController {
	

	public $model	=	'AdminModules';
	public $moduleList;

	public function __construct(){
		
		parent::__construct();

		View::share('modelName',$this->model);

		/*==== For make tree ====*/
		$List = AdminModules::where('parent_id', PARENT_ID)->orderBy('module_order', 'asc')->with('child', 'parent')->get();
		foreach($List as $value){
			$this->moduleList[] = ['id'=>$value->id, 'parentid'=>$value->parent_id, 'title'=>$value->title, 'module_order'=>$value->module_order, 'status'=>$value->is_active, 'parent'=>isset($value->parent['title']) ? $value->parent['title'] : "" ];
			if(count($value->child))
			foreach($value->child as $child){
				$this->moduleList[] = ['id'=>$child->id, 'parentid'=>$child->parent_id, 'title'=>$child->title , 'module_order'=>$child->module_order, 'status'=>$child->is_active, 'parent'=>$child->parent->title ];
			}
		}
	}


	/**
	* Function for Listing all Modules
	*
	* @param null
	*
	* @return view page
	*/
	public function listModules(){
		$searchVariable	= array();
		$moduleList 	= $this->moduleList;
		return View::make("AdminModules::index", compact('moduleList', 'searchVariable'));
	}//End listModules()


	/**
	* Function for Adding new Module
	*
	* @param null
	*
	* @return view page
	*/
	public function addModule(){
		$parentList 	= $this->moduleList;

		$maxOrder   =	AdminModules::max('module_order');
		$maxOrder	=	$maxOrder + 1;	    

		return View::make("AdminModules::add", compact('parentList','maxOrder'));
	}//End addModule()


	/**
	* Function for Save module
	*
	* @param null
	*
	* @return View page
	*/
	public function storeModule(){
		//Custom Validation rule
		Validator::extend('not_contains', function(){
			if(Request::input('parent_id')!=PARENT_ID){
				$child = AdminModules::find(Request::input('parent_id'));
				foreach($child->children as $value){
					if(Request::input('module_order') == $value->module_order) {
						return false;
					}
				}
				return true;
			}else {
				$parentsorder = AdminModules::where('parent_id', PARENT_ID)->get();
				foreach($parentsorder as $value) {
					if(Request::input('module_order')==$value->module_order){
						return false;
					}
				}
				return true;
			}
		});

		//Custom validation message
		$messages = array(
			'not_contains'=>trans("messages.$this->model.module_order_unique"),
			'title.required'=>trans("messages.AdminModules.TITLE_REQUIRE_ERROR"),
			'path.required'=>trans("messages.AdminModules.PATH_REQUIRE_ERROR"),
			'path.regex'=>trans("messages.AdminModules.PATH_VALID_ERROR"),
		);
		$validator = Validator::make(Request::all(),
			array(
				'title'=>'required',
				'path'=> [
					'required',
					'regex:/^(?:[A-Za-z]+)\.(?:[a-z])|([a-z])\::([a-z]).+$/'
				],
				'module_order' => 'required|numeric|not_contains'
			), $messages
		);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$addModule 					= new AdminModules;
		$addModule->parent_id 		= !empty(Request::input('parent_id'))?Request::input('parent_id'):PARENT_ID;
		$addModule->title 			= Request::input('title');
		$addModule->path 			= Request::input('path');
		$addModule->icon 			= Request::input('icon');
		$addModule->module_order 	= Request::input('module_order');
		$addModule->suffix 			= Request::input('suffix');
		$addModule->attribute		= Request::input('parameter');

		$controllerName='';
		if((Request::input('path') != 'javascript::void();') && (Request::input('path') != 'javascript:;') && (Request::input('path') != 'javascript::void(0);')){
			list($cName) 	= explode('.',Request::input('path'));
			$controllerName = $cName.'Controller';
		}
		$addModule->controller_name 	= $controllerName;
		$addModule->is_active 			= ACTIVE;
		
		###########################################################
		$allRoutes 			= 	Route::getRoutes();
		$routePrefixString	=	Request::input('route_prefixes');
		$routePrefixArray	=	explode(",", $routePrefixString);
		
		if(is_array($routePrefixArray) && !empty($routePrefixArray)){
			$allowedRoutes	=	[];		
			foreach ($allRoutes as $value) {
				$routeName			=	$value->getName();
				$routeNameArray		=	explode(".", $routeName);
				$routeNamePrefix	=	isset($routeNameArray[0]) ? $routeNameArray[0] : NULL;
				
				if(in_array($routeNamePrefix, $routePrefixArray)){
					$allowedRoutes[]	=	$routeName;
				}
			}
		}
		$addModule->allowed_routes	=  json_encode($allowedRoutes);
		$addModule->route_prefixes	=  Request::input('route_prefixes');
		$addModule->required_params	=  Request::input('required_params');
		###########################################################
		
		
		if($addModule->save()){
			Session::flash('success', trans("messages.$this->model.added_message"));
			return Redirect::route("$this->model.index");
		}
	}//End storeModule()


	/**
	* Function for Edit Module
	*
	* @param $id as module id
	*
	* @return View page
	*/
	public function editModule($id){
		$moduleData 		= 	AdminModules::find($id);
		$parentList 		= 	$this->moduleList;

		return View::make("AdminModules::edit", compact('moduleData','parentList'));
	}//End editModule()


	/**
	* Function for Update module
	*
	* @param null
	*
	* @return listing page
	*/
	public function updateModule(){
		$id = Request::input('id');
		//Custom Validation rule
		Validator::extend('not_contains', function(){
			$uniqueOrder = AdminModules::find(Request::input('id'));
			if($uniqueOrder->module_order==Request::input('module_order')){
				return true;
			}else{
				if(Request::input('parent_id')!=PARENT_ID){
					$child = AdminModules::find(Request::input('parent_id'));
					foreach($child->children as $value){
						if(Request::input('module_order') == $value->module_order){
							return false;
						}
					}
					return true;
				}else{
					$parentsorder = AdminModules::where('parent_id', PARENT_ID)->get();
					foreach($parentsorder as $value){
						if(Request::input('module_order')==$value->module_order){
							return false;
						}
					}
					return true;
				}
			}
		});

		//Custom validation message
		$messages 	= array('not_contains'=>trans("messages.$this->model.module_order_unique"));
		$validator 	= Validator::make(Request::all(),
			array(
				'title'=>'required',
				'path'=> [
					'required',
					'regex:/^(?:[A-Za-z]+)\.(?:[a-z])|([a-z])\::([a-z]).+$/'
				],
				'module_order' => 'required|numeric|not_contains'
			), $messages
		);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$addModule					= AdminModules::find($id);
		$addModule->parent_id 		= !empty(Request::input('parent_id'))?Request::input('parent_id'):PARENT_ID;
		$addModule->title 			= Request::input('title');
		$addModule->path 			= Request::input('path');
		$addModule->icon 			= Request::input('icon');
		$addModule->module_order 	= Request::input('module_order');
		$addModule->suffix 			= Request::input('suffix');
		$addModule->attribute		= Request::input('parameter');

		$controllerName='';
		if((Request::input('path') != 'javascript::void();') && (Request::input('path') != 'javascript:;') && (Request::input('path') != 'javascript::void(0);')){
			list($cName) = explode('.',Request::input('path'));
			$controllerName = $cName.'Controller';
		}
		$addModule->controller_name = $controllerName;
		
		
		###########################################################
		$allRoutes 			= 	Route::getRoutes();
		$routePrefixString	=	Request::input('route_prefixes');
		$routePrefixArray	=	explode(",", $routePrefixString);
		
		if(is_array($routePrefixArray) && !empty($routePrefixArray)){
			$allowedRoutes	=	[];		
			foreach ($allRoutes as $value) {
				$routeName			=	$value->getName();
				$routeNameArray		=	explode(".", $routeName);
				$routeNamePrefix	=	isset($routeNameArray[0]) ? $routeNameArray[0] : NULL;
				
				if(in_array($routeNamePrefix, $routePrefixArray)){
					$allowedRoutes[]	=	$routeName;
				}
			}
		}
		$addModule->allowed_routes	=  json_encode($allowedRoutes);
		$addModule->route_prefixes	=  Request::input('route_prefixes');
		$addModule->required_params	=  Request::input('required_params');
		###########################################################
		
		 
		if($addModule->update()){
			Session::flash('success', trans("messages.$this->model.updated_message"));
			return Redirect::route("$this->model.index");
		}
	}//End updateModule()


	/**
	* Function for Deleting Module
	*
	* @param $id as Module Id
	*
	* @return listing page
	*/
	public function deleteModule($id){
		$deletePrivilage = AdminModules::find($id);

		if($deletePrivilage->parent_id != PARENT_ID){
			$deleteModule = AdminModules::destroy($id);
			Session::flash('success', trans("messages.$this->model.delete_message"));
			return Redirect::route("$this->model.index");
		}elseif(count($deletePrivilage->children) == PARENT_ID){
			$deleteModule = AdminModules::destroy($id);
			Session::flash('success', trans("messages.$this->model.delete_message"));
			return Redirect::route("$this->model.index");
		}else{
			Session::flash('error', trans("messages.$this->model.cannot_delete_message"));
			return Redirect::route("$this->model.index");
		}
	}//End deleteModule()


	/**
	* Function for changing the status eg.active/inactive
	*
	* @param $id as Module Id
	*
	* @return listing page
	*/
	public function statusModule($id){
		$data = AdminModules::find($id);
		if($data->is_active == ACTIVE){
			$data->is_active = INACTIVE;
		}else{
			$data->is_active = ACTIVE;
		}
		$data->update();

		Session::flash('success', trans("messages.$this->model.status_changed"));
		return Redirect::route("$this->model.index");
	}//End statusModule ()


	/**
	 * Function for update the order of the module
	 *
	 * @param null
	 *
	 * @return response array
	 */
	public function changeOrder(){
		$order_by			=	Request::input('order_by'); 
		$id					=	Request::input('current_id');
		$moduleOrder		=	AdminModules::find($id)->module_order;

		//Custom Validation rule
		Validator::extend('not_contains', function(){
			$parentid = AdminModules::find(Request::input('current_id'))->parent_id;
			if($parentid != PARENT_ID){
				$child = AdminModules::find($parentid);
				foreach($child->children as $value){
					if(Request::input('order_by') == $value->module_order ){
						return false;
					}
				}
				return true;
			}else{
				$parentsorder = AdminModules::where('parent_id', PARENT_ID)->get();
				foreach($parentsorder as $value){
					if(Request::input('order_by')==$value->module_order){
						return false;
					}
				}
				return true;
			}
		});
		
		//Custom validation message
		$messages 	= array('not_contains' => trans("messages.$this->model.module_order_unique_error"));
		$validator 	= Validator::make(Request::all(),
			array(
				'order_by' => 'required|not_contains'
			), $messages
		);		
		if($validator->fails()){
			return Response::json(['success' => false, 'message'=> $messages['not_contains']]);
		}else{
			AdminModules::where('id',$id)->update(['module_order' => $order_by]);
			return Response::json(['success' => true, 'order_by' => $order_by]);
		}	
	}//End changeOrder()

}//End AdminModulesController class
