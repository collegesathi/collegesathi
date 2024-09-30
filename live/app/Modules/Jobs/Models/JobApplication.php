<?php
namespace App\Modules\Jobs\Models;
use Eloquent;

/**
 * JobApplication Model
*/
class JobApplication extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'job_applications';



	/**
     * Function for bind Job
     *
     * @param null
     *
     * return query
     */
    public function job(){
        return $this->belongsTo('App\Modules\Jobs\Models\Job', 'job_id', 'id');
    } //end job()


    public function stateName(){
        return $this->belongsTo('App\Modules\Country\Models\State', 'state', 'id');
    } //end ststeName()


    public function cityName(){
        return $this->belongsTo('App\Modules\Country\Models\City', 'city', 'id');
    } //end cityName()




} // end JobApplication class
