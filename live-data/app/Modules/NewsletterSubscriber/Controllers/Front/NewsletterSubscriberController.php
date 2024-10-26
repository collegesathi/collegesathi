<?php
namespace App\Modules\NewsletterSubscriber\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\NewsletterSubscriber\Models\NewsletterSubscriber;
use App\Services\SendMailService;
use CustomHelper;
use File;
use Redirect;
use Request;
use Response;
use Session;
use Validator;
use View;

/**
 * Blog Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/usermgmt
 **/
class NewsletterSubscriberController extends BaseController
{

    public $model = 'NewsletterSubscriber';

    public function __construct()
    {
        View::share('modelName', $this->model);

    }

/**
 * NewsletterSubscriberController::NewsletterSubscriber requesr()
 * Function for Newsletter
 * @param null
 * @return view page or redirect .
 **/
    public function subscribe(request $request)
    {

        $formData = Request::all();

        if (!empty($formData)) {

            $validator = Validator::make(
                Request::all(),
                array(
                    'email' => 'required|email|unique:newsletter_subscribers',
                ),
                array(
                    'email.email' => trans('front_messages.news_letter_valid_email.REQUIRED_ERROR'),
                    'email.unique' => trans('front_messages.news_letter_unique.REQUIRED_ERROR'),
                    'email.required' => trans('front_messages.news_letter_email.REQUIRED_ERROR'),
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
                return response()->json(['errors' =>$validator->errors()->toArray()]);
            }
			else {

                    $validateString = CustomHelper::getValidateString(Request::get('email'));

                    $Newsletter = new NewsletterSubscriber();
                    $Newsletter->email = Request::get('email');
                    $Newsletter->valid_string = $validateString;
                    if($Newsletter->save()){

                    //forgot password mail to user

                    $to = Request::get('email');
                    $to_name = Request::get('email');

                    $route_url = route('NewsletterSubscriber.unSubscribe', $validateString);
                    $click_link = '<a href="' . $route_url . '" target="_blank">Unsubscribe</a>';

                    $action = "mail_to_user_for_email_subscribe";

                    $rep_Array = array($to, $click_link, $route_url);

                    $sendMail = new SendMailService;
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                    return response()->json(['success' => trans('front_messages.email_was_sent')]);

                    }
                }

        }
    } // end editBasicProfile()

    /**
     * NewsletterSubscriberController::Newsletter unSubscribe()
     * Function for unSubscribe
     * @param null
     * @return view page or redirect .
     **/
    public function unSubscribe($string = '')
    {
        $newsletter = NewsletterSubscriber::where('valid_string', $string)->first();
        if (!empty($newsletter)) {
            $newsletter->delete();
            Session::flash(SUCCESS, trans("front_messages.global.unsubscribe_email_success"));
            return Redirect::route("home.index");
        } else {
            Session::flash(ERROR, trans("front_messages.global.email_address_not_registered"));
            return Redirect::route("home.index");
        }
    }

} // end NewsletterSubscriberController class
