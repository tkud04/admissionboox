<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolAdminController;

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
Route::get('add-plugin', [AdminController::class,'getAddPlugin']);
Route::get('plugins', [AdminController::class,'getPlugins']);
Route::get('add-sender', [AdminController::class,'getAddSender']);
Route::get('senders', [AdminController::class,'getSenders']);
Route::get('add-facility', [AdminController::class,'getAddFacility']);
Route::get('facilities', [AdminController::class,'getFacilities']);
Route::get('add-club', [AdminController::class,'getAddClub']);
Route::get('clubs', [AdminController::class,'getClubs']);

//School routes
Route::get('send-email', [SchoolAdminController::class,'getSendEmail']);