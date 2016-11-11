<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', function(){
	return view('admin.manager');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
/*get list post*/
Route::group(['prefix' => 'admin'], function (){
	Route::group(['prefix' => 'post'], function () {
		Route::get('list', ['as' => 'admin.post.list', 'uses' => 'PostController@getList']);
		Route::get('add', ['as' => 'admin.post.getAdd', 'uses' => 'PostController@getAdd']);
		Route::post('add', ['as' => 'admin.post.postAdd', 'uses' => 'PostController@postAdd']);
		Route::get('delete/{id?}', ['as' => 'admin.post.getDelete', 'uses' => 'PostController@getDelete']);
		Route::get('edit/{id?}', ['as' => 'admin.post.getEdit', 'uses' => 'PostController@getEdit']);
		Route::post('edit/{id?}', ['as' => 'admin.post.postEdit', 'uses' => 'PostController@postEdit']);
	});

	Route::group(['prefix' => 'product'], function () {
		Route::get('list', ['as' => 'admin.product.list', 'uses' => 'ProductController@getList']);
		Route::get('add', ['as' => 'admin.product.getAdd', 'uses' => 'ProductController@getAdd']);
		Route::post('add', ['as' => 'admin.product.postAdd', 'uses' => 'ProductController@postAdd']);
		Route::get('delete/{id?}', ['as' => 'admin.product.getDelete', 'uses' => 'ProductController@getDelete']);
		Route::get('edit/{id?}', ['as' => 'admin.product.getEdit', 'uses' => 'ProductController@getEdit']);
		Route::post('edit/{id?}', ['as' => 'admin.product.postEdit', 'uses' => 'ProductController@postEdit']);
		Route::get('delimg/{id?}', ['as' => 'admin.product.delImg', 'uses' => 'ProductController@getDelImg']);
	});
	Route::group(['prefix' => 'cate'], function () {
		Route::get('list', ['as' => 'admin.cate.list', 'uses' => 'CateController@getList']);
		Route::get('add', ['as' => 'admin.cate.getAdd', 'uses' => 'CateController@getAdd']);
		Route::post('add', ['as' => 'admin.cate.postAdd', 'uses' => 'CateController@postAdd']);
		Route::get('delete/{id?}', ['as' => 'admin.cate.getDelete', 'uses' => 'CateController@getDelete']);
		Route::get('edit/{id?}', ['as' => 'admin.cate.getEdit', 'uses' => 'CateController@getEdit']);
		Route::post('edit/{id?}', ['as' => 'admin.cate.postEdit', 'uses' => 'CateController@postEdit']);
	});

	Route::group(['prefix' => 'about'], function () {
		Route::get('list', ['as' => 'admin.about.getList', 'uses' => 'AboutController@getList']);
		Route::get('add', ['as' => 'admin.about.getAdd', 'uses' => 'AboutController@getAdd']);
		Route::post('add', ['as' => 'admin.about.postAdd', 'uses' => 'AboutController@postAdd']);
		Route::get('delete/{id?}', ['as' => 'admin.about.getDelete', 'uses' => 'AboutController@getDelete']);
		Route::get('edit/{id?}', ['as' => 'admin.about.getEdit', 'uses' => 'AboutController@getEdit']);
		Route::post('edit/{id?}', ['as' => 'admin.about.postEdit', 'uses' => 'AboutController@postEdit']);
		Route::get('listshop', ['as' => 'admin.about.getListShop', 'uses' => 'AboutController@getListShop']);
		Route::get('editshop/{id?}', ['as' => 'admin.about.getEditShop', 'uses' => 'AboutController@getEditShop']);
		Route::post('editshop/{id?}', ['as' => 'admin.about.postEditShop', 'uses' => 'AboutController@postEditShop']);
	});

	Route::group(['prefix' => 'tags'], function () {
		Route::get('list', ['as' => 'admin.tags.list', 'uses' => 'TagsController@getList']);
		Route::post('add', ['as' => 'admin.tags.getAdd', 'uses' => 'TagsController@getAdd']);
		Route::post('action', ['as' => 'admin.tags.action', 'uses' => 'TagsController@postAction']);
		Route::get('delete/{id?}', ['as' => 'admin.tags.getDelete', 'uses' => 'TagsController@getDelete']);
	});

	Route::group(['prefix' => 'manufacturer'], function () {
		Route::get('list', ['as' => 'admin.manufacturer.list', 'uses' => 'ManufacturerController@getList']);
		Route::post('add', ['as' => 'admin.manufacturer.getAdd', 'uses' => 'ManufacturerController@getAdd']);
		Route::post('action', ['as' => 'admin.manufacturer.action', 'uses' => 'ManufacturerController@postAction']);
		Route::get('delete/{id?}', ['as' => 'admin.manufacturer.getDelete', 'uses' => 'ManufacturerController@getDelete']);
	});

	Route::group(['prefix' => 'catepost'], function () {
		Route::get('list', ['as' => 'admin.catepost.list', 'uses' => 'CatePostController@getList']);
		Route::post('add', ['as' => 'admin.catepost.getAdd', 'uses' => 'CatePostController@getAdd']);
		Route::post('action', ['as' => 'admin.catepost.action', 'uses' => 'CatePostController@postAction']);
		Route::get('delete/{id?}', ['as' => 'admin.catepost.getDelete', 'uses' => 'CatePostController@getDelete']);
	});
});