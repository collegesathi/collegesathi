<?php
namespace App\Modules\Testimonial\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Testimonial\Models\Testimonial;
use App\Modules\Testimonial\Models\TestimonialDescription;
use CustomHelper;
use File;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Route;
use Session;
use ValidationHelper;
use Validator;
use View;
use App\Events\TestimonialCreated;
/**
 * TestimonialController Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/testimonial
 */

class TestimonialController extends BaseController
{

    public $model = 'Testimonial';
    public $TestimonialModel   = 'Testimonial';

    public function __construct()
    {
        View::share('modelName', $this->model);
        View::share('TestimonialModel', $this->TestimonialModel);
    }

    /**
     * Function for display all Testimonial
     *
     * @param null
     *
     * @return view page.
     */
    public function listTestimonial($uni_id = null)
    {
       
        $DB = Testimonial::query();
        $searchVariable = array();
        $inputGet = Request::all();
        ## Searching on the basis of comment ##

        if (Request::all()) {
            $searchData = Request::all();
            $searchVariable = Request::all();

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

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'active') {
                        $DB->where('is_active', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $recordPerPage = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : CustomHelper::getConfigValue("Reading.records_per_page");

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';

        $model = $DB->where('uni_id',$uni_id)->orderBy($sortBy, $order)->paginate((int) $recordPerPage);
        $currentRoute = Route::currentRouteName();
        $universityTestimonial = false;
        if($currentRoute == "UniversityTestimonial.index"){
            $universityTestimonial =true;
        }

        return View::make("Testimonial::index", compact('recordPerPage', 'model', 'searchVariable', 'sortBy', 'order','uni_id','universityTestimonial'));
    } // end listTestimonial()

    /**
     * Function for display page  for add new Testimonial
     *
     * @param null
     *
     * @return view page.
     */
    public function addTestimonial($uni_id = null)
    {
        $currentRoute = Route::currentRouteName();
        $universityTestimonial = false;
        if($currentRoute == "UniversityTestimonial.add"){
            $universityTestimonial =true;
        }
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        return View::make("Testimonial::add", compact('languages', 'language_code','uni_id','universityTestimonial'));
    } //end addTestimonial()

    /**
     * Function for save added Testimonial page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveTestimonial($uni_id = null)
    {
        $thisData = Request::all();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $thisData['data'][$language_code];

        $attribute = array("from" => "admin", "model" => $this->model, "type" => "add");
        list($validate, $message) = self::getTestimonialValidation($thisData, $attribute);

        $validator = Validator::make(
            array(
                'client_name' => $dafaultLanguageArray['client_name'],
                'comment' => $dafaultLanguageArray['comment'],
                'image' => isset($thisData['image']) ? $thisData['image'] : '',
                'designation' => $dafaultLanguageArray['designation'],
                'company' => $dafaultLanguageArray['company'],
                'batch' => $dafaultLanguageArray['batch'],
                'linkedin_url' => $dafaultLanguageArray['linkedin_url'],
            ),
            $validate, $message
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model = new Testimonial;
            $model->uni_id = isset($thisData['uni_id']) ? $thisData['uni_id'] : null;
            $model->client_name = ucfirst($dafaultLanguageArray['client_name']);
            $model->comment = ucfirst($dafaultLanguageArray['comment']);
            $model->designation = ucfirst($dafaultLanguageArray['designation']);
            $model->company = ucfirst($dafaultLanguageArray['company']);
            $model->batch = ucfirst($dafaultLanguageArray['batch']);
            $model->linkedin_url  = $dafaultLanguageArray['linkedin_url'] ?? null;

            $model->is_active = ACTIVE;

            if (isset($thisData['image']) && !empty($thisData['image'])) {
                $extension = $thisData['image']->getClientOriginalExtension();
                $fileName = time() . '-testimonial-image.' . $extension;
                if ($thisData['image']->move(TESTIMONIAL_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }
            }

            $model->save();
            $modelId = $model->id;
            foreach ($thisData['data'] as $language_id => $descriptionResult) {
                $modelDescription = new TestimonialDescription();
                $modelDescription->language_id = $language_id;
                $modelDescription->parent_id = $modelId;
                $modelDescription->client_name = $descriptionResult['client_name'];
                $modelDescription->comment = $descriptionResult['comment'];
                $modelDescription->designation = $descriptionResult['designation'];
                $modelDescription->company = $descriptionResult['company'];
                $modelDescription->batch = $descriptionResult['batch'];
                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.added_message"));
            if(!$uni_id == null){
                return Redirect::route("UniversityTestimonial.index",$uni_id);
            }else{
                return Redirect::route("$this->model.index");
            }
        }
    } //end saveTestimonial()

    /**
     * Function for display page  for edit Testimonial page
     *
     * @param $Id as id of Testimonial
     *
     * @return view page.
     */
    public function editTestimonial($modelId,$uni_id = null)
    {
        
        $result = Testimonial::findorFail($modelId);
        $modelDescriptions = TestimonialDescription::where('parent_id', '=', $modelId)->get();
        
        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                if (Request::Old() != null) {
                    $multiLanguage[$modelDescription->language_id]['comment'] = '';
                    $multiLanguage[$modelDescription->language_id]['client_name'] = '';
                    $multiLanguage[$modelDescription->language_id]['designation'] = '';
                    $multiLanguage[$modelDescription->language_id]['company'] = '';
                    $multiLanguage[$modelDescription->language_id]['batch'] = '';
                    $multiLanguage[$modelDescription->language_id]['linkedin_url'] = '';
                } else {
                    $multiLanguage[$modelDescription->language_id]['comment'] = $modelDescription['comment'];
                    $multiLanguage[$modelDescription->language_id]['client_name'] = $modelDescription['client_name'];
                    $multiLanguage[$modelDescription->language_id]['designation'] = $modelDescription['designation'];
                    $multiLanguage[$modelDescription->language_id]['company'] = $modelDescription['company'];
                    $multiLanguage[$modelDescription->language_id]['batch'] = $modelDescription['batch'];
                    $multiLanguage[$modelDescription->language_id]['linkedin_url'] = $modelDescription['linkedin_url'];
                }
            }
        }
        $currentRoute = Route::currentRouteName();
        $universityTestimonial = false;
        if($currentRoute == "UniversityTestimonial.edit"){
            $universityTestimonial =true;
        }

        return View::make("Testimonial::edit", compact( 'languages', 'language_code', 'result', 'multiLanguage','universityTestimonial','uni_id'));
    } // end editTestimonial()

    /**
     * Function for update Testimonial
     *
     * @param $Id ad id of Testimonial
     *
     * @return redirect page.
     */
    public function updateTestimonial($modelId,$uni_id = null)
    {
        $model = Testimonial::findOrFail($modelId);
        $this_data = Request::all();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $this_data['data'][$language_code];

        $attribute = array("from" => "admin", "model" => $this->model, "type" => "edit", 'id' => $modelId);
        list($validate, $message) = self::getTestimonialValidation($this_data, $attribute);

        $validator = Validator::make(
            array(
                'client_name' => $dafaultLanguageArray['client_name'],
                'comment' => $dafaultLanguageArray['comment'],
                'image' => isset($this_data['image']) ? $this_data['image'] : '',
                'designation' => $dafaultLanguageArray['designation'],
                'company' => $dafaultLanguageArray['company'],
                'batch' => $dafaultLanguageArray['batch'],
                'linkedin_url' => $dafaultLanguageArray['linkedin_url'],
            ),
            $validate, $message
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model->client_name = ucfirst($dafaultLanguageArray['client_name']);
            $model->comment = ucfirst($dafaultLanguageArray['comment']);
            $model->designation = ucfirst($dafaultLanguageArray['designation']);
            $model->company = ucfirst($dafaultLanguageArray['company']);
            $model->batch = ucfirst($dafaultLanguageArray['batch']);
            $model->linkedin_url = $dafaultLanguageArray['linkedin_url'] ?? null;


            if (isset($this_data['image']) && !empty($this_data['image'])) {
                $extension = $this_data['image']->getClientOriginalExtension();
                $fileName = time() . '-testimonial-image.' . $extension;

                if ($this_data['image']->move(TESTIMONIAL_IMAGE_ROOT_PATH, $fileName)) {
                    $old_image = $model->image;
                    @unlink(TESTIMONIAL_IMAGE_ROOT_PATH . $old_image);
                    $model->image = $fileName;
                }
            }

            $model->save();

            TestimonialDescription::where('parent_id', $modelId)->delete();
            foreach ($this_data['data'] as $language_id => $descriptionResult) {
                $modelDescription = new TestimonialDescription();
                $modelDescription->language_id = $language_id;
                $modelDescription->parent_id = $modelId;
                $modelDescription->client_name = $descriptionResult['client_name'];
                $modelDescription->comment = $descriptionResult['comment'];
                $modelDescription->designation = $descriptionResult['designation'];
                $modelDescription->company = $descriptionResult['company'];
                $modelDescription->batch = $descriptionResult['batch'];
                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.updated_message"));
            if(!$uni_id == null){
                return Redirect::route("UniversityTestimonial.index",$uni_id);
            }else{
                return Redirect::route("$this->model.index");
            }
        }
    } // end updateTestimonial()

    /**
     * Function for update Testimonial  status
     *
     * @param $Id as id of Testimonial
     * @param $Status as status of Testimonial
     *
     * @return redirect page.
     */
    public function updateTestimonialStatus($modelId = 0, $modelStatus = 0,$uni_id = null)
    {
        Testimonial::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));

        if(!$uni_id == null){
            return Redirect::route("UniversityTestimonial.index",$uni_id);
        }else{
            return Redirect::route("$this->model.index");
        }
    } // end updateTestimonialStatus()

    /**
     * Function for delete Testimonial
     *
     * @param $Id as id of Testimonial
     *
     * @return redirect page.
     */
    public function deleteTestimonial($modelId = 0,$uni_id = null)
    {
        if ($modelId) {
            $testimonialImage = Testimonial::where('id', $modelId)->first();
            if (!empty($testimonialImage->id)) {
                if (!empty($testimonialImage->image) && file_exists(TESTIMONIAL_IMAGE_ROOT_PATH . $testimonialImage->image)) {
                    @unlink(TESTIMONIAL_IMAGE_ROOT_PATH . $testimonialImage->image);
                }
                
                $testimonialImage->client_name 		= DELETE_PREFIX.$testimonialImage->client_name;
                $testimonialImage->slug 		= DELETE_PREFIX.$testimonialImage->slug;
                $testimonialImage->save();
                TestimonialDescription::where('parent_id', $modelId)->delete();
                Testimonial::where('id', $modelId)->delete();
                Session::flash('success', trans("messages.$this->model.deleted_message"));
            }
        }
        if(!$uni_id == null){
            return Redirect::route("UniversityTestimonial.index",$uni_id);
        }else{
            return Redirect::route("$this->model.index");
        }
    } // end deleteTestimonial()

    /**
     * Function for view Testimonial
     *
     * @param $Id as id of Testimonial
     *
     * @return redirect page.
     */
    public function viewTestimonial($id,$uni_id = null)
    {
        
        $result = Testimonial::find($id);
        $modelDescriptions = TestimonialDescription::where('parent_id', '=', $id)->get();

        $multiLanguage = array();

        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {

                $multiLanguage[$modelDescription->language_id]['comment'] = $modelDescription['comment'];
                $multiLanguage[$modelDescription->language_id]['client_name'] = $modelDescription['client_name'];
                $multiLanguage[$modelDescription->language_id]['designation'] = $modelDescription['designation'];
                $multiLanguage[$modelDescription->language_id]['company'] = $modelDescription['company'];
                $multiLanguage[$modelDescription->language_id]['batch'] = $modelDescription['batch'];

            }
        }
        $currentRoute = Route::currentRouteName();
        $universityTestimonial = false;
        if($currentRoute == "UniversityTestimonial.view"){
            $universityTestimonial =true;
        }

        return View::make('Testimonial::view', compact('result','id','multiLanguage', 'languages', 'language_code','universityTestimonial','uni_id'));
    } //end viewFaq()

    /**
     * Function for performMultipleAction
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
                    Testimonial::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Testimonial::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                } elseif ($actionType == 'delete') {
                    Testimonial::whereIn('id', Request::get('ids'))->delete();
                    TestimonialDescription::where('parent_id', Request::get('ids'))->delete();
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

    /**
     * ValidationHelper::getTestimonialValidation()
     * @Description Function  for validation Testimonial
     * @param $formData,$attribute
     * @return $validation message and validation
     **/
    public static function getTestimonialValidation($thisData = array(), $attribute = array())
    {

        $message = array(
            'client_name.required' => trans('messages.client_name.REQUIRED_ERROR'),
            'client_name.max' => trans('messages.name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
			// 'comment.max' => trans('messages.comment.MAX_KEYWORD_LENGTH_ERROR', ['max' => TESTIMONIAL_MESSAGE_LENGTH]),
			'comment.required' => trans('messages.comment.REQUIRED_ERROR'),
            'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
            'image.required' => trans('messages.image.required_error'),
            'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            'designation.required' => trans('messages.designation.REQUIRED_ERROR'),
            'company.required' => trans('messages.company.REQUIRED_ERROR'),
            'batch.required' => trans('messages.batch.REQUIRED_ERROR'),
            'linkedin_url.required' => trans('messages.linkedin_url.REQUIRED_ERROR'),
            'linkedin_url.url' => trans('messages.linkedin_url.VALID_ERROR')

        );

        $validate = array(
            'client_name' => 'required|max:'.CMS_PAGE_NAME_LIMIT,
            'comment' => 'required'/*|max: . TESTIMONIAL_MESSAGE_LENGTH*/,
			'image' => 'required|image|mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024),
            'designation' => 'required',
            'company' => 'required',
            'batch' => 'required',
            'linkedin_url' => 'required|url'
        );

        if (isset($attribute['id']) && !empty($attribute['id'])) {
            $validate['image'] = 'max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION;

        }

        return array($validate, $message);
    }

} // end TestimonialController class
