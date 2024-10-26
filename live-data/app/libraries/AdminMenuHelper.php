<?php
namespace App\libraries;
use App\Modules\AdminModules\Models\AdminModules;
use App\Modules\Permission\Models\Permission;
use Illuminate\Support\Facades\Request;
use Auth, Route;


/**
 * AdminMenu  Helper
 *
 * Add your methods in the class below
 */
class AdminMenuHelper {

	 /**
	 * getAdminSidebar Function for show admin sidebar menu
	 *
	 * @param null
	 *
	 * @return html of sidebar menu
	*/
	public static function getAdminSidebar(){
		$menu = self::buildTree();
		return self::getMenuHtml($menu);

	} // End getAdminSidebar()




	/**
	 * Method for getting module tree
	 *
	 * @param $parentId
	 *
	 * @return $branch
	 */
	public static function buildTree($parentId = 0) {
		$branch = array();
		$elements = array();
		// Get AdminModule Data
		$elements = AdminModules::where('parent_id',$parentId)->where('is_active',ACTIVE)->orderBy('module_order', 'ASC')->get();
		if(count($elements)>0){
			foreach ($elements as $element) {
				if ($element->parent_id == $parentId) {
					$children = self::buildTree($element->id);
					if ($children) {
						$element->children = $children;
					}
					$branch[] = $element;
				}
			}
		}
		return $branch;
	} // End buildTree

	/**
	 * Method for creating ul-li html of admin sidebar
	 *
	 * @param $menus
	 *
	 * @return $result
	 */
    public static function getMenuHtml($menus){
		$currentRoute 	= 	Route::currentRouteName();
        $user_role_id 	= 	Auth::user()->user_role_id;
		$user_id 	  	= 	Auth::id();
		$jsonArray		=	array();
		$jsonDecodeData	=	array();

		// Code for permissions
		$modulePermissionData  =  Permission::/*where('role_id',$user_role_id)->*/where('user_id',$user_id)->first();



		if(!empty($modulePermissionData)){
			$jsonArray			=	   json_decode($modulePermissionData->jsondata, true);
		}



		if(!empty($jsonArray)){
			foreach($jsonArray as $key => $data){
				foreach($menus as $menu){
					if($menu['id'] == $key){
						$jsonDecodeData[$key] = $menu['id'];
					}
					if(!empty($menu['children'])){
						foreach($menu['children'] as $k => $v){
							if($v['id'] == $key){
								$jsonDecodeData[$v['id']] = $v['id'];
							}
						}
					}
				}
			}
		}

		$result =   '<ul class="list">';
		foreach($menus as $menu){

			if(in_array($menu['id'],$jsonDecodeData) || ($user_role_id == SUPER_ADMIN_ROLE_ID)){
				$title 				= 	$menu->title;
				$path 				= 	$menu->path;
				$parameter 			= 	$menu->suffix;
				$pathController		= 	$menu->controller_name;


				if(($path == 'javascript::void();') || ($path == 'javascript:;') || ($path == 'javascript::void(0);')){
					$path = "";
				}

				$controllerAction = class_basename(Route::currentRouteAction());
				list($controller, $action) = explode('@', $controllerAction);


				$currentController = $controller;


				$active_class =  '';
				$icon_class   =  'material-icons ';
				if($pathController == $currentController){
					$active_class =  'active';
					$icon_class   =  'material-icons ';
				}

				if(!empty($menu->children)){

					$controllerArray = [];
					foreach($menu->children as $children){

						$controllerArray[] = $children->controller_name;
					}

					if(in_array($currentController,$controllerArray)){
						$active_class =  'active';
						$icon_class   =  'material-icons';
					}
				}

				if(!empty($menu->children) && count($menu->children) >0){
					$result .= '<li>';
				}else{
					$result .= '<li class="'.$active_class.'" >';
				}
				
				
				##########################
				$toggledClass = 'menu-toggle';
				if(count($menu->children) >0){
					$controllerArray = [];
					foreach($menu->children as $children){
						$controllerArray[] = $children->controller_name;
					}
					$toggledClass = (in_array($currentController,$controllerArray)) ? 'menu-toggle toggled': 'menu-toggle';
				}	
					
				##########################
				 

				if($path == ''){
					$result .= '<a href="javascript:;" class="'.$toggledClass.'"> <i class="'.$icon_class.'">'.$menu->icon.'</i>'.'  <span>'.$title.'</span></a>';
				}
				else{
					if(!empty($parameter)){
						$result .= '<li> <a href="'.route($path,$parameter).'"> <i class="'.$icon_class.'">'.$menu->icon.'</i>'.'  <span>'.$title.'</span></a>';
					}
					else{


						$result .= '<a href="'.route($path).'"  > <i class="'.$menu->icon.' '.$icon_class.'">'.$menu->icon.'</i>'.'  <span>'.$title.'</span></a>';

					}
				}

				if(count($menu->children) >0){
					$controllerArray = [];
					foreach($menu->children as $children){
						$controllerArray[] = $children->controller_name;
					}
					$class = (in_array($currentController,$controllerArray)) ? 'open':'closed';
					$style = (in_array($currentController,$controllerArray)) ? 'display:block;':'display:none;';

					$result .= "<ul class='ml-menu ".$class."' style='".$style."'>";


					foreach($menu->children as $children){
						if(in_array($children['id'],$jsonDecodeData) || ($user_role_id == SUPER_ADMIN_ROLE_ID)){


							$title 			= $children->title;
							$suffix 		= $children->suffix;
							$path 			= $children->path;
							$parameter 		= $children->suffix;
							$pathController	= $children->controller_name;

							if(($path == 'javascript::void();') || ($path == 'javascript:;') || ($path == 'javascript::void(0);')){
								$path = "";
							}

							$controllerAction 			= class_basename(Route::currentRouteAction());
							list($controller, $action) 	= explode('@', $controllerAction);
							$currentController 			= $controller;

							$li_class = '';
							if($pathController==$currentController){
								if(!empty($parameter)){
									if(Request::segment(3)==$parameter){
										$li_class = 'active';
									}
									if(Request::segment(4)==$parameter){
										$li_class = 'active';
									}
									if(Request::segment(5)==$parameter){
										$li_class = 'active';
									}
								}
								else{
									$li_class = 'active';
								}
							}

							if($path == ''){
								$result .= '<li class="'.$li_class.'"> <a href="javascript:;"> <span>'.$title.'</span></a>';
							}
							else{
								if(!empty($parameter)){
									$result .= '<li class="'.$li_class.'"> <a href="'.route($path,$parameter).'"> <span>'.$title.'</span></a>';
								}
								else{

									$result .= '<li class="'.$li_class.'"> <a id="'.$suffix.'" href="'.route($path).'"> <span>'.$title.'</span></a>';
								}
							}
							$result .= "</li>";
						}
					}
					$result .= "</ul>";
				}
				$result .= "</li>";
			}
		}
		$result .='</ul>';

		return $result;
    } // End getMenuHtml()
	
	
	
	
	
	/**
	* Function For Edit Admin Roles
	*
	* @param $menus as menu list
	*
	* @param $module as module
	*
	* @return $result
	*
	*/
	public static function EditTreeMenu($menus,$module) {
		$result = '<ul class="module_ul">';
		if(count($menus)>0){
			foreach($menus as $menu) {
				$title 	= $menu['title'];
				$path 	= $menu['path'];
				$id 	= $menu['id'];
				if(!empty($menu['children'])){
					$result .= '<div class="markhere">';
				}
				$result .= '<li  class="parent_li">';
				if(isset($module[$id]['allow']) && ($module[$id]['allow'] == PERMISSION_ALLOW)){
					if(!empty($menu['children'])){
						$result .= '<i class="fa fa-plus-circle plusbtn"></i><label class="parent_child_label" class="label label-danger" for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]" checked="checked">';
					}else{
						if($menu['path']!='AdminDashBoard.index'){
							$result .= '<label class="label dashboard"  for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]" checked="checked">';
						}else{
							$result .= '<label class="dashboard"  for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" class="parentCheckbox dashboard_class" disabled="disabled" checked="checked"><input type="hidden" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]">';
						}
					}
				}else{
					if(!empty($menu['children'])){
						$result .= '<i class="fa fa-plus-circle plusbtn"></i><label class="parent_child_label" for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]" >';
					}
					else{
						if($menu['path']!='AdminDashBoard.index'){
							$result .= '<label class="dashboard" for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]" >';
						}else{
							$result .= '<label class="dashboard" for="AdminRoleModuleId'.$id.'Allow"><input type="checkbox" value="1" class="parentCheckbox dashboard_class" disabled="disabled" checked="checked"> <input type="hidden" id="AdminRoleModuleId'.$id.'Allow" value="1" class="parentCheckbox" name="module['.$id.'][allow]" >';
						}
					}
				}

				$result .= '&nbsp;'.$title.'</label>';
				if(!empty($menu['children'])){
					$result .='<div class="childTree">';
					$result .='<ul class="children_ul">';
					foreach($menu['children'] as $child){
						$childId 	= $child['id'];
						$childTitle = $child['title'];
						$result .='<li>';
						$result .='<span class="label label-success">';
						if(isset($module[$childId]['allow']) && ($module[$childId]['allow'] == PERMISSION_ALLOW)){
							$result .='<label class="cursor_pointer" for="AdminRoleModuleId'.$childId.'Allow"><input type="checkbox" value="1" id="AdminRoleModuleId'.$childId.'Allow" class="childCheckbox" name="module['.$childId.'][allow]" checked="checked">';
						}else{
							$result .='<label class="cursor_pointer" for="AdminRoleModuleId'.$childId.'Allow"><input type="checkbox" value="1" id="AdminRoleModuleId'.$childId.'Allow" class="childCheckbox" name="module['.$childId.'][allow]">';
						}
						$result .= '&nbsp;'.$childTitle.'</label></span>';
						if(!empty($child['children'])){
							if(is_array($child['children'])){
								$result .= AdminMenuHelper::EditTreeMenu($child['children'],$module);
							}
						}
						$result .='</li>';
					}
					$result .= '</ul>

					</div>';
				}else{
					if($path != 'AdminDashBoard.index'){
						$childId	= $menu['id'];
						$childTitle	= $menu['title'];
						if(!empty($child['AdminRole']['children'])){
							if(is_array($child['AdminRole']['children'])){
								$result .= $this->PermissionTreeMenu($child['AdminRole']['children'],$module);
							}
						}
					}
				}
				$result .= '</li>';
				if(!empty($menu['children'])){
					$result .= '</div>';
				}
			}
		}else{
			$result .= trans("messages.global.no_record_found_message");
		}
		$result .='</ul>';
		return $result;
	} // End EditTreeMenu()
}
