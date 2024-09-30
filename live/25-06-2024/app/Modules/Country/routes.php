<?php
/*
|--------------------------------------------------------------------------
| Country Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Country module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Country\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {
        ### Country Routing ###

        Route::any('/location/index', array('as' => 'Country.index', 'uses' => 'CountryController@countryList'));
        Route::get('/location/add-country', array('as' => 'Country.add', 'uses' => 'CountryController@addCountry'));
        Route::post('/location/add-country', array('as' => 'Country.save', 'uses' => 'CountryController@saveCountry'));
        Route::get('/location/edit-country/{id}', array('as' => 'Country.edit', 'uses' => 'CountryController@editCountry'));
        Route::post('/location/edit-country/{id}', array('as' => 'Country.update', 'uses' => 'CountryController@updateCountry'));
        Route::get('location/update-country-status/{id}/{status}', array('as' => 'Country.status', 'uses' => 'CountryController@updateCountryStatus'));
        Route::get('location/update-country-default-status/{id}', array('as' => 'Country.default', 'uses' => 'CountryController@markAsDefault'));
        Route::any('/locationaction/multiple-action', array('as' => 'Country.Multipleaction', 'uses' => 'CountryController@performMultipleActionOnCountry'));

        ### State Routing ###

        Route::any('/location/states/{country_id}', array('as' => 'State.index', 'uses' => 'CountryController@stateList'));
        Route::get('/location/states/add-state/{country_id}', array('as' => 'State.add', 'uses' => 'CountryController@addState'));
        Route::post('/location/states/add-state/{country_id}', array('as' => 'State.save', 'uses' => 'CountryController@saveState'));
        Route::get('/location/edit-state/{country_id}/{state_id}', array('as' => 'State.edit', 'uses' => 'CountryController@editState'));
        Route::post('/location/edit-state/{country_id}/{state_id}', array('as' => 'State.update', 'uses' => 'CountryController@updateState'));
        Route::get('location/update-state-status/{id}/{status}', array('as' => 'State.status', 'uses' => 'CountryController@updateStateStatus'));
        Route::any('/location/delete-state/{stateId}', array('as' => 'State.delete', 'uses' => 'CountryController@deleteState'));
        Route::any('/location/statesaction/multiple-action', array('as' => 'State.Multipleaction', 'uses' => 'CountryController@performMultipleActionOnState'));

        ### City Routing ###

        Route::any('/location/city/{state_id}', array('as' => 'City.index', 'uses' => 'CountryController@CityList'));
        Route::get('/location/city/add-City/{state_id}', array('as' => 'City.add', 'uses' => 'CountryController@addCity'));
        Route::post('/location/city/add-City/{state_id}', array('as' => 'City.save', 'uses' => 'CountryController@saveCity'));
        Route::get('/location/edit-city/{state_id}/{city_id}', array('as' => 'City.edit', 'uses' => 'CountryController@editCity'));
        Route::post('/location/edit-city/{state_id}/{city_id}', array('as' => 'City.update', 'uses' => 'CountryController@updateCity'));
        Route::get('location/update-city-status/{id}/{status}', array('as' => 'City.status', 'uses' => 'CountryController@updateCityStatus'));
        Route::any('/location/delete-city/{city_id}', array('as' => 'City.delete', 'uses' => 'CountryController@deleteCity'));
        Route::any('/location/cityaction/multiple-action', array('as' => 'City.Multipleaction', 'uses' => 'CountryController@performMultipleActionOnCity'));
        Route::any('/save-state-data', array('as' => 'Country.saveStateData', 'uses' => 'CountryController@saveStateData'));
        Route::any('/save-city-data', array('as' => 'Country.saveCityData', 'uses' => 'CountryController@saveCityData'));
        Route::any('/save-group-data', array('as' => 'Country.saveGroupRecords', 'uses' => 'CountryController@saveGroupRecords'));

    });

});