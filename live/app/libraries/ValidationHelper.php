<?php

namespace App\libraries;

/**
 * Validation Helper
 *
 * Add your methods in the class below
 */
class ValidationHelper
{

    /**
     * ValidationHelper::getCountryValidation()
     * @Description Function
     * @param null
     * @return $validation message and validation
     * */
    public static function getCountryValidation($formData = array(), $modelId = 0)
    {
        /* define validatation messages */
        $message = array(
            'country_name.required' => trans('messages.country_name.REQUIRED_ERROR'),
            'country_name.unique' => trans('messages.country_name.REQUIRED_UNIQUE_ERROR'),
            'country_name.max' => trans('messages.country_name.REQUIRED_MAX_ERROR'),
            'country_iso_code.required' => trans('messages.country_iso_code.REQUIRED_ERROR'),
            'country_iso_code.unique' => trans('messages.country_iso_code.REQUIRED_UNIQUE_ERROR'),
            'country_iso_code.max' => trans('messages.country_iso_code.REQUIRED_MAX_ERROR'),
            'country_iso_code.unique_case_sensitive' => trans('messages.country_iso_code.REQUIRED_unique_case_sensitive_ERROR'),
            'country_code.required' => trans('messages.country_code.REQUIRED_ERROR'),
            'country_code.numeric' => trans('messages.country_code.REQUIRED_NUMARIC_ERROR'),
            'country_code.unique' => trans('messages.country_code.REQUIRED_UNIQUE_ERROR'),
            'country_status.required' => trans('messages.country_status.REQUIRED_ERROR'),
            'image.required' => trans('messages.slider_image.REQUIRED_ERROR'),
            'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['valid_extensions' => IMAGE_EXTENSION]),
            'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE]),
        );
        /* define validatation   messages */

        /* define validation */
        $validate['country_name'] = 'required|max:70|unique:countries,country_name,' . $modelId . ',id';
        $validate['country_iso_code'] = 'required|max:3|unique:countries,country_iso_code,' . $modelId . ',id|unique_case_sensitive_edit:' . $modelId . '';
        $validate['country_code'] = 'required|numeric|unique:countries,country_code,' . $modelId . ',id';
        $validate['image'] = 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE * 1024) . '|mimes:' . IMAGE_EXTENSION;

        if (!$modelId) {
            $validate['country_status'] = 'required';
        }

        return array($message, $validate);
        /* define validation */
    } // End getCountryValidation()


    /**
     * ValidationHelper::getStateValidation()
     * @Description Function
     * @param null
     * @return $validation message and validation
     * */
    public static function getStateValidation($formData = array(), $modelId = 0)
    {
        /* define validatation messages */
        $message = array(
            'state_name.required' => trans('messages.state_name.REQUIRED_ERROR'),
            'state_name.max' => trans('messages.state_name.REQUIRED_MAX_ERROR'),
            'state_code.required' => trans('messages.state_code.REQUIRED_ERROR'),
            'state_code.unique' => trans('messages.state_code.REQUIRED_UNIQUE_ERROR'),
            'state_code.min' => trans('messages.state_code.REQUIRED_MIN_ERROR'),
            'state_code.max' => trans('messages.state_code.REQUIRED_MAX_ERROR'),
            'state_status.required' => trans('messages.state_status.REQUIRED_ERROR'),
        );
        /* define validatation messages */

        /* define validation */
        $validate['state_name'] = 'required|max:80';
        /* $validate['state_code'] = 'required|min:2|max:10|unique:states,state_code,' . $modelId . ',id';*/
        $validate['state_code'] = 'required|min:2|max:10';

        if (!$modelId) {
            $validate['state_status'] = 'required';
        }
        return array($message, $validate);
        /* define validation */
    } // End getStateValidation()


    /**
     * ValidationHelper::getCityValidation()
     * @Description Function
     * @param null
     * @return $validation message and validation
     * */
    public static function getCityValidation($formData = array(), $modelId = 0)
    {
        /* define validatation messages */
        $message = array(
            'city_name.required' => trans('messages.city_name.REQUIRED_ERROR'),
            'city_name.max' => trans('messages.city_name.REQUIRED_MAX_ERROR'),
            'city_status.required' => trans('messages.city_status.REQUIRED_ERROR'),
        );
        /* define validatation messages */

        /* define validation */
        $validate['city_name'] = 'required|max:80';

        if (!$modelId) {
            $validate['city_status'] = 'required';
        }
        return array($message, $validate);
        /* define validation */
    } // End getCityValidation()



    /**
     * ValidationHelper::getForgotPasswordValidation()
     * @Description Function  for validation on Forgot Password form
     * @Used at Front HomeController
     * @param null
     * @return $validation message and validation
     * */
    public static function getForgotPasswordValidation($formData, $attribute)
    {
        /* define validatation messages */
        $message = array(
            'email.required' => trans("messages.email.REQUIRED_ERROR"),
            'email.email' => trans("messages.valid_email.REQUIRE_ERROR"),
            'email.numeric' => trans("messages.valid_mobile_number_error"),
            'phone.required' => trans("messages.phone.REQUIRED_ERROR"),
        );

        /* define validation */
        if (isset($formData['phone'])) {
            $validate['phone'] = 'required';
        } else {
            $validate['email'] = 'required|email';
        }
        /* return validation with werror messages */
        return array($message, $validate);
    } //end getForgotPasswordValidation()




    /**
     * ValidationHelper::getResetPasswordValidation()
     * @Description Function  for validation on reset password form
     * @param null
     * @return $validation message and validation
     * */
    public static function getResetPasswordValidation($model = 'Login', $formData = array())
    {
        /* define validatation messages */
        $message = array(
            'password.required' => trans('messages.password.REQUIRED_ERROR'),
            'password.regex' => trans('messages.password.VALID_PASSWORD_ERROR'),
            'confirm_password.required' => trans('messages.confirm_password.REQUIRED_ERROR'),
            'confirm_password.same' => trans('messages.confirm_password.MATCH_ERROR'),
        );
        /* define validatation messages */

        /* define validation */
        $validate = array(
            'password' => 'required|regex:' . PASSWORD_REGX,
            'confirm_password' => 'required|same:password',
        );
        /* define validation */

        return array($message, $validate);
        /* define validation */
    }



    /**
     * ValidationHelper::getLoginValidation()
     * @Description Function  for get Login Validation
     * @param null
     * @return $validation message and validation
     * */
    public static function getLoginValidation($model = 'Login', $formData = array())
    {
        /* define validatation messages */
        $message = array(
            'email.required' => trans('messages.email.REQUIRED_ERROR'),
            'email.email' => trans('messages.email.VALID_EMAIL_ERROR'),
            'password.required' => trans('messages.password.REQUIRED_ERROR'),
        );
        /* define validatation messages */

        /* define validation */
        $validate['password'] = 'required';
        $validate['email'] = 'required|email';

        return array($message, $validate);
        /* define validation */
    } // End getLoginValidation()



    /**
     * ValidationHelper::getUserChangePasswordValidation()
     * @param formData array
     * @param model
     * @return $validation message and validation
     * */
    public static function getUserChangePasswordValidation()
    {
        /* define messages */
        $message = array(
            'new_password.required' => trans('front_messages.new_password.RQUIRED_ERROR'),
            'new_password.regex' => trans('front_messages.front.password_help_message'),
            'new_password.min' => trans('front_messages.new_password.MIN_ERROR'),
            'old_password.required' => trans('front_messages.old_password.REQUIRED_ERROR'),
            'old_password.min' => trans('front_messages.old_password.MIN_ERROR'),
            'old_password.regex' => trans('front_messages.front.password_help_message'),
            'confirm_password.required' => trans('front_messages.confirm_password.RQUIRED_ERROR'),
            'confirm_password.min' => trans('front_messages.confirm_password.MIN_ERROR'),
            'confirm_password.same' => trans('front_messages.confirm_password_message'),
        );

        /* define validation */
        $validate = array(
            'old_password' => 'required',
            'new_password' => 'required|regex:' . PASSWORD_REGX,
            'confirm_password' => 'required|same:new_password',
        );

        /* return validation messages */
        return array($message, $validate);
    }





    /**
     * ValidationHelper::getBlogValidation()
     * @Description Function  for validation Blog
     * @param $formData,$attribute
     * @return $validation message and validation
     **/
    public static function getBlogValidation($formData = array(), $attribute = array())
    {

        $message = array(
            'title.unique_val'          => trans('messages.unique_name_val'),
            'title.required'            => trans('messages.blog.TITLE_REQUIRE_ERROR'),
            'description.required'      => trans('messages.blog.DESCRIPTION_REQUIRE_ERROR'),
            'image.required'            => trans('messages.image.required_error'),
            'image.mimes'               => trans('messages.image.VALID_IMAGE_ERROR'),
            'image.max'                 => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            'image_1.required'          => trans('messages.image.required_error'),
            'image_1.mimes'             => trans('messages.image.VALID_IMAGE_ERROR'),
            'image_1.max'               => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            'meta_title.required'       => trans('messages.meta_title.required_error'),
            'meta_title.max'            => trans('messages.blog.MAX_TITLE_LENGTH_ERROR', ['max' => BLOG_META_LENGTH]),
            'meta_keyword.required'     => trans('messages.meta_keyword.required_error'),
            'meta_keyword.max'          => trans('messages.blog.MAX_KEYWORD_LENGTH_ERROR', ['max' => BLOG_META_LENGTH]),
            'meta_description.required' => trans('messages.meta_description.required_error'),
            'meta_description.max'      => trans('messages.blog.MAX_DESCRIPTION_LENGTH_ERROR', ['max' => BLOG_META_LENGTH]),

        );

        $validate = array(
            'title'                 => 'required|max:200|unique:blogs',
            'description'           => 'required',
            'image'                 => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            'image_1'               => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            'meta_title'            => 'required|max:' . BLOG_META_LENGTH,
            'meta_keyword'          => 'required|max:' . BLOG_META_LENGTH,
            'meta_description'      => 'required|max:' . BLOG_META_LENGTH,
        );
        if (isset($attribute['blog_id']) && !empty($attribute['blog_id'])) {
            $validate['title']              = 'required|max:200|unique:blogs,title,' . $attribute['blog_id'] . ',id';
            $validate['description']        = 'required';
            $validate['image']              = 'max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION;
            $validate['image_1']            = 'max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION;
            $validate['meta_title']         = 'required|max:' . BLOG_META_LENGTH;
            $validate['meta_keyword']       = 'required|max:' . BLOG_META_LENGTH;
            $validate['meta_description']   = 'required|max:' . BLOG_META_LENGTH;
        }

        return array($validate, $message);
    }


    public static function getCourseValidation($formData = array(), $model)
    {
        // pr($formData); die;
        $message = array(
            'course_id.required'            => trans('messages.course.course_id'),
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
            

        );

        $validate = array(
            'course_id'                 => 'required',
            'per_semester_fee'           => 'required|numeric',
            'total_fee'           => 'required|numeric',
            'one_time_fee'           => 'required|numeric',
            'tag_line'           => 'required',
            'image'                 => 'required|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION,
            
        );
        // if (isset($attribute['blog_id']) && !empty($attribute['blog_id'])) {
            
        //     $validate['image']              = 'max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION;
           
        // }

        return array($validate, $message);
    }


    /**
     * ValidationHelper:reviewRatingValidation()
     * @Description Function  for save reviewRatingSave
     * @param $formData  as form data
     * @param $attribute as other values
     * @return $validation message and validation
     * */
    public static function reviewRatingValidation($formData = array(), $attributes = array())
    {

       
        $message = array(
            'score.required' => trans('front_messages.ReviewRating.RATING_REQUIRED_ERROR'),
            'review_message.required' => trans('front_messages.review_message.RATING_REQUIRED_ERROR'),
            'review_message.max' => trans('front_messages.ReviewRating.RATING_MAX_ERROR', ['max' => REVIEW_MESSAGE_LENGTH]),
        );
        /* define validatation messages */

        /* define validation */
        $validate = array(
            'score' => 'required',
            'review_message' => 'required|max:' . REVIEW_MESSAGE_LENGTH,
        );


        /* define validation */
        return array($message, $validate);
    }
} // end ValidationHelper
