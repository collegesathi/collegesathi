<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\User\Models\User;
use App\Modules\Country\Models\Country;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\TextSetting\Models\TextSetting;
use App\Modules\Faq\Models\Faq;
use App\Modules\Faq\Models\FaqDescription;
use App\Modules\Slider\Models\Slider;
use Validator;
use App\Modules\SurveQuestionAnswer\Models\SurveyAnswer;
use App\Modules\SurveQuestionAnswer\Models\SurveQuestion;
use App\Modules\University\Models\Course;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /** Code is used for validate unique key value of textsetting in admin**/
        Validator::extend('check_email', function ($attribute, $value, $parameters, $validator) {

            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return false;
            } else {
                return true;
            }

        });
		
		
		/** Code is used for check email is exists in our db our not */
        Validator::extend('check_unique_email', function ($attribute, $value, $parameters, $validator) {
            $user_role_slug = 	(isset($parameters[0]) && !empty($parameters[0])) ? $parameters[0] : '';
            $user_id 		= 	(isset($parameters[1]) && !empty($parameters[1])) ? $parameters[1] : 0;
            $email 			= 	isset($value) ? $value : '';
            if (!empty($email) && !empty($user_role_slug)) {
                if (isset($user_id) && !empty($user_id)) {
                    $exist_email = User::where('email', $email)->where('user_role_slug', $user_role_slug)->where('id', '!=', $user_id)->count();
                } 
				else {
                    $exist_email = User::where('email', $email)->where('user_role_slug', $user_role_slug)->count();
                }
				
                if (!empty($exist_email)) {
                    return false;
                } else {
                    return true;
                }
            } 
			else {
                return false;
            }
        });

    
		/** Code is used for validate mobile number **/
        Validator::extend('valid_mobile_number', function ($attribute, $value, $parameters, $validator) {
            if (preg_match('/^\+?\d+$/', $value)) {
                return true;
            } else {
                return false;
            }
        });
		
		
		
		/** Code is used for check phone is exists in our db our not */
        Validator::extend('check_unique_phones', function ($attribute, $value, $parameters, $validator) {
            $user_role_slug = (isset($parameters[0]) && !empty($parameters[0])) ? $parameters[0] : '';
            $userId = (isset($parameters[1]) && !empty($parameters[1])) ? $parameters[1] : '';
            $phone = isset($value) ? $value : '';

            if (!empty($phone) && !empty($user_role_slug)) {
                if (!empty($userId)) {
                    $result = User::where('id', '!=', $userId)->where('user_role_slug', $user_role_slug)
                        ->where(function ($query) use ($phone) {
                            $query->where('phone', $phone)->orWhere('temp_phone', $phone);
                        })->count();

                } else {
                    $result = User::where('user_role_slug', $user_role_slug)
                        ->where(function ($query) use ($phone) {
                            $query->where('phone', $phone)->orWhere('temp_phone', $phone);
                        })->count();

                }

                if (!empty($result)) {
                    return false;
                }
				else {
                    return true;
                }
            } 
			else {
                return false;
            }
        });
		
		
		
		/*** Code is used for validate unique case secsitive in edit mode **/
        Validator::extend('unique_case_sensitive_edit', function ($attribute, $value, $parameters, $validator) {
            $id     = isset($parameters[0]) ? $parameters[0] : '';
            $result = array();
            if ($value != '') {
                $result = Country::where('country_iso_code', 'like', '%' . $value . '%')->where('id', '!=', $id)->first();
                if (empty($result)) {
                    return true;
                } else {
                    return false;
                }
            }
            die;
        });
		
		
		 
		/*
         * Code is used for validate unique key value of DropDown in admin
         * */
        Validator::extend('unique_dropdown', function ($attribute, $value, $parameters, $validator) {
            $type = isset($parameters[0]) ? $parameters[0] : '';
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if (isset($modelId) && !empty($modelId)) {
                $result = DropDown::where('dropdown_type', $type)->where('name', 'like', $value)->where('id', '!=', $modelId)->first();
            } else {
                $result = DropDown::where('dropdown_type', $type)->where('name', 'like', $value)->first();
            }

            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });
		
		
		
		/*
         * Code is used for validate unique key value of DropDown in admin
         * */
        Validator::extend('unique_dropdown_order', function ($attribute, $value, $parameters, $validator) {
            $type = isset($parameters[0]) ? $parameters[0] : '';
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if (isset($modelId) && !empty($modelId)) {
                $result = DropDown::where('dropdown_type', $type)->where('dropdown_order', $value)->where('id', '!=', $modelId)->first();
            } else {
                $result = DropDown::where('dropdown_type', $type)->where('dropdown_order', $value)->first();
            }

            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });
		
		
		
		/** Code is used for validate unique key value of textsetting in admin**/
        Validator::extend('unique_textsetting_key', function ($attribute, $value, $parameters, $validator) {
            $type = isset($parameters[0]) ? intval($parameters[0]) : '';
            $result = array();
            $result = TextSetting::where('type', $type)->where('key_value', $value)->first();

            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });

        /** Code is used for validate unique order of faq in admin**/
        Validator::extend('unique_faq', function ($attribute, $value, $parameters, $validator) {
            $university_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $course_id = isset($parameters[2]) ? intval($parameters[2]) : null;
            $result = array();
            if (isset($modelId) && !empty($modelId)) {
                if($university_id != null && $course_id == null){
                    $result = Faq::where('uni_id', $university_id)->where('course_id',null)->where('faq_order',$value)->where('id', '!=', $modelId)->first();
                } elseif($university_id != null && $course_id != null){
                    $result = Faq::where('uni_id', $university_id)->where('course_id',$course_id)->where('faq_order',$value)->where('id', '!=', $modelId)->first();
                } else{
                    $result = Faq::where('uni_id', null)->where('course_id',null)->where('faq_order',$value)->where('id', '!=', $modelId)->first();
                }
            }else{
                if($university_id != null && $course_id == null){
                    $result = Faq::where('uni_id', $university_id)->where('course_id',null)->where('faq_order',$value)->first();
                } elseif($university_id != null && $course_id != null){
                    $result = Faq::where('uni_id', $university_id)->where('course_id',$course_id)->where('faq_order',$value)->first();
                } else{
                    $result = Faq::where('uni_id', null)->where('course_id',null)->where('faq_order',$value)->first();
                }
            }
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die; 
        });

        /** Code is used for validate unique order of slider in admin**/
        Validator::extend('unique_slider', function ($attribute, $value, $parameters, $validator) {
            $university_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if (isset($modelId) && !empty($modelId)) {
                if($university_id){
                    $result = Slider::where('uni_id', $university_id)->where('slider_order',$value)->where('id', '!=', $modelId)->first();
                }else{
                    $result = Slider::where('uni_id', null)->where('slider_order',$value)->where('id', '!=', $modelId)->first();
                }
            }else{
                if($university_id){
                    $result = Slider::where('uni_id', $university_id)->where('slider_order',$value)->first();
                }else{
                    $result = Slider::where('uni_id', null)->where('slider_order',$value)->first();
                }
            }
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });






        Validator::extend('unique_servey_answer', function ($attribute, $value, $parameters, $validator) {
            $question_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if(isset($modelId) && !empty($modelId)){
                $result = SurveyAnswer::where('question_id', $question_id)->whereNot('id', $modelId)->where('answer_order',$value)->first();
            } else{
                $result = SurveyAnswer::where('question_id', $question_id)->where('answer_order',$value)->first();
            }
            
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });


        Validator::extend('unique_servey_question_order', function ($attribute, $value, $parameters, $validator) {
            $category_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if(isset($modelId) && !empty($modelId)){
                $result = SurveQuestion::where('category_id', $category_id)->whereNot('id', $modelId)->where('question_order',$value)->first();
            } else{
                $result = SurveQuestion::where('category_id', $category_id)->where('question_order',$value)->first();
            }
            
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die; 
        });



        Validator::extend('unique_servey_question', function ($attribute, $value, $parameters, $validator) {
            $category_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            if(isset($modelId) && !empty($modelId)){
                $result = SurveQuestion::where('category_id', $category_id)->whereNot('id', $modelId)->where('question',$value)->first();
            } else{
                $result = SurveQuestion::where('category_id', $category_id)->where('question',$value)->first();
            }
            
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die; 
        });




        Validator::extend('unique_course_display_order', function ($attribute, $value, $parameters, $validator) {
            $univercity_id 	= 	isset($parameters[0]) ? intval($parameters[0]) : null;
            $modelId = isset($parameters[1]) ? intval($parameters[1]) : '';
            $result = array();
            // pr($parameters);die;
            if(isset($modelId) && !empty($modelId)){
                $result = Course::where('univercity_id', $univercity_id)->whereNot('id', $modelId)->where('display_order',$value)->first();
            } else{
                $result = Course::where('univercity_id', $univercity_id)->where('display_order',$value)->first();
            }
            // pr($result);die;
            
            if (empty($result)) {
                return true;
            } else {
                return false;
            }
            die;
        });


    }
}
