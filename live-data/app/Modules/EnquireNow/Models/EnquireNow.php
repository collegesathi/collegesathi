<?php
namespace App\Modules\EnquireNow\Models;
use Eloquent,Session;

/**
 * EnquireNow Model
*/

class EnquireNow extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/

	protected $table = 'enquiries';

	

	/**
     * Function for  bind Country model
     *
     * @param null
     *
     * return query
     */
    public function countryName()
    {
        return $this->belongsTo('App\Modules\Country\Models\Country', 'country');
    }


    /**
     * Function for  bind state model
     *
     * @param null
     *
     * return query
     */
    public function stateName()
    {
        return $this->belongsTo('App\Modules\Country\Models\State', 'state');
    }
	

    /**
     * Function for  bind City model
     *
     * @param null
     *
     * return query
     */
    public function cityName()
    {
        return $this->belongsTo('App\Modules\Country\Models\City', 'city');
    }
	

}// end EnquireNow class
