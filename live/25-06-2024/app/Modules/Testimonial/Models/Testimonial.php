<?php 
namespace App\Modules\Testimonial\Models; 
use Eloquent,Session;
use CustomHelper;

/**
 * Testimonial Model
 */

class Testimonial extends Eloquent  {


/**
 * The database table used by the model.
 *
 * @var string
 */

protected $table = 'testimonials';



/**
 * hasMany bind function for  Tesimonial  Description model 
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
	
	return $this->hasOne('App\Modules\Testimonial\Models\TestimonialDescription','parent_id')->where('language_id' , $currentLanguageId);
}// end description()


	
}// end Testimonial class
