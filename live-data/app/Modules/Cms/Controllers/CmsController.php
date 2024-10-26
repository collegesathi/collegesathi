<?php
namespace App\Modules\Cms\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Cms\Models\Cms;
use App\Modules\Cms\Models\CmsDescription;
use CustomHelper;
use Redirect;
use Request;
use Session;
use Validator;
use View;

/**
 * Cms Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Cms
 */
class CmsController extends BaseController
{

    public $model = 'Cms';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all cms page
     *
     * @param null
     *
     * @return view page.
     */
    public function listCms()
    {

        $DB = Cms::query();
        $searchVariable = array();
        $inputGet = Request::all();

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

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';
        $limit = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : CustomHelper::getConfigValue("Reading.records_per_page");
        $model = $DB->orderBy($sortBy, $order)->paginate((int) $limit);

        return View::make("Cms::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order'));
    } // end listcms()

    /**
     * Function for display page  for add new cms page
     *
     * @param null
     *
     * @return view page.
     */
    public function addCms()
    {

        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        return View::make("Cms::add", compact('languages', 'language_code'));
    } //end addCms()

    /**
     * Function for save added cms page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveCms()
    {
        $thisData = Request::all();

        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $thisData['data'][$language_code];
        $thisData['title'] = $dafaultLanguageArray['title'];
        $thisData['description'] = $dafaultLanguageArray['description'];

        $validator = Validator::make(
            array(
                'name' => Request::get('name'),
               /* 'image' => Request::file('image'),*/
                'title' => $thisData['title'],
                'description' => trim(strip_tags($thisData['description'])),
                'meta_title' => $thisData['meta_title'],
                'meta_description' => $thisData['meta_description'],
                'meta_keywords' => $thisData['meta_keywords'],
            ),
            array(
                'name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'title' => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
                'description' => 'required',
                'meta_title' => 'required|max:' . CMS_PAGE_META_TITLE_LIMIT,
                'meta_description' => 'required|max:' . CMS_PAGE_META_DESCRIPTION_LIMIT,
                'meta_keywords' => 'required|max:' . CMS_PAGE_META_KEYWORDS_LIMIT,
               /* 'image'        => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,*/

            ),
            array(
				'name.max' => trans('messages.name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
				'title.max' => trans('messages.title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
				'meta_title.max' => trans('messages.meta_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_TITLE_LIMIT]),
				'meta_description.max' => trans('messages.meta_description.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_DESCRIPTION_LIMIT]),
				'meta_keywords.max' => trans('messages.meta_keywords.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_KEYWORDS_LIMIT]),
                'name.required' => trans('messages.name.REQUIRE_ERROR'),
                'title.required' => trans('messages.title.REQUIRE_ERROR'),
                'description.required' => trans('messages.description.REQUIRE_ERROR'),
                'meta_title.required' => trans('messages.meta_title.REQUIRE_ERROR'),
                'meta_description.required' => trans('messages.meta_description.REQUIRE_ERROR'),
                'meta_keywords.required' => trans('messages.meta_keywords.REQUIRE_ERROR'),
              /*  'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),*/

            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $model = new Cms;
            $model->name = $thisData['name'];
            $model->title = $thisData['title'];
            $model->description = $thisData['description'];
            $model->meta_title = $thisData['meta_title'];
            $model->meta_description = $thisData['meta_description'];
            $model->meta_keywords = $thisData['meta_keywords'];
            $model->slug = CustomHelper::getSlug($thisData['title'], 'slug', 'Cms');
            $model->is_active = (int) ACTIVE;

           /* if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-cms-image.' . $extension;
                if (Request::file('image')->move(CMS_IMAGE_ROOT_PATH, $fileName)) {
                    $model->featured_image = $fileName;
                }
            }*/

            if ($model->save()) {
                $modelId = $model->id;
            }



            foreach ($thisData['data'] as $langCode => $descriptionResult) {

                // update multi langual data in Subject
                $modelDescription = new CmsDescription();
                $modelDescription->language_id = $langCode;
                $modelDescription->parent_id = $modelId;
                $modelDescription->title = $descriptionResult['title'];
                $modelDescription->description = $descriptionResult['description'];
                $modelDescription->save();

            }

            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.index");
        }
    } //end saveCms()

    /**
     * Function for display page  for edit cms page
     *
     * @param $Id ad id of cms page
     *
     * @return view page.
     */
    public function editCms($modelId)
    {
        $result = Cms::findorFail($modelId);
        $modelDescriptions = CmsDescription::where('parent_id', '=', $modelId)->get();
       if (Request::Old() != null) {
            $result->name = Request::Old('name');
            $result->meta_title = Request::Old('meta_title');
            $result->meta_description = Request::Old('meta_description');
            $result->meta_keywords = Request::Old('meta_keywords');
        }

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

        return View::make("Cms::edit", compact('result', 'languages', 'language_code', 'multiLanguage'));

    } // end editCms()

    /**
     * Function for update Cms
     *
     * @param $modelId as id of Cms
     *
     * @return redirect page.
     */
    public function updateCms($modelId)
    {
        $this_data = Request::all();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $this_data['data'][$language_code];
        $this_data['title'] = $dafaultLanguageArray['title'];
        $this_data['description'] = $dafaultLanguageArray['description'];

        $model = Cms::findorFail($modelId);
        $oldImage = $model->featured_image;

        $validator = Validator::make(
            array(
                'name' => Request::get('name'),
               /* 'image' => Request::file('image'),*/
                'title' => $this_data['title'],
                'description' => trim(strip_tags($this_data['description'])),
                'meta_title' => $this_data['meta_title'],
                'meta_description' => $this_data['meta_description'],
                'meta_keywords' => $this_data['meta_keywords'],
            ),
            array(
                'name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'title' => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
                'description' => 'required',
                'meta_title' => 'required|max:' . CMS_PAGE_META_TITLE_LIMIT,
                'meta_description' => 'required|max:' . CMS_PAGE_META_DESCRIPTION_LIMIT,
                'meta_keywords' => 'required|max:' . CMS_PAGE_META_KEYWORDS_LIMIT,
              /*  'image'        => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,*/

            ),

            array(
				'name.max' => trans('messages.name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
				'title.max' => trans('messages.title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
				'meta_title.max' => trans('messages.meta_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_TITLE_LIMIT]),
				'meta_description.max' => trans('messages.meta_description.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_DESCRIPTION_LIMIT]),
				'meta_keywords.max' => trans('messages.meta_keywords.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_KEYWORDS_LIMIT]),
                'name.required' => trans('messages.name.REQUIRE_ERROR'),
                'title.required' => trans('messages.title.REQUIRE_ERROR'),
                'description.required' => trans('messages.description.REQUIRE_ERROR'),
                'meta_title.required' => trans('messages.meta_title.REQUIRE_ERROR'),
                'meta_description.required' => trans('messages.meta_description.REQUIRE_ERROR'),
                'meta_keywords.required' => trans('messages.meta_keywords.REQUIRE_ERROR'),
              /*  'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),*/
            )

        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model->name = ucfirst(Request::get('name'));
            $model->title = $this_data['title'];
            $model->description = $this_data['description'];
            $model->meta_title = $this_data['meta_title'];
            $model->meta_description = $this_data['meta_description'];
            $model->meta_keywords = $this_data['meta_keywords'];

/*
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-cms-image.' . $extension;
                if (Request::file('image')->move(CMS_IMAGE_ROOT_PATH, $fileName)) {
                    $model->featured_image = $fileName;
                }

                if (file_exists(CMS_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(CMS_IMAGE_ROOT_PATH . $oldImage);
                }
            }
*/


            if ($model->save()) {
                $modelId = $model->id;
            }

            $modelDescription = CmsDescription::where('parent_id', $modelId)->delete();

            foreach ($this_data['data'] as $langCode => $descriptionResult) {
                // update multi langual data in Subject
                $modelDescription = new CmsDescription();
                $modelDescription->language_id = $langCode;
                $modelDescription->parent_id = $modelId;
                $modelDescription->title = $descriptionResult['title'];
                $modelDescription->description = $descriptionResult['description'];

                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    } // end updateCms()

    /**
     * Function for view Blog
     *
     * @param $Id as id of Blog
     *
     * @return redirect page.
     */
    public function viewCms($id)
    {

        $result = Cms::findOrFail($id);
        $modelDescriptions = CmsDescription::where('parent_id', '=', $id)->get();

        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                $multiLanguage[$modelDescription->language_id]['title'] = $modelDescription['title'];
                $multiLanguage[$modelDescription->language_id]['description'] = $modelDescription['description'];

            }
        }

        return View::make('Cms::view', compact('result', 'id', 'multiLanguage', 'languages'));
    } //end viewFaq()

    /**
     * Function for update cms page status
     *
     * @param $modelId as id of cms page
     * @param $modelStatus as status of cms page
     *
     * @return redirect page.
     */
    public function updateCmsStatus($modelId = 0, $modelStatus = 0)
    {
        Cms::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
    } // end updateCmstatus()

    /**
     * Function for delete,active or deactivate multiple cms
     *
     * @param null
     *
     * @return view page.
     */
    public function performMultipleAction()
    {
        if (Request::ajax()) {
            $actionType = ((Request::get('type'))) ? Request::get('type') : '';
            if (!empty($actionType) && !empty(Request::get('ids'))) {
                if ($actionType == 'delete') {
                    Cms::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Cms::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Cms::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

} // end CmsController()
