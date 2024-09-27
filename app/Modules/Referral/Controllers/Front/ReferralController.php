<?php

namespace App\Modules\Referral\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Referral\Models\Referral;
use App\Modules\Country\Models\City;
use CustomHelper, View, Session, Request;
use Validator,config;
use App\Services\SendMailService;

/**
 * ReferralController class
 */
class ReferralController extends BaseController
{

    public $model = 'Referral';

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
        $referal_banner = CustomHelper::getBlockdetail('referal-banner');
        $referal_heading = CustomHelper::getBlockdetail('referal-heading');
        $referal_terms_and_conditions = CustomHelper::getBlockdetail('referal-terms-and-conditions');
        $cityList = City::where('country_id', COUNTRY)->pluck('city_name','id')->toArray();
        return View::make("$this->model::Front.index", compact('referal_banner','referal_heading','cityList','referal_terms_and_conditions'));
    } //end index()






    public function addReferralDetails()
    {
        $formData = Request::all();
        
        if (Request::ajax()) {
            $validator = Validator::make(
                $formData,
                array(
                    'referee_name' => 'required',
                    'referee_phone' => 'required|numeric|digits:10',
                    'referee_email' => 'required|email',
                    'referee_city' => 'required',
                    'reference_name' => 'required',
                    'reference_phone' => 'required|numeric|digits:10',
                    'reference_email' => 'required|email',
                    'reference_city' => 'required',
                ),
                array(
                    'referee_name.required' => trans('messages.referee_name.REQUIRE_ERROR'),
                    'referee_phone.required' => trans('messages.referee_phone.REQUIRE_ERROR'),
                    'referee_phone.numeric' => trans('messages.referee_phone_valid.VALID_ERROR'),
                    'referee_phone.digits' => trans('messages.phone_valid_digit.VALID_ERROR'),
                    'referee_email.required' => trans('messages.referee_email.REQUIRE_ERROR'),
                    'referee_email.email' => trans('messages.referee_email_valid.VALID_ERROR'),
                    'referee_city.required' => trans('messages.referee_city.REQUIRE_ERROR'),
                    'reference_name.required' => trans('messages.reference_name.REQUIRE_ERROR'),
                    'reference_phone.required' => trans('messages.reference_phone.REQUIRE_ERROR'),
                    'reference_phone.numeric' => trans('messages.reference_phone_valid.VALID_ERROR'),
                    'reference_phone.digits' => trans('messages.phone_valid_digit.VALID_ERROR'),
                    'reference_email.required' => trans('messages.reference_email.REQUIRE_ERROR'),
                    'reference_email.email' => trans('messages.reference_email_valid.VALID_ERROR'),
                    'reference_city.required' => trans('messages.reference_city.REQUIRE_ERROR'),
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
                $model = new Referral;
                $model->referee_name = $formData['referee_name'];
                $model->referee_phone = $formData['referee_phone'];
                $model->referee_email = $formData['referee_email'];
                $model->referee_city = $formData['referee_city'];
                $model->reference_name = $formData['reference_name'];
                $model->reference_phone = $formData['reference_phone'];
                $model->reference_email = $formData['reference_email'];
                $model->reference_city = $formData['reference_city'];

                if($model->save()){
                    $name           = isset($formData['referee_name']) ? $formData['referee_name'] : "";
                    $email          = isset($formData['referee_email']) ? $formData['referee_email'] : "";
                    $phone          = isset($formData['referee_phone']) ? $formData['referee_phone'] : "";

                    $action         = "referral_request";  
                    $to             = config::get('Site.contact_email');
                    $to_name        = config::get('Email.username');
                    $rep_Array      = array($name, $email, $phone);

                    $sendMail       = new SendMailService;
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                    Session::flash(SUCCESS, trans('messages.referral.success_message'));
                    return array('status' => SUCCESS);
                }
            }
        }
    }


} // end ReferralController class
