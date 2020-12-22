<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CommentController;

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

// For the sake of the demo removing the middleware from API layer.
// Usually we use this to create authentication layer for the system
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


//Store Comment
Route::post('/comment',[CommentController::class,'store']);

//Get Comments
Route::get('/comments',[CommentController::class,'index']);