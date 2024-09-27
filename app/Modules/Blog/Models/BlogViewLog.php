<?php
namespace App\Modules\Blog\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent,Session;
use CustomHelper;

/**
 * User BlogViewLog
 */

class BlogViewLog extends Eloquent  {


	//use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog_view_log';


    /**
	 * hasMany bind function for
	 *
	 * @param null
	 *
	 * @return query
	 */
	public function UserDetail() {

		return $this->belongsTo('App\Modules\User\Models\User','user_id','id')->select('full_name','user_role_id','id');
    }// end description()




}// end class
