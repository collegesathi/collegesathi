<?php 
namespace App\Modules\Permission\Models;
use Eloquent;

/**
 * Permission Model
 */
class Permission extends Eloquent{
	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'admin_permissions';			
	
	protected $dates = ['deleted_at'];
	
	/* Function for  bind AdminUser model   
	*
	* @param null 
	*
	* return query
	*/
	public function user(){
		return $this->belongsTo('App\Modules\User\Models\User','user_id');
	}

	/*
	* Defines the relationship with AccessRoles table
	*/
	public function role(){
		return $this->belongsTo('App\Modules\AccessRoles\Models\AccessRoles','role_id');
	}
	
}// end Permission class
