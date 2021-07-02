<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers;

use App\Models\Branch;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

Route::get('/', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "loginPost"]);
Route::post('/register', [AuthController::class, "registerPost"]);
Route::post('/forgot-password', [AuthController::class, "forgotPasswordPost"]);
Route::get('/recover-password/{token}', [AuthController::class, "recoverPassword"]);
Route::post('/recover-password', [AuthController::class, "recoverPasswordPost"]);

Route::get('/menu', [Controllers\MenuController::class, "index"]);
Route::get('/menu/categoria/{id}', [Controllers\MenuController::class, "category"]);
Route::get('/menu/platillo/{id}', [Controllers\MenuController::class, "dish"]);

Route::get('/test', function(){
    $firebase = new FirebaseService();
    dd($firebase->saveOrder());
});

Route::get('/listen-orders', function(){
    return view('kitchen.orders.index');
});


Route::prefix('panel')->middleware('auth')->group(function () {

    Route::get('/', function(){
        return redirect('/panel/dashboard');
    });

    Route::get('auth/logout', [Controllers\AuthController::class, "logout"]);
    Route::get('/dashboard', [Controllers\Panel\DashboardController::class, "index"]);
    Route::resource('/qr', Controllers\Panel\QRController::class)->only([
        'index', 'show', 'update'
    ]);
    Route::get('cambiar-sucursal/{branchId}', function(Request $request, $branchId){
        $branch = Branch::find($branchId);
        $request->session()->put('branch', $branch);
        return redirect()->back()->with('success', 'Sucursal seleccionada correctamente.');
    });

    Route::resource('/configuracion', Controllers\Panel\SettingController::class)->only(['index', 'update']);

    Route::resource('/platillos', Controllers\Panel\DishController::class);
    Route::resource('/platillos/{dish_id}/imagenes', Controllers\Panel\DishImageController::class);
    Route::resource('/categorias', Controllers\Panel\CategoryController::class);
    Route::resource('/sucursales', Controllers\Panel\BranchController::class);
    Route::resource('/mesas', Controllers\Panel\TableController::class);
});

Route::prefix('cocina')->middleware('auth')->group(function(){
    Route::resource('ordenes', Controllers\Kitchen\OrderController::class);
});