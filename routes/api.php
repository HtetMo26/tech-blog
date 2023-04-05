<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('apiTesting', function() {
//     $data = [
//         'message' => 'this is api testing message'
//     ];
//     return response()->json($data, 200);
// });

Route::get('blogs', 'API\RouteController@blogList');
Route::get('categories', 'API\RouteController@categoryList');
Route::get('users', 'API\RouteController@userList');
Route::get('tags', 'API\RouteController@tagList');

Route::post('create/category', 'API\RouteController@createCategory');
Route::post('create/tag', 'API\RouteController@createTag');
Route::post('category/delete', 'API\RouteController@deleteCategory');

/**
 *
 *
 * blog list
 *
 * localhost:8000/api/blogs (GET)
 *
 *
 * create category
 *
 * http://localhost:8000/api/create/category (POST)
 */
