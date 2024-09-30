<?php
namespace App\Modules\Slider\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Slider\Models\Slider;
use App\Modules\Slider\Models\SliderDescription;
use App\Modules\Slider\Services\SliderService;
use Config;
use CustomHelper;
use File;
use Input;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Response;
use Route;
use Session;
use Validator;
use View;

/**
 * Sliders Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/slider
 */

class SliderController extends BaseController
{

    /**
     * Function for display list of all images for slider
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'Slider';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    public function listSlider($uni_id = null)
    {

        $DB = Slider::query();
        $searchVariable = array();
        $inputGet = Request::Input();

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

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'active') {
                        $DB->where('is_active', (int) $fieldValue);
                    } elseif ($fieldName == 'slider_order') {
                        $DB->where('slider_order', (int) $fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));

            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->where('uni_id',$uni_id)->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        $activeCount = $DB->where('is_active', ACTIVE)->get()->count();

        $currentRoute = Route::currentRouteName();
        $universitySlider = false;
        if($currentRoute == "UniversitySlider.index"){
            $universitySlider =true;
        }

        return View::make("Slider::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'activeCount','universitySlider','uni_id'));

    } // end listSlider()

    /**
     * Function for display page for add new image on slider
     *
     * @param null
     *
     * @return view page.
     */

    public function addSlider($uni_id = null)
    {
        $currentRoute = Route::currentRouteName();
        $universitySlider = false;
        if($currentRoute == "UniversitySlider.add"){
            $universitySlider =true;
        }

        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        return View::make("Slider::add", compact('languages', 'language_code', 'universitySlider','uni_id'));
    } // end addSlider()

    /**
     * Function for save images and description  for slider
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveSlider($uni_id = null)
    {
        $thisData = Request::all();
        $SliderService = new SliderService;
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguage = $thisData['data'][$language_code];

        $thisData['slider_title'] = $dafaultLanguage['slider_title'];
        $thisData['slider_text'] = $dafaultLanguage['slider_text'];

        $attribute = array("from" => "admin", "model" => $this->model, "type" => "add");
        list($validate, $message) = $SliderService->getSliderValidation($thisData, $attribute);

        $validator = Validator::make(
            array(
                'image' => Request::file('image'),
                'order' => !empty($thisData['order']) ? $thisData['order'] : $thisData['order'],
                'slider_title' => !empty($thisData['data'][$language_code]['slider_title']) ? $thisData['data'][$language_code]['slider_title'] : $thisData['data'][$language_code]['slider_title'],
                'slider_text' => !empty($thisData['data'][$language_code]['slider_text']) ? $thisData['data'][$language_code]['slider_text'] : $thisData['data'][$language_code]['slider_text'],
                'slider_url' => !empty($thisData['slider_url']) ? $thisData['slider_url'] : $thisData['slider_url'],
            ),
            $validate, $message
        );

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $model = new Slider;
            $model->uni_id = isset($thisData['uni_id']) ? $thisData['uni_id'] : null;
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-slider-image.' . $extension;
                if (Request::file('image')->move(SLIDER_ROOT_PATH, $fileName)) {
                    $model->slider_image = $fileName;
                }
            }

            $model->slider_title = $thisData['slider_title'];
            $model->slider_text = $thisData['slider_text'];
            $model->slider_order = (int) Request::get('order');
            $model->slider_url = Request::get('slider_url');
            $model->is_active = ACTIVE;

            $model->save();
            $modelId = $model->id;

            foreach ($thisData['data'] as $langCode => $descriptionResult) {

                // update multi langual data in Subject
                $modelDescription = new SliderDescription();
                $modelDescription->language_id = $langCode;
                $modelDescription->parent_id = $modelId;
                $modelDescription->slider_text = $descriptionResult['slider_text'];
                $modelDescription->slider_title = $descriptionResult['slider_title'];
                $modelDescription->save();

            }
            Session::flash('success', trans("messages.$this->model.added_message"));
            
            if(!$uni_id == null){
                return Redirect::route("UniversitySlider.index",$uni_id);
            }else{
                return Redirect::route("$this->model.index");
            }
        }
    } // end saveSlider()

    /**
     * Function for display page for edit image and description for slider
     *
     * @param $sliderId id  of image for slider
     *
     * @return view page.
     */
    public function editSlider($modelId,$uni_id = null)
    {
        $result = Slider::findorFail($modelId);
        $modelDescriptions = SliderDescription::where('parent_id', '=', $modelId)->get();

        if (Request::Old() != null) {
            $result->slider_order = Request::Old('slider_order');
            $result->slider_title = Request::Old('slider_title');
            $result->slider_text = Request::Old('slider_text');
            $result->slider_url = Request::Old('slider_url');
        }

        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {

                if (Request::Old() != null) {

                    $multiLanguage[$modelDescription->language_id]['slider_title'] = '';
                    $multiLanguage[$modelDescription->language_id]['slider_text'] = '';

                } else {
                    $multiLanguage[$modelDescription->language_id]['slider_title'] = $modelDescription['slider_title'];
                    $multiLanguage[$modelDescription->language_id]['slider_text'] = $modelDescription['slider_text'];

                }

            }
        }

        $currentRoute = Route::currentRouteName();
        $universitySlider = false;
        if($currentRoute == "UniversitySlider.edit"){
            $universitySlider =true;
        }

        return View::make("Slider::edit", compact('languages', 'language_code', 'result', 'multiLanguage','universitySlider','uni_id'));
    } // end editSlider()

    /**
     * Function for save updated image and description for slider
     *
     * @param null
     *
     * @return redirect page.
     */
    public function updateSlider($modelId,$uni_id = null)
    {
        
        $model = Slider::findOrFail($modelId);
        $SliderService = new SliderService;

        $oldImage = $model->slider_image;
        $oldLargeImage = $model->slider_image_large;

        $thisData = Request::all();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguage = $thisData['data'][$language_code];
        $thisData['slider_title'] = $dafaultLanguage['slider_title'];
        $thisData['slider_text'] = $dafaultLanguage['slider_text'];
        $thisData['uni_id'] = $uni_id;

        $attribute = array("from" => "admin", "model" => $this->model, "type" => "edit", 'id' => $modelId);
        list($validate, $message) = $SliderService->getSliderValidation($thisData, $attribute);

        $validator = Validator::make(
            array(
                'image' => Request::file('image'),
                'order' => !empty($thisData['order']) ? $thisData['order'] : $thisData['order'],
                'slider_title' => !empty($thisData['slider_title']) ? $thisData['slider_title'] : $thisData['slider_title'],
                'slider_text' => !empty($thisData['slider_text']) ? $thisData['slider_text'] : $thisData['slider_text'],
                'slider_url' => !empty($thisData['slider_url']) ? $thisData['slider_url'] : $thisData['slider_url'],

            ),
            $validate, $message
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-slider-image.' . $extension;
                if (Request::file('image')->move(SLIDER_ROOT_PATH, $fileName)) {
                    $model->slider_image = $fileName;
                }

                if (file_exists(SLIDER_ROOT_PATH . $oldImage)) {
                    @unlink(SLIDER_ROOT_PATH . $oldImage);
                }
            }

            $model->slider_title = $thisData['slider_title'];
            $model->slider_text = $thisData['slider_text'];
            $model->slider_order = (int) Request::get('order');
            $model->slider_url = Request::get('slider_url');
            $model->save();
            $modelId = $model->id;
            $modelDescription = SliderDescription::where('parent_id', $modelId)->delete();

            foreach ($thisData['data'] as $langCode => $descriptionResult) {
                $modelDescription = new SliderDescription();
                $modelDescription->language_id = $langCode;
                $modelDescription->parent_id = $modelId;
                $modelDescription->slider_text = $descriptionResult['slider_text'];
                $modelDescription->slider_title = $descriptionResult['slider_title'];
                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.updated_message"));
          
            if(!$uni_id == null){
                return Redirect::route("UniversitySlider.index",$uni_id);
            }else{
                return Redirect::route("$this->model.index");
            }
        }
    } // end updateSlider()

    /**
     * Function for display all clients
     *
     * @param $sliderId as id of image on slider
     *
     * @return redirect page.
     */

    public function deleteSlider($modelId = 0,$uni_id = null)
    {
        if ($modelId) {
            $sliderDetail = Slider::where('id', $modelId)->first();

            if (!empty($sliderDetail)) {
                $image = $sliderDetail->slider_image;

                if (file_exists(SLIDER_ROOT_PATH . $image)) {
                    @unlink(SLIDER_ROOT_PATH . $image);
                }
            }

            SliderDescription::where('parent_id', $modelId)->delete();
            $model = Slider::where('id', $modelId)->delete();
            Session::flash('success', trans("messages.$this->model.deleted_message"));
        }
        if(!$uni_id == null){
            return Redirect::route("UniversitySlider.index",$uni_id);
        }else{
            return Redirect::route("$this->model.index");
        }

    } // end deleteSlider()

    /**
     * Function for change status of slider image
     *
     * @param $sliderId as id of image on slider
     * @param $sliderStatus as status of image for slider
     *
     * @return redirect page.
     */

    public function updateSliderStatus($modelId = 0, $modelStatus = 0,$uni_id = null)
    {
        Slider::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        
        if(!$uni_id == null){
            return Redirect::route("UniversitySlider.index",$uni_id);
        }else{
            return Redirect::route("$this->model.index");
        }
    } // end updateSliderStatus()

    /**
     * Function for delete,active,deactive slider
     *
     * @param $userId as id of users
     *
     * @return redirect page.
     */

    public function performMultipleAction()
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'active') {
                    Slider::whereIn('id', Request::get('ids'))->update(array('is_active' => 1));
                } elseif ($actionType == 'inactive') {
                    Slider::whereIn('id', Request::get('ids'))->update(array('is_active' => 0));
                } elseif ($actionType == 'delete') {
                    Slider::whereIn('id', Request::get('ids'))->delete();
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

    /**
     * Function for view Slider
     *
     * @param $Id as id of Slider
     *
     * @return redirect page.
     */
    public function viewSlider($id,$uni_id = null)
    {

        $result = Slider::find($id);

        $multiLanguage = array();
        $modelDescriptions = SliderDescription::where('parent_id', '=', $id)->get();

        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                $multiLanguage[$modelDescription->language_id]['slider_title'] = $modelDescription['slider_title'];
                $multiLanguage[$modelDescription->language_id]['slider_text'] = $modelDescription['slider_text'];

            }
        }
        $currentRoute = Route::currentRouteName();
        $universitySlider = false;
        if($currentRoute == "UniversitySlider.view"){
            $universitySlider =true;
        }

        return View::make('Slider::view', compact('result', 'multiLanguage', 'languages','universitySlider','uni_id'));
    } //end viewFaq()

    /**
     * Function for update the orderby field
     *
     * @param null
     *
     * @return view page.
     */

    public function changeSliderOrder()
    {
        $order_by = (int) Request::get('order_by');
        $id = Request::get('current_id');
        $sliderOrder = Slider::where('id', $id)->pluck('slider_order');
        $validator = Validator::make(
            array(
                'order_by' => !empty((int) Request::get('order_by')) ? (int) Request::get('order_by') : Request::get('order_by'),
            ),
            array(
                'order_by' => 'required|numeric|unique:sliders,slider_order,' . $id . ',id',
            )
        );
        $message = $validator->messages()->toArray();
        if ($validator->fails()) {
            $response = array(
                'success' => false,
                'message' => $message['order_by'],

            );
            return Response::json($response);die;
        } else {
            Slider::where('id', $id)->update(
                array(
                    'slider_order' => $order_by,
                )
            );
            $response = array(
                'success' => 1,
                'order_by' => $order_by,
            );
            return Response::json($response);die;
        }
    } //end changeSliderOrder()



} // end SlidersController class
