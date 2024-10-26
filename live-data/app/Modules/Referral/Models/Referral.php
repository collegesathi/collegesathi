<?php
namespace App\Modules\Referral\Models;
use Eloquent;


/**
 * Referral Model
 */

class Referral extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'referrals';


	public function getRefereeCityName()
    {
        return $this->belongsTo('App\Modules\Country\Models\City', 'referee_city', 'id')->select('city_name','id');
    }



	public function getReferenceCityName()
    {
        return $this->belongsTo('App\Modules\Country\Models\City', 'reference_city', 'id')->select('city_name','id');
    }

} // end Referral class
