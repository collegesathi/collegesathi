<?php 
namespace App\Modules\Block\Models;
use Eloquent,Session;

/**
 * Block Model
 */
 
class Block extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'blocks';

	/**
	 * hasMany bind function for  BlockDescription model
	 *
	 * @param null
	 *
	 * @return query
	 */
	public function description() {
        return $this->hasMany('App\Modules\Block\Models\BlockDescription','parent_id');
    }// end description()

	/**
	* hasMany bind function for bind BlockDescription model according to language
	*
	* @param null
	*
	* @return query
	*/

	public function accordingLanguage() {
		$currentLanguageId	=	Session::get('currentLanguageId');

		return $this->hasMany('App\Modules\Block\Models\BlockDescription','parent_id')
					->select('description','parent_id')
					->where('language_id' , $currentLanguageId);
	} //end accordingLanguage()

	/**
	 * function for find result form database function
	 *
	 * @param $pageName as pageName
	 * @param $fields 	as fields which need to select
	 *
	 * @return array
	 */
	public static function getResult($pageName,$fields = array()){
		$currentLanguageId	=	Session::get('currentLanguageId');
		$blockResult		=	Block::with('accordingLanguage')->select($fields)->where('page', $pageName)->get()->toArray();
		$response	=	array();
		foreach($blockResult as $key => $result){
			$blockSlug	=	$result['block'];
			$response[$blockSlug]	=	$result;
			if (isset($result['according_language']) && (is_array($result))) {
				if(isset($result['according_language'][0]) && !empty($result['according_language'][0])){
					$currentLanguageData	=	$result['according_language'][0];
					$response[$blockSlug]['description']	=	$currentLanguageData['description'];
					unset($result['according_language']);
				}
			}
		}
		return $response;
	} //end getResult()


	/**
	 * hasMany bind function for  BlockDescription model 
	 *
	 * @param null
	 * 
	 * @return query
	 */	
	public function descriptiondata() {
        return $this->hasOne('App\Modules\Block\Models\BlockDescription','parent_id')->select('description','parent_id');
    }// end description()
    
}// end Block class
