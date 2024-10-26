<?php
/*
|--------------------------------------------------------------------------
| Slider Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Slider module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Slider\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        Route::get('/slider-manager', array('as' => 'Slider.index', 'uses' => 'SliderController@listSlider'));
        Route::get('slider-manager/add-slider', array('as' => 'Slider.add', 'uses' => 'SliderController@addSlider'));
        Route::post('slider-manager/add-slider', array('as' => 'Slider.save', 'uses' => 'SliderController@saveSlider'));
        Route::get('slider-manager/edit-slider/{id}', array('as' => 'Slider.edit', 'uses' => 'SliderController@editSlider'));
        Route::post('slider-manager/edit-slider/{id}', array('as' => 'Slider.update', 'uses' => 'SliderController@updateSlider'));
        Route::any('slider-manager/delete-slider/{id}', array('as' => 'Slider.delete', 'uses' => 'SliderController@deleteSlider'));
        Route::get('slider-manager/update-status/{id}/{status}', array('as' => 'Slider.status', 'uses' => 'SliderController@updateSliderStatus'));
        Route::any('slider-manager/change_order', array('as' => 'Slider.change_order', 'uses' => 'SliderController@changeSliderOrder'));
        Route::post('slider-manager/multiple-action', array('as' => 'Slider.Multipleaction', 'uses' => 'SliderController@performMultipleAction'));
        Route::any('slider-manager/view/{id}', array('as' => 'Slider.view', 'uses' => 'SliderController@viewSlider'));


        Route::get('/university-slider-manager/{uni_id}', array('as' => 'UniversitySlider.index', 'uses' => 'SliderController@listSlider'));
        Route::get('university-slider-manager/add-slider/{uni_id}', array('as' => 'UniversitySlider.add', 'uses' => 'SliderController@addSlider'));
        Route::post('university-slider-manager/add-slider/{uni_id}', array('as' => 'UniversitySlider.save', 'uses' => 'SliderController@saveSlider'));
        Route::get('university-slider-manager/edit-slider/{id}/{uni_id}', array('as' => 'UniversitySlider.edit', 'uses' => 'SliderController@editSlider'));
        Route::post('university-slider-manager/edit-slider/{id}/{uni_id}', array('as' => 'UniversitySlider.update', 'uses' => 'SliderController@updateSlider'));
        Route::any('university-slider-manager/delete-slider/{id}/{uni_id}', array('as' => 'UniversitySlider.delete', 'uses' => 'SliderController@deleteSlider'));
        Route::get('university-slider-manager/update-status/{id}/{status}/{uni_id}', array('as' => 'UniversitySlider.status', 'uses' => 'SliderController@updateSliderStatus'));
        Route::any('university-slider-manager/change_order/{uni_id}', array('as' => 'UniversitySlider.change_order', 'uses' => 'SliderController@changeSliderOrder'));
        Route::post('university-slider-manager/multiple-action/{uni_id}', array('as' => 'UniversitySlider.Multipleaction', 'uses' => 'SliderController@performMultipleAction'));
        Route::any('university-slider-manager/view/{id}/{uni_id}', array('as' => 'UniversitySlider.view', 'uses' => 'SliderController@viewSlider'));

    });

});
