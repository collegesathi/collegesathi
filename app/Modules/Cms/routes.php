<?php
/*
|--------------------------------------------------------------------------
| Cms Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Cms module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('namespace' => 'App\Modules\Cms\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\GuestFront']), function () {
        Route::get('pages/{slug}', array('as' => 'Page.cmsPages', 'uses' => 'CmsController@cmsPages'));
    });
});

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Cms\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        Route::any('/cms-manager', array('as' => 'Cms.index', 'uses' => 'CmsController@listCms'));
        Route::get('cms-manager/add-cms', array('as' => 'Cms.add', 'uses' => 'CmsController@addCms'));
        Route::post('cms-manager/add-cms', array('as' => 'Cms.save', 'uses' => 'CmsController@saveCms'));
        Route::get('cms-manager/edit-cms/{id}', array('as' => 'Cms.edit', 'uses' => 'CmsController@editCms'))->whereNumber('id');
        Route::post('cms-manager/edit-cms/{id}', array('as' => 'Cms.update', 'uses' => 'CmsController@updateCms'))->whereNumber('id');
        Route::get('cms-manager/update-status/{id}/{status}', array('as' => 'Cms.status', 'uses' => 'CmsController@updateCmsStatus'))->whereNumber('id')->whereIn('status', ['0', '1']);
        Route::get('/cms-manager/view/{id}', array('as' => 'Cms.view', 'uses' => 'CmsController@viewCms'))->whereNumber('id');
        Route::any('cms-manager/multiple-action', array('as' => 'Cms.Multipleaction', 'uses' => 'CmsController@performMultipleAction'));
    });

});
