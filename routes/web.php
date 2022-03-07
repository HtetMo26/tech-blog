<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/yourblogs', 'BlogController@showYourBlogs')->middleware('auth');

Route::get('/create-blog', 'BlogController@createBlog')->middleware('auth');

Route::post('/store-blog', 'BlogController@storeBlog')->name('blog.store');

Route::get('/view-blog/{id}', 'BlogController@showBlogDetails')->name('blog.view')->middleware('auth');

Route::post('/store-comment/{id}', 'BlogController@storeComment')->name('comment.store');

Route::get('/view-ownprofile', 'ProfileController@showOwnProfile')->name('ownprofile.view');

Route::post('/like-blog', 'BlogController@storeLike')->name('blog.like');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
