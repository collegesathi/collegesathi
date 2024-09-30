<?php 
/*
|--------------------------------------------------------------------------
| Language Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Language module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Language\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		// language routing
		Route::get('language',array('as'=>'Language.index','uses'=>'LanguageController@listLanguage'));
		Route::get('language/add-language',array('as'=>'Language.add','uses'=>'LanguageController@addLanguage'));
		Route::post('language/save-language',array('as'=>'Language.save','uses'=>'LanguageController@saveLanguage'));
		Route::any('language/delete-language/{id}',array('as'=>'Language.delete','uses'=>'LanguageController@deleteLanguage'));
		Route::get('language/update-status/{id}/{status}',array('as'=>'Language.status','uses'=>'LanguageController@updateLanguageStatus'));
		Route::any('language/default/{id}/{langCode}/{folderCode}',array('as'=>'Language.update_default','uses'=>'LanguageController@updateDefaultLanguage'));
		Route::any('language/multiple-action',array('as'=>'Language.Multipleaction','uses'=>'LanguageController@performMultipleAction'));
	});

});
