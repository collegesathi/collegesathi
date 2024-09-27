<?php
/*
|--------------------------------------------------------------------------
| SurveQuestionAnswer Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the SurveQuestionAnswer module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers. SurveQuestionAnswerController
|
 */



Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\SurveQuestionAnswer\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        /* Questions Routes */
       Route::get('survey-questions', array('as'=>'SurveQuestionAnswer.questions', 'uses'=>'SurveQuestionAnswerController@index'));
       Route::get('add-surve-question', array('as'=>'SurveQuestionAnswer.add', 'uses'=>'SurveQuestionAnswerController@addSurve'));
       Route::post('save-surve-question', array('as'=>'SurveQuestionAnswer.save', 'uses'=>'SurveQuestionAnswerController@saveSurve'));
       Route::get('edit-surve-question/{id}', array('as'=>'SurveQuestionAnswer.edit', 'uses'=>'SurveQuestionAnswerController@editSurve'));
       Route::post('save-edit-surve-question', array('as'=>'SurveQuestionAnswer.update', 'uses'=>'SurveQuestionAnswerController@updateSurve'));
       Route::get('view-surve-question', array('as'=>'SurveQuestionAnswer.view', 'uses'=>'SurveQuestionAnswerController@viewSurve'));

       Route::get('surve-question/update-status/{id}/{status}', array('as' => 'SurveQuestionAnswer.status', 'uses' => 'SurveQuestionAnswerController@updateStatus'));
       /* Questions Routes */



       /* Answers Routes */
       Route::get('survey-questions-answers/{question_id}', array('as'=>'SurveQuestionAnswer.answers', 'uses'=>'SurveyAnswerController@answersList'));
       Route::get('add-survey-question-answers/{question_id}', array('as'=>'SurveQuestionAnswer.addAnswers', 'uses'=>'SurveyAnswerController@addAnswers'));
       Route::post('save-survey-question-answers/{question_id}', array('as'=>'SurveQuestionAnswer.saveAnswer', 'uses'=>'SurveyAnswerController@saveAnswer'));
       Route::get('edit-surve-question-answer/{question_id}/{id}', array('as'=>'SurveQuestionAnswer.editAnswer', 'uses'=>'SurveyAnswerController@editAnswer'));
       Route::post('save-edit-surve-question-answers/{id}', array('as'=>'SurveQuestionAnswer.updateAnswer', 'uses'=>'SurveyAnswerController@updateAnswer'));
       Route::get('survey-question-answer/update-status/{id}/{status}/{question_id?}', array('as' => 'SurveQuestionAnswer.updateAnswerStatus', 'uses' => 'SurveyAnswerController@updateAnswerStatus'));

       /* Answers Routes */
    });

});

?>