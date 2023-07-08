<?php


use App\Http\Controllers\Api\PaymentScheduleController;
use App\Http\Controllers\Api\TaxController;
use Illuminate\Support\Facades\Route;


Route::apiResource('Tax', TaxController::class)->middleware('auth:sanctum');
