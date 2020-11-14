<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// OUTSIDE THE MIDDLE WARE SINCE NO NEED FOR API AUTH NEEDED
Route::prefix('comments')->group(function () {
    Route::get('{post_id}', 'CommentController@index');
    Route::post('{post_id}', 'CommentController@addComment');
});
