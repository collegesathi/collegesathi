<?php

namespace App\Modules\Survey\Controllers\Front;

use App\Modules\Survey\Models\Survey;
use App\Modules\SurveQuestionAnswer\Models\SurveQuestion;
use App\Http\Controllers\BaseController;
use CustomHelper, View, Config, Session;
use App\Services\SendMailService;
use App\Modules\Expert\Models\Expert;
use App\Modules\SurveQuestionAnswer\Models\SurveyAnswer;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\Survey\Models\SurveyQuestionAnswer;
use Validator;
use Redirect;
use Request;

/**
 * SurveyController class
 */
class SurveyController extends BaseController
{

    public $model = 'Survey';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function getAssist($slug = null)
    {
        Session::forget('answer_array');
        Session::forget('category');
        Session::forget('selected_answer_array');
        Session::forget('saved_current_answer');
        Session::forget('course_name');

        if ($slug) {
            Request::session()->put('expert_slug', $slug);
        } else {
            Request::session()->put('expert_slug', '');
        }

        $category = Config::get('SURVE_QUESTION_CATEGORY');
        return View::make('Survey::front.get_assist', compact('category'));
    }


    public function saveDegreeCategory()
    {
        $thisData     =     Request::all();
        $validator     =     Validator::make(
            $thisData,
            array(
                'education_degree' => 'required',
            ),
            array(
                'education_degree.required' => trans('front_messages.degree.REQUIRE_ERROR'),
            )
        );

        if ($validator->fails()) {
            Session::flash(ERROR, trans('front_messages.degree.REQUIRE_ERROR'));
            return Redirect::back();
        } else {
            Request::session()->put('category',    $thisData['education_degree']);
            return Redirect::route('survey.getAssistSteps');
        }
    }


    public function getAssistSteps()
    {
        $degreeSelected         =     Request::session()->get('category');
        $saved_current_answer    =    NULL;

        if ($degreeSelected == null) {
            return Redirect::route('survey.getAssist');
        } else {
            $conditionArray =     ['category_id' => $degreeSelected];
            $SurveQuestion     =    CustomHelper::getCurrentSurveyQuestionAnswer($conditionArray);

            $answerArray    =    [];
            if (Session::has('answer_array')) {
                $answerArray    =    Session::get('answer_array');
            }

            if (!empty($answerArray)) {
                /* get last element */
                $myLastElement            =    end($answerArray);
                $next_question_slug        =    isset($myLastElement['next_question_slug']) ? $myLastElement['next_question_slug'] : NULL;

                if ($next_question_slug) {
                    $conditionArray = ['slug' => $next_question_slug];
                    $SurveQuestion     = CustomHelper::getCurrentSurveyQuestionAnswer($conditionArray);
                }
            }

            if (Session::has('saved_current_answer')) {
                $saved_current_answer    =    Session::get('saved_current_answer');
            }

            $nextQuestion         =     $SurveQuestion->getNextQuestion($degreeSelected);
            $nextQuestionSlug    =    isset($nextQuestion->slug) ? $nextQuestion->slug : NULL;
            $previousQuestion     =     $SurveQuestion->getPreviousQuestion($degreeSelected);


            $totalQuestions    =    SurveQuestion::where('category_id', $degreeSelected)->where('is_active', ACTIVE)->count();
            $totalAnswers    =    count($answerArray);

            $totalQuestions    =    $totalQuestions + 1;
            $totalAnswers    =    $totalAnswers + 1;

            $totalAnswerdInPercentage    =    (($totalAnswers / $totalQuestions) * 100);

            $expert_slug = null;
            if (Session::has('expert_slug')) {
                $expert_slug    =    Session::get('expert_slug');
            }


            return View::make('Survey::front.get_assist_steps', compact('SurveQuestion', 'nextQuestionSlug', 'previousQuestion', 'saved_current_answer', 'totalAnswerdInPercentage', 'answerArray', 'expert_slug'));
        }
    } //end stepone()


    public function getAssistStepsSave()
    {
        $thisData     =     Request::all();
        $validator     =     Validator::make(
            $thisData,
            array(
                'current_answer' => 'required',
                'current_question_id' => 'required',
            ),
            array(
                'current_answer.required' => trans('front_messages.course.REQUIRE_ERROR'),
            )
        );

        if ($validator->fails()) {
            Session::flash(ERROR, trans('front_messages.course.REQUIRE_ERROR'));
            return Redirect::back();
        } else {

            $current_question_id    =    isset($thisData['current_question_id']) ? $thisData['current_question_id'] : NULL;
            $current_answer            =    isset($thisData['current_answer']) ? $thisData['current_answer'] : NULL;
            $next_question_slug        =    isset($thisData['next_question_slug']) ? $thisData['next_question_slug'] : NULL;

            $queDetail = SurveQuestion::where('id', $current_question_id)->where('is_active', ACTIVE)->where('is_course_question', ACTIVE)->get();

            if ($queDetail->isNotEmpty()) {
                $getQuestionAnswerDetails = SurveyAnswer::findOrFail($current_answer);;
                Request::session()->put('course_name',    $getQuestionAnswerDetails->answer);
            }
            $answerArray    =    [];
            if (Session::has('answer_array')) {
                $answerArray    =    Session::get('answer_array');
            }

            $answerArray[]    =    array(
                'current_question_id' => $current_question_id,
                'current_answer' => $current_answer,
                'next_question_slug' => $next_question_slug
            );
            Session::put('answer_array', $answerArray);


            if ($next_question_slug) {
                return Redirect::route('survey.getAssistSteps');
            } else {
                return Redirect::route('survey.getAssistFinalStep');
            }
        }
    }







    public function getAssistPreviousStep()
    {
        $answerArray    =    [];
        if (Session::has('answer_array')) {
            $answerArray    =    Session::get('answer_array');
        }

        if (!empty($answerArray)) {
            $myLastElement            =    end($answerArray);
            $saved_current_answer    =    isset($myLastElement['current_answer']) ? $myLastElement['current_answer'] : NULL;
            Session::put('saved_current_answer', $saved_current_answer);


            /* get last element */
            array_pop($answerArray);

            Session::put('answer_array', $answerArray);
        }

        return Redirect::route('survey.getAssistSteps');
    }


    public function getAssistFinalStep()
    {

        $answerArray    =    [];
        if (Session::has('answer_array')) {
            $answerArray    =    Session::get('answer_array');
        }
        if (Session::has('category')) {
            $category = Session::get('category');
        }
        $getAllQuestions = CustomHelper::getAllQuestionIdByCategory($category);
        $selectedQuestionAnswerArray = array();
        foreach ($answerArray as $answersQuestions) {
            if (!in_array($answersQuestions['current_question_id'], $getAllQuestions)) {
                Session::flash(ERROR, trans('front_messages.survey.form_incorret_message'));
                return Redirect::route('survey.getAssist');
            } else {
                $getQuestionAnswerDetails = SurveyAnswer::with('getQuestionDetails')->findOrFail($answersQuestions['current_answer']);
                $selectedQuestionAnswerArray[] = [
                    'question_id' => $getQuestionAnswerDetails->question_id,
                    'answer_id' => $getQuestionAnswerDetails->id,
                    'question' => $getQuestionAnswerDetails->getQuestionDetails->question,
                    'answer' => $getQuestionAnswerDetails->answer
                ];
                Session::put('selected_answer_array', $selectedQuestionAnswerArray);
            }
        }

        $stateList         =     [];
        $cityList         =     [];
        $mobileTextClass = 'mobile01';

        $dob             =     Request::old('dob');
        $old_country     =     Request::old('country');
        $old_state         =    Request::old('state');

        if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId   = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }

        return View::make('Survey::front.get_assist_final_step', compact('stateList', 'cityList', 'old_state', 'mobileTextClass'));
    } //end stepone()


    public function getAssistFinalStepSave()
    {
        $courseSlug = "";

        if (Session::has('category')) {
            $category = Session::get('category');
        }

        if (Session::has('selected_answer_array')) {
            $answerArray    =    Session::get('selected_answer_array');
        }

        if (Session::has('course_name')) {
            $courseName    =    Session::get('course_name');
            $course   = DropDown::where('dropdown_type', 'course')->where('name', $courseName)->where('status', ACTIVE)->select('id', 'name', 'slug')->get()->first();

            if ($course != null) {
                $courseSlug =  $course->slug;
            }
        }

        $thisData = Request::all();

        $validator = Validator::make(
            $thisData,
            array(
                'gender'     => 'required',
                'full_name' => 'required|max:200',
                'email'     => 'required|email|max:200',
                'phone_number_with_dial_code'     => 'required',
                'dob'     => 'required',
                'state'     => 'required',
                'city'     => 'required',

            ),
            array(
                'gender.required'      => trans('front_messages.city.REQUIRED_ERROR'),
                'full_name.required' => trans('front_messages.full_name.REQUIRED_ERROR'),
                'full_name.max' => trans('front_messages.full_name.MAX_ERROR'),
                'email.required' => trans('front_messages.email.REQUIRED_ERROR'),
                'email.email' => trans('front_messages.email.VALID_REQUIRED_ERROR'),
                'email.max' => trans('front_messages.email.MAX_ERROR'),
                'dob.required'      => trans('front_messages.dob.REQUIRED_ERROR'),
                'state.required'      => trans('front_messages.state.REQUIRED_ERROR'),
                'city.required'      => trans('front_messages.city.REQUIRED_ERROR'),
                'phone_number_with_dial_code.required'      => trans('front_messages.phone_number_with_dial_code.REQUIRED_ERROR'),

            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $recaptchaResponse = Request::input('g-recaptcha-response');
            $secret = env('GOOGLE_RECAPTCHA_SECRET');
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse);
            $responseData = (array) json_decode($verifyResponse);

            // if (!isset($responseData['success']) || empty($responseData['success'])) {
            //     $validator->after(function ($validator) {
            //         $validator->errors()->add("g-recaptcha-response", trans('front_messages.contact.recaptcha_error'));
            //     });
            // }

            $expert_slug    =   Request::session()->get('expert_slug');

            $expertData  =  Expert::where('slug', $expert_slug)->first();
            $expert_id   = isset($expertData->id) ? $expertData->id : null;

            $obj                              = new Survey;
            $obj->expert_id                   = $expert_id;
            $obj->degree                      = isset($category) ? $category : null;
            $obj->gender                      = isset($thisData['gender']) ? $thisData['gender'] : null;
            $obj->name                        = isset($thisData['full_name']) ? $thisData['full_name'] : null;
            $obj->email                       = isset($thisData['email']) ? $thisData['email'] : null;
            $obj->phone_number_with_dial_code = isset($thisData['phone_number_with_dial_code']) ? $thisData['phone_number_with_dial_code'] : null;
            $obj->phone                       = isset($thisData['phone_number']) ? $thisData['phone_number'] : null;
            $obj->date_of_birth                  = isset($thisData['dob']) ? $thisData['dob'] : null;
            $obj->state                          = isset($thisData['state']) ? $thisData['state'] : null;
            $obj->city                          = isset($thisData['city']) ? $thisData['city'] : null;

            $obj->save();

            if ($obj->save()) {

                foreach ($answerArray as $answersSelected) {
                    $surveyQuestionAnswer = new SurveyQuestionAnswer;
                    $surveyQuestionAnswer->survey_id = $obj->id;
                    $surveyQuestionAnswer->category_id = $category;
                    $surveyQuestionAnswer->question_id = $answersSelected['question_id'];
                    $surveyQuestionAnswer->answer_id = $answersSelected['answer_id'];
                    $surveyQuestionAnswer->question = $answersSelected['question'];
                    $surveyQuestionAnswer->answer = $answersSelected['answer'];
                    $surveyQuestionAnswer->save();
                }


                $name           = isset($obj->name) ? $obj->name : "";
                $email          = isset($obj->email) ? $obj->email : "";
                $phone          = isset($obj->phone_number_with_dial_code) ? $obj->phone_number_with_dial_code : "";
                $date_of_birth  = isset($obj->date_of_birth) ? $obj->date_of_birth : "";
                $state          = isset($obj->state) ? CustomHelper::get_state_name($obj->state) : "";
                $city           = isset($obj->city) ? CustomHelper::get_city_name($obj->city) : "";
                $degree         = isset($obj->degree) ? Config::get('SURVE_QUESTION_CATEGORY.'.$obj->degree) : "";

                if(!$expert_id == null){
                    $expert_name    = isset($expertData->name) ? $expertData->name : "";
                    
					$action         = "contact_expert";
					$to             = config::get('Site.contact_email');
					$to_name        = config::get('Email.username');
					$site_signature = Config::get('Site.site_signature');
                    $url = route('Survey.view', $obj->id);
					$rep_Array      = array($expert_name,$name,$email, $phone, $date_of_birth, $state,$city,$degree,$url);
					$sendMail       = new SendMailService;
					$sendMail->callSendMail($to, $to_name, $rep_Array, $action);
				}
				else{
					$action         = "survey_request";
					$to             = config::get('Site.contact_email');
					$to_name        = config::get('Email.username');
					$site_signature = Config::get('Site.site_signature');
                    $url = route('Survey.view', $obj->id);
					$rep_Array      = array($name,$email, $phone, $date_of_birth, $state,$city,$degree,$url);
					$sendMail       = new SendMailService;
					$sendMail->callSendMail($to, $to_name, $rep_Array, $action);
				}
 
                Session::flash(SUCCESS, trans("front_messages.global.added_message"));
                Request::session()->forget(['degree', 'course', 'specialization', 'budget', 'qualification', 'score', 'expert_slug']);
                return Redirect::route('University.listing', ['courses' => $courseSlug]);
            } else {
                Session::flash(ERROR, trans("front_messages.global.something_went_wrong_msg"));
                Request::session()->forget(['degree', 'course', 'specialization', 'budget', 'qualification', 'score', 'expert_slug']);
                return Redirect::route('home.index');
            }
        }
    }
} // end HomeController class
