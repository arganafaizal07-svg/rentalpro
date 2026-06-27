<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->group(function () {

    // Dashboard Admin/Staff
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Cars Search API (must be before resource route)
    Route::get('/cars/search', [CarController::class, 'search'])
        ->name('cars.search');

    // Cars Management
    Route::resource('cars', CarController::class);

    // Bookings Management
    Route::resource('bookings', BookingController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    // Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Payments
    Route::view('/payments', 'payments.index')
        ->name('payments.index');

    // Roles
    Route::view('/roles', 'roles.index')
        ->name('roles.index');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {

    // Customer Dashboard
    Route::view('/customer/dashboard', 'customer.dashboard')
        ->name('customer.dashboard');

    // Customer Cars
    Route::get('/customer/cars', [CarController::class, 'index'])
        ->name('customer.cars');

    // Customer Bookings
    Route::get('/customer/bookings', [BookingController::class, 'index'])
        ->name('customer.bookings');

    Route::get('/customer/booking/create/{car}', [BookingController::class, 'customerCreate'])
        ->name('customer.booking.create');

    Route::post('/customer/booking/store', [BookingController::class, 'customerStore']) 
        ->name('customer.booking.store');

});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';