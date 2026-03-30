<?php

use App\Http\Controllers\v1\AttendanceController;
use App\Http\Controllers\v1\ConstructionSitesController;
use App\Http\Controllers\v1\EmployeeController;
use App\Http\Controllers\v1\SegmentController;
use App\Http\Controllers\v1\SiteAssignmentController;
use App\Http\Controllers\v1\SiteSubContractorController;
use App\Http\Controllers\v1\SubContractorController;
use App\Http\Controllers\v1\TransportationExpenseController;
use App\Models\SubContractorsWorkers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function() {
    Route::delete('transportation_expenses/bulk-delete', [TransportationExpenseController::class, 'bulkDelete']);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('segments', SegmentController::class);
    Route::resource('transportation_expenses', TransportationExpenseController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('subcontractors', SubContractorController::class);
    Route::resource('sites', ConstructionSitesController::class);
    Route::resource('site-assignment', SiteAssignmentController::class);
    Route::resource('subcontractor-workers', SubContractorController::class);
    Route::resource('site-subcontractors', SiteSubContractorController::class);
});
