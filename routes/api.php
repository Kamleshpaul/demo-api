<?php

use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return \App\Services\ApiResponse::success($request->user());
});

Route::post('register', \App\Http\Controllers\Api\RegisterController::class);
Route::post('login', \App\Http\Controllers\Api\LoginController::class);

Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::resource('products', ApiProductController::class)->except(['create', 'edit']);
});
