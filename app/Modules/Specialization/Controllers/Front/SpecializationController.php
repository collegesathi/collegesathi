<?php
namespace App\Modules\Specialization\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Specialization\Models\Specialization;
use App\Modules\Specialization\Models\SpecializationDescription;
use App\Modules\Specialization\Models\SpecializationComment;
use App\Modules\Country\Models\Destination;
use App\Modules\Specialization\Services\SpecializationService;
use Auth;
use Config;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Route;
use Session;
use View;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\Specialization\Models\SpecializationViewLog;
/**
 * BlogController class
 *
 * Add your methods in the class below
 */

class SpecializationController extends BaseController{

    public $model = 'Specialization';
    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index() {
       
        $blogService                    = new SpecializationService;
        $attribute                      = array();
        $result                         = array();
        $searchVariable                 = array();
        $sort_by                        = array();
        $blogResult                      = array();
        $Specialization_posts                  = array();
        $featured_posts                   = array();
        
        
        $mobileTextClassEnquiry = 'mobile02';
        $stateList 		= 	[];
        $cityList 		= 	[];
        $old_country 	= 	Request::old('country');
        $old_state 		=	Request::old('state');
		if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId   = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }

        $formData                       = Request::all();
        $formData['from']               = 'front';
        $formData['records_per_page']   = FRONT_BLOG_PER_PAGE;
        $response                       = $blogService->getBlogDetail($formData, $attribute);
        if ($response['data']['status'] == SUCCESS) {
            //$searchVariable = $response['data']['searchVariable'];
            $sortBy                     = $response['data']['sort_by'];
            $order                      = $response['data']['order'];
            $blogResult              = $response['data']['blogs'];
            $last_page              = $response['data']['last_page'];
            $Specialization_posts              = $response['data']['Specialization_posts'];
            $featured_posts              = $response['data']['featured_posts'];
        }
        $keywordSearch             = isset($formData['keyword']) ?  $formData['keyword'] : '';

        $pageTitle = trans("front_messages.global.blogs");
        $metaTitle = trans("front_messages.global.blogs");
        $meta_description =trans("front_messages.global.blogs");
        $meta_keywords = trans("front_messages.global.blogs");

        $search_string      =   http_build_query(array('page' => 2));

        return View::make("Specialization::front.index", compact( 'result', 'searchVariable', 'sortBy', 'order', 'metaTitle', 'meta_description', 'meta_keywords',  'formData','last_page','blogResult','search_string','Specialization_posts','featured_posts','pageTitle','mobileTextClassEnquiry','stateList','cityList','old_state'));
    } //end index()


    /**
     * Function for  of all OurPartner
     *
     * @param null
     *
     * @return view page.
     **/
    public function blogLoadMore($page_no = 1) {

        $pageArr                        = Request::all();
        $formData                       = Request::all();
        $productTypes                   = isset($formData['product_type']) ? $formData['product_type'] : '' ;
        $keywordSearch                  = isset($formData['keyword']) ?  $formData['keyword'] : '';
        $blogService                    = new SpecializationService;
        $attribute                      = array();
        $result                         = array();
        $last_page                      = '';
        $page_no                        = !empty($pageArr['page']) ? $pageArr['page'] : '';
        $formData['from']               = 'front';
        $formData['records_per_page']   = FRONT_BLOG_PER_PAGE - FRONT_BLOG_LATEST_COUNT;
        unset($formData['page']);
        $response                       = $blogService->getBlogDetail($formData, $attribute);
        if ($response['data']['status'] == SUCCESS) {
           // $searchVariable = $response['data']['searchVariable'];
            $sortBy         = $response['data']['sort_by'];
            $order          = $response['data']['order'];
            $result              = $response['data']['blogs'];
            $last_page           = $response['data']['last_page'];
            $page_nos            = $page_no + 1;
            $search_string       = http_build_query(array('page' => $page_nos));
        }
        $html               =   view('Specialization::front.blog_load_more', compact('result'))->render();

        $res                =   array('status'=>"success",'html' => $html,'page' => $page_no,'last_page' => $last_page, 'search_string' => $search_string);
        return response()->json($res); die;

    } // end blogLoadMore()


    /**
     * Function for view Blog
     *
     * @param $slug as slug of Blog
     *
     * @return redirect page.
     */
    public function viewBlog($slug) {

        $record             = array();
        $recentblogs        = array();
        $blogService        = new SpecializationService;
        $formData           = array();
        $attribute          = array();
        $formData['slug']   = $slug;
        $response = $blogService->viewBlogData($formData, $attribute);
        if ($response['data']['status'] == SUCCESS) {
            $record = $response['data']['record'];
        }
        $current_route      = Route::current()->getName();
        $redirectUrl        = route($current_route, [$slug]);
        $pageHeadTitle      = trans("front_messages.global.detail_blogs_heading");
        $pageTitle          = (isset($record->meta_title) && !empty($record->meta_title)) ? $record->meta_title : $record->title;
        $meta_description   = $record->meta_description;
        $meta_keywords      = $record->meta_keyword;
        $ogImage            = '';
        if(!empty($record->image) && file_exists(TREND_IMAGE_ROOT_PATH.$record->image)) {
           $ogImage         = TREND_IMAGE_URL.$record->image;
        }
        $dashboardHeader = true;

        $countryId = COUNTRY;
        $stateId = 0;
        list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        $mobileTextClassEnquiry = 'mobile02';
        
        $userId  = 433;
        // if (Auth::user() && 1==2) {
        //     $userId = Auth::user()->id;
        //  }

        $browser_session_id = Session::getId();
        $blog_id = isset($record->id) ? $record->id : null;
        

        if ($blog_id) {
            $blogViewLog = SpecializationViewLog::where(function ($query) use ($browser_session_id, $userId) {
                $query->where('browser_session_id', '=', $browser_session_id)
                      ->orWhere('user_id', '=', $userId);  // Both conditions are logically grouped
            })->where('blog_id', $blog_id)->first();
        }
                       
        if(empty($blogViewLog))
        {
           $viewObj = new SpecializationViewLog();
           $viewObj->blog_id  = $blog_id;
           $viewObj->user_id  = $userId;
           $viewObj->browser_session_id  = $browser_session_id;
           $viewObj->blog_id  = $blog_id;
           $viewObj->save();
        }

        $blogViewCount =  SpecializationViewLog::where('blog_id',$blog_id)->count();
        Specialization::where('id',$blog_id)->update(['view_count'=>$blogViewCount]);

        return View::make('Specialization::front.view', compact('pageHeadTitle', 'record', 'slug',   'redirectUrl', 'pageTitle', 'meta_description', 'meta_keywords','ogImage','dashboardHeader','mobileTextClassEnquiry','stateList', 'cityList'));
    } //end viewBlog()
 



} // end HomeController class
