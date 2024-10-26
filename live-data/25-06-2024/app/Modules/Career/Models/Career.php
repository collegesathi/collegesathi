<?php
namespace App\Modules\Career\Models;
use Eloquent;


/**
 * Career Model
 */

class Career extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'careers';



	public function getTotalApplications()
    {
        return $this->hasMany('App\Modules\Career\Models\ApplyJob', 'career_id','id');
    }

} // end Career class
