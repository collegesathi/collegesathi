<?php

namespace App\Modules\Cms\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Cms\Models\Cms;
use App\Modules\OurTeam\Models\OurTeam;
use CustomHelper;
use Redirect;
use Request;
use Session;
use View;

/**
 * CmsController class
 *
 * Add your methods in the class below
 */
class CmsController extends BaseController
{

    /**
     * Model name
     */
    public $model = 'Cms';

    /**
     * function for construct
     * @return layout
     */
    public function __construct()
    {
        View::share('modelName', $this->model);
    } // end __construct()

    /**
     * Function for cms pages
     */
    public function cmsPages($slug = '')
    {

        if ($slug != '') {
            $result = CustomHelper::getCmsPage($slug);

            $blockData = array();

            if ($slug == 'about-us') {
                $blockData = CustomHelper::getBlockdetail('banner');
            }
            if ($result) {
                $pageTitle = $result['name'];
                $metaTitle = $result['meta_title'];
                $meta_description = $result['meta_description'];
                $meta_keywords = $result['meta_keywords'];

                return View::make("Cms::Front.cms_pages", compact('result', 'pageTitle', 'metaTitle', 'meta_description', 'meta_keywords', 'slug','blockData'));
            } else {
                Session::flash('messagered', 'Invalid URL Access');
                return Redirect::route("home.index");
            }
        } else {
            return Redirect::route("home.index");
        }
    } // end cmsPages()



} // end CmsController class
