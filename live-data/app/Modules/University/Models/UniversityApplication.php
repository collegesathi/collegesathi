<?php
namespace App\Modules\University\Models;
use Eloquent;

/**
 * UniversityApplication Model
*/
class UniversityApplication extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'university_applications';



	/**
     * Function for bind UniversityApplication
     *
     * @param null
     *
     * return query
     */
    public function university(){
        return $this->belongsTo('App\Modules\University\Models\University', 'uni_id', 'id');
    } //end university()


    public function stateName(){
        return $this->belongsTo('App\Modules\Country\Models\State', 'state', 'id');
    } //end ststeName()


    public function cityName(){
        return $this->belongsTo('App\Modules\Country\Models\City', 'city', 'id');
    } //end cityName()




} // end UniversityApplication class
