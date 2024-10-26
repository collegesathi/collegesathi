<?php
/*
|--------------------------------------------------------------------------
| Survey Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Survey module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */    

Route::group(array('prefix'=>'','namespace'=>'App\Modules\Survey\Controllers\Front'), function(){
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\GuestFront']), function() {
		Route::get('/survey/free-counselling/{expert_slug?}',  array('as' => 'survey.getAssist','uses'=>'SurveyController@getAssist'));
	    Route::post('/survey/save-degree-category',  array('as' => 'survey.saveDegreeCategory','uses'=>'SurveyController@saveDegreeCategory'));
		Route::get('/survey/free-counselling-steps',  array('as' => 'survey.getAssistSteps','uses'=>'SurveyController@getAssistSteps'));
		Route::post('/survey/get-assist-steps-save',  array('as' => 'survey.getAssistStepsSave','uses'=>'SurveyController@getAssistStepsSave'));
		Route::get('/survey/free-counselling-previous-steps',  array('as' => 'survey.getAssistPreviousStep','uses'=>'SurveyController@getAssistPreviousStep'));
		Route::get('/survey/free-counselling-final-step',  array('as' => 'survey.getAssistFinalStep','uses'=>'SurveyController@getAssistFinalStep'));
	    Route::post('/survey/get-assist-final-step-save',  array('as' => 'survey.getAssistFinalStepSave','uses'=>'SurveyController@getAssistFinalStepSave'));
	});
});




Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Survey\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

		Route::any('/survey-manager',array('as' => 'Survey.index', 'uses' => 'SurveyController@listSurvey'));
        Route::get('survey-manager/view/{id}',array('as' => 'Survey.view', 'uses' => 'SurveyController@viewSurvey'));
        Route::any('survey-manager/multiple-action',array('as' => 'Survey.Multipleaction', 'uses' => 'SurveyController@performMultipleAction'));
    });
});
