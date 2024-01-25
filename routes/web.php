<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function() {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/process_login', 'processLogin');
});

Route::group(['middleware' => 'auth'], function() {
    Route::controller(AdminDashboardController::class)->group(function() {
        Route::get('/admin_dashboard', 'index');
    });
    
    Route::controller(UserController::class)->group(function() {
        Route::get('/clients', 'indexClient');
        Route::get('/client/create', 'createClient');
        Route::get('/client/show/{id}', 'showClient');
        Route::get('/client/edit/{id}', 'editClient');
        
        Route::post('/store_client', 'storeClient');
        Route::post('/logout_user', 'logout');

        Route::put('/update_client/{user}', 'updateClient');
        Route::put('/destroy_client/{user}', 'destroyClient');
    });

    Route::controller(HouseController::class)->group(function() {
        Route::get('/houses', 'index');
        Route::get('/house/edit/{id}', 'edit');

        Route::post('/store_house', 'store');

        Route::put('/update_house/{house}', 'update');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/categories', 'index');
        Route::get('/category/edit/{id}', 'edit');

        Route::post('/store_category', 'store');

        Route::put('/update_category/{category}', 'update');
    });
});
