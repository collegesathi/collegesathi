<?php
namespace App\Modules\Specialization\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent,Session;
use CustomHelper;

/**
 * User Blog
 */

class Specialization extends Eloquent  {


	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specialization';


	/**
	 * hasMany bind function for  Blog  Description model
	 *
	 * @param null
	 *
	 * @return query
	 */
	public function descriptionData() {

		$currentLanguageId	=	CustomHelper::getCurrentLanguage();
		if($currentLanguageId == ''){
			$currentLanguageId	=	'1';
		}

		return $this->hasOne('App\Modules\Specialization\Models\SpecializationDescription','parent_id')->where('language_id' , $currentLanguageId)->select(['parent_id','title','description']);
    }// end description()



/**
	 * hasMany bind function for  Blog  Description model
	 *
	 * @param null
	 *
	 * @return query
	 */
	public function addedByUser() {

		return $this->belongsTo('App\Modules\User\Models\User','added_by','id')->select('full_name','user_role_id','id');
    }// end description()




}// end User class
