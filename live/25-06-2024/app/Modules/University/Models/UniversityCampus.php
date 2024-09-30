<?php
namespace App\Modules\University\Models;
use Eloquent;


/**
 * University Model
 */

class UniversityCampus extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'university_campuses';



	public function universityName()
    {
        return $this->belongsTo('App\Modules\University\Models\University', 'university_id', 'id')->select('title','id');
    }


} // end University class
