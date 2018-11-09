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
Route::group(['middleware' => ['web']], function () {

	Route::get('/logout','Auth\LoginController@logout')->name('logout');

	//various
	Route::get('blog/{slug}', ['as' => 'blog.single', 'uses'=>'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
	Route::get('blog', ['uses'=>'BlogController@getIndex', 'as' => 'blog.index']);
	Route::get('contact','PagesController@getContact');
	Route::post('contact','PagesController@postContact');
	Route::get('about','PagesController@getAbout');
	Route::get('/','PagesController@getIndex');

	Route::resource('posts', 'PostController');
	Route::resource('categories', 'CategoryController', ['except' => ['create'] ]);
	Route::resource('tags', 'TagController', ['except' => ['create'] ]);

	//comments
	Route::post('comments/{post_id}', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
	Route::get('comments/{id}/edit', ['as' => 'comments.edit', 'uses' => 'CommentsController@edit']);
	Route::put('comments/{id}', ['as' => 'comments.update', 'uses' => 'CommentsController@update']);
	Route::delete('comments/{id}', ['as' => 'comments.destroy', 'uses' => 'CommentsController@destroy']);
	Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
