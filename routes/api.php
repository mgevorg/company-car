<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


use App\Http\Controllers\CarBookingController;
use App\Http\Controllers\EmployeeController;
//use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cars/available', [CarBookingController::class, 'availableCars']);
Route::post('/bookings', [CarBookingController::class, 'createBooking']);

Route::get('/employees', [EmployeeController::class, 'getAllEmployees']);
Route::post('/employees', [EmployeeController::class, 'createEmployee']);
