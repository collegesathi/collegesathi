<?php
namespace App\Modules\Specialization\Services;

use App\Modules\Specialization\Models\Specialization;
use App\Modules\Specialization\Models\SpecializationComment;
use App\Modules\Specialization\Models\SpecializationDescription;
use App\Modules\Country\Models\Destination;
use App\Modules\User\Models\Consultant;
use App\Services\SendMailService;
use Auth,Config,CustomHelper,Request,ValidationHelper,Validator;

/**
 * Blog Service here
 *
 * Add your methods in the class below
 *
 */

class SpecializationService
{



    /**
     * BlogService::BlogValidateandSave()
     * @Description Function  for validation and save Blog
     * @param $formData as form data
     * @param $attribute as other attribute
     * @return $validation message and validation
     **/
    public static function BlogValidateandSave($formData = array(), $attribute = array()){

        $status                 = null;
        $response               = array();
        $errorsArray            = array();
        $response['status']     = ERROR;
        $id                     = Auth::user()->id;
        $userRole               = Auth::user()->user_role_id;
        $mobile                 = (isset($formData['mobil_req']) && $formData['mobil_req']) ? ACTIVE : INACTIVE;
        $type                   = isset($attribute['type']) ? $attribute['type'] : 'add';
        $user_id                   = isset($attribute['user_id']) ? $attribute['user_id'] : null;
        $uni_id                   = isset($attribute['uni_id']) ? $attribute['uni_id'] : null;

        list($validate, $message) = ValidationHelper::getBlogValidation($formData, $attribute);
        $validator                = Validator::make($formData, $validate, $message);
        if ($validator->fails()) {
            if ($mobile) {
                $errorsArray = $validator->errors()->toArray();
            } else {
                $errorsArray = $validator->errors()->toArray();
                $res = array('data' => $response, 'validator' => $validator);
                return $res;
            }
        } else {
            $obj                    = ($type == 'add')  ?   new Specialization :  Specialization::findorFail($attribute['blog_id']);
            $obj->title             = $formData['title'];
            if($type == 'add'){
                $obj->slug              = CustomHelper::getSlug($formData['title'], 'slug', 'Blog');
            }
            $obj->description       = $formData['description'];
            $obj->meta_title        = !empty($formData['meta_title']) ? $formData['meta_title'] : '';
            $obj->meta_keyword      = !empty($formData['meta_keyword']) ? $formData['meta_keyword'] : '';
            $obj->meta_description  = !empty($formData['meta_description']) ? $formData['meta_description'] : '';
            $obj->university_id     = $uni_id;
            $obj->added_by          = $user_id;

			$obj->is_active         = (int) ACTIVE;

            if (isset($formData['image']) && !empty($formData['image'])) {
                $extension = $formData['image']->getClientOriginalExtension();
                $fileName = time() . '-blog-image.' . $extension;
                if ($formData['image']->move(TREND_IMAGE_ROOT_PATH, $fileName)) {
                    $old_image = $obj->image;
                    @unlink(TREND_IMAGE_ROOT_PATH . $old_image);
                    $obj->image = $fileName;
                }
            }
                if (isset($formData['image_1']) && !empty($formData['image_1'])) {
					$extension = $formData['image_1']->getClientOriginalExtension();
					$fileName = time() . '-blog-image_1.' . $extension;
					if ($formData['image_1']->move(BLOG_IMAGE_ROOT_PATH, $fileName)) {
						$old_image = $obj->image_1;
						@unlink(BLOG_IMAGE_ROOT_PATH . $old_image);
						$obj->image_1 = $fileName;
					}
				}
                if ($obj->save()) {
                    $modelId = $obj->id;
                }

                if($type == 'edit') SpecializationDescription::where('parent_id', $modelId)->delete();

                foreach ($formData['data'] as $langCode => $descriptionResult) {
                    // update multi langual data in Subject
                    if ($descriptionResult == CustomHelper::getConfigValue('defaultLanguageCode')) {
                        $modelDescription                = new SpecializationDescription();
                        $modelDescription->language_id   = $langCode;
                        $modelDescription->parent_id     = $modelId;
                        $modelDescription->title         = $formData['title'];
                        $modelDescription->description   = $formData['description'];
                        $modelDescription->save();
                    } else {
                        $modelDescription               = new SpecializationDescription();
                        $modelDescription->language_id  = $langCode;
                        $modelDescription->parent_id    = $modelId;
                        $modelDescription->title        = $descriptionResult['title'];
                        $modelDescription->description  = $descriptionResult['description'];
                        $modelDescription->save();
                    }
                }
                $response['status'] = SUCCESS;
            }
        $response['errors'] = $errorsArray;
        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;

    } // end BlogValidateandSave


    /**
     * Function for view Blog
     *
     * @param $formData,
     * @param @attribute
     *
     * @return redirect page.
     */
    public function getBlogDetail($formData = array(), $attribute = array()){


        $sortBy                         = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'updated_at';
        $order                          = (isset($formData['order'])) ? $formData['order'] : 'DESC';
        $uni_id                          = (isset($attribute['uni_id'])) ? $attribute['uni_id'] : null;

        $recordPerPage                  = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        $result       = specialization::where('university_id',$uni_id)->with('descriptionData')->where('is_featured',INACTIVE)->where('is_active', ACTIVE)->orderBy($sortBy, $order)->paginate($recordPerPage);

        $Specialization_posts     = specialization::where('university_id',$uni_id)->with('descriptionData')->where('is_active', ACTIVE)->limit(10)->orderBy($sortBy, $order)->get();

        $featured_posts     = specialization::where('university_id',$uni_id)->where('is_featured',ACTIVE)->with('descriptionData')->where('is_active', ACTIVE)->orderBy('updated_at', $order)->get();


        $status                         = SUCCESS;
        $response['status']             = $status;
        $response['sort_by']            = $sortBy;
        $response['order']              = $order;
        $response['blogs']             = $result;
        $response['last_page']         = $result->lastPage();
        $response['Specialization_posts']    = $Specialization_posts;
        $response['featured_posts']    = $featured_posts;


        $mobile = 0;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 0;
        }
        $res = array('data' => $response, 'mobile_req' => $mobile);
        return $res;
    }


    /**
     * Function for view Blog
     *
     * @param $formData,
     * @param @attribute
     *
     * @return redirect page.
     */
    public function viewBlogData($formData = array(), $attribute = array())
    {

        $status = ERROR;
        $message = '';
        $response = array();
        $record = array();
        $recentblogs = array();
        $mobile = 0;

        if (!empty($formData['slug'])) {
            $slug = $formData['slug'];
            $record = specialization::with(['descriptionData'])->where('slug', $slug)->firstOrFail();
            $status = SUCCESS;
        }

        $response['status'] = $status;
        if (isset($formData['mobil_req']) && $formData['mobil_req']) {
            $mobile = 1;

        } else {
            $response['record'] = $record;

        }
        $res = array('data' => $response, 'mobile_req' => $mobile);

        return $res;

    } //end viewBlog()

} // end BlogService class
