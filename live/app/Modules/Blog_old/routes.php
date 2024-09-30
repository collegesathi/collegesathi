<?php
/*
|--------------------------------------------------------------------------
| User Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the User module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */

Route::group(array('prefix' => ADMIN_ROUTE_PREFIX, 'namespace' => 'App\Modules\Blog\Controllers'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\AuthAdmin']), function () {

        //Blog manager  module  routing start here
        Route::any('/blog-manager', array('as' => 'Blog.index', 'uses' => 'BlogController@index'));
        Route::get('blog-manager/add-blog', array('as' => 'Blog.add', 'uses' => 'BlogController@addBlog'));
        Route::post('blog-manager/add-blog', array('as' => 'Blog.save', 'uses' => 'BlogController@saveBlog'));
        Route::get('blog-manager/edit-blog/{id}', array('as' => 'Blog.edit', 'uses' => 'BlogController@editBlog'));
        Route::post('blog-manager/edit-blog/{id}', array('as' => 'Blog.update', 'uses' => 'BlogController@updateBlog'));
        Route::get('blog-manager/update-status/{id}/{status}', array('as' => 'Blog.status', 'uses' => 'BlogController@updateBlogStatus'));
        Route::any('blog-manager/delete-blog/{id}', array('as' => 'Blog.delete', 'uses' => 'BlogController@deleteBlog'));
        Route::post('blog-manager/multiple-action', array('as' => 'Blog.Multipleaction', 'uses' => 'BlogController@performMultipleAction'));
        Route::get('/blog-manager/view/{id}', array('as' => 'Blog.view', 'uses' => 'BlogController@viewBlog'));
        Route::get('blog/remove-image/{id}/{image_type}', array('as' => 'Blog.removeImage', 'uses' => 'BlogController@removeImage'));



        //University Blog manager  module  routing start here
        Route::any('/university-blog-manager/{uni_id}', array('as' => 'UniversityBlog.index', 'uses' => 'BlogController@index'));
        Route::get('university-blog-manager/add-blog/{uni_id}', array('as' => 'UniversityBlog.add', 'uses' => 'BlogController@addBlog'));
        Route::post('university-blog-manager/add-blog/{uni_id}', array('as' => 'UniversityBlog.save', 'uses' => 'BlogController@saveBlog'));
        Route::get('university-blog-manager/edit-blog/{uni_id}/{id}', array('as' => 'UniversityBlog.edit', 'uses' => 'BlogController@editBlog'));
        Route::post('university-blog-manager/edit-blog/{uni_id}/{id}', array('as' => 'UniversityBlog.update', 'uses' => 'BlogController@updateBlog'));
        Route::get('university-blog-manager/update-status/{uni_id}/{id}/{status}', array('as' => 'UniversityBlog.status', 'uses' => 'BlogController@updateBlogStatus'));
        Route::any('university-blog-manager/delete-blog/{uni_id}/{id}', array('as' => 'UniversityBlog.delete', 'uses' => 'BlogController@deleteBlog'));
        Route::post('university-blog-manager/multiple-action/{uni_id}', array('as' => 'UniversityBlog.Multipleaction', 'uses' => 'BlogController@performMultipleAction'));
        Route::get('university-blog-manager/view/{uni_id}/{id}', array('as' => 'UniversityBlog.view', 'uses' => 'BlogController@viewBlog'));
        Route::get('university-blog/remove-image/{uni_id}/{id}/{image_type}', array('as' => 'UniversityBlog.removeImage', 'uses' => 'BlogController@removeImage'));




    });
});

Route::group(array('prefix' => '', 'namespace' => 'App\Modules\Blog\Controllers\Front'), function () {
    Route::group(array('middleware' => ['web', 'App\Http\Middleware\PreventBackHistory', 'App\Http\Middleware\GuestFront']), function () {
        Route::get('/blogs', array('as' => 'Blog.frontIndex', 'uses' => 'BlogController@index'));
        Route::any('/blogs/detail/{slug}', array('as' => 'Blog.postView', 'uses' => 'BlogController@viewBlog'));
        Route::any('/blog-load-more', array('as' => 'Blog.blogLoadMore', 'uses' => 'BlogController@blogLoadMore'));
    });
});
