<?php
namespace App\Modules\Blog\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Blog\Models\Blog;
use App\Modules\Blog\Models\BlogDescription;
use App\Modules\Blog\Models\BlogComment;
use App\Modules\Country\Models\Destination;
use App\Modules\Blog\Services\BlogService;
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
use App\Modules\Blog\Models\BlogViewLog;
/**
 * BlogController class
 *
 * Add your methods in the class below
 */
class BlogController extends BaseController{

    public $model = 'Blog';
    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function index() {
       
        $blogService                    = new BlogService;
        $attribute                      = array();
        $result                         = array();
        $searchVariable                 = array();
        $sort_by                        = array();
        $blogResult                      = array();
        $trending_posts                  = array();
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
            $trending_posts              = $response['data']['trending_posts'];
            $featured_posts              = $response['data']['featured_posts'];
        }
        $keywordSearch             = isset($formData['keyword']) ?  $formData['keyword'] : '';

        $pageTitle = trans("front_messages.global.blogs");
        $metaTitle = trans("front_messages.global.blogs");
        $meta_description =trans("front_messages.global.blogs");
        $meta_keywords = trans("front_messages.global.blogs");

        $search_string      =   http_build_query(array('page' => 2));

        return View::make("Blog::front.index", compact( 'result', 'searchVariable', 'sortBy', 'order', 'metaTitle', 'meta_description', 'meta_keywords',  'formData','last_page','blogResult','search_string','trending_posts','featured_posts','pageTitle','mobileTextClassEnquiry','stateList','cityList','old_state'));
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
        $blogService                    = new BlogService;
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
        $html               =   view('Blog::front.blog_load_more', compact('result'))->render();

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
        $blogService        = new BlogService;
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
        if(!empty($record->image) && file_exists(BLOG_IMAGE_ROOT_PATH.$record->image)) {
           $ogImage         = BLOG_IMAGE_URL.$record->image;
        }
        $dashboardHeader = true;

        $countryId = COUNTRY;
        $stateId = 0;
        list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        $mobileTextClassEnquiry = 'mobile02';
        
        $userId  = null;
        if (Auth::user()) {
            $userId = Auth::user()->id;
         }

        $browser_session_id = Session::getId();
        $blog_id = isset($record->id) ? $record->id : null;


        $blogViewLog =  BlogViewLog::where(function ($query) use ($browser_session_id,$userId){
                        $query->where('browser_session_id', '=', $browser_session_id)
                            ->orWhere('user_id', '=', $userId);
                        })->where('blog_id',$blog_id)->first();


        if(empty($blogViewLog))
        {
           $viewObj = new BlogViewLog();
           $viewObj->blog_id  = $blog_id;
           $viewObj->user_id  = $userId;
           $viewObj->browser_session_id  = $browser_session_id;
           $viewObj->blog_id  = $blog_id;
           $viewObj->save();
        }

        $blogViewCount =  BlogViewLog::where('blog_id',$blog_id)->count();
        Blog::where('id',$blog_id)->update(['view_count'=>$blogViewCount]);

        return View::make('Blog::front.view', compact('pageHeadTitle', 'record', 'slug',   'redirectUrl', 'pageTitle', 'meta_description', 'meta_keywords','ogImage','dashboardHeader','mobileTextClassEnquiry','stateList', 'cityList'));
    } //end viewBlog()
 



} // end HomeController class
