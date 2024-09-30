<?php

namespace App\Modules\Scholarship\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\libraries\CustomHelper as LibrariesCustomHelper;
use App\Modules\Scholarship\Models\ScholarshipRequest;
use App\Modules\Country\Models\City;
use CustomHelper, View, Session, Request;
use Validator,config;
use App\Services\SendMailService;

/**
 * ScholarshipController class
 */
class ScholarshipController extends BaseController
{

    public $model = 'Scholarship';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    /**
     * Function to display website home page
     *
     * @param null
     *
     * @return view page
     */
    public function index()
    {
        $scholarship_banner = CustomHelper::getBlockdetail('scholarship-banner');
        $scholarship_heading = CustomHelper::getBlockdetail('scholarship-heading');
        $courseList = CustomHelper::getMasterDropdown('course');
        $cityList = City::where('country_id', COUNTRY)->pluck('city_name','id')->toArray();

        return View::make("$this->model::Front.index", compact('scholarship_banner','scholarship_heading','cityList','courseList'));
    } //end index()






    public function applyScholarship()
    {
        $formData = Request::all();
        
        if (Request::ajax()) {
            $validator = Validator::make(
                $formData,
                array(
                    'full_name' => 'required',
                    'phone' => 'required|numeric|digits:10',
                    'email' => 'required|email',
                    'course' => 'required',
                    'city' => 'required'
                ),
                array(
                    'full_name.required' => trans('messages.full_name.REQUIRE_ERROR'),
                    'phone.required' => trans('messages.phone.REQUIRE_ERROR'),
                    'phone.numeric' => trans('messages.phone_valid.VALID_ERROR'),
                    'phone.digits' => trans('messages.phone_valid_digit.VALID_ERROR'),
                    'email.required' => trans('messages.email.REQUIRE_ERROR'),
                    'email.email' => trans('messages.email_valid.VALID_ERROR'),
                    'course.required' => trans('messages.course.REQUIRE_ERROR'),
                    'city.required' => trans('messages.city.REQUIRE_ERROR'),
                )
            );


            $recaptchaResponse = Request::input('g-recaptcha-response');
			$secret = env('GOOGLE_RECAPTCHA_SECRET');
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse);
			$responseData = (array) json_decode($verifyResponse);

			if (!isset($responseData['success']) || empty($responseData['success'])) {
				$validator->after(function ($validator) {
					$validator->errors()->add("g-recaptcha-response", trans('front_messages.contact.recaptcha_error'));
				});
			}
            

            if ($validator->fails()) {
                return array('status' => "error", 'errors' => $validator->errors()->toArray());
            }
            else {
                $model = new ScholarshipRequest;
                $model->full_name = $formData['full_name'];
                $model->phone = $formData['phone'];
                $model->email = $formData['email'];
                $model->course = (int)$formData['course'];
                $model->city = (int)$formData['city'];

                if($model->save()){
                    $name           = isset($formData['full_name']) ? $formData['full_name'] : "";
                    $email          = isset($formData['email']) ? $formData['email'] : "";
                    $phone          = isset($formData['phone']) ? $formData['phone'] : "";
                    $course = CustomHelper::getMasterDropdownNameById($formData['course']);
                    

                    $action         = "scholarship_request";
                    $to             = config::get('Site.contact_email');
                    $to_name        = config::get('Email.username');
                    $rep_Array      = array($name, $email, $phone, $course);
                    $sendMail       = new SendMailService;
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                    Session::flash(SUCCESS, trans('messages.scholar.success_message'));
                    return array('status' => SUCCESS);
                }
            }
        }
    }


} // end ScholarshipController class
