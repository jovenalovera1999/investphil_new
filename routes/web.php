<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;

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

Route::controller(AdminDashboardController::class)->group(function() {
    Route::get('/', 'index');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/clients', 'index');
    Route::get('/client/create', 'create');
    
    Route::post('/store_client', 'storeClient');
});