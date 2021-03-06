<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShiftsController;
use App\Http\Controllers\NewsController;
use App\Models\News;
use Illuminate\Support\Facades\Route;

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
    $news=News::get();
    return view('welcome', compact('news'));
});
Route::group(['middleware'=> 'auth'], function () {
    Route::group(['prefix'=>'dashboard'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/users/create', [UsersController::class, 'create']);
        Route::post('/users/save', [UsersController::class, 'store']);
        Route::get('/users/delete/{id}', [UsersController::class, 'destroy']);
        Route::post('/users/update/{id}', [UsersController::class, 'update']);
        Route::get('/users/{id}/edit', [UsersController::class, 'edit']);

        Route::get('/shifts', [ShiftsController::class, 'index']);
        Route::get('/shifts/create', [ShiftsController::class, 'create']);
        Route::post('/shifts/save', [ShiftsController::class, 'store']);
        Route::get('/shifts/delete/{id}', [ShiftsController::class, 'destroy']);
        Route::post('/shifts/update/{id}', [ShiftsController::class, 'update']);
        Route::get('/shifts/{id}/edit', [ShiftsController::class, 'edit']);

        Route::get('/news', [NewsController::class, 'index']);
        Route::get('/news/create', [NewsController::class, 'create']);
        Route::post('/news/save', [NewsController::class, 'store']);
        Route::get('/news/delete/{id}', [NewsController::class, 'destroy']);
        Route::post('/news/update/{id}', [NewsController::class, 'update']);
        Route::get('/news/{id}/edit', [NewsController::class, 'edit']);
    });
});

require __DIR__.'/auth.php';
