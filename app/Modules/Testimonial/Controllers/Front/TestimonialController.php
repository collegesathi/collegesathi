<?php
namespace App\Modules\Testimonial\Controllers\Front;
use App\Modules\Testimonial\Services\TestimonialService;
use App\Http\Controllers\BaseController;
use App\Modules\Testimonial\Models\Testimonial;
use App\Modules\DropDown\Models\DropDown;
use CustomHelper;
use View;

/**
 * NewsController class
 *
 * Add your methods in the class below
 */
class TestimonialController extends BaseController
{

    /**
     * Model name
     */
    public $model = 'Testimonial';

    /**
     * function for construct
     * @return layout
     */
    public function __construct()
    {
        View::share('modelName', $this->model);
    } // end __construct()

    /**
     * Function for News pages
     */
    public function frontindex()
    {
        $pageTitle = trans("messages.global.testimonial");
        $metaTitle = trans("messages.global.testimonial");
        $metaDescriptions = trans("messages.global.testimonial");
        $metaKeywords = trans("messages.global.testimonial");

        $testimonialService = new TestimonialService;
        $formData = array();
        $attribute = array();
        $testimonials = array();
        $searchVariable = array();
        $sort_by = array();
        $formData['from'] = 'front';

        $response = $testimonialService->list($formData, $attribute);

        if ($response['data']['status'] == SUCCESS) {
            $searchVariable = $response['data']['searchVariable'];
            $sortBy = $response['data']['sort_by'];
            $order = $response['data']['order'];
            $testimonials = $response['data']['result'];
        }

        return View::make("Testimonial::Front.testimonial", compact('pageTitle', 'metaTitle', 'metaDescriptions', 'metaKeywords', 'testimonials', 'searchVariable', 'sortBy', 'order'));
    } // end cmsPages()

   

} // end NewsController class
