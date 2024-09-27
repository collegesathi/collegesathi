<?php

namespace App\libraries;

use App\Modules\Country\Models\City;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Models\State;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\Language\Models\Language;
use App\Modules\User\Models\User;
use App\Modules\Cms\Models\Cms;
use App\Models\Currency;
use App\Models\BankInformation;
use App\Modules\RecipientUser\Models\RecipientUser;
use App\Modules\Testimonial\Models\Testimonial;
use App\Modules\NotificationTemplate\Models\NotificationTemplate;
use App\Modules\NotificationTemplate\Models\NotificationAction;
use App\Modules\PushNotificationTemplate\Models\PushNotificationTemplate;
use App\Modules\PushNotificationTemplate\Models\PushNotificationAction;
use App\Modules\Notification\Models\Notification;
use App\Modules\Block\Models\Block;
use App\Modules\Coupon\Models\Coupon;
use App\Models\PushLog;
use App\Modules\Transactions\Models\Transaction;
use App\Modules\Transactions\Models\UserBalanceAmountLog;
use App\Services\SendMailService;
use App\Modules\Expert\Models\Expert;
use App\Modules\Blog\Models\Blog;
use App\Modules\University\Models\University;
use App\Modules\University\Models\UniversityCampus;
use App\Modules\University\Models\Course;
use App\Modules\University\Models\Semester;
use App\Modules\ReviewRating\Models\ReviewRating;
use App\Modules\SurveQuestionAnswer\Models\SurveQuestion;
use App\Modules\University\Models\CourseSpecification;
use Config;
use Session;
use Str;
use HTML;
use PushNotification;
use Request;

/**
 * Custom Helper
 * Add your methods in the class below
 */
class CustomHelper
{

    public static function getCoursesWithSpecifications($courseCategoryId = null, $type = null)
    {

        $courseIds = Course::where('course_category', $courseCategoryId)->where('active', ACTIVE)->pluck('course_id', 'course_id')->toArray();
        
        if ($courseCategoryId == 1) {          
            unset($courseIds[16],$courseIds[134]);
        }
        if ($courseCategoryId == 2) {          
            unset($courseIds[128]);
        }
    
        if (isset($type) && !empty($type)) {
            $coursesWithSpecificationsAndUniversities = DropDown::where('dropdown_type', 'course')->where('dropdown_id', NULL)->whereIn('id', $courseIds)->where('status', ACTIVE)->orderby('dropdown_order', 'ASC')->select('id', 'name', 'slug')->get();
        } else {
            $coursesWithSpecificationsAndUniversities = DropDown::with(['coursesSpecifications', 'universityCourses'])->where('dropdown_type', 'course')->whereIn('id', $courseIds)->where('status', ACTIVE)->get();
        }

        return $coursesWithSpecificationsAndUniversities;
    }








    /**
     * CustomHelper::getConfigValue()
     * @Description Function  to get Config Values
     * @param config
     * @return string
     * */
    public static function getConfigValue($config)
    {
        return Config::get($config);
    } //end getConfigValue()

    /**
     * CustomHelper::displayDate()
     * @Description Function to display date
     * @param $date as date
     * @param $formate as date formate
     * @return formated date
     * */
    public static function displayDate($date = null, $formate = null)
    {
        $disply_date = !empty($formate) ? $formate : SHOW_DATE_FORMAT;
        return date($disply_date, strtotime($date));
    } //end displayDate()

    /**
     * CustomHelper::getLanguageArrayWithCode()
     * @Description Function  to get site languages array with lang id and lang code
     * @param null
     * @return array
     * */
    public static function getLanguageArrayWithCode()
    {
        $languages = Language::where('is_active', '=', ACTIVE)->pluck('title', 'id')->toArray();
        return $languages;
    } //end getLanguageArray()

    /**
     * CustomHelper::getSlug()
     * @Description Function  to get slug
     * @param $title as slug value
     * @param $fieldName as database field to get slug
     * @param $modelName as database model
     * @param $limit as slug character limit
     * @return slug
     **/
    public static function getSlug($title, $fieldName, $modelName, $module = null, $limit = 100)
    {
        if ($module == null) {
            $module = $modelName;
        }
        $slug = substr(Str::slug($title), 0, $limit);
        $Model = "App\Modules\\$module\Models\\$modelName";

        $slugCount = count($Model::whereRaw("{$fieldName} REGEXP '^{$slug}(-[0-9]*)?$'")->get());

        $returnableSlug = ($slugCount > 0) ? $slug . "-" . $slugCount : $slug;
        $slugVerifyCount = $Model::where($fieldName, $returnableSlug)->count();
        if ($slugVerifyCount > 0) {
            return self::getSlug($returnableSlug, $fieldName, $modelName, $module);
        } else {
            return ($slugCount > 0) ? $slug . "-" . $slugCount : $slug;
        }
    } //end getSlug()

    /**
     * CustomHelper::showImage()
     * @Description Function for show image
     * @param        $root_path ,
     * @param        $http_path,
     * @param        $image_name,
     * @param        $attribute all attributes of image like(height,width, class),
     * @return        image url
     * */
    public static function showImage($root_path = '', $http_path = '', $image_name = '', $type = '', $attribute = array())
    {
        // $alt = Configure::read('CONFIG_SITE_TITLE');
        $alt = trans("messages.custom.image");
        $height = '';
        $width = '';
        $class = '';
        $link_url = '';
        $zc = '0';
        $ct = '0';
        $cropratio = '';
        $img_id_val = '';
        if (isset($attribute['alt']) && $attribute['alt'] != '') {
            $alt = strip_tags($attribute['alt']);
        }
        if (isset($attribute['id']) && $attribute['id'] != '') {
            $img_id_val = $attribute['id'];
        }

        if (isset($attribute['height']) && $attribute['height'] != '') {
            $height = $attribute['height'];
        }

        if (isset($attribute['width']) && $attribute['width'] != '') {
            $width = $attribute['width'];
        }
        if (isset($attribute['class']) && $attribute['class'] != '') {

            $class = $attribute['class'];
        }

        if (isset($attribute['url']) && $attribute['url'] != '') {

            $link_url = $attribute['url'];
        }

        // override Default zoom/crop setting of img.php file .

        if (isset($attribute['zc']) && $attribute['zc'] != '') {

            $zc = $attribute['zc'];
        }

        if (isset($attribute['ct']) && $attribute['ct'] != '') {

            $ct = $attribute['ct'];
        }

        if (isset($attribute['type']) && $attribute['type'] != '') {

            $type = $attribute['type'];
        }

        if (isset($attribute['cropratio']) && $attribute['cropratio'] != '') {

            $cropratio = $attribute['cropratio'];
        }

        $height = str_replace("px", "", $height);
        $width = str_replace("px", "", $width);

        if (file_exists($root_path . $image_name) && !empty($image_name)) {
            $url = WEBSITE_IMG_FILE_URL . '?image=' . $http_path . $image_name . '&amp;height=' . $height . '&amp;webp=1&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;

            $html = '<img src="' . $url . '" alt="' . $alt . '" class="' . $class . '">';
            return $html;
        } else {

            if ($type == 3) {
                $url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/no-user.png' . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;
                $html = HTML::image($url, $alt, array('class' => $class));
                return $html;
            } else {
                $url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/icon-no-image.png' . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;
                $html = HTML::image($url, $alt, array('class' => $class));
                return $html;
            }
        }
    } // end showImage()

    /**
     * CustomHelper::showImage()
     * @Description Function for show image
     * @param        $root_path ,
     * @param        $http_path,
     * @param        $image_name,
     * @param        $attribute all attributes of image like(height,width, class),
     * @return        image url
     * */
    public static function showImageWithLightBox($root_path = '', $http_path = '', $image_name = '', $type = '', $attribute = array())
    {
        $alt = trans("messages.custom.image");
        $height = '';
        $width = '';
        $class = '';
        $link_url = '';
        $zc = '0';
        $ct = '0';
        $cropratio = '';
        $img_id_val = '';
        if (isset($attribute['alt']) && $attribute['alt'] != '') {
            $alt = strip_tags($attribute['alt']);
        }
        if (isset($attribute['id']) && $attribute['id'] != '') {
            $img_id_val = $attribute['id'];
        }

        if (isset($attribute['height']) && $attribute['height'] != '') {
            $height = $attribute['height'] . 'px';
        }

        if (isset($attribute['width']) && $attribute['width'] != '') {
            $width = $attribute['width'] . 'px';
        }
        if (isset($attribute['class']) && $attribute['class'] != '') {

            $class = $attribute['class'];
        }

        if (isset($attribute['url']) && $attribute['url'] != '') {

            $link_url = $attribute['url'];
        }

        // override Default zoom/crop setting of img.php file .

        if (isset($attribute['zc']) && $attribute['zc'] != '') {

            $zc = $attribute['zc'];
        }

        if (isset($attribute['ct']) && $attribute['ct'] != '') {

            $ct = $attribute['ct'];
        }

        if (isset($attribute['type']) && $attribute['type'] != '') {

            $type = $attribute['type'];
        }

        if (isset($attribute['cropratio']) && $attribute['cropratio'] != '') {

            $cropratio = $attribute['cropratio'];
        }



        $height = str_replace("px", "", $height);
        $width = str_replace("px", "", $width);


        if (file_exists($root_path . $image_name) && !empty($image_name)) {
            $url = WEBSITE_IMG_FILE_URL . '?image=' . $http_path . $image_name . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;
            $html = '<img src="' . $url . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" class="' . $class . '">';

            $returnHtml = '<a class="items-image" data-lightbox="roadtrip' . $image_name . '" href="' . $http_path . $image_name . '">' . $html . '</a>';

            return $returnHtml;
        } else {

            if ($type == 3) {
                $url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/no-user.png' . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;
                $html = HTML::image($url, $alt, array('width' => $width, 'height' => $height, 'class' => $class));

                $returnHtml = '<a class="items-image" data-lightbox="roadtrip-no-user.png" href="' . WEBSITE_IMG_URL . 'admin/no-user.png">' . $html . '</a>';

                return $returnHtml;
            } else {
                $url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/icon-no-image.png' . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;
                $html = HTML::image($url, $alt, array('width' => $width, 'height' => $height, 'class' => $class));

                $returnHtml = '<a class="items-image" data-lightbox="roadtrip-no-user.png" href="' . WEBSITE_IMG_URL . 'admin/icon-no-image.png">' . $html . '</a>';

                return $returnHtml;
            }
        }
    } // end showImageWithLightBox()

    /**
     * CustomHelper::getFieldValueByFieldName()
     * @Description Function  to get field name by field value
     * @param $value
     * @param $fieldName as field name by which value is to be find
     * @param $model
     * @param $field as field name of which value is to be find
     * @return id
     * */
    public static function getFieldValueByFieldName($value = null, $fieldName = null, $model = null, $field = null, $module = null)
    {
        $result = '';
        if (!empty($value) && !empty($model) && !empty($fieldName) && !empty($field)) {
            $Model = "\App\Modules\\$module\Models\\$model";
            $result = $Model::where($fieldName, $value)->pluck($field)->first();
        }
        return $result;
    } //end getFieldValueByFieldName

    public static function getCurrentLanguage()
    {
        $currentLanguage = Session::has('language');

        return $currentLanguage;
    }

    /**
     * CustomHelper::showImageUrl()
     * @Description Function for show image
     * @param        $root_path ,
     * @param        $http_path,
     * @param        $image_name,
     * @param        $attribute all attributes of image like(height,width, class),
     * @return        image url
     * */
    public static function showImageUrl($root_path = '', $http_path = '', $image_name = '', $type = '', $attribute = array())
    {
        $alt = trans("messages.custom.image");
        $height = '';
        $width = '';
        $class = '';
        $link_url = '';
        $zc = '0';
        $ct = '0';
        $cropratio = '';
        $img_id_val = '';
        if (isset($attribute['alt']) && $attribute['alt'] != '') {
            $alt = strip_tags($attribute['alt']);
        }
        if (isset($attribute['id']) && $attribute['id'] != '') {
            $img_id_val = $attribute['id'];
        }

        if (isset($attribute['height']) && $attribute['height'] != '') {
            $height = $attribute['height'] . 'px';
        }

        if (isset($attribute['width']) && $attribute['width'] != '') {
            $width = $attribute['width'] . 'px';
        }
        if (isset($attribute['class']) && $attribute['class'] != '') {

            $class = $attribute['class'];
        }

        if (isset($attribute['url']) && $attribute['url'] != '') {

            $link_url = $attribute['url'];
        }

        // override Default zoom/crop setting of img.php file .

        if (isset($attribute['zc']) && $attribute['zc'] != '') {

            $zc = $attribute['zc'];
        }

        if (isset($attribute['ct']) && $attribute['ct'] != '') {

            $ct = $attribute['ct'];
        }

        if (isset($attribute['type']) && $attribute['type'] != '') {

            $type = $attribute['type'];
        }

        if (isset($attribute['cropratio']) && $attribute['cropratio'] != '') {

            $cropratio = $attribute['cropratio'];
        }


        $height = str_replace("px", "", $height);
        $width = str_replace("px", "", $width);


        if (file_exists($root_path . $image_name) && !empty($image_name)) {

            $url = WEBSITE_IMG_FILE_URL . '?image=' . $http_path . $image_name . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;

            return $url;
        } else {

            $url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/no-image.jpg' . '&amp;height=' . $height . '&amp;width=' . $width . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio;

            return $url;
        }
    } // end showImageUrl()

    /**
     * CustomHelper::convert_date_to_timestamp()
     * @Description Function  to get timestamp value of any date
     * @param $date date
     * @return timestamp
     * */
    public static function convert_date_to_timestamp($date = null, $formate = null)
    {
        if ($formate == 'DD/MM/YYYY') {
            $dataArray = explode("/", $date);
            $dateYear = isset($dataArray[2]) ? $dataArray[2] : 1970;
            $dateMonth = isset($dataArray[1]) ? $dataArray[1] : 01;
            $dateDay = isset($dataArray[0]) ? $dataArray[0] : 01;
            return strtotime($dateYear . "-" . $dateMonth . "-" . $dateDay);
        } else {
            return strtotime($date);
        }
    }

    /**
     * GeneralFunctionsHelper::get_country_name()
     * @Description Function  to get country name
     * @param $country_id
     * @return $country_name
     * */
    public static function get_country_name($country_id = null)
    {
        $country = Country::where('id', $country_id)->pluck('country_name', 'id')->toArray();
        return $country[$country_id];
    }

    /**
     * GeneralFunctionsHelper::get_state_name()
     * @Description Function  to get country name
     * @param $country_id
     * @return $country_name
     * */
    public static function get_state_name($state_id = null)
    {
        $state = State::where('id', $state_id)->pluck('state_name', 'id')->toArray();
        return $state[$state_id];
    }

    /**
     * GeneralFunctionsHelper::get_state_name()
     * @Description Function  to get country name
     * @param $country_id
     * @return $country_name
     * */
    public static function get_city_name($city_id = null)
    {
        $city = City::where('id', $city_id)->pluck('city_name', 'id')->toArray();
        return $city[$city_id];
    }

    /**
     * CustomHelper::getMasterDropdown()
     * @Description Function for get master dropdown
     * @param $drop_down As slug of dropdown
     * @return array
     **/
    public static function getMasterDropdown($drop_down, $order_by_field = 'name', $order_direction = "ASC")
    {
        if (in_array($drop_down, DROPDOWN_TYPES_FOR_ORDER)) {
            $order_by_field = 'dropdown_order';
        }

        $master = DropDown::where('dropdown_type', $drop_down)->where('dropdown_id', NULL)->where('status', (int) ACTIVE)->orderby($order_by_field, $order_direction)->pluck('name', 'id')->toArray();

        return $master;
    } //end getMasterDropdown()


    /**
     * CustomHelper::getMasterDropdownNameById()
     * @param DropdwonId
     * @param $drop_down As slug of dropdown
     * @return array
     **/
    public static function getMasterDropdownNameById($dropdown_id)
    {

        $dorpdownName = DropDown::where('id', $dropdown_id)->where('status', (int) ACTIVE)->pluck('name')->first();
        return $dorpdownName;
    } //end getMasterDropdownNameById()


    /**
     * CustomHelper::getStringLimit()
     * @Description Function  to get String Limit
     * @param $stringData As data
     * @return trimed string
     **/
    public static function getStringLimit($stringData, $limit = 20)
    {
        $stringLimit = Str::limit(strip_tags($stringData), $limit, $end = '...');

        return $stringLimit;
    } //end getStringLimit()

    /**
     * CustomHelper::getCountry()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getCountry()
    {
        $countryList = array();
        $countryList = Country::where('status', ACTIVE)->pluck('country_name', 'id')->all();
        return $countryList;
    } //end getCountry()

    /**
     * CustomHelper::getStateList()
     * @Description Function  to get state name and id
     * @param $countryId
     * @return $stateList
     **/
    public static function getStateList($countryId = null, $locale = null)
    {
        $stateList = array();
        if (empty($locale)) {
            $stateList = State::where('country_id', $countryId)->where('status', ACTIVE)->orderBy('state_name', 'ASC')->pluck('state_name', 'id')->toArray();
        } else {
            $stateList = State::where('country_id', $countryId)->where('status', ACTIVE)->orderBy('state_name', 'ASC')->pluck($locale . '.state_name', 'id')->toArray();
        }

        return $stateList;
    } //end getStateList()

    /**
     * CustomHelper::getCityList()
     * @Description Function  to get city name and id
     * @param $countryId , $stateId
     * @return $city_list
     **/
    public static function getCityList($countryId = null, $stateId = null, $locale = null)
    {
        $cityList = array();
        if (empty($locale)) {
            $cityList = City::where('country_id', $countryId)->where('state_id', $stateId)->where('status', ACTIVE)->orderBy('city_name', 'ASC')->pluck('city_name', 'id')->toArray();
        } else {
            $cityList = City::where('country_id', $countryId)->where('state_id', $stateId)->where('status', ACTIVE)->orderBy('city_name', 'ASC')->pluck($locale . '.city_name', 'id')->toArray();
        }

        /*
        if (empty($cityList)) {
            $city_name = CustomHelper::getFieldValueByFieldName($stateId, 'id', 'State', 'state_name', 'Country');
            $slug = self::getSlug($city_name, 'city_name', 'City', 'Country');
            $city = new City;
            $city->city_name = $city_name;
            $city->state_id = $stateId;
            $city->country_id = $countryId;
            $city->slug = $slug;
            $city->status = ACTIVE;
            $city->save();

            $cityList = City::where('country_id', $countryId)->where('state_id', $stateId)->where('status', ACTIVE)->orderBy('city_name', 'ASC')->pluck($locale . '.city_name', 'id')->toArray();
        }*/

        return $cityList;
    } //end getCityList()

    /**
     *  Function to get state and city list
     *
     * @param int $state id
     * @return hub name
     */
    public static function getStateCityList($countryId = 0, $stateId = 0)
    {
        $stateList = array();
        $cityList = array();
        $cityList = City::where('status', ACTIVE)->where('country_id', $countryId)->where('state_id', $stateId)->pluck('city_name', 'id')->toArray();
        $stateList = State::where('status', ACTIVE)->where('country_id', '=', $countryId)->orderBy('state_name', 'ASC')
            ->pluck('state_name', 'id')->toArray();
        return array($stateList, $cityList);
    } // end getStateCity()

    /**
     * CustomHelper::getFullName()
     * @Description Function  to make FullName
     * @param $firstName as first name
     * @param $LastName as last name
     * @return full Name
     * */
    public static function getFullName($firstName, $lastName)
    {
        $result = $firstName . ' ' . $lastName;
        return ucwords($result);
    } //end getFullName

    /**
     * CustomHelper::getValidateString()
     * @Description Function  to make validate string
     * @param $string as value
     * @return string
     * */
    public static function getValidateString($string)
    {
        $result = md5(time() . $string);
        return $result;
    } //end getValidateString

    /**
     * CustomHelper::showImage()
     * @Description Function for show image
     * @param        $root_path ,
     * @param        $http_path,
     * @param        $image_name,
     * @param        $attribute all attributes of image like(height,width, class),
     * @return        image url
     * */
    public static function showUserImage($root_path = '', $http_path = '', $image_name = '', $gender = '', $attribute = array())
    {
        $alt = Config::get('Site.title');
        $height = '90';
        $width = '90';
        $class = '';
        $zc = '1';
        $ct = '0';
        $cropratio = '';
        $img_id_val = '';
        if (isset($attribute['alt']) && $attribute['alt'] != '') {
            $alt = strip_tags($attribute['alt']);
        }
        if (isset($attribute['id']) && $attribute['id'] != '') {
            $img_id_val = $attribute['id'];
        }

        if (isset($attribute['height']) && $attribute['height'] != '') {
            $height = $attribute['height'];
        }

        if (isset($attribute['width']) && $attribute['width'] != '') {
            $width = $attribute['width'];
        }
        if (isset($attribute['class']) && $attribute['class'] != '') {

            $class = $attribute['class'];
        }
        if (isset($attribute['zc']) && $attribute['zc'] != '') {

            $zc = $attribute['zc'];
        }

        if (isset($attribute['ct']) && $attribute['ct'] != '') {

            $ct = $attribute['ct'];
        }
        if (isset($attribute['cropratio']) && $attribute['cropratio'] != '') {

            $cropratio = $attribute['cropratio'];
        }

        $height = str_replace("px", "", $height);
        $width = str_replace("px", "", $width);

        if (file_exists($root_path . $image_name) && !empty($image_name)) {
            $user_image_name = $image_name;
            $user_image_path = $http_path . $user_image_name;
        } else {
            if (isset($gender) && $gender == Config::get('GENDER_VALUE.Female')) {
                $user_image_name = 'user-female.png';
                $user_image_path = $http_path . $user_image_name;
            } elseif (isset($gender) && $gender == Config::get('GENDER_VALUE.Male')) {
                $user_image_name = 'user-male.png';
                $user_image_path = $http_path . $user_image_name;
            } else {
                $user_image_name = 'user-male.png';
                $user_image_path = $http_path . $user_image_name;
            }
        }

        $html = '<a class="items-image" data-lightbox="roadtrip' . $user_image_name . '" href="' . $user_image_path . '"><div class="' . $class . ' usermgmt_image"><img class="img-circle"  src="' . WEBSITE_URL . 'image.php?width=' . $width . '&amp;height=' . $height . '&amp;zc=' . $zc . '&amp;ct=' . $ct . '&amp;cropratio=' . $cropratio . '&image=' . $user_image_path . '" alt="' . $alt . '"></div></a>';

        return $html;
    } // end showImage()

    /**
     * CustomHelper::randomPassword()
     * @Description Function  user to genrate password
     * @param $length
     * @return password
     * */
    public static function randomPassword($length)
    {
        $len = $length;

        //define character libraries - remove ambiguous characters like iIl|1 0oO
        $sets = array();
        $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        $sets[] = '123456789';
        $sets[] = '~!@#$%^&*';

        $password = '';

        //append a character from each set - gets first 4 characters
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
        }

        //use all characters to fill up to $len
        while (strlen($password) < $len) {
            //get a random set
            $randomSet = $sets[array_rand($sets)];

            //add a random char from the random set
            $password .= $randomSet[array_rand(str_split($randomSet))];
        }

        //shuffle the password string before returning!
        $res = str_shuffle($password);

        return $res; // return the generated password
    } //end randomPassword()

    /**
     * CustomHelper::convert_timestamp_to_date_time()
     * @Description Function  to get timestamp value of any date
     * @param $date date
     * @return timestamp
     * */
    public static function convert_timestamp_to_date_time($timestamp = null, $format = DISPLAY_DATE_TIME_FORMAT)
    {
        return date($format, $timestamp);
    }

    /**
     * CustomHelper::getState()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getState($countryId = '')
    {
        $stateList = array();
        $stateList = State::where('status', ACTIVE)->where('country_id', '=', $countryId)->orderBy('state_name', 'ASC')
            ->pluck('state_name', 'id')->toArray();
        return $stateList;
    } //end getState()

    /**
     * CustomHelper::getUserList()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getUserList()
    {
        $userList = array();
        $results = User::where('user_role_slug', CUSTOMER_ROLE_SLUG)->whereNot('is_deleted', ACTIVE)->select('full_name', 'email', 'id')->get();

        foreach ($results as $result) {
            $userList[$result->id] = $result->full_name . " (" . $result->email . ")";
        }

        return $userList;
    } //end getUserList()

    /**
     * CustomHelper::displayPrice()
     * @Description Function to display price
     * @param $price as price
     * @return formated price
     * */
    public static function displayPrice($price = null)
    {
        if ($price == '') {
            $price = INACTIVE;
        }

        $currencyCode = Config::get("Site.currencyCode");

        return $currency_symbol = $currencyCode . ' ' . number_format($price, 2) . '/-';
    } //end displayPrice()

    /**
     * CustomHelper::getArrayFormat()
     * Function to change key value array in id and text form
     * @param array()
     * @return array()
     * */
    public static function getArrayFormat($array = array(), $firstIndex, $secondIndex)
    {
        if (!empty($array)) {
            $counter = 0;
            $getArray = array();
            foreach ($array as $key => $value) {
                $getArray[$counter][$firstIndex] = $key;
                $getArray[$counter][$secondIndex] = $value;
                $counter++;
            }
            return $getArray;
        } else {
            $array[0][$firstIndex] = '';
            $array[0][$secondIndex] = 'Please Select';
            return $array;
        }
    } // end getArrayFormat()

    public static function getUserIdBySlug($slug = '')
    {
        $userData = array();
        if ($slug != '') {
            $userData = User::where("active", ACTIVE)->where("is_deleted", INACTIVE)->where('slug', $slug)->get()->first();

            if (!empty($userData)) {
                $userData = $userData->toArray();
            } else {
                $userData = array();
            }
        }
        return $userData;
    }




    /**
     * Function to get client List
     * */
    public static function getClientList()
    {
        $getClientList = array();

        $clientList = User::where("active", ACTIVE)->where("is_deleted", INACTIVE)->where("user_role_slug", CUSTOMER_ROLE_SLUG)->orderBy('full_name', 'ASC')->select('full_name', 'email', 'id')->get();

        foreach ($clientList as $client) {
            $getClientList[$client->id] = $client->full_name . " (" . $client->email . ")";
        }

        return $getClientList;
    } // end getClientList()

    /**
     * Function to get Recipient List
     * */
    public static function getRecipientList($recipientCond = array())
    {
        $getRecipientList = array();

        $db = RecipientUser::where("is_active", ACTIVE)->where("is_deleted", INACTIVE);

        if (!empty($recipientCond)) {
            $db->where($recipientCond);
        }

        $results = $db->orderBy('recipient_name', 'ASC')->select('recipient_name', 'email', 'id')->get();


        foreach ($results as $result) {
            $getRecipientList[$result->id] = $result->recipient_name . " (" . $result->email . ")";
        }

        return $getRecipientList;
    } // end getRecipientList()

    /**
     * CustomHelper::getCurrentTime()
     * @Description Function to get current time
     * @param null
     * @return time
     * */
    public static function getCurrentTime()
    {
        return time();
    } //end getCurrentTime()

    /*
     * Function to getCmsPage()
     *
     * @param $tyep as
     *
     * @return null
     * */
    public static function getCmsPage($type = null, $forTeamPreview = false)
    {
        $result = array();
        if (!empty($type)) {

            if ($forTeamPreview) {
                $result = Cms::with('descriptionData')->where('slug', $type)->firstOrFail();
            } else {
                $result = Cms::with('descriptionData')->where('slug', $type)->where('is_active', ACTIVE)->firstOrFail();
            }
        }
        return $result;
    } //end getCmsPage()

    /**
     * AjaxdataController::getCurrencyConversion()
     * @description function to use for get curreny rates.
     * @param null
     * @return void
     **/
    public static function getCurrencyConversion($formData = array())
    {
        $converCurency = array();
        $initial_amount = isset($formData['initial_amount']) ? $formData['initial_amount'] : 1;
        $source_currency = isset($formData['source_currency']) ? $formData['source_currency'] : Config::get("Site.currencyCode");
        $required_currency = isset($formData['required_currency']) ? $formData['required_currency'] : Config::get("Site.currencyCode");
        $source_country = isset($formData['source_country']) ? $formData['source_country'] : null;

        $per_initial_amount = 1;

        if ($initial_amount >= .01) {

            $filename = WEBSITE_UPLOADS_ROOT_PATH . CURRENCY_LOG_FILE_NAME;
            if (file_exists($filename)) {

                $handle = fopen($filename, 'r');
                $currencyJsonArray = fread($handle, filesize($filename));
                $currencyConvertedArray = json_decode($currencyJsonArray, true);
                $sourceCurrencyValue = isset($currencyConvertedArray[$source_currency]) ? $currencyConvertedArray[$source_currency] : 1;
                $requiredCurrencyValue = isset($currencyConvertedArray[$required_currency]) ? $currencyConvertedArray[$required_currency] : 1;
            } else {
                $sourceCurrencyData = Currency::where('code', $source_currency)->first();
                $requiredCurrencyData = Currency::where('code', $required_currency)->first();
                $sourceCurrencyValue = isset($sourceCurrencyData->value) ? $sourceCurrencyData->value : 1;
                $requiredCurrencyValue = isset($requiredCurrencyData->value) ? $requiredCurrencyData->value : 1;
            }


            $total_usd = $initial_amount / $sourceCurrencyValue;
            $per_total_usd = $per_initial_amount / $sourceCurrencyValue;
            $total_destination_currency = $total_usd * $requiredCurrencyValue;
            $per_destination_currency = $per_total_usd * $requiredCurrencyValue;
            /*
            $siteTransCharge	            =	Config::get('Site.site_transaction_charges');
            $siteTransChargeType	        =	Config::get('Site.site_transaction_charges_type');
            */

            $processingFeeArray = self::getProcessingFee($source_country);
            $siteTransCharge = $processingFeeArray['processing_fee'];
            $siteTransChargeType = $processingFeeArray['processing_fee_type'];

            $processing_fee_text = $siteTransCharge;
            if ($siteTransChargeType == FIXED) {
                $processing_fee_text .= ' ' . trans('front_messages.global.aud');
            } else {
                $processing_fee_text .= ' %';
            }

            $totalDestCurrency = number_format($total_destination_currency, 2, '.', '');

            if ($siteTransChargeType == FIXED) {
                $totalSiteCharge = $siteTransCharge;
            } else {
                $totalSiteCharge = ($totalDestCurrency * $siteTransCharge / 100);
            }

            $totalSiteCharge = number_format($totalSiteCharge, 2, '.', '');
            $converCurency['total_site_charge'] = $totalSiteCharge;
            $converCurency['total_destination_currency'] = $totalDestCurrency;
            $converCurency['per_destination_currency'] = number_format($per_destination_currency, 2, '.', '');
            $converCurency['site_transaction_charges'] = $siteTransCharge;
            $converCurency['site_transaction_charges_type'] = $siteTransChargeType;
            $converCurency['status'] = SUCCESS;
            $converCurency['source_country'] = $source_country;
            $converCurency['processing_fee_text'] = $processing_fee_text;

            return $converCurency;
        } else {
            $response['status'] = ERROR;
            $response['message'] = trans('front_messages.Transactions.initial_invalid_amount_error');

            return $response;
        }
    }

    /**
     * CustomHelper::currencyListWithFlag()
     * @description function to use for get curreny rates.
     * @param null
     * @return void
     **/
    public static function currencyListWithFlag($formData = array())
    {
        $currencyFlagList = [];
        $mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $currencyListObj = Currency::with('Country')->where('is_active', ACTIVE)->get();
        if (!$currencyListObj->isEmpty()) {
            foreach ($currencyListObj as $currency) {

                foreach ($currency->Country as $country) {

                    $currencyCode = $currency->code;
                    $flagName = isset($country->flag_name) ? $country->flag_name : NULL;
                    $countryName = isset($country->country_name) ? $country->country_name : NULL;

                    $currencyFlagList[] = ['id' => $country->id, 'currency' => $currencyCode, 'flag_name' => $flagName, 'country_name' => $countryName];
                }
            }
        }

        if ($mobile) {
            $response['result'] = $currencyFlagList;
            $response['status'] = SUCCESS;
            $response['flag_folder_path'] = COUNTRY_FLAG_URL;
            $res = array('data' => $response, 'mobile_req' => $mobile);
            return $res;
        } else {
            return $currencyFlagList;
        }
    }


    /*
     *
     * Function to getTestimonial()/
     *
     * @param $tyep as
     *
     * @return null*/
    public static function getTestimonial($uni_id = null, $limit = TESTIMONIAL_HOME_PAGE_LIMIT, $id = null)
    {
        if ($id != "") {
            $result = Testimonial::with('descriptionData')->where('is_active', ACTIVE)->where('id', $id)->get()->first();
        } else {
            $result = Testimonial::with('descriptionData')->where('is_active', ACTIVE)->where('uni_id', $uni_id)->limit($limit)->get();
        }
        return $result;
    } //end getTestimonial()




    /*
     *
     * Function to blockdetail()/
     *
     * @param $tyep as
     *
     * @return null*/
    public static function getBlockdetail($block)
    {
        $result = array();
        if (!empty($block)) {
            $result = Block::where('block', $block)->where('is_active', ACTIVE)->first();
        }
        return $result;
    } //end getBlockdetail()


    /**
     * CustomHelper::generate_verification_code()
     * @Description Function  generate verification code/otp
     * @param null
     * @return otp
     * */
    public static function generate_verification_code()
    {
        if (SMS_API_ENABLE) {
            $digits = OTP_CHARACTER_LIMIT;
            $verification_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        } else {
            $verification_code = '1234';
        }
        return $verification_code;
    } //end generate_verification_code()


    /**
     * CustomHelper::currencyConversionToAUD()
     * @description function to use for get curreny rates.
     * @param null
     * @return void
     **/
    public static function currencyConversionToAUD($initial_amount = 1, $source_currency = 'AUD')
    {
        $formData['initial_amount'] = $initial_amount;
        $formData['source_currency'] = $source_currency;
        $formData['required_currency'] = Config::get("Site.currencyCode");

        $converCurency = self::getCurrencyConversion($formData);
        $totalAmount = isset($converCurency['total_destination_currency']) ? $converCurency['total_destination_currency'] : NULL;
        return $totalAmount;
    }


    /**
     * CustomHelper::getRecipientDetail()
     * @Description Function to get recipient detail
     * @param condition as condition
     * @param select as select
     * @return $result
     **/
    public static function getRecipientDetail($condition = array(), $fields = array())
    {
        $result = array();

        if (!empty($fields)) {
            $result = RecipientUser::where($condition)->select($fields)->first();
        } else {
            $result = RecipientUser::where($condition)->select('*')->first();
        }

        return $result;
    } //end getRecipientDetail(


    /**
     * CustomHelper::getUserDetail()
     * @Description Function to get User detail
     * @param condition as condition
     * @param select as select
     * @return $result
     **/
    public static function getUserDetail($condition = array(), $fields = array())
    {
        $result = array();

        if (!empty($fields)) {
            $result = User::where($condition)->select($fields)->first();
        } else {
            $result = User::where($condition)->select('*')->first();
        }

        return $result;
    } //end getUserDetail(


    /**
     * CustomHelper::encryption()
     * @Description Function for encoding
     * @param $id as data to be encode
     * @return $Result
     * */
    public static function encryption($id = null)
    {
        /*
        $sKey = Config::get('UrlEncoding.key');
        $sResult = '';
        for ($i = 0; $i < strlen($id); $i++) {
            $sChar = substr($id, $i, 1);
            $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
            $sChar = chr(ord($sChar) + ord($sKeyChar));
            $sResult .= $sChar;
        }
        return base64_encode($sResult);
        */
        return base64_encode($id);
    } //end encryption()

    /**
     * CustomHelper::decription()
     * @Description Function for decoding
     * @param $id as data to be decode
     * @return $Result
     * */
    public static function decription($id = null)
    {
        /*
        $sKey = Config::get('UrlEncoding.key');
        $sResult = '';
        $sData = base64_decode($id);

        for ($i = 0; $i < strlen($sData); $i++) {
            $sChar = substr($sData, $i, 1);
            $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
            $sChar = chr(ord($sChar) - ord($sKeyChar));
            $sResult .= $sChar;
        }
        return $sResult;
        */

        return base64_decode($id);
    } //end decription()


    /**
     * CustomHelper::getLoginUserData()
     * @function get login userData
     * @param $userId
     *
     * @return array
     * */
    public static function getLoginUserData($userId)
    {
        $userData = array();
        if (!empty($userId)) {
            $userData = User::where('id', $userId)->first()->toArray();
        }
        return $userData;
    }



    /*
     * Function to save notification and activity logs
     *
     * @param $tyep as
     *
     * @return null
     * */


    public static function saveNotificationActivity($rep_Array, $action, $type = 'order', $user_id = 0, $attribute = array(), $extra_param = array())
    {
        $notification_template = NotificationTemplate::where('action', $action)->first();


        if (!empty($notification_template)) {
            $notification_template = $notification_template->toArray();
            $template_action = $notification_template['action'];
            $title = $notification_template['title'];
            $notification_action = NotificationAction::where('action', $template_action)->first();
            $cons = explode(',', $notification_action->options);
            $constants = array();
            foreach ($cons as $key => $val) {
                $constants[] = '{' . $val . '}';
            }
            $message = str_replace($constants, $rep_Array, $notification_template['body']);
            $notificationData = new Notification;
            $notificationData->user_id = $user_id;
            $notificationData->notification_type = $type;
            $notificationData->title = $title;
            $notificationData->notification = $message;
            $notificationData->is_read = INACTIVE;
            $notificationData->extra_parameters = json_encode($extra_param);
            $notificationData->save();
        }
    } //end saveNotificationActivity()



    /*
     * Function to save push notification and activity logs
     *
     * @param $tyep as
     *
     * @return null
     * */
    public static function savePushNotificationActivity($rep_Array, $action, $user_id = 0, $attribute = array(), $additional_data = [], $type = null)
    {

        $pushNotificationTemplate = PushNotificationTemplate::where('action', $action)->first();

        if (!empty($pushNotificationTemplate)) {
            $pushNotificationTemplate = $pushNotificationTemplate->toArray();
            $template_action = $pushNotificationTemplate['action'];
            $title = $pushNotificationTemplate['title'];
            $pushNotificationAction = PushNotificationAction::where('action', $template_action)->first();
            $cons = explode(',', $pushNotificationAction->options);
            $constants = array();
            foreach ($cons as $key => $val) {
                $constants[] = '{' . $val . '}';
            }

            $message = str_replace($constants, $rep_Array, $pushNotificationTemplate['body']);
            $userData = self::getUserDetailsIdById($user_id);


            $device_id = isset($userData['device_id']) ? $userData['device_id'] : 1;
            $device_token = isset($userData['device_token']) ? $userData['device_token'] : 1;
            $device_type = isset($userData['device_type']) ? $userData['device_type'] : 1;
            $additional_data = isset($additional_data) ? $additional_data : [];
            $type = isset($type) ? $type : 'broadcast';

            self::pushNotification($title, $message, $user_id, $device_id, $device_token, $device_type, $additional_data, $type);
        }
    } //end savePushNotificationActivity()


    public static function pushNotification($title = '', $message = '', $user_id = 0, $device_id = '', $device_token = '', $device_type = '', $additional_data = [], $type = '', $badge = '')
    {


        $title = htmlspecialchars_decode($title);
        $message = htmlspecialchars_decode($message);

        if (strtolower($device_type) == 'android' && $device_token) {
            if (Config::get('Site.fcm_key') == '') {
                Session::flash('flash_notice', 'Unable to Find Configuration Push.fcm_key for sending Message (' . $message . ') to Device :: ' . $device_token . "    FILE " . __FILE__ . ' :: LINE #' . __LINE__);
                return false;
            }
            try {
                $title = (string) html_entity_decode($title);
                $message = (string) html_entity_decode($message);
                /*
                 * use FCM as Push Service provider
                 * Android app
                 */
                $payLoad = [
                    'data' => [
                        'title' => $title,
                        'body' => $message,
                        'sound' => 'default'
                    ],
                ];
                if ($additional_data) {
                    $payLoad['data'] = $additional_data;
                }
                $payLoad['data']['title'] = $title;
                $payLoad['data']['message'] = $message;
                $payLoad['data']['type'] = $type;

                $response = PushNotification::setService('fcm')
                    ->setMessage($payLoad)
                    ->setApiKey(Config::get('Site.fcm_key'))
                    ->setDevicesToken(is_array($device_token) ? $device_token : [$device_token])
                    ->send()
                    ->getFeedback();

                if (is_array($device_token)) {
                    foreach ($user_id as $key => $uid) {
                        // Adding Push Log
                        $pushLogModel = new PushLog;
                        $pushLogModel->user_id = $uid;
                        $pushLogModel->title = $title;
                        $pushLogModel->message = $message;
                        $pushLogModel->device_id = $device_id[$key];
                        $pushLogModel->device_token = $device_token[$key];
                        $pushLogModel->device_type = $device_type;
                        $pushLogModel->type = $type;
                        $pushLogModel->status = $response->success;
                        $pushLogModel->additional_data = json_encode($additional_data);
                        $pushLogModel->server_response = json_encode($response);
                        $pushLogModel->save();
                    }
                } else {
                    // Adding Push Log
                    $pushLogModel = new PushLog;
                    $pushLogModel->user_id = $user_id;
                    $pushLogModel->title = $title;
                    $pushLogModel->message = $message;
                    $pushLogModel->device_id = $device_id;
                    $pushLogModel->device_token = $device_token;
                    $pushLogModel->device_type = $device_type;
                    $pushLogModel->type = $type;
                    $pushLogModel->status = $response->success;
                    $pushLogModel->additional_data = json_encode($additional_data);
                    $pushLogModel->server_response = json_encode($response);
                    $pushLogModel->save();
                }
            } catch (PushException $e) {
                Session::flash('flash_notice', "UNABLE TO SEND PUSH :: {$e->getMessage()} " . __FILE__ . ":: " . __LINE__);
            }
        } else if (strtolower($device_type) == 'iphone' && $device_token) {


            try {
                $title = (string) html_entity_decode($title);
                $message = (string) html_entity_decode($message);


                /* use FCM as Push Service provider
                 * Android app
                 * */

                $payLoad = [
                    'notification' => [
                        'title' => $title,
                        'body' => $message,
                        'sound' => 'default'
                    ],
                    'data' => []
                ];
                if ($additional_data) {
                    $payLoad['data'] = $additional_data;
                }
                $payLoad['data']['title'] = $title;
                $payLoad['data']['message'] = $message;
                $payLoad['data']['type'] = $type;

                $iphoneToken = is_array($device_token) ? $device_token : [$device_token];
                // Sending Push Log
                $response = [];
                foreach ($iphoneToken as $i_token) {
                    $res_pn = self::sendIosPN($title, $message, $i_token, $type, $additional_data);


                    array_push($response, $res_pn);
                }

                if (is_array($device_token)) {
                    foreach ($user_id as $key => $uid) {
                        // Adding Push Log
                        $pushLogModel = new PushLog;
                        $pushLogModel->user_id = $uid;
                        $pushLogModel->title = $title;
                        $pushLogModel->message = $message;
                        $pushLogModel->device_id = $device_id[$key];
                        $pushLogModel->device_token = $device_token[$key];
                        $pushLogModel->device_type = $device_type;
                        $pushLogModel->type = $type;
                        $pushLogModel->status = 'success';
                        $pushLogModel->additional_data = json_encode($additional_data);
                        $pushLogModel->server_response = json_encode($response);
                        $pushLogModel->save();
                    }
                } else {
                    // Adding Push Log
                    $pushLogModel = new PushLog;
                    $pushLogModel->user_id = $user_id;
                    $pushLogModel->title = $title;
                    $pushLogModel->message = $message;
                    $pushLogModel->device_id = $device_id;
                    $pushLogModel->device_token = $device_token;
                    $pushLogModel->device_type = $device_type;
                    $pushLogModel->type = $type;
                    $pushLogModel->status = 'success';
                    $pushLogModel->additional_data = json_encode($additional_data);
                    $pushLogModel->server_response = json_encode($response);
                    $pushLogModel->save();
                }
            } catch (PushException $e) {
                //dump($e);
                Session::flash('flash_notice', "UNABLE TO SEND PUSH :: {$e->getMessage()} " . __FILE__ . ":: " . __LINE__);
            }
        }
    } //end pushNotification()


    // sendIosPN()

    public static function sendIosPN($title, $message, $token, $type = '', $additional_data)
    {

        $keyfile = $_SERVER['DOCUMENT_ROOT'] . "/AuthKey_82FBB56236.p8";
        $keyid = I_PHONE_PUSH_NOTIFICATION_KEY_ID;                            # <- Your Key ID
        $teamid = I_PHONE_PUSH_NOTIFICATION_TEAM_ID;                           # <- Your Team ID (see Developer Portal)
        $bundleid = 'com.fullestop.PushChat';                                    # <- Your Bundle ID
        $url = 'https://api.development.push.apple.com';  # <- development url, or use http://api.push.apple.com for production environment
        $token = $token;              # <- Device Token
        $additional_data = json_encode($additional_data);
        $message = '{"aps":{"alert":"' . $message . '" ,"sound":"default"}, "data": {"body": "' . $message . '","type": "' . $type . '","sound": "default","title":"' . $title . '","message":"' . $message . '","additional_data":' . $additional_data . '}}';
        //$message = '{"aps":{"alert":"'.$message.'" ,"sound":"default"}, "data": {"body": "'.$message.'","type": "'.$type.'","sound": "default","title":"'.$title.'","message":"'.$message.'"}}';
        //dd($message);
        $key = openssl_pkey_get_private('file://' . $keyfile);
        //$key = openssl_pkey_get_public('file://'.$keyfile);



        $header = ['alg' => 'ES256', 'kid' => $keyid];
        $claims = ['iss' => $teamid, 'iat' => time()];

        $header_encoded = rtrim(strtr(base64_encode(json_encode($header)), '+/', '-_'), '=');
        $claims_encoded = rtrim(strtr(base64_encode(json_encode($claims)), '+/', '-_'), '=');

        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);

        // only needed for PHP prior to 5.5.24
        if (!defined('CURL_HTTP_VERSION_2_0')) {
            define('CURL_HTTP_VERSION_2_0', 3);
        }

        $http2ch = curl_init();
        curl_setopt_array(
            $http2ch,
            array(
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_URL => "$url/3/device/$token",
                CURLOPT_PORT => 443,
                CURLOPT_HTTPHEADER => array(
                    "apns-topic: {$bundleid}",
                    "authorization: bearer $jwt"
                ),
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => $message,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HEADER => 1
            )
        );

        try {
            $result = curl_exec($http2ch);


            if ($result === FALSE) {
                return true;
            }
            $status = curl_getinfo($http2ch, CURLINFO_HTTP_CODE);

            return $status;
        } catch (Exception $e) {
            return true;
        }
    }




    /**
     * CustomHelper::getUserDetailsIdById()
     * @Description Function for user data
     * @param $attr as attributes
     * @return post data
     * */

    public static function getUserDetailsIdById($id = '')
    {
        $userData = array();
        if ($id != '') {
            $userData = User::where('id', $id)->get()->first();
            if (!empty($userData)) {
                $userData = $userData->toArray();
            } else {
                $userData = array();
            }
        }
        return $userData;
    } // end getUserDetailsIdById()



    /*
     * Function to get notification of user
     *
     * @param $attribute as array
     *
     * @return array
     * */
    public static function getMyNotifications($attribute)
    {
        $notifications = array();
        $conditions = array();
        if (!empty($attribute)) {
            $sortBy = isset($attribute['sortBy']) ? $attribute['sortBy'] : 'id';
            $order = isset($attribute['order']) ? $attribute['order'] : 'DESC';
            $user = isset($attribute['user']) ? $attribute['user'] : array();
            if (isset($attribute['is_read'])) {
                $conditions[] = array('is_read', $attribute['is_read']);
            }
            $recordPerPage = isset($attribute['recordPerPage']) ? $attribute['recordPerPage'] : Config::get("Reading.records_per_page");
            $page_number = isset($attribute['page_number']) ? $attribute['page_number'] : ACTIVE;
            $thisData = Request::all();

            if (isset($thisData['page'])) {
                $page_number = $thisData['page'];
            }

            $notifications = array();
            if (!empty($user)) {

                $notifications = Notification::where('user_id', $attribute['user']['id'])->where($conditions)->orderBy($sortBy, $order)->paginate($recordPerPage, ['*'], 'page', $page_number);
            }
        }
        return $notifications;
    } //end getMyNotifications()

    /*
     * Function to get notification of user
     *
     * @param $attribute as array
     *
     * @return array
     * */
    public static function getMyNotificationsCount($attribute)
    {
        $notificationsCount = 0;
        $conditions = array();

        if (!empty($attribute)) {
            $user = isset($attribute['user']) ? $attribute['user'] : array();
            if (isset($attribute['is_read'])) {
                $conditions[] = array('is_read', $attribute['is_read']);
            }

            if (!empty($user)) {
                $notificationsCount = Notification::where('user_id', $attribute['user']['id'])->where($conditions)->count();
            }
        }
        return $notificationsCount;
    } //end getMyNotifications()




    /**
     * CustomHelper::getActiveCurrencieCountry()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getActiveCurrencieCountry()
    {
        $countryList = array();
        $countryList = Country::whereHas('Currency', function ($q) {
            $q->where('is_active', ACTIVE)->where('use_for_money_transfer', ACTIVE);
        })->where('status', ACTIVE)->pluck('country_name', 'id')->all();

        return $countryList;
    } //end getActiveCurrencieCountry()



    /**
     * CustomHelper::getActiveBankList()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getActiveBankList($country_id = '')
    {
        $bankList = array();
        if (!empty($country_id)) {
            $allowCountry = Country::where('id', $country_id)->where('status', ACTIVE)->first();
            $bankList = BankInformation::where('allowed_currency_id', $allowCountry->currency_id)->where('status', ACTIVE)->pluck('bank_name', 'pg_bank_id')->all();
        }
        return $bankList;
    } //end getActiveBankList()



    /**
     * CustomHelper::getBankNameByPgBankId()
     * @Description Function  to get country array
     * @param null
     * @return array
     * */
    public static function getBankNameByPgBankId($pgBankId = '')
    {
        $bankName = '';
        if (!empty($pgBankId)) {
            $bankName = BankInformation::where('pg_bank_id', $pgBankId)->value('bank_name');
        }
        return $bankName;
    } //end getBankNameByPgBankId()



    /**
     * CustomHelper::allCurrencyListWithFlag()
     * @description function to use for get curreny rates.
     * @param null
     * @return void
     **/
    public static function allCurrencyListWithFlag($formData = array())
    {
        $currencyFlagList = [];
        $mobile = (isset($formData['mobile_req']) && $formData['mobile_req']) ? ACTIVE : INACTIVE;
        $countryListObj = Country::with('Currency')->where('status', ACTIVE)->get();

        if (!$countryListObj->isEmpty()) {
            foreach ($countryListObj as $country) {

                if (isset($country->Currency->code) && !empty($country->Currency->code) && isset($country->Currency->value) && $country->Currency->value > 0) {
                    $currencyCode = $country->Currency->code;
                    $flagName = isset($country->flag_name) ? $country->flag_name : NULL;
                    $currencyFlagList[] = ['id' => $country->id, 'currency' => $currencyCode, 'flag_name' => $flagName, 'country_name' => $country->country_name];
                }
            }
        }



        if ($mobile) {
            $response['result'] = $currencyFlagList;
            $response['status'] = SUCCESS;
            $response['flag_folder_path'] = COUNTRY_FLAG_URL;
            $res = array('data' => $response, 'mobile_req' => $mobile);
            return $res;
        } else {
            return $currencyFlagList;
        }
    }

    /**
     * CustomHelper::allCurrencyListWithFlag()
     * @description function to use for get client ip.
     * @param null
     * @return void
     **/

    public static function getClientIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    } //end getClientIp()



    /**
     * CustomHelper::getClientCountryApi()
     * @description function to get client country.
     * @param null
     * @return void
     **/
    public static function getClientCountryApi()
    {
        $countryName = null;
        $firstCurrencyId = '';
        $firstCurrencyCode = '';
        $firstCountryName = '';
        $firstCountryFlagName = '';
        //$ip = '49.249.232.74'; /*self::getClientIp();*/
        $ip = self::getClientIp();
        $access_key = APIIP_ACCESS_KEY;

        if (env('APP_ENV') == 'storage') {
            // Initialize CURL
            $ch = curl_init(APIIP_URL . '?ip=' . $ip . '&accessKey=' . $access_key . '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data
            $json_res = curl_exec($ch);
            curl_close($ch);
            // Decode JSON response
            $api_result = json_decode($json_res, true);
            // Output the "code" value inside "currency" object
            //echo $api_result['currency']['code'];
        } else {
            $api_result['countryName'] = 'india';
        }

        if (isset($api_result['countryName']) && !empty(isset($api_result['countryName']))) {
            $countryName = isset($api_result['countryName']) ? $api_result['countryName'] : NULL;
            $countryData = Country::with('Currency')->where('country_name', 'LIKE', $countryName)->first();

            if (!empty($countryData)) {
                $firstCurrencyId = isset($countryData->id) ? $countryData->id : NULL;
                $firstCurrencyCode = isset($countryData->Currency->code) ? $countryData->Currency->code : NULL;
                $firstCountryName = isset($countryData->country_name) ? $countryData->country_name : NULL;
                $firstCountryFlagName = isset($countryData->flag_name) ? $countryData->flag_name : NULL;
            }
        }
        $res = array('firstCurrencyId' => $firstCurrencyId, 'firstCurrencyCode' => $firstCurrencyCode, 'firstCountryName' => $firstCountryName, 'firstCountryFlagName' => $firstCountryFlagName);
        return $res;
    } // end getClientCountryApi()


    /**
     * CustomHelper::get_country_iso_code()
     * @Description Function  to get country name
     * @param $country_id
     * @return $country_name
     * */
    public static function get_country_iso_code($country_id = null)
    {
        $country_iso_code = Country::where('id', $country_id)->value('country_iso_code');
        return $country_iso_code;
    }



    /**
     * CustomHelper::deleteApprovedUserDocument()
     * @param formData
     * @param model
     * @return
     * */
    public static function deleteApprovedUserDocument($approvedDocument = NULL)
    {
        $currentTime = CustomHelper::getCurrentTime();
        $userId = isset($approvedDocument->id) ? $approvedDocument->id : NULL;

        if (!empty($approvedDocument) && $userId) {

            if (!empty($approvedDocument->dl_image_1) && file_exists(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->dl_image_1)) {
                @unlink(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->dl_image_1);
            }

            if (!empty($approvedDocument->dl_image_2) && file_exists(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->dl_image_2)) {
                @unlink(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->dl_image_2);
            }

            if (!empty($approvedDocument->passport_image) && file_exists(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->passport_image)) {
                @unlink(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->passport_image);
            }

            if (!empty($approvedDocument->national_id) && file_exists(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->national_id)) {
                @unlink(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->national_id);
            }

            if (!empty($approvedDocument->upload_document) && file_exists(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->upload_document)) {
                @unlink(USER_DOCUMENT_IMAGE_ROOT_PATH . $approvedDocument->upload_document);
            }

            User::where('id', $userId)->update(['is_document_deleted' => (int) ACTIVE, 'document_deletion_time' => $currentTime, 'dl_image_1' => NULL, 'dl_image_2' => NULL, 'passport_image' => NULL, 'national_id' => NULL, 'upload_document' => NULL, 'document_scan_response' => NULL]);
        }
    }




    public static function applyCoupon($formData = array(), $attribute = array())
    {
        $success = ERROR;
        $response = array();
        $error = trans('front_messages.INVALID_ACCESS');
        $mobile = 0;
        $coupan_valid = false;
        $currentTime = time();
        $price = isset($attribute['price']) ? $attribute['price'] : NULL;

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        if (isset($formData['coupon_code']) && isset($formData['user_id'])) {
            $couponDetail = Coupon::where('coupon_code', $formData['coupon_code'])->first();

            if (!empty($couponDetail)) {
                $UserCouponData = $couponDetail->toArray();


                $couponPayIdCount = Transaction::where('coupon_code', $formData['coupon_code'])->where('payment_gateway_type', PAYID)->where('payment_status', "pending")->count();

                $couponPayIdUseCount = Transaction::where('user_id', $formData['user_id'])->where('coupon_code', $formData['coupon_code'])->where('payment_gateway_type', PAYID)->where('payment_status', "pending")->count();

                $couponUseCount = Transaction::where('user_id', $formData['user_id'])->where('coupon_code', $formData['coupon_code'])->where('payment_status', "completed")->count();

                $totalCouponUseCount = Transaction::where('coupon_code', $formData['coupon_code'])->where('payment_status', "completed")->count();

                $couponUseCount = $couponUseCount + $couponPayIdUseCount;
                $totalCouponUseCount = $totalCouponUseCount + $couponPayIdCount;



                if (!empty($UserCouponData['start_date']) && ($currentTime < $UserCouponData['start_date'])) {
                    $response['msg'] = trans('front_messages.coupon_not_valid');
                } else if (!empty($UserCouponData['last_date']) && ($currentTime > $UserCouponData['last_date'])) {
                    $response['msg'] = trans('front_messages.front_messages.coupon_expired');
                } else if ($UserCouponData['is_active'] == INACTIVE) {
                    $response['msg'] = trans('front_messages.coupon_not_valid');
                } else if ($UserCouponData['usage_limit'] == ONLY_ONE_TIME_USEAGE_LIMIT && ($totalCouponUseCount >= ACTIVE)) {
                    $response['msg'] = trans('front_messages.coupon_max_limit_reach');
                } else if ($UserCouponData['usage_limit'] == N_TIME_USEAGE_LIMIT && $couponUseCount >= $UserCouponData['quantity']) {
                    $response['msg'] = trans('front_messages.coupon_max_limit_reach');
                    /*
                }
                else if ($totalCouponUseCount >= $UserCouponData['max_limit']) {
                    $response['msg'] = trans('front_messages.coupon_max_limit_reach');
                }
                else if ($couponUseCount >= $UserCouponData['quantity']) {
                    $response['msg'] = trans('front_messages.coupon_max_limit_reach');
                */
                } else {
                    $coupan_valid = true;
                }

                if ($coupan_valid) {

                    #############
                    //$price
                    #############

                    if ($price) {
                        $totalDiscount = INACTIVE;
                        if ($couponDetail['discounttype'] == 'fixed') {
                            if ($couponDetail['discount'] >= $price) {
                                $totalDiscount = $price;
                            } else {
                                $totalDiscount = $couponDetail['discount'];
                            }
                        } else {
                            $max_discount = $couponDetail['max_discount_allowed'];
                            $percentdiscount = ($price * $couponDetail['discount']) / 100;
                            if ($max_discount > $percentdiscount) {
                                $totalDiscount = $percentdiscount;
                            } else {
                                $totalDiscount = $max_discount;
                            }
                        }

                        $priceAfterDiscount = $price - $totalDiscount;
                        $response['discounted_amount'] = $totalDiscount;
                        $response['final_amount_after_discount'] = $priceAfterDiscount;
                    }

                    $response['couponDetail'] = $UserCouponData;
                    $response['msg'] = trans('front_messages.coupon_applied');
                    $success = SUCCESS;
                }
            } else {
                $response['msg'] = trans('front_messages.coupon_not_exist');
            }
        } else {
            $response['msg'] = $error;
        }


        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        if ($mobile == 1) {
            $response['status'] = $success;
            $response['message'] = $response['msg'];
            $response['mobile_req'] = $mobile;
            unset($response['msg']);
            $res = array('data' => $response);
            return $res;
        } else {
            $response['status'] = $success;
            return $response;
        }
    } //end applyCoupon()


    /**
     * CustomHelper::Function to apply Coupon
     * @param $formData as form data
     * @param $attribute as other parameters
     * @return number
     */

    public static function displayPriceForPlanWithCouponApplied________($price = null, $couponData = array())
    {
        if (Session::has('UserCouponData')) {
            $totalDiscount = INACTIVE;
            if (Session::has('UserCouponData')) {
                $couponDetail = Session::get('UserCouponData');


                if ($couponDetail['discounttype'] == 'fixed') {
                    if ($couponDetail['discount'] >= $price) {
                        $totalDiscount = $price;
                    } else {
                        $totalDiscount = $couponDetail['discount'];
                    }
                } else {
                    $max_discount = $couponDetail['max_discount_allowed'];
                    $percentdiscount = ($price * $couponDetail['discount']) / 100;
                    if ($max_discount > $percentdiscount) {
                        $totalDiscount = $percentdiscount;
                    } else {
                        $totalDiscount = $max_discount;
                    }
                }
                $priceAfterDiscount = $price - $totalDiscount;
            }
        } elseif (!empty($couponData)) {

            $totalDiscount = INACTIVE;

            if ($couponData['discounttype'] == 'fixed') {
                if ($couponData['discount'] >= $price) {
                    $totalDiscount = $price;
                } else {
                    $totalDiscount = $couponData['discount'];
                }
            } else {
                $max_discount = $couponData['max_discount_allowed'];
                $percentdiscount = ($price * $couponData['discount']) / 100;
                if ($max_discount > $percentdiscount) {
                    $totalDiscount = $percentdiscount;
                } else {
                    $totalDiscount = $max_discount;
                }
            }
            $priceAfterDiscount = $price - $totalDiscount;
        } else {
            $priceAfterDiscount = $price;
        }


        $currencyCode = Config::get("Site.currencyCode");

        $baseCurrencyData = self::currencyConversionToAUD($priceAfterDiscount, $currencyCode);

        $baseCurrencyCode = $currencyCode;

        $priceAsPerSelectedCurrency = $priceAfterDiscount;

        $desiredCurrencyCode = $currencyCode;
        $newPrice = $priceAsPerSelectedCurrency;

        $site_currency = self::getConfigValue('Site.currency');

        $result['priceAfterDiscount'] = number_format($priceAfterDiscount, 2, '.', '');
        $result['formattedPriceAfterDiscount'] = number_format($newPrice, 2) . ' ' . $desiredCurrencyCode;

        if (isset($totalDiscount)) {
            $result['totalDiscountApplied'] = number_format($totalDiscount, 2, '.', '');
            $result['formattedtotalDiscountApplied'] = number_format($totalDiscount, 2) . ' ' . $desiredCurrencyCode;
        } else {
            $result['totalDiscountApplied'] = 0;
            $result['formattedtotalDiscountApplied'] = number_format($newPrice, 2) . ' ' . $desiredCurrencyCode;
        }

        return $result;
    } //end applyCoupon()




    /**
     * CustomHelper::generateUniqueCode()
     * @param $limit as slug character limit
     * @return slug
     **/
    public static function generateUniqueCode($codeLength = 8)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }
        if (User::where('my_referrer_code', $code)->exists()) {
            return self::generateUniqueCode();
        }

        return $code;
    } //end getSlug()



    public static function applyAmountBalance($formData = array(), $attribute = array())
    {
        $success = 'error';
        $response = array();
        $error = trans('front_messages.INVALID_ACCESS');
        $mobile = 0;
        $coupan_valid = false;
        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }
        if (isset($formData['user_id'])) {

            Session::forget('amount_balance');

            $userDetails = User::where('id', $formData['user_id'])->firstOrFail();

            $amount_balance = $userDetails->amount_balance ? $userDetails->amount_balance : INACTIVE;


            if ($mobile == 0) {


                if (isset($formData['checkBoxValue']) && $formData['checkBoxValue'] == "true") {

                    if ($amount_balance > INACTIVE) {
                        Session::put('amount_balance', $amount_balance);

                        if (Session::has('UserCouponData')) {
                            Session::forget('UserCouponData');
                        }
                        $response['msg'] = trans('front_messages.amount_balance_apply');
                        $success = 'success';
                    } else {
                        $response['msg'] = trans('front_messages.insufficient_balance');
                        $success = 'error';
                    }
                } else {
                    if ($mobile == 0) {
                        Session::forget('amount_balance');
                        $success = 'success';
                    }
                }
            }
        }

        if (isset($formData['mobile_req']) && $formData['mobile_req']) {
            $mobile = 1;
        }

        if ($mobile == 1) {
            $response['status'] = $success;
            $response['message'] = $response['msg'];
            $response['mobile_req'] = $mobile;
            unset($response['msg']);
            $res = array('data' => $response);
            return $res;
        } else {
            $response['status'] = $success;
            return $response;
        }
    } //end applyAmountBalance()



    public static function userBalanceAmountLog($userId = null, $debit_balance = null, $credit_balance = null, $description = null, $money_transfer_id = null, $referee_id = null, $refrrer_id = null, $minimum_amount_transfered = false)
    {
        $logObj = new UserBalanceAmountLog();
        $logObj->user_id = $userId;
        $logObj->debit_balance = $debit_balance;
        $logObj->credit_balance = $credit_balance;
        $logObj->description = $description;

        $logObj->money_transfer_id = $money_transfer_id;
        $logObj->referee_id = $referee_id;
        $logObj->refrrer_id = $refrrer_id;

        if ($logObj->save()) {
            $logObj2 = UserBalanceAmountLog::find($logObj->id);

            $total_debit_balance = UserBalanceAmountLog::where('user_id', $userId)->sum('debit_balance');
            $total_credit_balance = UserBalanceAmountLog::where('user_id', $userId)->sum('credit_balance');
            $balance = $total_credit_balance - $total_debit_balance;

            $logObj2->balance = $balance;
            $logObj2->save();

            $user_email = isset($logObj2->userDetails->email) ? $logObj2->userDetails->email : null;
            $user_name = isset($logObj2->userDetails->full_name) ? $logObj2->userDetails->full_name : null;


            if ($minimum_amount_transfered == true) {

                User::where('id', $userId)->update(['minimum_amount_transfered' => ACTIVE, 'amount_balance' => $balance]);

                if ($user_email) {
                    $action = "get_user_refer_amount_email_to_referral";
                    $to = $user_email;
                    $rep_Array = array($user_name, $credit_balance);
                    $sendMail = new SendMailService;
                    $sendMail->callSendMail($to, $user_name, $rep_Array, $action);
                }
            } else {
                User::where('id', $userId)->update(['amount_balance' => $balance]);

                if ($user_email) {
                    $action2 = "get_user_refer_amount_email_to_referee";
                    $to = $user_email;
                    $rep_Array2 = array($user_name, $credit_balance);
                    $sendMail = new SendMailService;
                    $sendMail->callSendMail($to, $user_name, $rep_Array2, $action2);
                }
            }
        }
    }



    public static function getProcessingFee($countryId = null)
    {

        $processing_fee = Config::get('Site.site_transaction_charges');
        $processing_fee_type = Config::get('Site.site_transaction_charges_type');

        if ($countryId != NULL) {
            $countryData = Country::where('id', $countryId)->first();
            if (isset($countryData->processing_fee) && ($countryData->processing_fee > 0)) {
                $processing_fee = $countryData->processing_fee;
                $processing_fee_type = $countryData->processing_fee_type;
            }
        }

        $returnArray['processing_fee'] = $processing_fee;
        $returnArray['processing_fee_type'] = $processing_fee_type;
        return $returnArray;
    }



    public static function writeCurrencyFile()
    {
        $currency_array = Currency::pluck('value', 'code')->toArray();
        $jsonCurrency = json_encode($currency_array);
        $filename = WEBSITE_UPLOADS_ROOT_PATH . CURRENCY_LOG_FILE_NAME;
        if (is_writable($filename) && file_exists($filename)) {
            $handle = fopen($filename, 'w');
            fwrite($handle, $jsonCurrency);
            fclose($handle);
        }
    }








    /**
     * CustomHelper::getExpertData()
     * @function get login expertData
     * @param $userId
     *
     * @return array
     * */
    public static function getExpertData()
    {

        $expertData = Expert::where('is_active', ACTIVE)->get()/*->random(HOME_PAGE_EXPERT_LIMIT)*/ ;

        return $expertData;
    }


    /**
     * CustomHelper::getHomeBlogList()
     * @function get login expertData
     * @param $userId
     *
     * @return array
     * */
    public static function getHomeBlogList($universityId = null)
    {
        $totalBlogs = Blog::where('is_active', ACTIVE)->where('university_id', $universityId)->count();
        if ($totalBlogs > HOME_PAGE_BLOG_LIMIT) {
            $blogLimit = HOME_PAGE_BLOG_LIMIT;
        } else {
            $blogLimit = $totalBlogs;
        }

        $blogList = Blog::where('is_active', ACTIVE)->where('university_id', $universityId)->with(['addedByUser'])->get()->random($blogLimit);

        return $blogList;
    }




    /**
     * CustomHelper::getUniversiryNameById()
     * @param DropdwonId
     * @param $nui_id As id of Universiry
     * @return array
     **/
    public static function getUniversiryNameById($nui_id)
    {

        $universityName = University::where('id', $nui_id)->pluck('title')->first();
        return $universityName;
    } //end getUniversiryNameById()

    public static function getUserNameById($user_id)
    {

        $userName = User::where('id', $user_id)->pluck('full_name')->first();
        return $userName;
    }





    public static function getUniversityCampuses($university_id = '', $campus_type = '')
    {
        $getUniversityCampuses = UniversityCampus::where('university_id', $university_id)->where('campus_type', $campus_type)->pluck('campus_name')->toArray();
        return $getUniversityCampuses;
    }





    /**
     * Store Files
     * @return FileName || null
     */
    public static function UploadFile($file, $midFix, $path, $oldFile = null)
    {
        if (isset($oldFile) && is_array($oldFile)) {
            foreach ($oldFile as $val) {
                @unlink($path . $val);
            }
        }

        if (isset($oldFile) && !is_array($oldFile) && !empty($oldFile)) {
            @unlink($path . $oldFile);
        }
        if (isset($file) && !is_array($file)) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . "$midFix." . $extension;
            if ($file->move($path, $fileName)) {
                return $fileName;
            }
        }
        if (isset($file) && is_array($file)) {
            $fileData = [];
            $sr_no = 1;
            foreach ($file as $item) {
                $extension = $item->getClientOriginalExtension();
                $fileName = time() . "$sr_no$midFix." . $extension;
                if ($item->move($path, $fileName)) {
                    array_push($fileData, $fileName);
                }
                $sr_no++;
            }
            return $fileData;
        }
        return null;
    }





    public static function universityCourseNameById($course_id)
    {

        $courseName = Course::where('id', $course_id)->pluck('name')->first();
        return $courseName;
    }





    public static function getSemesterData($uni_id, $course_id, $semester, $specification_id)
    {
        if ((isset($uni_id) && !empty($uni_id)) && (isset($course_id) && !empty($course_id)) && (isset($specification_id) && !empty($specification_id))) {
            $getSemesterData = Semester::where('uni_id', $uni_id)->where('course_id', $course_id)->where('semester', $semester)->where('specification_id', $specification_id)->get();
        } else {
            $getSemesterData = Semester::where('uni_id', $uni_id)->where('course_id', $course_id)->where('semester', $semester)->where('specification_id', NULL)->get();
        }
        return $getSemesterData;
    }



    public static function getUniversities()
    {
        $universities = University::where('is_active', ACTIVE)->get()->toArray();
        return $universities;
    }




    public static function getCoursesWithUniversityCount($id = "")
    {
        $courses = DropDown::with('getCoursesDetails', 'getCoursesSpecificationsDropdown')->where('dropdown_type', 'course')->where('dropdown_id', NULL)->where('status', ACTIVE)->get();
        return $courses;
    }



    public static function getFeaturedCourses()
    {
        $featuredCourses = Course::with(['getUniversityDetails', 'getCourseDropDownDetails'])->where('is_featured', ACTIVE)->where('active', ACTIVE)->get();
        return $featuredCourses;
    }



    public static function getUniversityComparisonData()
    {
        $universityData = '';
        $course_id = Session::get('course_id');
        $univercity_id = Session::get('university_id');
        $universityData = Course::with('getAllUniversityDetails')->where('course_id', $course_id)->whereIn('univercity_id', $univercity_id)->get();

        return $universityData;
    }


    /*
     * Function to is allow review and rating
     *
     * @param $session id
     *
     * @return avg
     * */
    public static function isAllowReviewAndRating($user_id = 0, $university_id = 0)
    {
        $status = false;
        if (!empty($user_id)) {

            $alreadyRated = ReviewRating::where('user_id', $user_id)->where('university_id', $university_id)
                ->where(function ($q) {
                    $q->where('is_approved', REQAPPROVE)->orWhere('is_approved', REQPENDING);
                })->get();


            if (!$alreadyRated->isEmpty()) {
                $status = false;
            } else {
                $status = true;
            }
        }

        return $status;
    }



    /**
     * CustomHelper::avgReviewRating()
     * @Description Function  to get average rating
     * @param config
     * @return string
     * */
    public static function avgReviewRating($university_id)
    {
        $avgrating = 0;
        if (!empty($university_id)) {
            $averageRating = ReviewRating::where('university_id', $university_id)->where('is_approved', REQAPPROVE)->where('status', ACTIVE)->avg('rating');
            $avgrating = ceil($averageRating);
        }
        return $avgrating;
    }



    /**
     * CustomHelper::updateUserAvgReviewRating()
     * @Description Function  to get average rating
     * @param config
     * @return string
     * */
    public static function updateUserAvgReviewRating($attributes)
    {
        $userData = array();
        if (!empty($attributes)) {
            $userData = University::findOrFail($attributes['university_id']);
            $userData->avg_rating = isset($attributes['avg_rating']) ? $attributes['avg_rating'] : INACTIVE;
            $userData->save();
        }
        return $userData;
    }



    /**
     * CustomHelper::getUserNameByUserId()
     * @function for user name bu user id
     * @param $conditions
     * @return array
     * */
    public static function getUserNameByUserId($userId)
    {
        $result = User::where('id', $userId)->select('full_name')->first();
        $userName = '';
        if (!empty($result)) {
            $userName = $result['full_name'];
        }
        return $userName;
    }



    /**
     * CustomHelper::getFirstLatterOfFullName()
     * @function for get first latter of full name
     * @param $name as user full name 
     * @return array
     * */
    public static function getFirstLatterOfFullName($name = "")
    {
        /* Split the name into words*/
        $words = explode(" ", $name);


        /* Get the first and last words */
        $firstWord = $words[0];
        $lastWord = $words[count($words) - 1];

        /* Concatenate the first letters of the first and last words */
        $initials = strtoupper(isset($firstWord[0]) ? $firstWord[0] : NULL) . strtoupper(isset($lastWord[0]) ? $lastWord[0] : NULL);

        return $initials;
    }





    public static function getReviewRatingForProgressBar($uni_id)
    {
        $ratingCounts = ReviewRating::where('university_id', $uni_id)->where('is_approved', ACTIVE)->selectRaw('rating, COUNT(*) as count')->groupBy('rating')->pluck('count', 'rating');

        $totalReviews = ReviewRating::where('university_id', $uni_id)->where('is_approved', ACTIVE)->count();

        $ratingPercentages = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];
        foreach ($ratingCounts as $rating => $count) {
            $ratingPercentages[$rating] = number_format(($count / $totalReviews) * 100, 2);
        }

        return $ratingPercentages;
    }




    public static function getQuestionDetails($question_id = null)
    {
        $getQuestionDetails = '';
        $getQuestionDetails = SurveQuestion::findOrFail($question_id);
        return $getQuestionDetails;
    }



    public static function getCurrentSurveyQuestionAnswer($conditionArray = array())
    {
        $surveyCurrentQuestion = SurveQuestion::with('getAnswers')->where($conditionArray)->orderBy('question_order', 'asc')->get()->first();
        return $surveyCurrentQuestion;
    }



    /**
     * CustomHelper::getAllQuestionIdByCategory()
     * @function for get first latter of full name
     * @param $name as user full name 
     * @return array
     * */
    public static function getAllQuestionIdByCategory($categoryId = "")
    {
        $questionIdArray = array();
        if ($categoryId != "") {
            $questionIdArray = SurveQuestion::where('category_id', $categoryId)->pluck('id')->toArray();
        }

        return $questionIdArray;
    }



    /**
     * CustomHelper::getSemesterCreditTotal()
     * @function for get total sum of credit score
     * @param $course_id as course id
     * @semester $course_id as semester number
     * @return array
     * */
    public static function getSemesterCreditTotal($course_id = null, $semester = null, $specification_id = null)
    {
        $credit_score = "";
        if ($specification_id == '') {
            $credit_score = Semester::where('course_id', $course_id)->where('semester', $semester)->where('specification_id', NULL)->sum('credit_score');
        } else {
            $credit_score = Semester::where('course_id', $course_id)->where('specification_id', $specification_id)->where('semester', $semester)->sum('credit_score');
        }
        return $credit_score;
    } // end getSemesterCreditTotal()



    /** 
     * CustomHelper::getMasterSlug()
     * @function for get master slug by id 
     * @param $id as master id
     * @return string
     */
    public static function getMasterSlug($id = 0)
    {
        $slug = "";
        $slug = DropDown::where('status', ACTIVE)->where('id', $id)->select('slug')->get()->first();
        return $slug;
    } // end getMasterSlug()



    /** 
     * CustomHelper::getCoallborationUniversity()
     * @function for get master slug by id 
     * @param $id as master id
     * @return string
     */
    public static function getCoallborationUniversity()
    {
        $university = "";
        $university = University::where('is_active', ACTIVE)->where('collaborate_university_home_top', ACTIVE)->limit(7)->get();

        return $university;
    } // end getCoallborationUniversity()



    /** 
     * CustomHelper::getCourseCategory()
     * @function for get master slug by id 
     * @param $id as master id
     * @return string
     */
    public static function getCourseCategory()
    {
        $courseCategory = Config::get('COURSE_CATEGORY_TYPE_DROPDOWN');
        return $courseCategory;
    } // end getCourseCategory()


    /** 
     * CustomHelper::getCourseDetails()
     * @function for get master slug by id 
     * @param $id as master id
     * @return string
     */
    public static function getCourseDetails($categoryId)
    {

        $courseDetails = Course::where('course_category', $categoryId)->where('active', ACTIVE)->orderBy('created_at', 'DESC')->get();
        return $courseDetails;
        die;
    } // end getCourseDetails()




    public static function getCoursesWithSpecifications123()
    {
        $allCourseCategories = array(1, 2, 3, 4);
        $courseDetails = Course::with('getUniversityDetails', 'getCourseSpecifications')->whereIn('course_category', $allCourseCategories)->where('active', ACTIVE)->orderBy('course_category', 'ASC')->select('id', 'name', 'image', 'university_slug', 'course_slug', 'course_id', 'univercity_id', 'course_category', 'total_fee')->get()->groupBy(['course_category', 'name']);
        return $courseDetails;
    }







} // end CustomHelper
