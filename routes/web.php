<?php

use App\Http\Controllers\CarBookingController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//
//Route::get('/cars/available', [CarBookingController::class, 'availableCars']);
//Route::post('/bookings', [CarBookingController::class, 'createBooking'])->middleware('api');
//Route::get('/employees', [EmployeeController::class, 'listEmployees']);
