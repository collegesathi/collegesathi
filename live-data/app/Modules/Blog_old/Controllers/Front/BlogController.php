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
        $formData                       = Request::all();
        $formData['from']               = 'front';
        $formData['records_per_page']   = FRONT_BLOG_PER_PAGE;
        $response                       = $blogService->getBlogDetail($formData, $attribute);
        if ($response['data']['status'] == SUCCESS) {
            //$searchVariable = $response['data']['searchVariable'];
            $sortBy                     = $response['data']['sort_by'];
            $order                      = $response['data']['order'];
            $uaeBlogResult              = $response['data']['uae_blog'];
            $travelBlogResult           = $response['data']['travel_blog'];
            $comboBlogResult            = $response['data']['combo_blog'];
            $uae_last_page              = $response['data']['uae_last_page'];
            $travel_last_page           = $response['data']['travel_last_page'];
            $combo_last_page            = $response['data']['combo_last_page'];
        }
        $keywordSearch             = isset($formData['keyword']) ?  $formData['keyword'] : ''; 
        $uae_search_string         = http_build_query(array('page' => 2,'keyword' => $keywordSearch,'product_type'=>UAE_TOURIST_VISA_ID));
        $travel_search_string      = http_build_query(array('page' => 2,'keyword' => $keywordSearch,'product_type'=>TRAVEL_INSURANCE_ID));
        $combo_search_string       = http_build_query(array('page' => 2,'keyword' => $keywordSearch,'product_type'=>COMBO_ID));
        $pageHeadTitle             = 'Blogs';
        $metaDescriptions          = 'Blogs';
        $metaKeywords              = 'Blogs';
        $metaTitle                 = 'Blogs';
        $productTypes 	           = DropDown::where('dropdown_type','product_type')->where('status',ACTIVE)->get();
        return View::make("Blog::front.index", compact('pageHeadTitle', 'result', 'searchVariable', 'sortBy', 'order', 'metaTitle', 'metaDescriptions', 'metaKeywords',  'formData','uae_search_string','travel_search_string','combo_search_string','productTypes','uae_last_page','travel_last_page','combo_last_page','uaeBlogResult','travelBlogResult','comboBlogResult'));
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
            if(isset($formData['product_type']) && $formData['product_type'] == UAE_TOURIST_VISA_ID){
                $result              = $response['data']['uae_blog'];
                $last_page           = $response['data']['uae_last_page'];
                $page_nos            = $page_no + 1;
                $search_string       = http_build_query(array('page' => $page_nos,'keyword' => $keywordSearch,'product_type'=>UAE_TOURIST_VISA_ID));
            }elseif(isset($formData['product_type']) && $formData['product_type'] == TRAVEL_INSURANCE_ID){
                $result              = $response['data']['travel_blog'];
                $last_page           = $response['data']['travel_last_page'];
                $page_nos            = $page_no + 1;
                $search_string       = http_build_query(array('page' => $page_nos,'keyword' => $keywordSearch,'product_type'=>TRAVEL_INSURANCE_ID));
            }elseif(isset($formData['product_type']) && $formData['product_type'] == COMBO_ID){
                $result              = $response['data']['combo_blog'];
                $last_page           = $response['data']['combo_last_page'];
                $page_nos            = $page_no + 1;
                $search_string       = http_build_query(array('page' => $page_nos,'keyword' => $keywordSearch,'product_type'=>COMBO_ID));
            }
        }
        $html               =   view('Blog::front.blog_load_more', compact('result'))->render();
        $res                =   array('status'=>"success",'html' => $html,'page' => $page_no,'last_page' => $last_page, 'search_string' => $search_string, 'productTypes' => $productTypes);
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
        return View::make('Blog::front.view', compact('pageHeadTitle', 'record', 'slug',   'redirectUrl', 'pageTitle', 'meta_description', 'meta_keywords','ogImage','dashboardHeader'));
    } //end viewBlog()


      

} // end HomeController class
