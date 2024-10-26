<?php
namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Blog\Models\Blog;
use App\Modules\Blog\Models\BlogDescription;
use App\Modules\Blog\Services\BlogService;
use Config,CustomHelper,DB,File,Redirect,Request,Route,Session,ValidationHelper,Validator,View,Auth;


/**
 * Blog Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/usermgmt
 **/
class BlogController extends BaseController
{

    public $model       = 'Blog';
    public $BlogModel   = 'Blog';

    public function __construct()
    {
        View::share('modelName', $this->model);
        View::share('BlogModel', $this->BlogModel);
    }


	/**
	 * Function for display list of all blogs
	 *
	 * @param null
	 *
	 * @return view page.
	 **/
    public function index($uni_id = null)
    {


        $DB = Blog::query();
        $searchVariable = array();
        $inputGet = Request::all();

        /**
         * seacrching on the basis of username and email
         **/


        if (Request::Input()) {
            $searchData = Request::Input();
            $searchVariable = Request::Input();

            if (isset($searchData['display'])) {
                unset($searchData['display']);
            }

            if (isset($searchData['_token'])) {
                unset($searchData['_token']);
            }

            if (isset($searchData['sortBy'])) {
                unset($searchData['sortBy']);
            }

            if (isset($searchData['order'])) {
                unset($searchData['order']);
            }

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }

            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

            $start_date = $end_date = '';

            foreach ($searchData as $fieldName => $fieldValue) {

                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'created_at') {
                        if (!empty(Request::get('created_at'))) {
                            $start_date = Request::get('created_at');
                        }
                    } elseif ($fieldName == 'updated_at') {
                        if (!empty(Request::get('updated_at'))) {
                            $end_date = Request::get('updated_at');
                        }
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }

                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }


        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $recordPerPage = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $result = $DB->with('AddedByUser')->where('university_id',$uni_id)->orderBy($sortBy, $order)->paginate((int) $recordPerPage);

        $currentRoute = Route::currentRouteName();
        $universityBlog = false;
        if($currentRoute == "UniversityBlog.index"){
            $universityBlog =true;
        }

        return View::make("Blog::index", compact('recordPerPage','result', 'searchVariable', 'sortBy', 'order','uni_id','universityBlog'));
    } // end index()


	/**
	 * Function for display page for add new Blog
	 *
	 * @param null
	 *
	 * @return view page.
	 */
    public function addBlog($uni_id = null){


        $languages      = CustomHelper::getLanguageArrayWithCode();
        $language_code  = CustomHelper::getConfigValue('defaultLanguageCode');


        $currentRoute = Route::currentRouteName();
        $universityBlog = false;
        if($currentRoute == "UniversityBlog.add"){
            $universityBlog =true;
        }

        return view::make('Blog::add', compact('languages', 'language_code','currentRoute','uni_id','universityBlog'));
    }


	/**
	 * Function for save images and description  for Blog
	 *
	 * @param null
	 *
	 * @return redirect page.
	 */
    public function saveBlog($uni_id = null){
        $formData = Request::all();
        if (!empty($formData)) {

            $user_id = Auth::user()->id;

            $language_code              = CustomHelper::getConfigValue('defaultLanguageCode');
            $dafaultLanguageArray       = $formData['data'][$language_code];
            $formData['title']          = isset($dafaultLanguageArray['title']) ? $dafaultLanguageArray['title'] : '';
            $formData['description']    = isset($dafaultLanguageArray['description']) ? $dafaultLanguageArray['description'] : '';

            $attribute                  = array("from" => "admin", "model" => $this->model, "type" => "add",'user_id'=>$user_id,'uni_id'=>$uni_id);
            $blog                       = new BlogService;
            $formData['image']          = isset($formData['image']) ? $formData['image'] : '';
            $res                        = $blog->BlogValidateandSave($formData, $attribute, $this->model);
            if ($res['data']['status'] == 'error') {
                $validator = $res['validator'];
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                Session::flash('success', trans("messages.$this->model.added_message"));

                if($uni_id != null){
                  return Redirect::route("UniversityBlog.index",$uni_id);
                }else{
                   return Redirect::route("$this->BlogModel.index");
                }
            }
        }
    }



	/**
	 * Function for display page for edit Blog
	 *
	 * @param null
	 *
	 * @return redirect page.
	 */
    public function editBlog($id,$uni_id = null){

        $result = Blog::findorFail($id);
        $modelDescriptions = BlogDescription::where('parent_id', '=', $id)->get();

        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                if (Request::Old() != null) {
                    $multiLanguage[$modelDescription->language_id]['title'] = '';
                    $multiLanguage[$modelDescription->language_id]['description'] = '';
                } else {
                    $multiLanguage[$modelDescription->language_id]['title'] = $modelDescription['title'];
                    $multiLanguage[$modelDescription->language_id]['description'] = $modelDescription['description'];
                }
            }
        }

        $currentRoute = Route::currentRouteName();
        $universityBlog = false;
        if($currentRoute == "UniversityBlog.edit"){
            $universityBlog =true;
        }



        return View::make("Blog::edit", compact('result', 'languages', 'language_code', 'multiLanguage','universityBlog','uni_id'));
    } // end edit



	/**
	 * Function for save images and description  for Blog
	 *
	 * @param null
	 *
	 * @return redirect page.
	 */
    public function updateBlog($id,$uni_id = null){
        $formData = Request::all();
        if (!empty($formData)) {

            $user_id = Auth::user()->id;

            $attribute                  = array("from" => "admin", "type" => "edit", "model" => $this->model, "blog_id" => $id,'user_id'=>$user_id,'uni_id'=>$uni_id);
            $blog                       = new BlogService;
            $language_code              = CustomHelper::getConfigValue('defaultLanguageCode');
            $dafaultLanguageArray       = $formData['data'][$language_code];
            $formData['image']          = isset($formData['image']) ? $formData['image'] : '';
            $formData['title']          = isset($dafaultLanguageArray['title']) ? $dafaultLanguageArray['title'] : '';
            $formData['description']    = isset($dafaultLanguageArray['description']) ? $dafaultLanguageArray['description'] : '';
            $res                        = $blog->BlogValidateandSave($formData, $attribute, $this->model);
            if ($res['data']['status'] == ERROR) {
                $validator = $res['validator'];
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                Session::flash('success', trans("messages.$this->model.blog_DataUpdated"));

                if($uni_id != null){
                    return Redirect::route("UniversityBlog.index",$uni_id);
                  }else{
                     return Redirect::route("$this->BlogModel.index");
                  }
            }
        }
    }



	/**
	 * Function for update Blog  status
	 *
	 * @param $Id as id of Blog
	 * @param $Status as status of Blog
	 *
	 * @return redirect page.
	 */
    public function updateBlogStatus($modelId = 0, $modelStatus = 0,$uni_id = null)
    {
        Blog::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));

        if($uni_id != null){
            return Redirect::route("UniversityBlog.index",$uni_id);
          }else{
             return Redirect::route("$this->BlogModel.index");
          }

    } // end updateBlogStatus()


	/**
	 * Function for delete Blog
	 *
	 * @param $Id as id of Blog
	 *
	 * @return redirect page.
	 */
    public function deleteBlog($modelId = 0,$uni_id = null)
    {
        if ($modelId) {
            $blogImage = Blog::where('id', $modelId)->first();
            if (!empty($blogImage->id)) {
                if (!empty($blogImage->image) && file_exists(BLOG_IMAGE_ROOT_PATH . $blogImage->image)) {
                    @unlink(BLOG_IMAGE_ROOT_PATH . $blogImage->image);
                }
                if (!empty($blogImage->image_1) && file_exists(BLOG_IMAGE_ROOT_PATH . $blogImage->image_1)) {
                    @unlink(BLOG_IMAGE_ROOT_PATH . $blogImage->image_1);
                }
                $blogImage->title 		= DELETE_PREFIX.$blogImage->title;
			    $blogImage->slug 		= DELETE_PREFIX.$blogImage->slug;
                $blogImage->save();
                BlogDescription::where('parent_id', $modelId)->delete();
                Blog::where('id', $modelId)->delete();
            }
            Session::flash('success', trans("messages.$this->model.deleted_message"));
        }

        if($uni_id != null){
            return Redirect::route("UniversityBlog.index",$uni_id);
        }else{
             return Redirect::route("$this->model.index");
        }

    } // end deleteBlog()


	/**
	 * Function for delete multiple Block
	 *
	 * @param null
	 *
	 * @return view page.
	 */
    public function performMultipleAction($uni_id = null)
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'active') {
                    Blog::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Blog::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                } elseif ($actionType == 'delete') {
                    Blog::whereIn('id', Request::get('ids'))->delete();
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()


	/**
	 * Function for view Blog
	 *
	 * @param $Id as id of Blog
	 *
	 * @return redirect page.
	 */
    public function viewBlog($id,$uni_id = null)
    {

        $result             = Blog::findOrFail($id);
        $modelDescriptions  = BlogDescription::where('parent_id', '=', $id)->get();
        $multiLanguage      = array();
        $languages          = CustomHelper::getLanguageArrayWithCode();
        $language_code      = CustomHelper::getConfigValue('defaultLanguageCode');
        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                $multiLanguage[$modelDescription->language_id]['title'] = $modelDescription['title'];
                $multiLanguage[$modelDescription->language_id]['description'] = $modelDescription['description'];
            }
        }

        $currentRoute = Route::currentRouteName();
        $universityBlog = false;
        if($currentRoute == "UniversityBlog.view"){
            $universityBlog =true;
        }

        return View::make('Blog::view', compact('result', 'id', 'multiLanguage', 'languages','universityBlog','uni_id'));
    } //end viewFaq()



/**
	 * Function for updating featured Blog status
	 *
	 * @param $featuredId as id of Blog and $featuredStatus as Blog status
	 *
	 * @return redirect page.
	*/
	public function updateFeaturedStatus($featuredId = INACTIVE, $featuredStatus = INACTIVE){
		Blog::where('id', '=', $featuredId)->update(array('is_featured' => (int)$featuredStatus));

		Session::flash('success', trans("messages.$this->model.featured_updated_message"));
		return Redirect::route("$this->model.index");
	}// updateFeaturedStatus()



} // end BlogsController class
