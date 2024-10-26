<?php 
namespace App\Modules\DropDown\Models;
use Eloquent;

/**
 * DropDown Model
*/
 
class DropDownDescription extends Eloquent  {

	public $timestamps = false;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/
 
	protected $table = 'dropdown_manager_descriptions';
 
			
}// end DropDown class
