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
Route::get('schools', [MainController::class,'getSchools']);
Route::get('school', [MainController::class,'getSchool']);

Route::get('init-school-application', [MainController::class,'getInitSchoolApplication']);
Route::post('init-school-application', [MainController::class,'postInitSchoolApplication']);
Route::get('complete-school-application', [MainController::class,'getCompleteSchoolApplication']);
Route::post('complete-school-application', [MainController::class,'postCompleteSchoolApplication']);


//Auth routes
Route::get('forgot-password', [LoginController::class,'getForgotPassword']);
Route::get('reset-password', [LoginController::class,'getResetPassword']);
Route::get('change-password', [LoginController::class,'getChangePassword']);
Route::get('set-password', [LoginController::class,'getSetPassword']);
Route::get('bye', [LoginController::class,'getLogout']);

Route::get('dashboard', [MainController::class,'getDashboard']);
Route::get('profile', [MainController::class,'getProfile']);


//Admin routes
Route::get('add-plugin', [AdminController::class,'getAddPlugin']);
Route::get('plugins', [AdminController::class,'getPlugins']);
Route::get('add-sender', [AdminController::class,'getAddSender']);
Route::get('senders', [AdminController::class,'getSenders']);
Route::get('add-facility', [AdminController::class,'getAddFacility']);
Route::get('facilities', [AdminController::class,'getFacilities']);
Route::get('add-club', [AdminController::class,'getAddClub']);
Route::get('clubs', [AdminController::class,'getClubs']);
Route::get('my-schools', [AdminController::class,'getSchools']);
Route::get('my-school', [AdminController::class,'getSchool']);
Route::get('admin-school-admissions', [AdminController::class,'getSchoolAdmissions']);

//School routes
Route::get('send-email', [SchoolAdminController::class,'getSendEmail']);

Route::get('school-admissions', [SchoolAdminController::class,'getSchoolAdmissions']);
Route::get('school-admission', [SchoolAdminController::class,'getSchoolAdmission']);
Route::get('add-school-admission', [SchoolAdminController::class,'getAddSchoolAdmission']);

Route::get('school-admission-forms', [SchoolAdminController::class,'getSchoolAdmissionForms']);
Route::get('school-admission-form', [SchoolAdminController::class,'getSchoolAdmissionForm']);
Route::get('add-school-admission-form', [SchoolAdminController::class,'getAddSchoolAdmissionForm']);

Route::get('school-applications', [SchoolAdminController::class,'getSchoolApplications']);
Route::get('school-application', [SchoolAdminController::class,'getSchoolApplication']);
Route::get('add-school-application', [SchoolAdminController::class,'getAddSchoolApplication']);
Route::get('application-invoice', [SchoolAdminController::class,'getApplicationInvoice']);

Route::get('school-classes', [SchoolAdminController::class,'getSchoolClasses']);
Route::get('add-school-class', [SchoolAdminController::class,'getAddSchoolClass']);

Route::get('school-faqs', [SchoolAdminController::class,'getSchoolFaqs']);
Route::get('school-faq', [SchoolAdminController::class,'getSchoolFaq']);
Route::get('add-school-faq', [SchoolAdminController::class,'getAddSchoolFaq']);

Route::get('school-reviews', [SchoolAdminController::class,'getSchoolReviews']);


Route::get('api-test', [SchoolAdminController::class,'getApiTester']);
