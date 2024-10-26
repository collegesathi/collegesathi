<?php

namespace App\Modules\University\Controllers;

use App\Modules\University\Models\University;
use App\Modules\University\Models\UniversityCampus;
use App\Modules\University\Models\UniversityPlacementPartner;
use App\Modules\University\Models\UniversityBadge;
use App\Modules\University\Models\UniversityLoanPartner;
use App\Http\Controllers\BaseController;
use App\Modules\University\Models\Course;
use App\Modules\University\Models\CourseSpecification;
use Config;
use CustomHelper;
use Redirect;
use Request;
use Session;
use Validator;
use View;
   

/**
 * University Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/University
 */

class UniversityController extends BaseController
{

    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'University';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    public function listUniversity()
    {


        $DB = University::query();
        $DB->withCount('UniversityApplications as total_applications');


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
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        $activeCount = $DB->where('is_active', ACTIVE)->get()->count();

        return View::make("University::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'activeCount'));
    } // end listTeam()


    /**
     * Function for display page for add new image on Team
     *
     * @param null
     *
     * @return view page.
     */
    public function addUniversity()
    {
        $placementPartners = CustomHelper::getMasterDropdown('placement_partners');
        $selectedPlacementPartners = !empty(Request::old('university_placement_partners')) ? Request::old('university_placement_partners') : array();
        $badges = CustomHelper::getMasterDropdown('badges');
        $selectedBadges = !empty(Request::old('university_badges_id')) ? Request::old('university_badges_id') : array();
        return View::make("University::add", compact('placementPartners', 'selectedPlacementPartners', 'badges', 'selectedBadges'));
    } // end addTeam()


    /**
     * Function for save images and description  for Team
     *
     * @param null
     * 
     * @return redirect page.
     */
    public function saveUniversity()
    {
        $thisData = Request::all();
        $validator = Validator::make(
            $thisData,
            array(
                'title'                      => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
                'short_text'                 => 'required',
                'file'                       => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . PDF_EXTENSION,
                'image'                      => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'description'                 => 'required',
                'short_description'             => 'required',
                'university_approval'        => 'required',
                'emi_detail'                 => 'required',
                'admission_process'             => 'required',
                'examination_pattern'         => 'required',
                'placement_partners'         => 'required',
                'meta_title' => 'required|max:' . CMS_PAGE_META_TITLE_LIMIT,
                'meta_description' => 'required|max:' . CMS_PAGE_META_DESCRIPTION_LIMIT,
                'meta_keywords' => 'required|max:' . CMS_PAGE_META_KEYWORDS_LIMIT,
                'nirf_ranking'  =>  'required|numeric',
                'university_badges_id' => 'required',
                'management_specialisations'                 => 'required',
                'ranking'                 => 'required',
                'eligibility_criteria'                 => 'required',
                'university_advantages'                 => 'required',
                'university_certificate_image'       => 'mimes:' . IMAGE_EXTENSION,
                'tag_line'                     => 'required',
                'display_order'                => 'nullable|numeric'/*'|unique:universities,display_order'*/,
            ),
            array(
                'title.required' => trans('messages.university_title.REQUIRE_ERROR'),
                'title.max' => trans('messages.university_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
                'short_text.required' =>  trans('messages.university.short_text_REQUIRE_ERROR'),
                'file.required' => trans('messages.file.required_error'),
                'file.mimes' => trans('messages.file.VALID_FILE_ERROR', ['file_extension' => PDF_EXTENSION]),
                'file.max' => trans('messages.file.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'description.required' =>  trans('messages.university.DESCRIPTION_REQUIRE_ERROR'),
                'short_description.required' =>  trans('messages.university.short_description_REQUIRE_ERROR'),
                'university_approval.required' =>  trans('messages.university.university_approval_REQUIRE_ERROR'),
                'emi_detail.required' =>  trans('messages.university.emi_detail_REQUIRE_ERROR'),
                'admission_process.required' =>  trans('messages.university.admission_process_REQUIRE_ERROR'),
                'examination_pattern.required' =>  trans('messages.university.examination_pattern_REQUIRE_ERROR'),
                'placement_partners.required' =>  trans('messages.university.placement_partners_REQUIRE_ERROR'),
                'meta_title.required' => trans('messages.meta_title.REQUIRE_ERROR'),
                'meta_description.required' => trans('messages.meta_description.REQUIRE_ERROR'),
                'meta_keywords.required' => trans('messages.meta_keywords.REQUIRE_ERROR'),
                'meta_title.max' => trans('messages.meta_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_TITLE_LIMIT]),
                'meta_description.max' => trans('messages.meta_description.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_DESCRIPTION_LIMIT]),
                'meta_keywords.max' => trans('messages.meta_keywords.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_META_KEYWORDS_LIMIT]),
                'nirf_ranking.required' => trans('messages.nirf_ranking.REQUIRE_ERROR'),
                'nirf_ranking.numeric' => trans('messages.nirf_ranking.NUMERIC_ERROR'),
                'university_badges_id.required' => trans('messages.university_badges.REQUIRE_ERROR'),
                'management_specialisations.required' => trans('messages.university_management_specialisations.REQUIRE_ERROR'),
                'ranking.required' => trans('messages.university_ranking.REQUIRE_ERROR'),
                'eligibility_criteria.required' => trans('messages.university_eligibility_criteria.REQUIRE_ERROR'),
                'university_advantages.required' => trans('messages.university_advantages.REQUIRE_ERROR'),
                'university_certificate_image.max' => trans('messages.university_certificate_image.mimes', ['mimes' => IMAGE_EXTENSION]),
                'tag_line.required'   => trans('messages.university.tag_line'),
                'display_order.numeric'  => trans('messages.display_order.numeric'),
                // 'display_order.unique'  => trans('messages.display_order.unique'),
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model = new University;
            $model->title = $thisData['title'];
            $model->tag_line  = $thisData['tag_line'];
            $model->slug = CustomHelper::getSlug($thisData['title'], 'slug', 'University');
            $model->short_text = $thisData['short_text'];
            $model->nirf_ranking = (int)$thisData['nirf_ranking'];
            $model->description = $thisData['description'];
            $model->short_description = $thisData['short_description'];
            $model->university_facts = $thisData['university_facts'];
            $model->university_approval = $thisData['university_approval'];
            $model->emi_detail = $thisData['emi_detail'];
            $model->admission_process = $thisData['admission_process'];
            $model->examination_pattern = $thisData['examination_pattern'];
            $model->placement_partners = $thisData['placement_partners'];
            $model->meta_title = $thisData['meta_title'];
            $model->meta_description = $thisData['meta_description'];
            $model->meta_keywords = $thisData['meta_keywords'];
            $model->is_active = (int) ACTIVE;

            $model->university_advantages = $thisData['university_advantages'];
            $model->eligibility_criteria = $thisData['eligibility_criteria'];
            $model->ranking = $thisData['ranking'];
            $model->management_specialisations = $thisData['management_specialisations'];
            $model->program  = isset($thisData['program']) && !empty($thisData['program']) ? $thisData['program'] : INACTIVE;
            $model->display_order  = isset($thisData['display_order']) && !empty($thisData['display_order']) ? $thisData['display_order'] : null;

            $model->collaborate_university_home_top = isset($thisData['collaborate_university_home_top']) && !empty($thisData['collaborate_university_home_top']) ? (int)$thisData['collaborate_university_home_top'] : INACTIVE;
           

            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-university-image.' . $extension;
                if (Request::file('image')->move(UNIVERSITY_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }
            }

            if (Request::hasFile('file')) {
                $extension = Request::file('file')->getClientOriginalExtension();
                $fileName = time() . '-university-file.' . $extension;
                if (Request::file('file')->move(UNIVERSITY_IMAGE_ROOT_PATH, $fileName)) {
                    $model->file = $fileName;
                }
            }

            if (Request::hasFile('university_certificate_image')) {
                $extension = Request::file('university_certificate_image')->getClientOriginalExtension();
                $fileName = time() . '-university-certificate.' . $extension;
                if (Request::file('university_certificate_image')->move(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH, $fileName)) {
                    $model->university_certificate_image = $fileName;
                }
            }

            if ($model->save()) {
                if (isset($obj->university_placement_partners)) {
                    $obj = new UniversityPlacementPartner;
                    $obj->university_placement_partners = implode(",", $thisData['university_placement_partners']);
                    $obj->university_id = $model->id;
                    $obj->save();
                }

                $badges = new UniversityBadge;
                $badges->university_badges_id = implode(",", $thisData['university_badges_id']);
                $badges->university_id = $model->id;
                $badges->save();
            }



            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.index");
        }
    } // end saveSlider()

    /**
     * Function for display page for edit image and description for slider
     *
     * @param $sliderId id  of image for slider
     *
     * @return view page.
     */
    public function editUniversity($modelId = 0)
    {
        $result = University::with('universityPlacementPartners', 'universityBadges')->findorFail($modelId);

        if (Request::Old() != null) {
            $result->title                   = Request::Old('title');
            $result->short_text              = Request::Old('short_text');
            $result->description             = Request::Old('description');
            $result->short_description       = Request::Old('short_description');
            $result->university_facts        = Request::Old('university_facts');
            $result->university_approval     = Request::Old('university_approval');
            $result->emi_detail              = Request::Old('emi_detail');
            $result->admission_process       = Request::Old('admission_process');
            $result->examination_pattern     = Request::Old('examination_pattern');
            $result->placement_partners      = Request::Old('placement_partners');
            $result->meta_title = Request::Old('meta_title');
            $result->meta_description = Request::Old('meta_description');
            $result->meta_keywords = Request::Old('meta_keywords');
            if (isset($result->universityPlacementPartners->university_placement_partners)) {
                $result->universityPlacementPartners->university_placement_partners = !empty(Request::old('university_placement_partners')) ? implode(',', Request::old('university_placement_partners')) : '';
            }
            $result->universityBadges->university_badges_id = !empty(Request::old('university_badges_id')) ? implode(',', Request::old('university_badges_id')) : '';

            $result->tag_line  = Request::Old('tag_line');
            $result->program = Request::Old('program');
            $result->display_order  = Request::Old('display_order');
            $result->collaborate_university_home_top = Request::Old('collaborate_university_home_top');
        }

        $placementPartners = CustomHelper::getMasterDropdown('placement_partners');
        $badges = CustomHelper::getMasterDropdown('badges');
        return View::make("University::edit", compact('result', 'placementPartners', 'badges'));
    } // end editSlider()

    /**
     * Function for save updated image and description for slider
     *
     * @param null
     *
     * @return redirect page.
     */
    public function updateUniversity($modelId)
    {
        $this_data = Request::all();
        $model = University::with('universityPlacementPartners', 'universityBadges')->findorFail($modelId);
        $oldFile = $model->file;
        $oldImage = $model->image;
        $oldCertificateImage = $model->university_certificate_image;

        $validator = Validator::make(
            $this_data,
            array(
                'title' => 'required|max:' . CMS_PAGE_TITLE_LIMIT,
                'short_text' => 'required',
                'file'  => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . PDF_EXTENSION,
                'image'        => 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'description'                 => 'required',
                'short_description'             => 'required',
                'university_approval'        => 'required',
                'emi_detail'                 => 'required',
                'admission_process'             => 'required',
                'examination_pattern'         => 'required',
                'placement_partners'         => 'required',
                'meta_title' => 'required|max:' . CMS_PAGE_META_TITLE_LIMIT,
                'meta_description' => 'required|max:' . CMS_PAGE_META_DESCRIPTION_LIMIT,
                'meta_keywords' => 'required|max:' . CMS_PAGE_META_KEYWORDS_LIMIT,
                'nirf_ranking'  =>  'required|numeric',
                'university_badges_id' => 'required',
                'management_specialisations'                 => 'required',
                'ranking'                 => 'required',
                'eligibility_criteria'                 => 'required',
                'university_advantages'                 => 'required',
                'university_certificate_image'       => 'mimes:' . IMAGE_EXTENSION,
                'tag_line'  => 'required',
                'display_order'                => 'nullable|numeric'/*'|unique:universities,display_order,' . $modelId . ',id'*/,
            ),
            array(
                'title.required' => trans('messages.university_title.REQUIRE_ERROR'),
                'title.max' => trans('messages.university_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
                'short_text.required' =>  trans('messages.university.short_text_REQUIRE_ERROR'),
                'file.mimes' => trans('messages.file.VALID_FILE_ERROR', ['file_extension' => PDF_EXTENSION]),
                'file.max' => trans('messages.file.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'description.required' =>  trans('messages.university.DESCRIPTION_REQUIRE_ERROR'),
                'short_description.required' =>  trans('messages.university.short_description_REQUIRE_ERROR'),
                'university_approval.required' =>  trans('messages.university.university_approval_REQUIRE_ERROR'),
                'emi_detail.required' =>  trans('messages.university.emi_detail_REQUIRE_ERROR'),
                'admission_process.required' =>  trans('messages.university.admission_process_REQUIRE_ERROR'),
                'examination_pattern.required' =>  trans('messages.university.examination_pattern_REQUIRE_ERROR'),
                'placement_partners.required' =>  trans('messages.university.placement_partners_REQUIRE_ERROR'),
                'meta_title.required' => trans('messages.meta_title.REQUIRE_ERROR'),
                'meta_description.required' => trans('messages.meta_description.REQUIRE_ERROR'),
                'meta_keywords.required' => trans('messages.meta_keywords.REQUIRE_ERROR'),
                'nirf_ranking.required' => trans('messages.nirf_ranking.REQUIRE_ERROR'),
                'nirf_ranking.numeric' => trans('messages.nirf_ranking.NUMERIC_ERROR'),
                'university_badges_id.required' => trans('messages.university_badges.REQUIRE_ERROR'),
                'management_specialisations.required' => trans('messages.university_management_specialisations.REQUIRE_ERROR'),
                'ranking.required' => trans('messages.university_ranking.REQUIRE_ERROR'),
                'eligibility_criteria.required' => trans('messages.university_eligibility_criteria.REQUIRE_ERROR'),
                'university_advantages.required' => trans('messages.university_advantages.REQUIRE_ERROR'),
                'university_certificate_image.max' => trans('messages.university_certificate_image.mimes', ['mimes' => IMAGE_EXTENSION]),
                'tag_line.required'   => trans('messages.university.tag_line'),
                'display_order.numeric'  => trans('messages.display_order.numeric'),
                // 'display_order.unique'  => trans('messages.display_order.unique'),
            )

        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model->title = $this_data['title'];
            $model->tag_line = $this_data['tag_line'];
            $model->short_text = $this_data['short_text'];
            $model->nirf_ranking = (int)$this_data['nirf_ranking'];
            $model->description = $this_data['description'];
            $model->short_description = $this_data['short_description'];
            $model->university_facts = $this_data['university_facts'];
            $model->university_approval = $this_data['university_approval'];
            $model->emi_detail = $this_data['emi_detail'];
            $model->admission_process = $this_data['admission_process'];
            $model->examination_pattern = $this_data['examination_pattern'];
            $model->placement_partners = $this_data['placement_partners'];
            $model->meta_title = $this_data['meta_title'];
            $model->meta_description = $this_data['meta_description'];
            $model->meta_keywords = $this_data['meta_keywords'];
            $model->university_advantages = $this_data['university_advantages'];
            $model->eligibility_criteria = $this_data['eligibility_criteria'];
            $model->ranking = $this_data['ranking'];
            $model->management_specialisations = $this_data['management_specialisations'];
            $model->program  = isset($this_data['program']) && !empty($this_data['program']) ? $this_data['program'] : INACTIVE;
            $model->display_order  = isset($this_data['display_order']) && !empty($this_data['display_order']) ? $this_data['display_order'] : null;
            
            $model->collaborate_university_home_top = isset($this_data['collaborate_university_home_top']) && !empty($this_data['collaborate_university_home_top']) ? (int)$this_data['collaborate_university_home_top'] : INACTIVE;
            
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-university-image.' . $extension;
                if (Request::file('image')->move(UNIVERSITY_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }

                if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(UNIVERSITY_IMAGE_ROOT_PATH . $oldImage);
                }
            }


            if (Request::hasFile('file')) {
                $extension = Request::file('file')->getClientOriginalExtension();
                $fileName = time() . '-university-file.' . $extension;
                if (Request::file('file')->move(UNIVERSITY_IMAGE_ROOT_PATH, $fileName)) {
                    $model->file = $fileName;
                }

                if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $oldFile)) {
                    @unlink(UNIVERSITY_IMAGE_ROOT_PATH . $oldFile);
                }
            }

            if (Request::hasFile('university_certificate_image')) {
                $extension = Request::file('university_certificate_image')->getClientOriginalExtension();
                $fileName = time() . '-university-certificate.' . $extension;
                if (Request::file('university_certificate_image')->move(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH, $fileName)) {
                    $model->university_certificate_image = $fileName;
                }

                if (file_exists(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH . $oldCertificateImage)) {
                    @unlink(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH . $oldCertificateImage);
                }
            }

            if ($model->save()) {
                if (isset($model->universityPlacementPartners) && !empty($model->universityPlacementPartners)) {
                    $obj = UniversityPlacementPartner::findorFail($model->universityPlacementPartners->id);
                    $obj->delete();
                }

                if (isset($this_data['university_placement_partners']) && !empty($this_data['university_placement_partners'])) {
                    $obj = new UniversityPlacementPartner;
                    $obj->university_placement_partners = implode(",", $this_data['university_placement_partners']);
                    $obj->university_id = $model->id;
                    $obj->save();
                }

                if (isset($model->universityBadges) && !empty($model->universityBadges)) {
                    $badge = UniversityBadge::findorFail($model->universityBadges->id);
                    $badge->delete();
                }

                if (isset($this_data['university_badges_id']) && !empty($this_data['university_badges_id'])) {
                    $badge = new UniversityBadge;
                    $badge->university_badges_id = implode(",", $this_data['university_badges_id']);
                    $badge->university_id = $model->id;
                    $badge->save();
                }
            }

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.index");
        }
    } // end updateSlider()

    /**
     * Function for display all clients
     *
     * @param $sliderId as id of image on slider
     *
     * @return redirect page.
     */

    public function deleteUniversity($modelId = 0)
    {
        if ($modelId) {
            $UniversityDetail = University::where('id', $modelId)->first();

            if (!empty($UniversityDetail)) {
                $file = $UniversityDetail->file;

                if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $file)) {
                    @unlink(UNIVERSITY_IMAGE_ROOT_PATH . $file);
                }
            }
            $model = University::where('id', $modelId)->delete();
            Course::where('univercity_id',$modelId)->update(array('active' => (int)INACTIVE));
            Session::flash('success', trans("messages.$this->model.deleted_message"));
        }
        return Redirect::route("$this->model.index");
    } // end deleteSlider()

    /**
     * Function for change status of slider image
     *
     * @param $sliderId as id of image on slider
     * @param $sliderStatus as status of image for slider
     *
     * @return redirect page.
     */

    public function updateUniversityStatus($modelId = 0, $modelStatus = 0)
    {
        University::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Course::where('univercity_id',$modelId)->update(array('active' => (int) $modelStatus));
        CourseSpecification::where('univercity_id',$modelId)->update(array('active' => (int) $modelStatus));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.index");
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
                    University::whereIn('id', Request::get('ids'))->update(array('is_active' => 1));
                } elseif ($actionType == 'inactive') {
                    University::whereIn('id', Request::get('ids'))->update(array('is_active' => 0));
                } elseif ($actionType == 'delete') {
                    University::whereIn('id', Request::get('ids'))->delete();
                }
                Session::flash('success', trans("messages.global.action_performed_message"));
            }
        }
    }

    public function viewUniversity($id)
    {
        $result = University::findOrFail($id);

        return View::make('University::view', compact('result', 'id'));
    }

    public function downloadDocument($id)
    {
        $result = University::where('id', $id)->first();

        $downloadPath    =    UNIVERSITY_IMAGE_ROOT_PATH;
        $fileName        =    isset($result['file']) ? $result['file'] : "";
        $filePath        =    UNIVERSITY_IMAGE_ROOT_PATH . $fileName;

        if (!empty($fileName) && file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            Session::flash(ERROR, trans("messages.$this->model.file_not_exists"));
            return Redirect::route("$this->model.edit", $id);
        }
    }





    public function listCampuses($id)
    {
        $DB = UniversityCampus::query();
        $universityName = CustomHelper::getFieldValueByFieldName($id, 'id', 'University', 'title', 'University');
        $campusType = Config::get('CAMPUS_TYPE');

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
                    if ($fieldName == 'campus_type') {
                        $DB->where('campus_type', (int)$fieldValue);
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->where('university_id', $id)->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        return View::make("University::Campus.index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'id', 'universityName', 'campusType'));
    }




    public function saveCampus()
    {
        $formData = Request::all();
        if (Request::ajax()) {
            $validator = Validator::make(
                $formData,
                array(
                    'campus_type' => 'required',
                    'campus_name' => 'required',
                ),
                array(
                    'campus_type.required' => trans('messages.campus_type.REQUIRE_ERROR'),
                    'campus_name.required' => trans('messages.campus_name.REQUIRE_ERROR'),
                )
            );

            if ($validator->fails()) {
                return array('status' => "error", 'errors' => $validator->errors()->toArray());
            } else {
                $model = new UniversityCampus;
                $model->campus_name = $formData['campus_name'];
                $model->campus_type = (int)$formData['campus_type'];
                $model->university_id = $formData['university_id'];
                if ($model->save()) {
                    return array('status' => "success");
                }
            }
        }
    }





    public function deleteUniversityCampus($modelId = 0, $uniId = 0)
    {
        if ($modelId) {
            UniversityCampus::where('id', $modelId)->delete();
            Session::flash('success', trans("messages.$this->model.campus_deleted_message"));
        }
        return Redirect::route("$this->model.campuses", $uniId);
    }





    public function loanPartners($id)
    {
        $DB = UniversityLoanPartner::with('universityName');
        $universityName = CustomHelper::getFieldValueByFieldName($id, 'id', 'University', 'title', 'University');

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
                    $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->where('university_id', $id)->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        return View::make("University::LoanPartners.index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'id', 'universityName'));
    }





    public function addLoanPartners($id)
    {
        $universityName = CustomHelper::getFieldValueByFieldName($id, 'id', 'University', 'title', 'University');

        return View::make("University::LoanPartners.add", compact('universityName', 'id'));
    }




    public function saveLoanPartners()
    {
        $formData = Request::all();
        $validator = Validator::make(
            $formData,
            array(
                'loan_partner' => 'required',
                'image'        => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            ),
            array(
                'loan_partner.required' => trans('messages.loan_partner.REQUIRE_ERROR'),
                'image.required' => trans('messages.image.required_error'),
                'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]),
                'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $model = new UniversityLoanPartner;
            $model->university_id = $formData['university_id'];
            $model->loan_partner = $formData['loan_partner'];
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-university-image.' . $extension;
                if (Request::file('image')->move(LOAN_PARTNER_IMAGE_ROOT_PATH, $fileName)) {
                    $model->image = $fileName;
                }
            }

            $model->save();
            Session::flash('success', trans("messages.$this->model.loan_partner_added_message"));
            return Redirect::route("$this->model.loan_partners", $formData['university_id']);
        }
    }




    public function deleteLoanPartner($modelId = 0, $uniId = 0)
    {
        if ($modelId) {
            $loanPartner = UniversityLoanPartner::findOrFail($modelId);
            if (file_exists(LOAN_PARTNER_IMAGE_ROOT_PATH . $loanPartner->image)) {
                @unlink(LOAN_PARTNER_IMAGE_ROOT_PATH . $loanPartner->image);
            }
            $loanPartner->delete();
            Session::flash('success', trans("messages.$this->model.loan_partner_deleted_message"));
        }
        return Redirect::route("$this->model.loan_partners", $uniId);
    }
}
