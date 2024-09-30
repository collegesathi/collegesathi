<?php
namespace App\Modules\Expert\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Country\Models\Country;
use  Auth, CustomHelper, View, Config, Session, Request,CURLFILE;
use App\Modules\Expert\Services\ExpertService;
use App\Modules\User\Models\User;

/**
 * ExpertController class
 */
class ExpertController extends BaseController
{

    public $model = 'Expert';

    public function __construct(){
        View::share('modelName', $this->model);
    }


   /**
     * Function for apply job
     * @param null
     * @return
     */
    public function consultNow()
    {
        $formData = Request::all();

        if (Request::isMethod('post')) {

            $attribute = array("from" => "front", "model" => $this->model, "type" => "add");
            $expertService = new ExpertService;
            $res = $expertService->consultNowValidateAndSave($formData, $attribute, $this->model);

            if ($res['data']['status'] == ERROR) {
                $validator = $res['validator'];
                return response()->json(['status' => ERROR, 'errors' => $validator->errors()->toArray()]);
            } else {
                if ($res['data']['status'] == 'success') {
                    Session::flash(SUCCESS, $res['data']['message']);
                    return response()->json(['status' => SUCCESS]);
                }
            }
        } else {
            return response()->json(['status' => ERROR, 'message' => trans('front_messages.global.something_went_wrong')]);
        }
    }

} // end HomeController class
