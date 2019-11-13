<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'UserController@index')->name('index');
Route::get('post/{id}/detail', 'UserController@detailPost')->name('detailPost');
Route::post('/comment/store', 'UserController@storeComment')->name('storeComment');
Route::post('/process/login', 'UserController@login')->name('Login');
Route::group(['prefix' => 'superadmin'], function() {
	Route::get('/', 'UserController@indexSuperAdmin');
	Route::group(['middleware' => 'admin'], function () {
		Route::get('/dashboard', 'superadmin\DashboardController@index')->name('dashboardSuperadmin');
		Route::get('/author', 'superadmin\DashboardController@authorIndex')->name('viewAuthor');
		Route::get('/author/add', function() {
			return view('superadmin.add');
		});
		Route::post('/author/save', 'superadmin\AuthorController@saveAuthor');
		Route::get('/author/{id}/active/{idActive}', 'superadmin\AuthorController@updateActive');

		Route::get('/post', 'superadmin\DashboardController@postIndex')->name('viewPost');
		Route::get('/post/detail/{id}', 'superadmin\DashboardController@postDetail')->name('postDetail');	
	});
	
});


Route::group(['prefix' => 'author'], function() {
	Route::get('/', 'UserController@indexAuthor')->name('indexAuthor');
	Route::get('/register', function() {
		return view('author.register');
	});
	Route::group(['middleware' => 'admin'], function() {
		Route::post('/register/save', 'author\AuthorController@register');

		Route::get('/dashboard', 'author\DashboardController@index')->name('dashboardAuthor');
		
		Route::get('/post', 'author\AuthorController@post')->name('indexPost');
		Route::get('/post/add', function() {
			return view('author.post-add');
		});
		Route::post('/post/update', 'author\AuthorController@update');
		Route::post('/post/add', 'author\AuthorController@store');
		Route::get('/post/detail/{id}', 'author\AuthorController@find');
		Route::get('/post/edit/{id}', 'author\AuthorController@edit');
		Route::get('/post/delete/{id}', 'author\AuthorController@delete');

		Route::get('/comment', 'author\CommentController@index')->name('indexComment');
		Route::get('/comment/edit/{id}', 'author\CommentController@edit');
		Route::get('/comment/delete/{id}', 'author\CommentController@delete');
		Route::post('/comment/update', 'author\CommentController@update');
	});
	
});


