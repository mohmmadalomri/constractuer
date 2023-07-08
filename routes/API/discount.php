<?php


use App\Http\Controllers\Api\DiscountController;
use Illuminate\Support\Facades\Route;


Route::apiResource('discount', DiscountController::class)->middleware('auth:sanctum');
