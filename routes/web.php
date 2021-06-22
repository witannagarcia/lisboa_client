<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers;

Route::get('/', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "loginPost"]);
Route::post('/register', [AuthController::class, "registerPost"]);
Route::post('/forgot-password', [AuthController::class, "forgotPasswordPost"]);
Route::get('/recover-password/{token}', [AuthController::class, "recoverPassword"]);
Route::post('/recover-password', [AuthController::class, "recoverPasswordPost"]);

Route::get('/menu/{hash}', [Controllers\MenuController::class, "index"]);
Route::get('/menu/categoria/{id}', [Controllers\MenuController::class, "category"]);
Route::get('/menu/platillo/{id}', [Controllers\MenuController::class, "dish"]);


Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/dashboard', [Controllers\Panel\DashboardController::class, "index"]);
    Route::resource('/qr', Controllers\Panel\QRController::class)->only([
        'index', 'update'
    ]);;

    Route::resource('/configuracion', Controllers\Panel\SettingController::class)->only(['index', 'update']);

    Route::resource('/platillos', Controllers\Panel\DishController::class);
    Route::resource('/platillos/{dish_id}/imagenes', Controllers\Panel\DishImageController::class);
    Route::resource('/categorias', Controllers\Panel\CategoryController::class);
});