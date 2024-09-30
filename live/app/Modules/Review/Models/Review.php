<?php
namespace App\Modules\Review\Models;
use Eloquent;

/**
 * Review Model
*/
class Review extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'university_reviews';

	public function universityreview(){
        return $this->belongsTo('App\Modules\University\Models\University', 'uni_id', 'id');
    } //end university()

} // end Advertisement class
