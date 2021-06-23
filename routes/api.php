<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::post('register', [Controllers\API\AuthController::class, 'register']);
Route::post('login', [Controllers\API\AuthController::class, 'login']);

Route::resource('dishes', Controllers\API\DishController::class)->only(['index', 'show']);
Route::resource('categories', Controllers\API\CategoryController::class)->only(['index', 'show']);

     
Route::middleware('auth:api')->group( function () {
    Route::get('me', [Controllers\API\AuthController::class, 'me']);
    Route::post('logout', [Controllers\API\AuthController::class, 'logout']);    
});