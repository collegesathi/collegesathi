<?php
namespace App\Modules\Video\Models;
use Eloquent;

/**
 * Video Model
*/
class Video extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'videos';

/**
     * this function is used to get categoryDetails
     *
     * @param null
     */
	public function categoryDetails(){
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown','category_id')->where('status',ACTIVE);
    }//end


} // end Video class
