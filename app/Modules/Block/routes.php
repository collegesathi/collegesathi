<?php
/*
|--------------------------------------------------------------------------
| Block Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Block module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/


Route::group(array('prefix'=>ADMIN_ROUTE_PREFIX,'namespace'=>'App\Modules\Block\Controllers'), function()
{
	Route::group(array('middleware' => ['web','App\Http\Middleware\PreventBackHistory','App\Http\Middleware\AuthAdmin']), function() {
		Route::get('/block-manager',array('as'=>'Block.index','uses'=>'BlockController@listBlock'));
		Route::get('block-manager/add-block',array('as'=>'Block.add','uses'=>'BlockController@addBlock'));
		Route::post('block-manager/add-block',array('as'=>'Block.save','uses'=>'BlockController@saveBlock'));
		Route::get('block-manager/edit-block/{id}',array('as'=>'Block.edit','uses'=>'BlockController@editBlock'));
		Route::post('block-manager/edit-block/{id}',array('as'=>'Block.update','uses'=>'BlockController@updateBlock'));
		Route::get('block-manager/update-status/{id}/{status}',array('as'=>'Block.status','uses'=>'BlockController@updateBlockStatus'));
		Route::any('block-manager/delete-block/{id}',array('as'=>'Block.delete','uses'=>'BlockController@deleteBlock'));		
		Route::post('block-manager/multiple-action',array('as'=>'Block.Multipleaction','uses'=>'BlockController@performMultipleAction'));
	});

});
