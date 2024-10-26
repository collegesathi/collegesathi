<?php
namespace App\Modules\Faq\Controllers\Front;
use App\Modules\Faq\Models\Faq;
use App\Http\Controllers\BaseController;
use View;

/**
* faqController class
*
* Add your methods in the class below
*/
class FaqController extends BaseController {

	public $model	=	'Faq';

	public function __construct() {
		View::share('modelName',$this->model);
	}

	/**
	 * Function to display website faq page
	 *
	 * @param null
	 *
	 * @return view page
	 */
	public function index(){
		$faqData  		= 	Faq::whereNull('uni_id')->where('is_active',ACTIVE)->orderBy('faq_order','ASC')->get();

        $pageTitle = trans("front_messages.Faq.faqs");
        $metaTitle = trans("front_messages.Faq.friquently_asked_question");
        $meta_description = trans("front_messages.Faq.friquently_asked_question");
        $meta_keywords = trans("front_messages.Faq.friquently_asked_question");

		return  View::make("Faq::front.index", compact( 'faqData','pageTitle', 'metaTitle', 'meta_description', 'meta_keywords'));
	}//end index()
}
