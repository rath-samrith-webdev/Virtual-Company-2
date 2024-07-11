<?php

use App\Http\Controllers\API\V1\AppointmentController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\DepartmentController;
use App\Http\Controllers\API\V1\DoctorController;
use App\Http\Controllers\API\V1\FavouriteController;
use App\Http\Controllers\API\V1\HospitalController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\RateController;
use App\Http\Controllers\API\V1\RateReplyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SystemRequestController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    Route::post('/profileUpload',[AuthController::class, 'profileUpload'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
    Route::put('/update/profile',[AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->prefix('hospitals')->group(function () {
        Route::get('/list', [HospitalController::class, 'index']);
        Route::post('/create', [HospitalController::class, 'store']);
        Route::get('/show/{hospital}', [HospitalController::class, 'show']);
        Route::put('/update/{hospital}', [HospitalController::class, 'update']);
        Route::delete('/delete/{hospital}', [HospitalController::class, 'destroy']);
        Route::post('/upload', [HospitalController::class, 'uploadPreviewImage']);
        Route::post('/uploadCover', [HospitalController::class, 'uploadCover']);
    });
    Route::middleware('auth:sanctum')->prefix('appointments')->group(function () {
        Route::get('/list', [AppointmentController::class, 'index']);
        Route::post('/create', [AppointmentController::class, 'store']);
        Route::get('/todayAppointment', [AppointmentController::class, 'todayAppointment']);
        Route::get('/show/{appointment}', [AppointmentController::class, 'show']);
        Route::get('/monthlyAppointments', [AppointmentController::class, 'monthlyAppointments']);
        Route::put('/update/{appointment}', [AppointmentController::class, 'update']);
        Route::put('/update-status/{appointment}', [AppointmentController::class, 'updateAppointments']);
        Route::get('/summary', [AppointmentController::class, 'appointmentSummary']);
        Route::delete('/delete/{appointment}', [AppointmentController::class, 'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('categories')->group(function () {
        Route::get('/list', [CategoryController::class, 'index']);
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/show/{category}', [CategoryController::class, 'show']);
        Route::put('/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('departments')->group(function () {
        Route::get('/list', [DepartmentController::class, 'index']);
        Route::post('/create', [DepartmentController::class, 'store']);
        Route::get('/show/{department}', [DepartmentController::class, 'show']);
        Route::put('/update/{department}', [DepartmentController::class, 'update']);
        Route::delete('/delete/{department}', [DepartmentController::class, 'destroy']);
    });

    Route::middleware('auth:sanctum')->prefix('doctors')->group(function () {
        Route::get('/list', [DoctorController::class, 'index']);
        Route::post('/create', [DoctorController::class, 'store']);
        Route::get('/show/{doctor}', [DoctorController::class, 'show']);
        Route::put('/update/{doctor}', [DoctorController::class, 'update']);
        Route::delete('/delete/{doctor}', [DoctorController::class, 'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('feedbacks')->group(function (){
        Route::get('/list',[RateController::class,'index']);
        Route::post('/create',[RateController::class,'store']);
        Route::get('/show/{rate}',[RateController::class,'show']);
        Route::get('/recent',[RateController::class,'recentFeedback']);
        Route::get('/monthly',[RateController::class,'monthlyFeedback']);
        Route::put('/update/{rate}',[RateController::class,'update']);
        Route::delete('/delete/{rate}',[RateController::class,'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('feedback-reply')->group(function () {
        Route::get('/list',[RateReplyController::class,'index']);
        Route::post('/create',[RateReplyController::class,'store']);
        Route::get('/show/{rateReply}',[RateReplyController::class,'show']);
        Route::put('/update/{rateReply}',[RateReplyController::class,'update']);
        Route::delete('/delete/{rateReply}',[RateReplyController::class,'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('system-requests')->group(function () {
        Route::get('/list',[SystemRequestController::class,'index']);
        Route::get('/categories',[SystemRequestController::class,'categories']);
        Route::post('/create',[SystemRequestController::class,'store']);
        Route::get('/show/{systemRequest}',[SystemRequestController::class,'show']);
        Route::put('/update/{systemRequest}',[SystemRequestController::class,'update']);
        Route::delete('/delete/{systemRequest}',[SystemRequestController::class,'destroy']);
    });
    Route::middleware('auth:sanctum')->prefix('favourites')->group(function () {
        Route::get('/list',[FavouriteController::class,'index']);
        Route::post('/create',[FavouriteController::class,'store']);
        Route::put('/update/{favourite}',[FavouriteController::class,'update']);
        Route::delete('/delete/{favourite}',[FavouriteController::class,'destroy']);
    });
    Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');
});
