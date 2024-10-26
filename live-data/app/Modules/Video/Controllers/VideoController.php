<?php
namespace App\Modules\Video\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Video\Models\Video;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Redirect;
use Request;
use Session;
use Validator;
use View;

/**
 * Video Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/Video
 */
class VideoController extends BaseController
{

    public $model = 'Video';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function for display all Video page
     *
     * @param null
     *
     * @return view page.
     */
    public function listVideo($uni_id = null)
    {
      

        $DB = Video::query();
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
        $model = $DB->where('uni_id',$uni_id)->orderBy($sortBy, $order)->paginate((int) $limit);

        return View::make("Video::index", compact('limit', 'model', 'searchVariable', 'sortBy', 'order','uni_id'));
    } // end listVideo()

    /**
     * Function for display page  for add new Video page
     *
     * @param null
     *
     * @return view page.
     */
    public function addVideo($uni_id = null)
    {

        return View::make("Video::add", compact('uni_id'));
    } //end addVideo()

    /**
     * Function for save added	Video page
     *
     * @param null
     *
     * @return redirect page.
     */
    public function saveVideo($uni_id = null)
    {
        $thisData = Request::all();

        $validator = Validator::make(
            $thisData,
            array(
                'name' => 'required',
                'short_description' => 'required',
                'duration' => 'required',
                'youtube_id' => 'required',
                'image'        => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,

            ),
            array(
                'name.required' => trans('messages.title.REQUIRE_ERROR'),
                'duration.required' => trans('messages.duration.REQUIRE_ERROR'),
                'youtube_id.required' => trans('messages.youtube_id.REQUIRE_ERROR'),
                'short_description.required' => trans('messages.description.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $model = new Video;
            $model->uni_id = isset($thisData['uni_id']) ? $thisData['uni_id'] : null;
            $model->name = $thisData['name'];
            $model->short_description = $thisData['short_description'];
            $model->duration = $thisData['duration'];
            $model->youtube_id = $thisData['youtube_id'];
            $model->slug = CustomHelper::getSlug($thisData['name'], 'slug', 'Video');
            $model->is_active = (int) ACTIVE;

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-video-image.' . $extension;
                if (Request::file('image')->move(VIDEO_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }
            }

			$model->save();

            Session::flash('success', trans("messages.$this->model.added_message"));

            if(!$uni_id == null){
                return Redirect::route("UniversityVideo.index",$uni_id);
            }else{
                return Redirect::route("$this->model.index");
            }
        }
    } //end saveVideo()

    /**
     * Function for display page  for edit Video page
     *
     * @param $Id ad id of Video page
     *
     * @return view page.
     */
    public function editVideo($modelId,$uni_id = null)
    {
        $result = Video::findorFail($modelId);

        if (Request::Old() != null) {
            $result->name = Request::Old('name');
            $result->short_description = Request::Old('short_description');
            $result->duration = Request::Old('duration');
            $result->youtube_id = Request::Old('youtube_id');
        }

        return View::make("Video::edit", compact('result','uni_id'));

    } // end editExpert()

    /**
     * Function for update Expert
     *
     * @param $modelId as id of Expert
     *
     * @return redirect page.
     */
    public function updateVideo($modelId,$uni_id = null)
    {
        $this_data = Request::all();

        $model = Video::findorFail($modelId);
        $oldImage = $model->image;

        $validator = Validator::make(
            $this_data,
            array(

                'name' => 'required',
                'short_description' => 'required',
                'duration' => 'required',
                'youtube_id' => 'required',
                'image'        => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            ),

            array(
                'name.required' => trans('messages.title.REQUIRE_ERROR'),
                'short_description.required' => trans('messages.description.REQUIRE_ERROR'),
                'duration.required' => trans('messages.duration.REQUIRE_ERROR'),
                'youtube_id.required' => trans('messages.youtube_id.REQUIRE_ERROR'),
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
            $model->duration = $this_data['duration'];
            $model->youtube_id = $this_data['youtube_id'];

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-video-image.' . $extension;
                if (Request::file('image')->move(VIDEO_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }

                if (file_exists(VIDEO_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(VIDEO_IMAGE_ROOT_PATH . $oldImage);
                }
            }

            $model->save();

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("UniversityVideo.index",$uni_id);
           
        }
    } // end updateVideo()

    /**
     * Function for view viewVideo
     *
     * @param $Id as id of viewVideo
     *
     * @return redirect page.
     */
    public function viewVideo($id,$uni_id = null)
    {
        $result = Video::findOrFail($id);

        return View::make('Video::view', compact('result', 'id','uni_id'));
    } //end viewExpert()

    /**
     * Function for update Expert page status
     *
     * @param $modelId as id of Expert page
     * @param $modelStatus as status of Expert page
     *
     * @return redirect page.
     */
    public function updateVideoStatus($modelId = 0, $modelStatus = 0,$uni_id = null)
    {
        Video::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("UniversityVideo.index",$uni_id);
       
    } // end updateVideoStatus()

    /**
     * Function for delete,active or deactivate multiple Video
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
                if ($actionType == 'delete') {
                    Video::whereIn('id', Request::get('ids'))->delete();
                } elseif ($actionType == 'active') {
                    Video::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
                } elseif ($actionType == 'inactive') {
                    Video::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    } //end performMultipleAction()

} // end VideoController()
