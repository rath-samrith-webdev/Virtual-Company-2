<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('hospitals')->group(function () {
    Route::get('/list', [HospitalController::class, 'index']);
    Route::post('/create', [HospitalController::class, 'store']);
    Route::get('/show/{hospital}', [HospitalController::class, 'show']);
    Route::put('/update/{hospital}', [HospitalController::class, 'update']);
    Route::delete('/delete/{hospital}', [HospitalController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->prefix('appointments')->group(function () {
    Route::get('/list', [AppointmentController::class, 'index']);
    Route::post('/create', [AppointmentController::class, 'store']);
    Route::get('/show/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/update/{appointment}', [AppointmentController::class, 'update']);
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
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');
