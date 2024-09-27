<?php

namespace App\Modules\University\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\University\Models\Course;
use App\Modules\University\Models\CourseSpecification;
use App\Modules\University\Models\University;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\University\Services\UniversityService;
use CustomHelper;
use Redirect;
use Request;
use Session;
use View;
use Response, Route;
use App\Modules\ReviewRating\Models\ReviewRating;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Notifications\Action;

/**
 * UniversityController class
 *
 * Add your methods in the class below
 */
class UniversityController extends BaseController
{

    /**
     * Model name
     */
    public $model = 'University';

    /**
     * function for construct
     * @return layout
     */
    public function __construct()
    {
        View::share('modelName', $this->model);
    } // end __construct()



    public function allUniversityList()
    {
        $db = University::where('is_active', ACTIVE)->with(['faqs', 'blogs', 'getSliders', 'universityCourses', 'universityBadges', 'getUniversityPlacementPartners']);

        $queryString    =    Request::all();
        if (empty($queryString)) {
            Session::forget('course_id');
            Session::forget('university_id');
            Session::save();
        }
        $isCourse       =       false;

        if (isset($queryString) && !empty($queryString)) {
            foreach ($queryString as $fieldName => $fieldValue) {
                if ($fieldValue != '') {
                    if ($fieldName == 'courses') {
                        $coursesId         = DropDown::whereIn('slug', explode(",", $fieldValue))->pluck('id')->toArray();
                        $universityId     = Course::whereIn('course_id', $coursesId)->pluck('univercity_id')->toArray();
                        $db->whereIn('id', $universityId);
                        $isCourse = true;
                    }
                }
            }

            if (isset($queryString['search']) && !empty($queryString['search'])) {
                if($queryString['search'] == 'online mba'){
                    $queryString['search'] = 'mba';
                }
                $coursesId         = DropDown::where('name', $queryString['search'])->select('id', 'slug')->get()->toArray();
                if (!empty($coursesId)) {
                    $queryString['courses'] = $coursesId[0]['slug'];
                    $universityId     = Course::where('course_id', $coursesId[0]['id'])->pluck('univercity_id')->toArray();
                    $db->whereIn('id', $universityId);
                    $isCourse = true;
                } else {
                    $db->where('title', 'like', '%' . $queryString['search'] . '%');
                }
            }
        }
        $courseDropdown = $this->getCourseFiltersList($queryString);
        $recordPerPage        =     15;
        $result     =    $db->orderByRaw('CASE WHEN display_order IS NULL THEN 1 ELSE 0 END, display_order ASC')->paginate((int)$recordPerPage);
        $nextPage       = $result->lastpage();
        $currentPage    = $result->currentPage();
        $lastPage       = $result->lastPage();
        $countryId    =    COUNTRY;
        $stateId   =    0;
        $old_state   =    0;
        list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        $mobileTextClass = 'mobile01';
        $mobileTextClassEnquiry = 'mobile02';

        if (Request::ajax()) {
            Session::forget('course_id');
            Session::forget('university_id');
            Session::save();

            return response()->json([
                'status'    => SUCCESS,
                'html' => view("University::Front.elements.universities", compact('result', 'currentPage', 'lastPage', 'queryString', 'isCourse', 'mobileTextClass','mobileTextClassEnquiry'))->render(),
                'nextPage' => $nextPage,
                'currentPage' => $currentPage,
                'lastPage' => $lastPage
            ]);
        }
        return View::make("University::Front.university_listing", compact('result', 'courseDropdown', 'queryString', 'currentPage', 'lastPage', 'stateList', 'old_state', 'cityList', 'isCourse', 'mobileTextClass','mobileTextClassEnquiry'));
    }




    public function getCourseFiltersList($queryString = array())
    {

        $courses = isset($queryString['courses']) ? explode(",", $queryString['courses']) : array();
        $courseDropdown = '';

        // if (empty($courses)) {
            $courseDropdown   = DropDown::where('dropdown_type', 'course')->where('status', ACTIVE)->where('dropdown_id',NULL)->orderby('dropdown_order', 'ASC')->select('id', 'name', 'slug')->get();
        // } else {
        //     $courseDropdown   = DropDown::where('dropdown_type', 'course')->where('status', ACTIVE)->orderby('dropdown_order', 'ASC')->where(function ($query) use ($courses) {
        //         $query->whereIn('slug', $courses);
        //     })->select('id', 'name', 'slug')->paginate((int)4);
        // }

        // if (Request::ajax()) {
        //     $nextPage       = ($courseDropdown->currentPage() != $courseDropdown->lastPage() ? $courseDropdown->currentPage() + 1 : $courseDropdown->currentPage());
        //     $currentPage    = $courseDropdown->currentPage();
        //     $lastPage       = $courseDropdown->lastPage();
        //     $html = view("$this->model::Front.elements.course_filters", compact('courseDropdown'))->render();

        //     return response()->json([
        //         'status'    => SUCCESS,
        //         'html' => $html,
        //         'nextPage' => $nextPage,
        //         'currentPage' => $currentPage,
        //         'lastPage' => $lastPage
        //     ]);
        // } else {
            return $courseDropdown;
        // }
    }


    /**
     * Function for University pages
     */
    public function index($slug = null, $course_slug = null, $specification_slug = null)
    {
        Session::forget('course_id');
        Session::forget('university_id');
        Session::save();
        $mobileTextClass = 'mobile01';
        $mobileTextClassEnquiry = 'mobile02';
        if ($slug != '') {
            $courseDetail = array();
            $otherUniversities = array();
            $specificationDetails = array();

            if ($course_slug != '') {
                $courseDetail = Course::with('courseFaqs', 'courseSemesters','getCourseSpecifications')->where('university_slug', $slug)->where('active',ACTIVE)->where('course_slug',$course_slug)->get()->first();
                $otherUniversities = Course::with('getAllUniversityDetails')->where('course_id', $courseDetail->course_id)->where('active',ACTIVE)->whereNot('univercity_id', $courseDetail->univercity_id)->get();
            } else {
                $otherUniversities = University::whereNot('slug', $slug)->where('is_active',ACTIVE)->with(['faqs', 'blogs', 'getSliders', 'universityCourses', 'universityBadges', 'getUniversityPlacementPartners'])->get();
            }

            if($specification_slug != ''){
                $specificationDetails = CourseSpecification::with('getCourseSpecificationDropdownDetails','courseSemesters')->where('slug', $specification_slug)->where('active',ACTIVE)->get()->first();
                // pr($specificationDetails->toArray());die;
            }
            // pr($courseDetail->toArray());die;

            $result = University::where('slug', $slug)->with(['faqs', 'blogs', 'getSliders', 'universityCourses', 'universityBadges', 'getUniversityPlacementPartners', 'getReviewRatingUniversitiesPage', 'universityCourseEmiDetail', 'universityLoanPartners'])->first();
            
            $indianCampuses = CustomHelper::getUniversityCampuses($result->id, INDIAN_CAMPUS);
            $internationalCampuses = CustomHelper::getUniversityCampuses($result->id, INTERNATIONAL_CAMPUS);

            if ($result) {
                $pageTitle             =     $result['title'];
                $metaTitle             =     $result['meta_title'];
                $meta_description      =     $result['meta_description'];
                $meta_keywords         =     $result['meta_keywords'];


                $countryId    =    COUNTRY;
                $stateId   =    0;
                $old_state   =    0;
                list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);


                if (isset($slug) && !isset($course_slug) && !isset($specification_slug)) {
                    return View::make("University::Front.index", compact('result', 'pageTitle', 'metaTitle', 'meta_description', 'meta_keywords', 'slug', 'stateList', 'old_state', 'cityList', 'otherUniversities', 'mobileTextClass', 'indianCampuses', 'internationalCampuses', 'mobileTextClassEnquiry'));
                } else {
                    return View::make("University::Front.university_course_detail", compact('result', 'pageTitle', 'metaTitle', 'meta_description', 'meta_keywords', 'slug', 'stateList', 'cityList', 'old_state', 'courseDetail', 'course_slug', 'otherUniversities', 'mobileTextClass', 'indianCampuses', 'internationalCampuses', 'specification_slug','specificationDetails', 'mobileTextClassEnquiry'));
                }
            } else {
                Session::flash('messagered', 'Invalid URL Access');
                return Redirect::route("home.index");
            }
        } else {
            return Redirect::route("home.index");
        }
    } // end index()




    /**
     * Function for apply job
     * @param null
     * @return
     */
    public function applyUniversity()
    {
        $formData = Request::all();
        if (Request::isMethod('post')) {

            $attribute = array("from" => "front", "model" => $this->model, "type" => "add");
            $university = new UniversityService;
            $res = $university->applyUniversityValidateandSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) {
                $validator = $res['validator'];
                return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
            } else {
                if ($res['data']['status'] == 'success') {

                    Session::put('download_prospectus', ACTIVE);
                    Session::put('uni_slug', $formData['slug']);

                    Session::put('download_prospectus_messages', $res['data']['message']);
                    Session::save();
                    // Session::flash(SUCCESS, $res['data']['message']);

                    return response()->json(['status' => SUCCESS]);
                }
            }
        } else {
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.global.something_went_wrong')]);
        }
    }


    public function downloadProspectus()
    {
        if ((Session::has('download_prospectus') && (Session::get('download_prospectus')) == ACTIVE) && (Session::has('uni_slug'))) {
            $university = University::where('slug', Session::get('uni_slug'))->first();
            if (!empty($university->toArray()) && isset($university->file) && $university->file != '') {

                Session::forget('download_prospectus');
                Session::forget('uni_slug');
                Session::save();

                $path = UNIVERSITY_IMAGE_ROOT_PATH;
                $fieldNameWithPath = $path . $university->file;

                if (is_file($fieldNameWithPath) && file_exists($fieldNameWithPath)) {
                    return Response::download($fieldNameWithPath);
                    exit;
                }
            }
        }
    }


    public function addCompareUniversity()
    {
        if (Request::ajax() && Request::Input()) {
            $messages           =   '';
            $status             =   ERROR;
            $universityArray    =   [];
            $course_id          =   Request::get('courseId');
            $university_id      =   Request::get('universityId');
            $type               =   Request::get('type');
            $limitStatus        =   '';
            $page               =   Request::get('page');
            $redirect           =   '';

            if (Session::has('course_id') && Session::has('university_id')) {
                $universityArray = Session::get('university_id');
                if ($type != '') {
                    $universityArray = Session::get('university_id');
                    $key = array_search($university_id, $universityArray);
                    if ($key !== false) {
                        unset($universityArray[$key]);
                    }

                    Session::put('university_id', $universityArray);
                    if (count($universityArray) == 0) {
                        Session::forget('course_id');
                    }
                    Session::save();
                    $status = SUCCESS;

                    if ($page != '' && $page == 'compare') {
                        $courseDetail = DropDown::where('id', $course_id)->select('slug', 'id')->first();
                        $courseSlug = $courseDetail->slug;
                        $redirect = route('University.listing') . "?courses=$courseSlug";
                    }
                } else {
                    if (is_array(Session::get('university_id')) && in_array($university_id, $universityArray)) {
                    } else {
                        if (count($universityArray) < 2) {
                            $universityArray[] = $university_id;
                            Session::put('university_id', $universityArray);
                            Session::save();
                            $status = SUCCESS;
                        } else {
                            $messages = trans('front_messages.global.university_id_limit_in_session');
                            $limitStatus = 'full';
                        }
                    }
                }
            } else {
                Session::put('course_id', $course_id);
                $universityArray[] = $university_id;
                Session::put('university_id', $universityArray);
                Session::save();
                $status = SUCCESS;
            }
        }

        $count = count($universityArray);
        $html = '';

        $universityData = CustomHelper::getUniversityComparisonData();
        $html = view("University::Front.elements.university_compare_list", compact('universityData', 'count'))->render();

        return response()->json(['status' => $status, 'message' => $messages, 'count' => $count, 'html' => $html, 'type' => $type, 'limitStatus' => $limitStatus, 'route' => $redirect]);
    }





    public function universityCompare()
    {
        $data = CustomHelper::getUniversityComparisonData();
        $count = count($data);

        if ($data->isNotEmpty() && $count == 2) {
            $data = $data->toArray();
        } else {
            return redirect(route('University.listing'));
        }

        $universityOne = $data[0];
        $universityTwo = $data[1];
        $mobileTextClass = 'mobile01';

        return View::make("University::Front.compare", compact('data', 'universityOne', 'universityTwo', 'mobileTextClass'));
    }



    public function verifyOtp()
    {
        $otp = CustomHelper::generate_verification_code();
        $data = Request::all();
        if (SMS_API_ENABLE) {

            $mobile = $data['Mobile'];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://control.msg91.com/api/v5/otp?template_id=" . SMS_TEMPLATE_ID . "&mobile=91" . $mobile,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'OTP' => $otp
                ]),
                CURLOPT_HTTPHEADER => [
                    "accept: application/json",
                    "authkey: " . SMS_AUTH_KEY,
                    "content-type: application/json"
                ],
            ]);

            $response     = curl_exec($curl);
           
            $err         = curl_error($curl);

            curl_close($curl);

            if ($err) {              
                $errorMessages = "cURL Error #:" . $err;
                return response()->json(['errorMessages' => $errorMessages, 'status' => ERROR, 'response' => $response]);
            } else {               
                $responseArray = json_decode($response, true);
                echo "<pre>";
                print_r($responseArray);
                echo "</pre>";
                $responseArray['OTP'] = $otp;
                $responseArray['type'] = SUCCESS;
                $json = json_encode($responseArray);
                return response()->json(['errorMessages' => '', 'status' => SUCCESS, 'response' => json_decode($json)]);
            }
        } else {          
            // $responseArray = json_decode($response, true);
            $responseArray['OTP'] = $otp;
            $responseArray['type'] = SUCCESS;
            $json = json_encode($responseArray);
            return response()->json(['errorMessages' => '', 'status' => SUCCESS, 'response' => json_decode($json)]);
        }
    }





    public function viewAllReviews()
    {
        $university_id = Request::get('university_id');
        $allReviews = ReviewRating::with('getUserDetails')->where('university_id', $university_id)->where('is_approved', ACTIVE)->orderBy('created_at', 'DESC')->get();
        $html = view("University::Front.elements.university_all_reviews", compact('allReviews'))->render();

        return response()->json(['status' => SUCCESS, 'html' => $html]);
    }



    public function  getAllNewUniversity() {
        $db = University::where('is_active', ACTIVE)->with(['faqs', 'blogs', 'getSliders', 'universityCourses', 'universityBadges', 'getUniversityPlacementPartners']);

        $recordPerPage        =     40;
        $result     =    $db->orderByRaw('CASE WHEN display_order IS NULL THEN 1 ELSE 0 END, display_order ASC')->paginate((int)$recordPerPage);
        $currentPage    = $result->currentPage();
        $nextPage       = $currentPage + 1;
        $lastPage       = $result->lastPage();
        $mobileTextClassEnquiry = 'mobile02';
        $countryId    =    COUNTRY;
        $stateId   =    0;
        list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);

        if (Request::ajax()) {
            // pr($lastPage);die;
            return response()->json([
                'status'    => SUCCESS,
                'html' => view("University::Front.elements.new_universities", compact('result', 'currentPage', 'lastPage'))->render(),
                'nextPage' => $nextPage,
                'currentPage' => $currentPage,
                'lastPage' => $lastPage
            ]);
        }
        // pr($result->toArray());die;
        return View::make("University::Front.new_university_pages", compact('result','currentPage', 'lastPage','mobileTextClassEnquiry','stateList','cityList'));
    }
} // end UniversityController class
