<?php

namespace App\Modules\SurveQuestionAnswer\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\SurveQuestionAnswer\Models\SurveQuestion;
use Config;
use CustomHelper;
use Redirect;
use Request;
use Session;
use Validator; 
use View;


class SurveQuestionAnswerController extends BaseController
{
    /**
     * Function for display list of all images for slider
     *
     * @param null
     *
     * @return view page.
     */

    public $question = 'SurveQuestionAnswer';

    public function __construct()
    {
        View::share('modelName', $this->question);
    }


    public function index()
    {
        $DB = SurveQuestion::query();

        $searchVariable = array();  
        $inputGet = Request::Input();

        if (Request::Input()) {
            $searchData = Request::Input();
            $searchVariable = Request::Input();

            if (isset($searchData['display'])) {
                unset($searchData['display']);
            }
            if (isset($searchData['_token'])) {
                unset($searchData['_token']);
            }
            if (isset($searchData['sortBy'])) {
                unset($searchData['sortBy']);
            }
            if (isset($searchData['order'])) {
                unset($searchData['order']);
            }
            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'active') {
                        $DB->where('is_active', (int) $fieldValue);
                    } else if ($fieldName == 'category_id') {
                        $DB->where('category_id', (int) $fieldValue);
                    }
                     else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);

        $category = Config::get('SURVE_QUESTION_CATEGORY');

        return View::make("SurveQuestionAnswer::index", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable','category'));
    }


    public function addSurve()
    {

        $category = Config::get('SURVE_QUESTION_CATEGORY');
        return View::make("SurveQuestionAnswer::add", compact('category'));
    }


    public function saveSurve()
    {
        $formData                =    Request::all();
        $validator = Validator::make(
            $formData,
            array(
                'question'                      => 'required|unique_servey_question:'.$formData['category_id'],
                'category_id'                 => 'required',
                'question_order'                        => 'required|numeric|unique_servey_question_order:' .$formData['category_id']
            ),
            array( 
                'question.required' => trans('messages.question.REQUIRE_ERROR'),
                'question.unique_servey_question' => trans('messages.UNIQUE.question'),
                'category_id.required' => trans('messages.category_id.REQUIRE_ERROR'),
                'question_order.required' => trans('messages.order.REQUIRE_ERROR'),
                'question_order.numeric' => trans('messages.order.VALID'),
                'question_order.unique_servey_question_order'  => trans('messages.question_order.UNIQUE'),
            )
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $question = new SurveQuestion;
            $question->slug   = CustomHelper::getSlug($formData['question'], 'slug', "SurveQuestion", "SurveQuestionAnswer");
            $question->question = isset($formData['question']) ? $formData['question']  : '';
            $question->category_id = isset($formData['category_id']) ? $formData['category_id']  : '';
            $question->question_order = isset($formData['question_order']) ? $formData['question_order']  : '';
            $question->is_active = (int)ACTIVE;
            $question->is_course_question = isset($formData['is_course_question']) && !empty($formData['is_course_question']) ? $formData['is_course_question'] : null;
            if($question->save()){
                if($question->is_course_question == ACTIVE){
                    $queId =  $question->id;
                    SurveQuestion::where('category_id',$question->category_id)->where('id','!=',$queId)->update(['is_course_question' => null]);
                }
            }
            Session::flash('success', trans("messages.$this->question.added_message"));
            return Redirect::route("$this->question.questions");
        }
    }



    public function editSurve($questionId)
    {

        $question = SurveQuestion::find($questionId);
        $category = Config::get('SURVE_QUESTION_CATEGORY');
        return View::make("SurveQuestionAnswer::edit", compact('category', 'question'));
    }


    public function updateSurve()
    {
        $formData                =    Request::all();
        $question = SurveQuestion::find($formData['id']);
        $validator = Validator::make(
            $formData,
            array(
                'question'                      => 'required|unique_servey_question:'.$formData['category_id'] . ',' . $formData['id'],
                'category_id'                 => 'required',
                'question_order'                        => 'required|numeric|unique_servey_question_order:' .$formData['category_id'] . ',' . $formData['id']
            ),
            array(
                'question.required' => trans('messages.question.REQUIRE_ERROR'),
                'question.unique_servey_question' => trans('messages.UNIQUE.question'),
                'category_id.required' => trans('messages.category_id.REQUIRE_ERROR'),
                'question_order.required' => trans('messages.order.REQUIRE_ERROR'),
                'question_order.numeric' => trans('messages.order.VALID'),
                'question_order.unique_servey_question_order'  => trans('messages.question_order.UNIQUE'),
            )
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $question->question = isset($formData['question']) ? $formData['question']  : '';
            $question->category_id = isset($formData['category_id']) ? $formData['category_id']  : '';
            $question->question_order = isset($formData['question_order']) ? $formData['question_order']  : '';
            $question->is_course_question = isset($formData['is_course_question']) && !empty($formData['is_course_question']) ? $formData['is_course_question'] : null;
            if($question->save()){
                if($question->is_course_question == ACTIVE){
                    $queId =  $question->id;
                    SurveQuestion::where('category_id',$question->category_id)->where('id','!=',$queId)->update(['is_course_question' => null]);
                }
            }
            Session::flash('success', trans("messages.update_messages"));
            return Redirect::route("SurveQuestionAnswer.questions");
        }
    }



    public function updateStatus($modelId = 0, $modelStatus = 0){
        SurveQuestion::where('id', '=', $modelId)->update(array('is_active' => (int) $modelStatus));
        Session::flash('success', trans("messages.status_updated_message"));
        return Redirect::route("SurveQuestionAnswer.questions");
    }
}
