<?php
namespace App\Modules\Block\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Block\Models\Block;
use App\Modules\Block\Models\BlockDescription;
use Config;
use CustomHelper;
use Input;
use Redirect;
use Request;
use Route;
use Session;
use Validator;
use View;

/**
 * BlockController Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Block
 */
class BlockController extends BaseController
{

    public $model = 'Block';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Block
     *
     * @param null
     *
     * @return view page.
     */
    public function listBlock()
    {
        $DB = Block::query();
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
                if (!empty($fieldValue)) {
                    $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
                }
            }
        }

        $sortBy = (Request::input('sortBy')) ? Request::input('sortBy') : 'created_at';
        $order = (Request::input('order')) ? Request::input('order') : 'DESC';
        $recordPerPage = (Request::input('records_per_page') != '') ? Request::input('records_per_page') : Config::get("Reading.records_per_page");
        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPage);
        return View::make("Block::index", compact('recordPerPage','model', 'searchVariable', 'sortBy', 'order'));

    } // end listBlock()

    /**
     * Function for display page  for add new Block
     *
     * @param null
     *
     * @return view page.
     */
    public function addBlock()
    {
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        return View::make("Block::add", compact('languages', 'language_code'));
    } //end addBlock()

    /**
     * Function for save added Block page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveBlock()
    {
        $thisData = Request::all();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $thisData['data'][$language_code];

        $validator = Validator::make(
            array(
                'page_name' => Request::input('page_name'),
                'block_name' => Request::input('block_name'),
                'description' => $dafaultLanguageArray['description'],
            ),
            array(
                'page_name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'block_name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'description' => 'required',
            ),
            array(
				'page_name.max' => trans('messages.page_name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
				'block_name.max' => trans('messages.block_name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
                'page_name.required' => trans('messages.page_name.REQUIRED_ERROR'),
                'block_name.required' => trans('messages.block_name.REQUIRED_ERROR'),
                'description.required' => trans('messages.description.REQUIRED_ERROR'),

            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model = new Block;
            $model->page_name = ucfirst(Request::input('page_name'));
            $model->block_name = ucfirst(Request::input('block_name'));
            $model->page = CustomHelper::getSlug(Request::input('page_name'), 'page', $this->model);
            $model->block = CustomHelper::getSlug(Request::input('block_name'), 'block', $this->model);
            $model->description = $dafaultLanguageArray['description'];
            $model->save();
            $modelId = $model->id;
            foreach ($thisData['data'] as $language_id => $descriptionResult) {
                $modelDescription = new BlockDescription();
                $modelDescription->language_id = $language_id;
                $modelDescription->parent_id = $modelId;
                $modelDescription->description = $descriptionResult['description'];
                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.index");
        }
    } //end saveBlock()

    /**
     * Function for display page  for edit Block page
     *
     * @param $modelId as id of Block page
     *
     * @return view page.
     */
    public function editBlock($modelId)
    {
        $result = Block::findorFail($modelId);
        $modelDescriptions = BlockDescription::where('parent_id', '=', $modelId)->get();

        if (Request::old() != null) {
            $result->page_name = Request::old('page_name');
            $result->block_name = Request::old('block_name');
        }
        $multiLanguage = array();
        $languages = CustomHelper::getLanguageArrayWithCode();
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');

        if (!empty($modelDescriptions)) {
            foreach ($modelDescriptions as $modelDescription) {
                if (Request::old() != null) {
                    $multiLanguage[$modelDescription->language_id]['description'] = '';
                } else {
                    $multiLanguage[$modelDescription->language_id]['description'] = $modelDescription->description;
                }
            }
        }

        return View::make("Block::edit", compact('languages', 'language_code', 'result', 'multiLanguage'));
    } // end editBlock()

    /**
     * Function for update Block
     *
     * @param $modelId as id of Block
     *
     * @return redirect page.
     */
    public function updateBlock($modelId)
    {
        $this_data = Request::all();
        $model = Block::findorFail($modelId);
        $language_code = CustomHelper::getConfigValue('defaultLanguageCode');
        $dafaultLanguageArray = $this_data['data'][$language_code];


        $validator = Validator::make(
            array(
                'page_name' => Request::input('page_name'),
                'block_name' => Request::input('block_name'),
                'description' => $dafaultLanguageArray['description'],
            ),
            array(
                'page_name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'block_name' => 'required|max:' . CMS_PAGE_NAME_LIMIT,
                'description' => 'required',
            ),
            array(
				'page_name.max' => trans('messages.page_name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
				'block_name.max' => trans('messages.block_name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]),
                'page_name.required' => trans('messages.page_name.REQUIRED_ERROR'),
                'block_name.required' => trans('messages.block_name.REQUIRED_ERROR'),
                'description.required' => trans('messages.description.REQUIRED_ERROR'),

            )
        );


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model->block_name = ucfirst(Request::input('block_name'));
            $model->description = $dafaultLanguageArray['description'];
            $model->save();

            BlockDescription::where('parent_id', $modelId)->delete();
            foreach ($this_data['data'] as $language_id => $descriptionResult) {
                $modelDescription = new BlockDescription();
                $modelDescription->language_id = $language_id;
                $modelDescription->parent_id = $modelId;
                $modelDescription->description = $descriptionResult['description'];
                $modelDescription->save();
            }

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    } // end updateBlock()

    /**
     * Function for delete Block
     *
     * @param $modelId as id of Block
     *
     * @return redirect page.
     */
    public function deleteBlock($modelId = 0)
    {
        if ($modelId) {
            $model = Block::where('id', $modelId)->delete();
            Session::flash('success', trans("messages.$this->model.deleted_message"));
        }
        return Redirect::route("$this->model.index");
    } // end deleteBlock()

} // end BlockController
