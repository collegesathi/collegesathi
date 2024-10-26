<?php
namespace App\Modules\Expert\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Expert\Models\Expert;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Session;
use Validator;
use View;

/**
 * Expert Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Expert
 */
class ExpertController extends BaseController
{

    public $model = 'Expert';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Expert page
     *
     * @param null
     *
     * @return view page.
     */
    public function listExpert()
    {
        ### Breadcrums is added here dynamically ###
       /*  Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"), route('AdminDashBoard.index'));
        Breadcrumb::addBreadcrumb(trans("messages.$this->model.breadcrumbs_module"), route($this->model . '.index'));
        $breadcrumbs = Breadcrumb::generate(); */
        ### breadcrumbs End ###

        $DB = Expert::query();
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
        $model = $DB->withCount('expertEnquiry')->orderBy($sortBy, $order)->paginate((int) $limit);

        return View::make("Expert::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order'));
    } // end listExpert()

    /**
     * Function for display page  for add new Expert page
     *
     * @param null
     *
     * @return view page.
     */
    public function addExpert()
    {

        return View::make("Expert::add");
    } //end addNews()

    /**
     * Function for save added	Expert page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveExpert()
    {
        $thisData = Request::all();

        $validator = Validator::make(
            $thisData,
            array(
                'name' => 'required',
                'short_description' => 'required',
                'designation' => 'required',
                'image'        => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,

            ),
            array(
                'name.required' => trans('messages.expert_name.REQUIRE_ERROR'),
                'designation.required' => trans('messages.designation.REQUIRE_ERROR'),
                'short_description.required' => trans('messages.description.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $model = new Expert;
            $model->name = $thisData['name'];
            $model->short_description = $thisData['short_description'];
            $model->designation = $thisData['designation'];
            $model->slug = CustomHelper::getSlug($thisData['name'], 'slug', 'Expert');
            $model->is_active = (int) ACTIVE;

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-expert-image.' . $extension;
                if (Request::file('image')->move(EXPERT_IMAGE_ROOT_PATH, $fileName)) {
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
    public function editExpert($modelId)
    {
        $result = Expert::findorFail($modelId);

        if (Request::Old() != null) {
            $result->name = Request::Old('name');
            $result->short_description = Request::Old('short_description');
            $result->designation = Request::Old('designation');
        }

        return View::make("Expert::edit", compact('result'));

    } // end editExpert()

    /**
     * Function for update Expert
     *
     * @param $modelId as id of Expert
     *
     * @return redirect page.
     */
    public function updateExpert($modelId)
    {
        $this_data = Request::all();

        $model = Expert::findorFail($modelId);
        $oldImage = $model->image;

        $validator = Validator::make(
            $this_data,
            array(

                'name' => 'required',
                'short_description' => 'required',
                'designation' => 'required',
                'image'        => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            ),

            array(
                'name.required' => trans('messages.expert_name.REQUIRE_ERROR'),
                'short_description.required' => trans('messages.description.REQUIRE_ERROR'),
                'designation.required' => trans('messages.designation.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            )

        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
		else {
            $model->name = $this_data['name'];
            $model->short_description = $this_data['short_description'];
            $model->designation = $this_data['designation'];

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-expert-image.' . $extension;
                if (Request::file('image')->move(EXPERT_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }

                if (file_exists(EXPERT_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(EXPERT_IMAGE_ROOT_PATH . $oldImage);
                }
            }

            $model->save();

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    } // end updateExpert()

    /**
     * Function for view viewExpert
     *
     * @param $Id as id of viewExpert
     *
     * @return redirect page.
     */
    public function viewExpert($id)
    {
        $result = Expert::findOrFail($id);

        return View::make('Expert::view', compact('result', 'id'));
    } //end viewExpert()

    /**
     * Function for update Expert page status
     *
     * @param $modelId as id of Expert page
     * @param $modelStatus as status of Expert page
     *
     * @return redirect page.
     */
    public function updateExpertStatus($modelId = 0, $modelStatus = 0)
    {
        Expert::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
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
                    Expert::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Expert::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Expert::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

} // end ExpertController()
