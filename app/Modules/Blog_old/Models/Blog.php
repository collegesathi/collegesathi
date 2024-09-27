<?php
namespace App\Modules\Blog\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent,Session;
use CustomHelper;

/**
 * User Blog
 */

class Blog extends Eloquent  {


	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

 
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

		return $this->hasOne('App\Modules\Blog\Models\BlogDescription','parent_id')->where('language_id' , $currentLanguageId)->select(['parent_id','title','description']);
    }// end description()

     
}// end User class
