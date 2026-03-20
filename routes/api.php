<?php

use App\Http\Controllers\v1\AttendanceController;
use App\Http\Controllers\v1\EmployeeController;
use App\Http\Controllers\v1\SegmentController;
use App\Http\Controllers\v1\TransportationExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function() {
    Route::resource('attendances', AttendanceController::class);
    Route::resource('segments', SegmentController::class);
    Route::resource('transportation_expenses', TransportationExpenseController::class);
    Route::resource('employee', EmployeeController::class);
});
