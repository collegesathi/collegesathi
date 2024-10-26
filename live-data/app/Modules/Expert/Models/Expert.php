<?php
namespace App\Modules\Expert\Models;
use Eloquent;

/**
 * Expert Model
*/
class Expert extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'experts';

/**
     * this function is used to get categoryDetails
     *
     * @param null
     */
	public function categoryDetails(){
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown','category_id')->where('status',ACTIVE);
    }//end


/**
     * this function is used to get categoryDetails
     *
     * @param null
     */
	public function expertEnquiry(){
        return $this->hasMany('App\Modules\Survey\Models\Survey','expert_id','id');
    }//end



} // end Expert class
