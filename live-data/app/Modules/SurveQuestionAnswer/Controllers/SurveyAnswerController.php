<?php

namespace App\Modules\SurveQuestionAnswer\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\SurveQuestionAnswer\Models\SurveyAnswer;
use Config;
use Redirect;
use Request;
use Session;
use Validator;
use View;


class SurveyAnswerController extends BaseController
{
    /**
     * Function for display list of all images for slider
     *
     * @param null
     *
     * @return view page.
     */

    public $model = 'SurveQuestionAnswer';

    public function __construct()
    {
        View::share('modelName', $this->model);
    }


    public function answersList($question_id = null)
    {
        $DB = SurveyAnswer::with('getQuestionDetails');

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
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                }
                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }

        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';

        $recordPerPagePagination = (Request::get('records_per_page') != '') ? Request::get('records_per_page') : Config::get("Reading.records_per_page");

        $model = $DB->where('question_id', $question_id)->orderBy($sortBy, $order)->paginate((int) $recordPerPagePagination);
        return View::make("SurveQuestionAnswer::answers_list", compact('recordPerPagePagination', 'model', 'sortBy', 'order', 'searchVariable', 'question_id'));
    }




    public function addAnswers($question_id = null)
    {
        return View::make("SurveQuestionAnswer::add_answer", compact('question_id'));
    }




    public function saveAnswer($question_id = null)
    {
        $formData = Request::all();
        $validator = Validator::make(
            $formData,
            array(
                'answer'        => 'required',
                'answer_order'  => 'required|numeric|unique_servey_answer:' . $question_id
            ),
            array(
                'answer.required'           => trans("messages.$this->model.answer_required_error"),
                'answer_order.required'     => trans("messages.$this->model.answer_order_required_error"),
                'answer_order.numeric'     => trans("messages.$this->model.answer_order_numeric_error"),
                'answer_order.unique_servey_answer'     => trans("messages.$this->model.answer_order_unique_error"),
            ),
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj     = new SurveyAnswer;
            $obj->question_id = $question_id;
            $obj->question_slug = $formData['question_slug'];
            $obj->answer = $formData['answer'];
            $obj->answer_order = $formData['answer_order'];
            $obj->status = ACTIVE;
            $obj->save();
            Session::flash('success', trans("messages.$this->model.question_answer_add_message"));
            return Redirect::route("$this->model.answers", $question_id);
        }
    }




    public function editAnswer($question_id = null, $id = null)
    {
        $survey_answer = SurveyAnswer::findOrFail($id);
        return View::make("SurveQuestionAnswer::edit_answer", compact('survey_answer', 'question_id', 'id'));
    }




    public function updateAnswer($id = null)
    {
        $formData = Request::all();
        $validator = Validator::make(
            $formData,
            array(
                'answer'        => 'required',
                'answer_order'  => 'required|numeric|unique_servey_answer:' . $formData['question_id'] . ',' . $id
            ),
            array(
                'answer.required'           => trans("messages.$this->model.answer_required_error"),
                'answer_order.required'     => trans("messages.$this->model.answer_order_required_error"),
                'answer_order.numeric'     => trans("messages.$this->model.answer_order_numeric_error"),
                'answer_order.unique_servey_answer'     => trans("messages.$this->model.answer_order_unique_error"),
            ),
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $obj     = SurveyAnswer::findOrFail($id);
            $obj->answer = $formData['answer'];
            $obj->answer_order = $formData['answer_order'];
            $obj->status = ACTIVE;
            $obj->save();
            Session::flash('success', trans("messages.$this->model.question_answer_update_message"));
            return Redirect::route("$this->model.answers", $formData['question_id']);
        }
    }





    public function updateAnswerStatus($modelId = null, $modelStatus = null, $question_id = null)
    {
        SurveyAnswer::where('id', '=', $modelId)->update(array('status' => (int) $modelStatus));
        Session::flash('success', trans("messages.status_updated_message"));
        return Redirect::route("$this->model.answers", $question_id);
    }
}
