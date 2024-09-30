<?php
namespace App\Modules\ReviewRating\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;


/**
 * ReviewRating Model
 */

class ReviewRating extends Eloquent   {

    use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'review_ratings';



	public function getUserDetails()
    {
        return $this->belongsTo('App\Modules\User\Models\User', 'user_id', 'id')->select('id','full_name','email');
    }


	public function getUniversityDetails()
    {
        return $this->belongsTo('App\Modules\University\Models\University', 'university_id', 'id')->select('id','title');
    }

} // end ReviewRating class
