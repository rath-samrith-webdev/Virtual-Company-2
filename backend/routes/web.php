<?php

use App\Http\Controllers\MailController;
use App\Mail\ResetPasswordMail;
use App\Mail\TestMail;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Rate;
use App\Models\SystemRequest;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
};

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/mail', function () {
    try {
        Mail::to('rothsamreth@gmail.com')->send(new TestMail());
    } catch (Exception $e) {
        dd($e);
    }
});
// Admin routes
Route::get('/admin/dashboard', function () {
    $hospitals = Hospital::all();
    $users = User::all();
    $appointments = Appointment::all();
    $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $stars = [0, 1, 2, 3, 4, 5];
    $year = Carbon::now()->year;
    $new_orders_count = [];
    $new_feedback_count = [];
    $star_base_count = [];
    foreach ($month as $key => $value) {
        $new_orders_count[] = User::whereYear('created_at', $year)
            ->whereMonth('created_at', $value)->count();
        $new_feedback_count[] = Rate::whereYear('created_at', $year)
            ->whereMonth('created_at', $value)->count();
    }
    foreach ($stars as $key => $value) {
        $star_base_count[] = Rate::where('star', $value)->count();
    }
    $request = SystemRequest::orderByDesc('id')->take(10)->get();
    $data = [
        'label' => ['Hospital', 'User', 'Appointment'],
        'data' => [$hospitals->count(), $users->count(), $appointments->count()],
        'monthly_user' => $new_orders_count,
        'feedbacks' => $new_feedback_count,
        'star_base' => $star_base_count,
        'system_requests' => $request
    ];
    return view('dashboard', compact('data'));
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('hospitals', 'HospitalController');
        Route::resource('appointments', 'AppointmentController');
        Route::resource('doctors', 'DoctorController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('rates', 'RateController');
        Route::resource('system-requests', 'SystemRequestController');
        Route::resource('rooms', 'RoomController');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
    });
