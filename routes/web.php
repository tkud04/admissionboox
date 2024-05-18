<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

//AdmissionBoox routes
Route::get('/', [MainController::class,'getIndex']);


//Auth routes
Route::get('forgot-password', [LoginController::class,'getForgotPassword']);
Route::get('reset-password', [LoginController::class,'getResetPassword']);
Route::get('change-password', [LoginController::class,'getChangePassword']);
Route::get('set-password', [LoginController::class,'getSetPassword']);
Route::get('bye', [LoginController::class,'getLogout']);

Route::get('dashboard', [MainController::class,'getDashboard']);


//Admin routes
Route::get('admin-dashboard', [AdminController::class,'getDashboard']);
Route::get('add-sender', [AdminController::class,'getAddSender']);
