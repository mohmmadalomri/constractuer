<?php


use App\Http\Controllers\Api\PaymentScheduleController;
use Illuminate\Support\Facades\Route;


Route::apiResource('payment', PaymentScheduleController::class)->middleware('auth:sanctum');
