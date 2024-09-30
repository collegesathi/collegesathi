<?php
namespace App\Modules\Scholarship\Models;
use Eloquent;


/**
 * ScholarshipRequest Model
 */

class ScholarshipRequest extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'scholarship_requests';



	public function getCityName()
    {
        return $this->belongsTo('App\Modules\Country\Models\City', 'city', 'id')->select('city_name','id');
    }

} // end ScholarshipRequest class
