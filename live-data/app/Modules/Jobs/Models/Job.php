<?php
namespace App\Modules\Jobs\Models;
use Eloquent;

/**
 * Job Model
*/
class Job extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'jobs';



	/**
     * Function for bind Job Type
     *
     * @param null
     *
     * return query
     */
    public function jobType(){
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown', 'job_type', 'id');
    } //end jobType()


/**
     * Function for bind Job Type
     *
     * @param null
     *
     * return query
     */
    public function experienceName(){
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown', 'experience', 'id');
    } //end experience()




	/**
     * Function for bind Job Type
     *
     * @param null
     *
     * return query
     */
    public function JobApplications(){
        return $this->hasMany('App\Modules\Jobs\Models\JobApplication', 'job_id', 'id');
    } //end JobApplications()



} // end Job class
