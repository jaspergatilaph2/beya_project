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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/appointments/data', [AnalyticsAppointmentsController::class, 'getMonthlyAppointments']);


// Admin routes
// These routes are protected by the 'auth' and 'admin' middleware
// The 'auth' middleware checks if the user is authenticated
// The 'admin' middleware checks if the user has the 'admin' role
// If the user is not authenticated or does not have the 'admin' role, they will be redirected to a 403 error page
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [Admincontroller::class, 'index'])->name('admin.dashboard');
    Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance');




    // Admin routes for managing accounts
    // These routes are protected by the 'auth' and 'admin' middleware
    // The 'auth' middleware checks if the user is authenticated
    Route::prefix('accounts')->name('admin.accounts.')->controller(AdminController::class)->group(function () {
        Route::get('/', 'accounts')->name('show'); // List accounts
        Route::get('/edit', 'editAccounts')->name('edit'); // Show form
        Route::put('/update/{user}', 'updateAccounts')->name('update'); // Update
    });


    // Admin routes for managing the pets
    // These routes are protected by the 'auth' and 'admin' middleware
    // The 'auth' middleware checks if the user is authenticated
    Route::prefix('pets')->name('admin.pets.')->controller(PetsController::class)->group(function () {
        Route::get('/', 'list')->name('show'); // List pets
        Route::get('/medical', 'medicalHistory')->name('medical'); // show medical records
    });


    // Admin routes for managing the appointments
    Route::prefix('appointments')->name('admin.appointments.')->controller(ClientController::class)->group(function () {
        Route::get('/', 'indexAppointments')->name('show'); // List appointments

        // Change PATCH to POST and include {status} in the URI
        Route::post('/{appointment}/status/{status}', 'updateStatus')->name('updateStatus');

        Route::delete('/{appointment}', 'destroy')->name('destroy'); // Delete appointment

        // Get the User profile information
    });

    // Admin Route for managing the pets
    Route::prefix('pets')->name('admin.pets.')->controller(PetsController::class)->group(function () {
        Route::get('/', 'list')->name('show'); // List pets
        Route::get('/{appointment}/edit', 'edit')->name('edit');
        Route::delete('/{appointment}', 'destroy')->name('destroy');
    });

    // Admin routes for Managing the users
    Route::prefix('owners')->name('admin.owners.')->controller(ClientController::class)->group(function () {
        Route::get('/owners/{id}', 'viewAppointments')->name('show');
    });
});



// User routes
// These routes are protected by the 'auth' middleware
// The 'auth' middleware checks if the user is authenticated
// If the user is not authenticated, they will be redirected to the login page
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/maintenance', [UserController::class, 'userMaintenance'])->name('user.maintenance');


    // User routes for managing accounts
    // These routes are protected by the 'auth' middleware
    // The 'auth' middleware checks if the user is authenticated
    Route::prefix('accounts')->name('user.accounts.')->controller(UserController::class)->group(function () {
        Route::get('/', 'accounts')->name('show');
        Route::get('/edit', 'userEditAccounts')->name('edit'); // Show form
        Route::put('/update/{user}', 'userUpdateAccounts')->name('update');
    });


    // User routes for managing Appointments
    // These routes are protected by the 'auth' middleware
    // The 'auth' middleware checks if the user is authenticated
    Route::prefix('appointments')->name('user.appointments.')->controller(UserClientController::class)->group(function () {
        Route::get('/', 'userAppointments')->name('show'); // List appointments
        Route::post('/book', 'store')->name('store'); // Book appointment
        Route::get('/viewAppointments', 'viewAppointments')->name('view');
        Route::put('/appointments/{id}', 'update')->name('update');
    });

    // User routes for managing pets
    // These routes are protected by the 'auth' middleware
    // The 'auth' middleware checks if the user is authenticated
    Route::prefix('pets')->name('user.pets.')->controller(UserClientController::class)->group(function () {
        Route::get('/{id}', 'viewPets')->name('view');
    });
});
