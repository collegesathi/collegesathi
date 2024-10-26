<?php
namespace App\Modules\University\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\University\Models\Course;
use App\Modules\University\Models\Semester;
use Config;
use CustomHelper;
use Request, Redirect,Session;
use Validator;
use View;


/**
 * UniversityApplication Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/UniversityApplication
 */
class CourseController extends BaseController
{
    /**
     * Function for display list of all images for Team
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'Course';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function listCourses($univercityId = 0)
    {
        $DB = Course::query();

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
                        $DB->where('active', (int) $fieldValue);
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

        $model = $DB->where('univercity_id', $univercityId)->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        $activeCount = $DB->where('active', ACTIVE)->get()->count();

        return View::make("University::Course.index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'activeCount', 'univercityId'));
    }



    public function addCourses($univercityId = 0)
    {
        $courseDropdown         = CustomHelper::getMasterDropdown('course');
        $courseCategoryDropdown = CustomHelper::getConfigValue('COURSE_CATEGORY_TYPE_DROPDOWN');
        return View::make("University::Course.add", compact('univercityId', 'courseDropdown','courseCategoryDropdown'));
    }


    public function saveCourses()
    {
        $thisData = Request::all();
        $validator = Validator::make(
            $thisData,
            array(
                'course_id'                 => 'required',
                'per_semester_fee'           => 'required|numeric',
                'total_fee'           => 'required|numeric',
                'one_time_fee'           => 'required|numeric',
                'tag_line'           => 'required',
                'image'                 => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'number_of_semesters' => 'required|numeric',
                'about_course' => 'required',
                'eligibility_criteria' => 'required',
                'management_specialisations' => 'required',
                'course_category' => 'required',
                'course_certificate_image' => 'mimes:' . IMAGE_EXTENSION,
                'display_order' => 'nullable|unique_course_display_order:'.$thisData['univercity_id']
            ),
            array(
                'course_id.required'            => trans('messages.course.course_id_error'),
                'per_semester_fee.required'      => trans('messages.course.per_semester_fee'),
                'per_semester_fee.numeric'      => trans('messages.course.per_semester_fee_numeric'),
                'image.required'            => trans('messages.course.image.required_error'),
                'image.mimes'               => trans('messages.course.image.VALID_IMAGE_ERROR'),
                'image.max'                 => trans('messages.course.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'total_fee.required'       => trans('messages.course.total_fee'),
                'one_time_fee.required'       => trans('messages.course.one_time_fee'),
                'tag_line.required'       => trans('messages.course.tag_line'),
                'total_fee.numeric'       => trans('messages.course.total_fee_numeric'),
                'one_time_fee.numeric'       => trans('messages.course.one_time_fee_numeric'),
                'number_of_semesters.required'       => trans('messages.course.number_of_semesters_error'),
                'number_of_semesters.numeric'       => trans('messages.course.number_of_semesters_numeric_error'),
                'about_course.required'       => trans('messages.course.about_course_error'),
                'eligibility_criteria.required'       => trans('messages.course.eligibility_criteria_error'),
                'management_specialisations.required'       => trans('messages.course.management_specialisations_error'),
                'course_category.required'       => trans('messages.course.course_category_error'),
                'course_certificate_image.mimes' => trans('messages.course_certificate_image.mimes', ['mimes' => IMAGE_EXTENSION]),
                'display_order.unique_course_display_order' => trans('messages.course.display_order_unique_error')
            ),

        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj     =  new Course;
            $obj->active   = (int)ACTIVE;
            $obj->name = CustomHelper::getMasterDropdownNameById($thisData['course_id']);
            $obj->slug = CustomHelper::getSlug($obj->name, 'slug', 'Course','University');
            $obj->course_id = isset($thisData['course_id']) && !empty($thisData['course_id']) ? $thisData['course_id'] : "";
            $obj->per_semester_fee  = isset($thisData['per_semester_fee']) && !empty($thisData['per_semester_fee']) ? (float)$thisData['per_semester_fee'] : "";
            $obj->total_fee  = isset($thisData['total_fee']) && !empty($thisData['total_fee']) ? (float)$thisData['total_fee'] : "";
            $obj->one_time_fee  = isset($thisData['one_time_fee']) && !empty($thisData['one_time_fee']) ? (float)$thisData['one_time_fee'] : "";
            $obj->tag_line  = isset($thisData['tag_line']) && !empty($thisData['tag_line']) ? $thisData['tag_line'] : "";
            $obj->univercity_id  = isset($thisData['univercity_id']) && !empty($thisData['univercity_id']) ? $thisData['univercity_id'] : "";
            $obj->number_of_semesters  = isset($thisData['number_of_semesters']) && !empty($thisData['number_of_semesters']) ? (int)$thisData['number_of_semesters'] : "";
            $obj->about_course  = isset($thisData['about_course']) && !empty($thisData['about_course']) ? $thisData['about_course'] : "";
            $obj->management_specialisations  = isset($thisData['management_specialisations']) && !empty($thisData['management_specialisations']) ? $thisData['management_specialisations'] : "";
            $obj->eligibility_criteria  = isset($thisData['eligibility_criteria']) && !empty($thisData['eligibility_criteria']) ? $thisData['eligibility_criteria'] : "";
            $obj->course_category  = isset($thisData['course_category']) && !empty($thisData['course_category']) ? $thisData['course_category'] : "";
            $obj->is_featured  = isset($thisData['is_featured']) && !empty($thisData['is_featured']) ? $thisData['is_featured'] : INACTIVE;

            $obj->is_admission_open  = isset($thisData['is_admission_open']) && !empty($thisData['is_admission_open']) ? $thisData['is_admission_open'] : INACTIVE;
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-course-image.' . $extension;
                if (Request::file('image')->move(COURSE_IMAGE_ROOT_PATH, $fileName)) {
                    $obj->image = $fileName;
                }
            }

            if (Request::hasFile('course_certificate_image')) {
                $extension = Request::file('course_certificate_image')->getClientOriginalExtension();
                $fileName = time() . '-course-certificate.' . $extension;
                if (Request::file('course_certificate_image')->move(COURSE_CERTIFICATE_IMAGE_ROOT_PATH, $fileName)) {
                    $obj->course_certificate_image = $fileName;
                }
            }  


            $obj->program  = isset($thisData['program']) && !empty($thisData['program']) ? $thisData['program'] : INACTIVE;
            $obj->specialization  = isset($thisData['specialization']) && !empty($thisData['specialization']) ? $thisData['specialization'] : INACTIVE;
            $obj->display_order  = isset($thisData['display_order']) && !empty($thisData['display_order']) ? $thisData['display_order'] : INACTIVE;
            $obj->save();

            Session::flash('success', trans("messages.$this->model.added_message"));
            return Redirect::route("$this->model.listCourse", $thisData['univercity_id']);
        }
    }


    public function editCourses($id)
    {
        $result = Course::find($id);
        $courseDropdown = CustomHelper::getMasterDropdown('course');
        $courseCategoryDropdown = CustomHelper::getConfigValue('COURSE_CATEGORY_TYPE_DROPDOWN');
        return View::make("University::Course.edit", compact('result', 'courseDropdown', 'id','courseCategoryDropdown'));
    }


 
    public function updateCourses($id)
    {
        $thisData = Request::all();
        $obj = Course::findorFail($id);
        $oldImage = $obj->image;
        $oldCourseCertificateImage = $obj->course_certificate_image;
        $validator = Validator::make(
            $thisData,
            array(
                'course_id'                 => 'required',
                'per_semester_fee'           => 'required|numeric',
                'total_fee'           => 'required|numeric',
                'one_time_fee'           => 'required|numeric',
                'tag_line'           => 'required',
                'image'                 => 'max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
                'number_of_semesters' => 'required|numeric',
                'about_course' => 'required',
                'management_specialisations' => 'required',
                'eligibility_criteria' => 'required',
                'course_category' => 'required',
                'course_certificate_image' => 'mimes:' . IMAGE_EXTENSION,
                'display_order' => 'nullable|unique_course_display_order:'.$thisData['univercity_id'] . ',' . $id
            ),
            array(
                'course_id.required'            => trans('messages.course.course_id_error'),
                'per_semester_fee.required'      => trans('messages.course.per_semester_fee'),
                'per_semester_fee.numeric'      => trans('messages.course.per_semester_fee_numeric'),
                'image.required'            => trans('messages.course.image.required_error'),
                'image.mimes'               => trans('messages.course.image.VALID_IMAGE_ERROR'),
                'image.max'                 => trans('messages.course.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
                'total_fee.required'       => trans('messages.course.total_fee'),
                'one_time_fee.required'       => trans('messages.course.one_time_fee'),
                'tag_line.required'       => trans('messages.course.tag_line'),
                'total_fee.numeric'       => trans('messages.course.total_fee_numeric'),
                'one_time_fee.numeric'       => trans('messages.course.one_time_fee_numeric'),
                'number_of_semesters.required'       => trans('messages.course.number_of_semesters_error'),
                'number_of_semesters.numeric'       => trans('messages.course.number_of_semesters_numeric_error'),
                'about_course.required'       => trans('messages.course.about_course_error'),
                'management_specialisations.required'       => trans('messages.course.admission_process_error'),
                'eligibility_criteria.required'       => trans('messages.course.eligibility_criteria_error'),
                'course_category.required'       => trans('messages.course.course_category_error'),
                'course_certificate_image.mimes' => trans('messages.course_certificate_image.mimes', ['mimes' => IMAGE_EXTENSION]),
                'display_order.unique_course_display_order' => trans('messages.course.display_order_unique_error')
            ),
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj->name = CustomHelper::getMasterDropdownNameById($thisData['course_id']);
            $obj->course_id = isset($thisData['course_id']) && !empty($thisData['course_id']) ? $thisData['course_id'] : "";
            $obj->per_semester_fee  = isset($thisData['per_semester_fee']) && !empty($thisData['per_semester_fee']) ? (float)$thisData['per_semester_fee'] : "";
            $obj->total_fee  = isset($thisData['total_fee']) && !empty($thisData['total_fee']) ? (float)$thisData['total_fee'] : "";
            $obj->one_time_fee  = isset($thisData['one_time_fee']) && !empty($thisData['one_time_fee']) ? (float)$thisData['one_time_fee'] : "";
            $obj->tag_line  = isset($thisData['tag_line']) && !empty($thisData['tag_line']) ? $thisData['tag_line'] : "";
            $obj->univercity_id  = isset($thisData['univercity_id']) && !empty($thisData['univercity_id']) ? $thisData['univercity_id'] : "";
            $obj->number_of_semesters  = isset($thisData['number_of_semesters']) && !empty($thisData['number_of_semesters']) ? (int)$thisData['number_of_semesters'] : "";
            $obj->about_course  = isset($thisData['about_course']) && !empty($thisData['about_course']) ? $thisData['about_course'] : "";
            $obj->eligibility_criteria  = isset($thisData['eligibility_criteria']) && !empty($thisData['eligibility_criteria']) ? $thisData['eligibility_criteria'] : "";
            $obj->management_specialisations  = isset($thisData['management_specialisations']) && !empty($thisData['management_specialisations']) ? $thisData['management_specialisations'] : "";
            $obj->course_category  = isset($thisData['course_category']) && !empty($thisData['course_category']) ? $thisData['course_category'] : "";
            $obj->is_featured  = isset($thisData['is_featured']) && !empty($thisData['is_featured']) ? $thisData['is_featured'] : INACTIVE;
            $obj->is_admission_open  = isset($thisData['is_admission_open']) && !empty($thisData['is_admission_open']) ? $thisData['is_admission_open'] : INACTIVE;
            if (Request::hasFile('image')) {
                $extension = Request::file('image')->getClientOriginalExtension();
                $fileName = time() . '-course-image.' . $extension;
                if (Request::file('image')->move(COURSE_IMAGE_ROOT_PATH, $fileName)) {
                    $obj->image = $fileName;
                }

                if (file_exists(COURSE_IMAGE_ROOT_PATH . $oldImage)) {
                    @unlink(COURSE_IMAGE_ROOT_PATH . $oldImage);
                }
            }

            if (Request::hasFile('course_certificate_image')) {
                $extension = Request::file('course_certificate_image')->getClientOriginalExtension();
                $fileName = time() . '-course-certificate.' . $extension;
                if (Request::file('course_certificate_image')->move(COURSE_CERTIFICATE_IMAGE_ROOT_PATH, $fileName)) {
                    $obj->course_certificate_image = $fileName;
                }

                if (file_exists(COURSE_CERTIFICATE_IMAGE_ROOT_PATH . $oldCourseCertificateImage)) {
                    @unlink(COURSE_CERTIFICATE_IMAGE_ROOT_PATH . $oldCourseCertificateImage);
                }
            }

            $obj->program  = isset($thisData['program']) && !empty($thisData['program']) ? $thisData['program'] : INACTIVE;
            $obj->specialization  = isset($thisData['specialization']) && !empty($thisData['specialization']) ? $thisData['specialization'] : INACTIVE;
            $obj->display_order  = isset($thisData['display_order']) && !empty($thisData['display_order']) ? $thisData['display_order'] : INACTIVE;
            $obj->save();

            Session::flash('success', trans("messages.$this->model.updated_message"));
            return Redirect::route("$this->model.listCourse", $thisData['univercity_id']);
        }
    }



    public function updateCourseStatus($id, $status, $uni_id)
    {
        Course::where('id', '=', $id)->update(array('active' => (int) $status));
        Session::flash('success', trans("messages.$this->model.status_updated_message"));
        return Redirect::route("$this->model.listCourse", $uni_id);
    }



    public function viewCourses($id , $uni_id)
    {
        $course = Course::find($id)->toArray();

        return View::make("University::Course.view", compact('course', 'uni_id', 'id'));
    }




    public function semester($uni_id = null,$course_id = null)
    {
        $noOfSemesters = Course::where('id',$course_id)->where('univercity_id',$uni_id)->pluck('number_of_semesters')->toArray();
        
        $inacitveSemesters = Semester::where('course_id',$course_id)->where('is_active', INACTIVE)->count();
        
        $acitveSemesters = Semester::where('course_id',$course_id)->where('is_active', ACTIVE)->count();
        return View::make("University::Course.semesters", compact('noOfSemesters', 'uni_id', 'course_id','inacitveSemesters','acitveSemesters'));
    }





    public function addSemester()
    {
        $formData = Request::all();
        $validator = Validator::make(
            $formData,
            array(
                'subject'                 => 'required',
                'credit_score'                 => 'required|numeric',
            ),
            array(
                'subject.required'                  => trans('messages.subject.REQUIRED_ERROR'),
                'credit_score.required'                  => trans('messages.credit_score.REQUIRED_ERROR'),
                'credit_score.numeric'                  => trans('messages.credit_score.numeric_REQUIRED_ERROR'),
            ),
        );

        if ($validator->fails()) {
            return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
        } else{
            $obj = new Semester;
            $obj->uni_id = isset($formData['uni_id']) && !empty($formData['uni_id']) ? $formData['uni_id'] : '';
            $obj->course_id = isset($formData['course_id']) && !empty($formData['course_id']) ? $formData['course_id'] : '';
            $obj->semester = isset($formData['semester']) && !empty($formData['semester']) ? $formData['semester'] : '';
            $obj->subject = isset($formData['subject']) && !empty($formData['subject']) ? $formData['subject'] : '';
            $obj->credit_score = isset($formData['credit_score']) && !empty($formData['credit_score']) ? $formData['credit_score'] : '';
            $obj->description = isset($formData['description']) && !empty($formData['description']) ? $formData['description'] : '';
            $obj->is_active = INACTIVE;

            if($obj->save()){
                Session::flash(SUCCESS, trans("messages.$this->model.semester_added_message"));
                if (Session::has('semester')) {
                    Session::forget('semester');
                }
                Session::put('semester', $formData['semester']);
                return response()->json(['status' => SUCCESS]);
            }
        }
    }





    public function deleteSemester($id = null, $semester = null)
    {
        $semesterDetail = Semester::findOrFail($id);
        $semesterDetail->delete();
        Session::flash(SUCCESS, trans("messages.$this->model.semester_deleted_message"));
        if (Session::has('semester')) {
            Session::forget('semester');
        }
        Session::put('semester', $semester);
        return Redirect::route("$this->model.semester", [$semesterDetail->uni_id,$semesterDetail->course_id]);
    }






    public function loanAndEmi($course_id = null){
        $loan_and_emi_data = Course::where('id',$course_id)->select('id','univercity_id','semester_total_fee','semester_loan_amount','semester_tenure','semester_interest','semester_monthly_emi','annually_total_fee','annually_loan_amount','annually_tenure','annually_interest','annually_monthly_emi','one_time_total_fee','one_time_loan_amount','one_time_tenure','one_time_interest','one_time_monthly_emi','show_on_front')->get()->first()->toArray();

        return View::make("University::Course.loan_and_emi", compact('loan_and_emi_data','course_id'));
    }




    public function saveLoanAndEmi()
    {
        $thisData = Request::all();
        $validator = Validator::make(
            $thisData,
            array(
                'semester_total_fee'        => 'nullable|numeric',
                'semester_loan_amount'      => 'nullable|numeric',
                'semester_interest'         => 'nullable|numeric',
                'annually_total_fee'        => 'nullable|numeric',
                'annually_loan_amount'      => 'nullable|numeric',
                'annually_interest'         => 'nullable|numeric',
                'one_time_total_fee'        => 'nullable|numeric',
                'one_time_loan_amount'      => 'nullable|numeric',
                'one_time_interest'         => 'nullable|numeric',
            ),
            array(
                'semester_total_fee.numeric'            => trans('messages.course.numeric_error'),
                'semester_loan_amount.numeric'            => trans('messages.course.numeric_error'),
                'semester_interest.numeric'            => trans('messages.course.numeric_error'),
                'annually_total_fee.numeric'            => trans('messages.course.numeric_error'),
                'annually_loan_amount.numeric'            => trans('messages.course.numeric_error'),
                'annually_interest.numeric'            => trans('messages.course.numeric_error'),
                'one_time_total_fee.numeric'            => trans('messages.course.numeric_error'),
                'one_time_loan_amount.numeric'            => trans('messages.course.numeric_error'),
                'one_time_interest.numeric'            => trans('messages.course.numeric_error'),
            ),
        );  

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj     = Course::findOrFail($thisData['course_id']);
            $obj->semester_total_fee = isset($thisData['semester_total_fee']) && !empty($thisData['semester_total_fee']) ? $thisData['semester_total_fee'] : null;
            $obj->semester_loan_amount = isset($thisData['semester_loan_amount']) && !empty($thisData['semester_loan_amount']) ? $thisData['semester_loan_amount'] : null;
            $obj->semester_tenure = isset($thisData['semester_tenure']) && !empty($thisData['semester_tenure']) ? $thisData['semester_tenure'] : null;
            $obj->semester_interest = isset($thisData['semester_interest']) && !empty($thisData['semester_interest']) ? $thisData['semester_interest'] : null;
            $obj->semester_monthly_emi = isset($thisData['semester_monthly_emi']) && !empty($thisData['semester_monthly_emi']) ? $thisData['semester_monthly_emi'] : null;
            $obj->annually_total_fee = isset($thisData['annually_total_fee']) && !empty($thisData['annually_total_fee']) ? $thisData['annually_total_fee'] : null;
            $obj->annually_loan_amount = isset($thisData['annually_loan_amount']) && !empty($thisData['annually_loan_amount']) ? $thisData['annually_loan_amount'] : null;
            $obj->annually_tenure = isset($thisData['annually_tenure']) && !empty($thisData['annually_tenure']) ? $thisData['annually_tenure'] : null;
            $obj->annually_interest = isset($thisData['annually_interest']) && !empty($thisData['annually_interest']) ? $thisData['annually_interest'] : null;
            $obj->annually_monthly_emi = isset($thisData['annually_monthly_emi']) && !empty($thisData['annually_monthly_emi']) ? $thisData['annually_monthly_emi'] : null;
            $obj->one_time_total_fee = isset($thisData['one_time_total_fee']) && !empty($thisData['one_time_total_fee']) ? $thisData['one_time_total_fee'] : null;
            $obj->one_time_loan_amount = isset($thisData['one_time_loan_amount']) && !empty($thisData['one_time_loan_amount']) ? $thisData['one_time_loan_amount'] : null;
            $obj->one_time_tenure = isset($thisData['one_time_tenure']) && !empty($thisData['one_time_tenure']) ? $thisData['one_time_tenure'] : null;
            $obj->one_time_interest = isset($thisData['one_time_interest']) && !empty($thisData['one_time_interest']) ? $thisData['one_time_interest'] : null;
            $obj->one_time_monthly_emi = isset($thisData['one_time_monthly_emi']) && !empty($thisData['one_time_monthly_emi']) ? $thisData['one_time_monthly_emi'] : null;
            $obj->show_on_front = isset($thisData['show_on_front']) && !empty($thisData['show_on_front']) ? $thisData['show_on_front'] : INACTIVE;
            $obj->save();
            Session::flash('success', trans("messages.$this->model.loan_and_emi_add"));
            return Redirect::route("$this->model.listCourse", $thisData['uni_id']);
        }
    }


    public function markAsAllSemesterActive($courseId , $uni_id){
        Semester::where('course_id', $courseId)->update(['is_active' => ACTIVE]);
        Session::flash(SUCCESS, trans("messages.$this->model.semester_status_change_message"));
        return Redirect::route("$this->model.semester", [$uni_id,$courseId]);
    }
   

    public function markAsAllSemesterInactive($courseId , $uni_id){
        Semester::where('course_id', $courseId)->update(['is_active' => INACTIVE]);
        Session::flash(SUCCESS, trans("messages.$this->model.semester_status_change_message"));
        return Redirect::route("$this->model.semester", [$uni_id,$courseId]);
    }
}
