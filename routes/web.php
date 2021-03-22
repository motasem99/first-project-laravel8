<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShiftsController;
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
    return view('welcome');
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
    });
});

require __DIR__.'/auth.php';
