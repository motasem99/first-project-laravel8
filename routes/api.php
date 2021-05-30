<?php

// use Facade\FlareClient\Api;
use App\Http\Controllers\Api;
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

Route::post('addNews', [Api\NewsController::class, 'addNews']);

Route::post('login', [Api\NewsController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('getNews', [Api\NewsController::class, 'getNews']);

});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
