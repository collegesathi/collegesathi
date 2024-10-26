<?php
namespace App\Modules\Slider\Services;

use App\Modules\Slider\Models\Slider;
use CustomHelper;
use View;

/**
 * Pages Serivces
 *
 * Add your methods in the class below
 *
 * This file will render data from api
 */
class SliderService
{

    public $model = 'Slider';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }

    /**
     * Function to display slider page on website
     *
     * @return view page
     */
    public function showSlider($formData)
    {

        $status = ERROR;
        $message = '';
        $response = array();

        if (!empty($formData)) {

            $result = CustomHelper::getSliders();

            if (!empty($result)) {
                $response['data'] = $result;
                $status = SUCCESS;
            } else {
                $message = trans('front_messages.global.something_went_wrong');
            }
        } else {
            $message = trans('front_messages.global.something_went_wrong');
        }

        $response['status'] = $status;
        $response['message'] = $message;
        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;

    } //end showCms()

    /**
     * ValidationHelper::getSliderValidation()
     * @Description Function  for validation slider
     * @param $formData,$attribute
     * @return $validation message and validation
     **/
    public static function getSliderValidation($thisData = array(), $attribute = array())
    {
        $message = array(
            'slider_title.required' => trans('messages.slider_title.REQUIRED_ERROR'),
            'slider_title.max' => trans('messages.slider_title.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
			'slider_text.required' => trans('messages.slider_text.REQUIRED_ERROR'),
			'slider_text.max' => trans('messages.slider_text.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_TITLE_LIMIT]),
			'slider_url.url' => trans('messages.slider_url.VALID_URL_ERROR'),
			'image.required' => trans('messages.slider_image.REQUIRED_ERROR'),
			'image.mimes' => trans('messages.image.VALID_IMAGE_ERROR', ['valid_extensions' => IMAGE_EXTENSION]),
            'image.max' => trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]),
            'order.required' => trans('messages.order.REQUIRED_ERROR'),
            'order.numeric' => trans('messages.order.NUMERIC_ERROR'),
            'order.unique_slider' => trans('messages.slider_order.UNIQUE_ERROR')
        );

        $validate = array(
            'slider_title' => 'required|max:'.CMS_PAGE_TITLE_LIMIT,
            'slider_text' => 'required|max:'.CMS_PAGE_TITLE_LIMIT,
            'slider_url' => 'nullable|url',
        );

        if (isset($attribute['id']) && !empty($attribute['id'])) {
            $validate['order'] = 'required|numeric|min:1|unique_slider:' .$thisData['uni_id'] . ','. $attribute['id'];
            $validate['image'] = 'nullable|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024) . '|mimes:' . IMAGE_EXTENSION;

        } else {
            $validate = array(
                'image' => 'required|image|mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024),
                'order' => 'required|numeric|min:1|unique_slider:'. $thisData['uni_id'],
                'slider_title' => 'required|max:'.CMS_PAGE_TITLE_LIMIT,
                'slider_text' => 'required|max:'.CMS_PAGE_TITLE_LIMIT,
                'slider_url' => 'nullable|url',
            );
        }

        return array($validate, $message);
    }

}

//PagesController end