<?php 
/*
|--------------------------------------------------------------------------
| EmailTemplate Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the EmailTemplate module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\EmailTemplate\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		###email template manager  routing
		Route::get('/email-manager',array('as'=>'EmailTemplate.index','uses'=>'EmailTemplateController@listTemplate'));
		Route::get('/email-manager/add-template',array('as'=>'EmailTemplate.add','uses'=>'EmailTemplateController@addTemplate'));
		Route::post('/email-manager/add-template',array('as'=>'EmailTemplate.save','uses'=>'EmailTemplateController@saveTemplate'));
		Route::get('/email-manager/edit-template/{id}',array('as'=>'EmailTemplate.edit','uses'=>'EmailTemplateController@editTemplate'));
		Route::post('/email-manager/edit-template/{id}',array('as'=>'EmailTemplate.update','uses'=>'EmailTemplateController@updateTemplate'));
		Route::post('/email-manager/get-constant',array('as'=>'EmailTemplate.get_constant','uses'=>'EmailTemplateController@getConstant'));
		Route::any('email-manager/multiple-action',array('as'=>'EmailTemplate.Multipleaction','uses'=>'EmailTemplateController@performMultipleAction'));
	});
});
