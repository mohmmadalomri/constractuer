<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::put('user/change_password', [UserController::class, 'change_password']);

Route::apiResource('user', UserController::class)->middleware('auth:sanctum');
