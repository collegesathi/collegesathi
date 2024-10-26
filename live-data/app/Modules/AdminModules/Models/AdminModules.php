<?php
namespace App\Modules\AdminModules\Models;

use Eloquent;

/**
* AdminModules class
*/
class AdminModules extends Eloquent{
	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'admin_modules';


	/**
	* Method for finding parent of a module
	*
	* @param null
	*
	* @return parent
	*/
	public function parent()
	{
		return $this->belongsTo('App\Modules\AdminModules\Models\AdminModules', 'parent_id');
	}

	/**
	* Method for finding active children 
	*
	* @param null
	*
	* @return children
	*/	
	public function children()
	{
		return $this->hasMany('App\Modules\AdminModules\Models\AdminModules', 'parent_id')->where('is_active',ACTIVE);
	}

	/**
	* Method for finding children all children
	*
	* @param null
	*
	* @return children
	*/	
	public function child()
	{
		return $this->hasMany('App\Modules\AdminModules\Models\AdminModules', 'parent_id');
	}
	
}
// End AdminModules class
