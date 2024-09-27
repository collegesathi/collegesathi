<?php

namespace App\Modules\TextSetting\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\TextSetting\Models\TextSetting;
use CustomHelper;
use App\Modules\Setting\Models\Setting;
use App\Modules\Language\Models\Language;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth, Blade,Config, Cache, Cookie, DB, File, Hash, Input, Mail, mongoDate, Redirect, Request, Response, Session, URL, View, Validator;
/**
 * text Settings Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/textsetting
 */

class JsTextSettingController extends BaseController
{
	public $model	=	'JsTextSetting';

	public function __construct() {
		View::share('modelName',$this->model);

	}

    public function index() {

        $upateArray = $this->bulkJsSettting();

        $currLangArray = '';

        foreach ($upateArray as $key => $val) {

            $currLangArray .= "var " . strtoupper($key) . " = '" . trans($val) . "';" . "\n";

        }

        $currLangArray .= '';

        $file = ROOT . DS . 'js' . DS . 'js_messages.js';

        $bytes_written = File::put($file, $currLangArray);
        if ($bytes_written === false) {
            die("Error writing to file");
        }

        echo WEBSITE_JS_URL.'js_messages.js';
        die;

    }

    private function bulkJsSettting() {

        $upateArray = array(

            /* Header Js */

            "ERROR_ENTER_FIRST_NAME"                =>   "front_messages.first_name_REQUIRE_ERROR",
            "ERROR_ENTER_LAST_NAME"                =>   "front_messages.last_name_REQUIRE_ERROR",
            "ERROR_ENTER_EMAIL_ADDRESS"             =>  "front_messages.global.ERROR_ENTER_EMAIL_ADDRESS",
            "ERROR_ENTER_VALID_EMAIL_ADDRESS"             =>   "front_messages.global.ERROR_ENTER_VALID_EMAIL_ADDRESS",
            "PLEASE_ENTER_VALID_MOBILE_NO"                =>    "front_messages.global.PLEASE_ENTER_VALID_MOBILE_NO",
            "ERROR_ENTER_SUBJECT"                         =>   "front_messages.global.ERROR_ENTER_SUBJECT",
            "ERROR_ENTER_MESSAGE"                         =>   "front_messages.global.ERROR_ENTER_MESSAGE",
            "ERROR_ENTER_OTP"                             =>   "front_messages.INVALID_OTP",
            "ERROR_ENTER_EMAIL_ADDRESS_OR_PHONE_NUMBER"      =>   "front_messages.global.ERROR_ENTER_EMAIL_OR_PHONE",
            "ERROR_ENTER_EMAIL_OR_MOBILE"                   =>   "front_messages.global.ERROR_ENTER_EMAIL_OR_PHONE",
            "ERROR_VALID_MOBILE_NO"                         =>   "front_messages.global.PLEASE_ENTER_VALID_MOBILE_NO",
            "ERROR_ENTER_PASSWORD"                          =>   "front_messages.login_password.REQUIRED_ERROR",
            "PASSWORD_HELP_MESSAGE"                         =>   "front_messages.global.password_help_message",
            "ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH"     =>   "front_messages.global.ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH",
            "ERROR_ENTER_CONFIRM_PASSWORD"                  =>   "front_messages.login_con_password.REQUIRED_ERROR",
            "ERROR_ENTER_MOBILE_NO"                         =>   "front_messages.global.ERROR_ENTER_MOBILE_NO",
            "ERROR_ENTER_VALID_VALUE"                       =>   "front_messages.global.ERROR_ENTER_MESSAGE",
            "ERROR_ACCEPT_TERMS_CONDITION"                  =>   "front_messages.global.ERROR_ACCEPT_TERMS_CONDITION",
            "ERROR_ENTER_NAME"                              =>   "front_messages.name_REQUIRE_ERROR",

            "PLEASE_SELECT_COUNTRY"                     =>      "messages.country.REQUIRED_ERROR",
            "PLEASE_SELECT_STATE"                       =>      "messages.State.REQUIRED_ERROR",
            "PLEASE_SELECT_CITY"                        =>      "messages.city.REQUIRED_ERROR",
            "PLEASE_SELECT_DATE_OF_BIRTH"               =>      "messages.date_of_birth.REQUIRED_ERROR",
            "ERROR_SELECT_TIME_ZONE"                    =>      "messages.timezone.REQUIRED_ERROR",
            "ERROR_SELECT_GENDER"                       =>      "messages.gender.REQUIRED_ERROR",
            "ERROR_ENTER_DOMESTIC_FEE"                  =>      "messages.domestic_fee.REQUIRED_ERROR",
            "ERROR_ENTER_INTERNATIONAL_FEE"             =>      "messages.international_fee.REQUIRED_ERROR",
            "ERROR_ENTER_SPECIALTITY_TAGS"              =>      "messages.speciality_tags.REQUIRED_ERROR",
            "ERROR_ENTER_ADDRESS"                       =>      "messages.address.REQUIRED_ERROR",
            "ERROR_ENTER_DESCRIPTION"                   =>      "messages.description.REQUIRED_ERROR",
            "ERROR_ENTER_HIGHEST_QUALIFICATION"         =>      "messages.highest_qualifications.REQUIRED_ERROR",
            "ERROR_ENTER_YEARS_EXPERIENCE"              =>      "messages.years_of_experience.REQUIRED_ERROR",

            /* Appointment Request */

            "ERROR_ENTER_APPOINTMENT_TITLE"             =>      "front_messages.appointment_title.REQUIRED_ERROR",
            "ERROR_ENTER_APPOINTMENT_DESCRIPTION"       =>      "front_messages.appointment_description.REQUIRED_ERROR",
            "ERROR_ENTER_APPOINTMENT_DATE"              =>      "front_messages.appointment_date.REQUIRED_ERROR",
            "ERROR_ENTER_APPOINTMENT_SLOT"              =>      "front_messages.appointment_slot.REQUIRED_ERROR",

            /* Blog */

            "ERROR_ENTER_BLOG_TITLE"                    => "messages.blog.TITLE_REQUIRE_ERROR",
            "ERROR_ENTER_DESCRIPTION"                   => "messages.blog.DESCRIPTION_REQUIRE_ERROR",
            "ERROR_ENTER_DESTINATION"                   =>  "messages.blog.SELECT_CITY_REQUIRE_ERROR",
            "ERROR_SELECT_IMAGE"                        =>  "messages.image.required_error",

            /* Consultant Profile Validation */

            "ERROR_NAME_VALIDATE"   => "front_messages.global.enter_alphabet_only",

            /* Expert Q/A */

            "ERROR_ANSWER_REQUIRED"   => "messages.answer.REQUIRED_ERROR",

            /* Expert Bank Details */

            "ERROR_NAME_BANK_REQUIRED"               =>  "messages.account_no.please_enter_name",
            "ERROR_ACCOUNT_REQUIRED"            =>  "messages.account_no.please_enter_account_no",
            "ERROR_CONFIRM_ACCOUNT_REQUIRED"    =>  "messages.account_no.please_enter_confirm_account_no",
            "ERROR_CONFIRM_ACCOUNT_MATCH_REQUIRED"    =>  "messages.account_no.account_confirm_no_not_match",

            /* Expert Price Request */

            "ERROR_NUMBER_VALIDATE"   => "front_messages.global.enter_number_only",


            /* Blog Image Size */
            "IMAGE_UPLOAD_FILE_MAX_SIZE_TWO"   => 2,
            "IMAGE_EXTENSION"   => IMAGE_EXTENSION,

            "IMAGE_EXTENSION_ERROR"   => "messages.image.VALID_IMAGE_ERROR",

        );

        return $upateArray;

    }


} //end TextSettingController class
