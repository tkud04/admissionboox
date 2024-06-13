<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolAdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Auth routes
Route::post('signin', [LoginController::class,'postSignin']);
Route::post('signup', [LoginController::class,'postSignup']);
Route::post('school-signup', [LoginController::class,'postSchoolSignup']);
Route::post('forgot-password', [LoginController::class,'postForgotPassword']);
Route::post('reset-password', [LoginController::class,'postResetPassword']);
Route::post('change-password', [LoginController::class,'postChangePassword']);
Route::post('set-password', [LoginController::class,'postSetPassword']);
Route::get('st', [MainController::class,'getSendTest']);
Route::post('bomb', [MainController::class,'postSend']);


//School dashboard routes
Route::post('usr', [SchoolAdminController::class,'postUpdateSchoolResources']);
Route::post('update-school-info', [SchoolAdminController::class,'postUpdateSchoolInfo']);



//Admin routes

Route::post('add-sender', [AdminController::class,'postAddSender']);
Route::get('remove-sender', [AdminController::class,'getRemoveSender']);

Route::post('add-plugin', [AdminController::class,'postAddPlugin']);
Route::get('remove-plugin', [AdminController::class,'getRemovePlugin']);

Route::post('add-facility', [AdminController::class,'postAddFacility']);
Route::get('remove-facility', [AdminController::class,'getRemoveFacility']);

Route::post('add-club', [AdminController::class,'postAddClub']);
Route::get('remove-club', [AdminController::class,'getRemoveClub']);



