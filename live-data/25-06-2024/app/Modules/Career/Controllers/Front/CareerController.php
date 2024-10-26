<?php

namespace App\Modules\Career\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Career\Models\Career;
use App\Modules\Career\Models\ApplyJob;
use CustomHelper, View, config, Session, Request;
use Validator;
use App\Services\SendMailService;

/**
 * CareerController class
 */
class CareerController extends BaseController
{

    public $model = 'Career';

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
        $query = Career::where('is_active', ACTIVE);
        $result = $query->paginate((int)CAREER_PAGE_DEFAULT_LIMIT);
    
        $totalCareerCount = $result->total();
        $career_page_block_image = CustomHelper::getBlockdetail('career');
        $career_page_block_heading = CustomHelper::getBlockdetail('career-heading');
        if ($result) {
            return View::make("$this->model::Front.index", compact('result','career_page_block_image','career_page_block_heading','totalCareerCount'));
        }
    } //end index()




    public function loadMoreCareerPage() 
    {
        $result = Career::where('is_active', ACTIVE)->paginate((int)CAREER_PAGE_DEFAULT_LIMIT);
        $nextPage       = $result->lastpage();
        $currentPage    = $result->currentPage();
        $totalCount = $currentPage * count($result);

        $html = view("$this->model::Front.elements.career_element", compact('result'))->render();

        return array('status' => "success", 'html' => $html, 'nextPage' => $nextPage, 'currentPage'=> $currentPage, 'totalCount' => $totalCount);
    }





    public function applyCareer()
    {
        $formData = Request::all();
        if (Request::ajax()) {
            $validator = Validator::make(
                $formData,
                array(
                    'full_name' => 'required',
                    'email_address' => 'required|email',
                    'mobile_number' => 'required|numeric|digits:10',
                    'job_position' => 'required',
                    'description' => 'required',
                    'upload_cv' => 'required|mimes:'. CV_EXTENSION
                ),
                array(
                    'full_name.required' => trans('messages.full_name.REQUIRE_ERROR'),
                    'email_address.required' => trans('messages.email_address.REQUIRE_ERROR'),
                    'email_address.email' => trans('messages.email_address_valid.VALID_ERROR'),
                    'mobile_number.required' => trans('messages.mobile_number.REQUIRE_ERROR'),
                    'mobile_number.numeric' => trans('messages.mobile_number_valid.VALID_ERROR'),
                    'mobile_number.digits' => trans('messages.phone_valid_digit.VALID_ERROR'),
                    'job_position.required' => trans('messages.job_position.REQUIRE_ERROR'),
                    'description.required' => trans('messages.description.REQUIRE_ERROR'),
                    'upload_cv.required' => trans('messages.upload_cv.REQUIRE_ERROR'),
                    'upload_cv.mimes' => trans('messages.upload_cv_valid.VALID_ERROR'),
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
                $model = new ApplyJob;
                $model->career_id = $formData['career_id'];
                $model->full_name = $formData['full_name'];
                $model->email_address = $formData['email_address'];
                $model->mobile_number = $formData['mobile_number'];
                $model->job_position = $formData['job_position'];
                $model->description = $formData['description'];
                $fileName = CustomHelper::UploadFile($formData['upload_cv'], '-cv', APPLY_CAREER_CV_ROOT_PATH);
				$model->upload_cv         =   $fileName;

                if($model->save()){
                    $name           = isset($formData['full_name']) ? $formData['full_name'] : "";
                    $email          = isset($formData['email_address']) ? $formData['email_address'] : "";
                    $phone          = isset($formData['mobile_number']) ? $formData['mobile_number'] : "";
                    $url = route("Career.view_job_request",['list',$model->id]);
                    $apply_for = $formData['job_position'];
                    
                    $action         = "job_request";
                    $to             = config::get('Site.contact_email');
                    $to_name        = config::get('Email.username');
                    $rep_Array      = array($name, $email, $phone, $apply_for, $url);
                    $sendMail       = new SendMailService;
                    $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

                    Session::flash(SUCCESS, trans('messages.career.success_message'));
                    return array('status' => SUCCESS);
                }
            }
        }
    }


} // end CareerController class
