<?php


use App\Http\Controllers\Api\DepositController;
use App\Http\Controllers\Api\DiscountController;
use Illuminate\Support\Facades\Route;


Route::apiResource('deposit', DepositController::class)->middleware('auth:sanctum');
