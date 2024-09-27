<?php
namespace App\Http\Middleware;
use App\Modules\Permission\Models\Permission;
use App\Modules\AdminModules\Models\AdminModules;
use App\Modules\AccessRoles\Models\AccessRoles;
use App\Modules\User\Models\User;

use Closure;
Use Auth;
Use Redirect;
Use Route;
Use CustomHelper;
Use Config;
include app_path() . '/admin_routes.php';
class AuthAdmin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (Auth::guest()){
			return Redirect::route('login');
		}
		elseif(!in_array(Auth::user()->user_role_id, [SUPER_ADMIN_ROLE_ID,SUB_ADMIN_ROLE_ID])){
			return Redirect::route('login')->with('error', trans('messages.dashboard.you_are_not_authorized_to_access_this_location'));
		}
		else{

			$currentRoute = Route::currentRouteName();


			if(Auth::user()->user_role_id == SUB_ADMIN_ROLE_ID){
				
				$route 			= 	Route::current()->parameters();
				$parameters		=	'';
				if(!empty($route)){
					$routeValues	=	array_values($route);
					$parameters		.=	"/";
					$parameters		.=	implode("/",$routeValues);
				}

				$subAdminRoles	=	AccessRoles::pluck('id','id')->toArray();

				$skipURLArray = array('Admin.account','logout','Admin.account_update', 'AdminAjax.getStates', 'AdminAjax.getCities', 'AdminAjax.SubCategory', 'Country.getStatesList', 'Country.getMultipleCities', 'Country.getMulipleStatesList');


				if(isset(Auth::user()->user_role_id) && (Auth::user()->user_role_id==SUB_ADMIN_ROLE_ID) && $currentRoute != 'AdminDashBoard.index' && !in_array($currentRoute, $skipURLArray)){

					$userId 		= 	Auth::id();
					$userRoleId 	= 	Auth::user()->user_role_id;
                    $permissionData = 	Permission::whereIn('role_id',$subAdminRoles)->where('user_id',$userId)->first();

					if(empty($permissionData)){
						return Redirect::route('AdminDashBoard.index')->with('error', trans('messages.dashboard.you_are_not_authorized_to_access_this_location'));
					}
					
					$jsonData	=	$permissionData->jsondata;
					$jsonData	=	json_decode($jsonData,true);
					 
					$allowedRoutes			=	[]; 
					$allAdminRoutesArray	=	[];
					$suffix					=	[];
					$required_params		=	[];
					
					if(count($jsonData)>0){
						foreach($jsonData as $k=>$data){
							
							$adminModules 				=	AdminModules::where('id',$k)->first();
							$adminModulesAllowedRoutes	=	isset($adminModules->allowed_routes) ? json_decode($adminModules->allowed_routes) : [];
							$allowedRoutes				=	array_merge($allowedRoutes, $adminModulesAllowedRoutes);
							
							$allAdminRoutesArray[$k]	=	isset($adminModules->allowed_routes) ? json_decode($adminModules->allowed_routes) : [];	
							
							if($adminModules->suffix){
								$suffix[$k]		=	$adminModules->suffix;
							}
							
							if($adminModules->required_params){
								$required_params[$k]	=	$adminModules->required_params;
							}
						}
					}
					
					
					/** IF CURRENT-ROUTE IS NOT AVAILABLE IN ALLOWED ROUTES THEN REDIRECT SUB-ADMIN TO DASHBOARD  */
					if(!in_array($currentRoute, $allowedRoutes)){
						return Redirect::route('AdminDashBoard.index')->with('error', trans('messages.dashboard.you_are_not_authorized_to_access_this_location'));
					}
					
					
					
					/** IF CURRENT-ROUTE IS AVAILABLE IN ALLOWED ROUTES BUT WE NEED REQUIRED PARAMETERS THEN  */
					 
					/* GET MODULE KEYS IN WHICH CURRENT ROUTE EXISTS */
					foreach($allAdminRoutesArray as $routeKey => $allAdminRoutes){
						if(in_array($currentRoute, $allAdminRoutes)){
							$moduleKeysArray[]	=	$routeKey;
						}
					}
					
					/*
					print_r($moduleKeysArray); 
					print_r($suffix); 
					exit; 
					*/
					
					/* GET ALL ALLOWED PARAMETERS IN CURRENT ROUTES */
					$allowedParamsInCurrentRoute = [];
					foreach($moduleKeysArray as $moduleId){
						if(isset($suffix[$moduleId])){
							$allowedParamsInCurrentRoute[] = $suffix[$moduleId];
						}
					}
					  
					/* GET CURRENT REQUIRED VALUE FROM url */
					$requiredParamsValue	=	NULL;
					$requiredParamsName		=	isset($required_params[$moduleKeysArray[0]]) ? $required_params[$moduleKeysArray[0]] : '';
					
					if($requiredParamsName){
						$requiredParamsValue	=	$request->{$requiredParamsName};
					}
				
					/* CHECK THIS REQUIRED PARAM VALUE IS AVAILABLE IN ALLOWED PARAMS VALUES */
					if($requiredParamsValue != NULL){
						if(!in_array($requiredParamsValue,  $allowedParamsInCurrentRoute)){
							return Redirect::route('AdminDashBoard.index')->with('error', trans('messages.dashboard.you_are_not_authorized_to_access_this_location'));
						}
					}
				}
			}
		}
		
        return $next($request);
    }
}
