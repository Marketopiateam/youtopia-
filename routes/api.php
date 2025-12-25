<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LeaveRequestController;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Controllers\Api\OkrObjectiveController;
use App\Http\Controllers\Api\PayrollCycleController;
use App\Http\Controllers\Api\PayslipController;
use App\Http\Controllers\Api\PerformanceReviewController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\WorklifePostController;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('leave-requests', LeaveRequestController::class);
    Route::apiResource('meetings', MeetingController::class);
    Route::apiResource('okr-objectives', OkrObjectiveController::class);
    Route::apiResource('payroll-cycles', PayrollCycleController::class);
    Route::apiResource('payslips', PayslipController::class);
    Route::apiResource('performance-reviews', PerformanceReviewController::class);
    Route::apiResource('surveys', SurveyController::class);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('worklife-posts', WorklifePostController::class);
});
