<?php 
namespace App\Modules\Cms\Models;
use Eloquent;
use CustomHelper;
/**
 * Cms Model
*/
class Cms extends Eloquent   {
	
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	 
	protected $table = 'cms_pages';
	
	
	
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
		
		return $this->hasOne('App\Modules\Cms\Models\CmsDescription','parent_id')->where('language_id' , $currentLanguageId)->select(['parent_id','title','description']);
    }// end description()
} // end Cms class
