<?php
namespace App\Modules\Advertisement\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Advertisement\Models\Advertisement;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Session;
use Validator;
use View;

/**
 * Advertisement Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Advertisement
 */
class AdvertisementController extends BaseController
{

    public $model = 'Advertisement';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Advertisement page
     *
     * @param null
     *
     * @return view page.
     */
    public function listAdvertisement()
    {
        $DB = Advertisement::query();
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

        return View::make("Advertisement::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order'));
    } // end listAdvertisement()

    /**
     * Function for display page  for add new Advertisement page
     *
     * @param null
     *
     * @return view page.
     */
    public function addAdvertisement()
    {
        $location = CustomHelper::getConfigValue('DISPLAY_PAGE');
        return View::make("Advertisement::add", compact('location'));
    } //end addNews()

    /**
     * Function for save added	Advertisement page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveAdvertisement()
    {
        $thisData = Request::all();

        $validator = Validator::make(
            $thisData,
            array(
                'name' => 'required',
                'image'       => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'advertisement_url'  => 'nullable|url',
                'location' => 'required|unique:advertisements,location',

            ),
            array(
                'name.required' => trans('messages.advertisement_name.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'advertisement_url.url' => trans('messages.advertisement_url.VALID_URL_ERROR'),
                'location' => trans('messages.location.required_error'),
                'location.unique' => trans('messages.location.UNIQUE_BANNER_ERROR'),
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $model = new Advertisement;
            $model->title = $thisData['name'];
            $model->location = isset($thisData['location']) ? $thisData['location'] : null;
            $model->advertisement_url	 = Request::get('advertisement_url');
            $model->is_active = (int) ACTIVE;

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-advertisement-image.' . $extension;
                if (Request::file('image')->move(ADVERTISEMENT_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }
            }

			$model->save();

            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.index");
        }
    } //end saveExpert()

    /**
     * Function for display page  for edit Expert page
     *
     * @param $Id ad id of Expert page
     *
     * @return view page.
     */
    public function editAdvertisement($modelId)
    {
        $result = Advertisement::findorFail($modelId);

        if (Request::Old() != null) {
            $result->title = Request::Old('name');
            $result->advertisement_url = Request::Old('advertisement_url');
        }

        return View::make("Advertisement::edit", compact('result'));

    } // end editExpert()

    /**
     * Function for update Advertisement
     *
     * @param $modelId as id of Expert
     *
     * @return redirect page.
     */
    public function updateAdvertisement($modelId)
    {
        $this_data = Request::all();

        $model = Advertisement::findorFail($modelId);
        $oldImage = $model->image;

        $validator = Validator::make(
            $this_data,
            array(

                'name' => 'required',
                'image'        => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'advertisement_url'  => 'nullable|url',
            ),

            array(
                'name.required' => trans('messages.expert_name.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'advertisement_url.url' => trans('messages.slider_url.VALID_URL_ERROR'),
            )

        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
		else {
            $model->title = $this_data['name'];
            $model->advertisement_url = Request::get('advertisement_url');

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-advertisement-image.' . $extension;
                if (Request::file('image')->move(ADVERTISEMENT_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }

                if (file_exists(ADVERTISEMENT_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(ADVERTISEMENT_IMAGE_ROOT_PATH . $oldImage);
                }
            }

            $model->save();

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    } // end updateAdvertisement()

    /**
     * Function for view viewAdvertisement
     *
     * @param $Id as id of viewExpert
     *
     * @return redirect page.
     */
    public function viewAdvertisement($id)
    {
        $result = Advertisement::findOrFail($id);

        return View::make('Advertisement::view', compact('result', 'id'));
    } //end viewExpert()

    /**
     * Function for update Expert page status
     *
     * @param $modelId as id of Expert page
     * @param $modelStatus as status of Expert page
     *
     * @return redirect page.
     */
    public function updateAdvertisementStatus($modelId = 0, $modelStatus = 0)
    {
        Advertisement::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
    } // end updateExpertStatus()

    /**
     * Function for delete,active or deactivate multiple Expert
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
                    Advertisement::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Advertisement::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Advertisement::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

} // end ExpertController()
