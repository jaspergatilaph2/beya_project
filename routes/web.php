<?php


use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Appointments\ClientController;
use App\Http\Controllers\Appointments\UserClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pets\PetsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Appointments\AnalyticsAppointmentsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home route, only accessible to verified users
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// Email verification notice
Route::get('/email/verify', function () {
    return view('auth.verify'); // Make sure this view exists
})->middleware('auth')->name('verification.notice');

// Email verification handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/appointments/data', [AnalyticsAppointmentsController::class, 'getMonthlyAppointments']);

// Admin routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [Admincontroller::class, 'index'])->name('admin.dashboard');
    Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance');

    Route::prefix('accounts')->name('admin.accounts.')->controller(AdminController::class)->group(function () {
        Route::get('/', 'accounts')->name('show');
        Route::get('/edit', 'editAccounts')->name('edit');
        Route::put('/update/{user}', 'updateAccounts')->name('update');
    });

    Route::prefix('pets')->name('admin.pets.')->controller(PetsController::class)->group(function () {
        Route::get('/', 'list')->name('show');
        Route::get('/medical', 'medicalHistory')->name('medical');
        Route::get('/{appointment}/edit', 'edit')->name('edit');
        Route::delete('/{appointment}', 'destroy')->name('destroy');
    });

    Route::prefix('appointments')->name('admin.appointments.')->controller(ClientController::class)->group(function () {
        Route::get('/', 'indexAppointments')->name('show');
        Route::post('/{appointment}/status/{status}', 'updateStatus')->name('updateStatus');
        Route::delete('/{appointment}', 'destroy')->name('destroy');
    });

    Route::prefix('owners')->name('admin.owners.')->controller(ClientController::class)->group(function () {
        Route::get('/owners/{id}', 'viewAppointments')->name('show');
    });

    Route::prefix('logs')->name('admin.logs.')->controller(ClientController::class)->group(function () {
        Route::get('/', 'logs')->name('logs');
    });
});

// User routes
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/maintenance', [UserController::class, 'userMaintenance'])->name('user.maintenance');

    Route::prefix('accounts')->name('user.accounts.')->controller(UserController::class)->group(function () {
        Route::get('/', 'accounts')->name('show');
        Route::get('/edit', 'userEditAccounts')->name('edit');
        Route::put('/update/{user}', 'userUpdateAccounts')->name('update');
    });

    Route::prefix('appointments')->name('user.appointments.')->controller(UserClientController::class)->group(function () {
        Route::get('/', 'userAppointments')->name('show');
        Route::post('/book', 'store')->name('store');
        Route::get('/viewAppointments', 'viewAppointments')->name('view');
        Route::put('/appointments/{id}', 'update')->name('update');
    });

    Route::prefix('pets')->name('user.pets.')->controller(UserClientController::class)->group(function () {
        Route::get('/{id}', 'viewPets')->name('view');
    });

    Route::prefix('logs')->name('user.logs.')->controller(UserClientController::class)->group(function () {
        Route::get('/', 'logs')->name('logs');
    });
});