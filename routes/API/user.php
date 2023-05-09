<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::post('logout' ,[AuthController::class , 'logout'])->middleware('auth:sanctum');
//Route::get('users',[UserController::class ,'index']);
//Route::post('user/create' , [UserController::class , 'store']);
//Route::get('user/show',[UserController::class ,'show']);
//Route::put('user/update',[UserController::class ,'update']);
//Route::delete('user/delete',[UserController::class ,'destroy']);
Route::put('user/change_password',[UserController::class ,'change_password']);

\Illuminate\Support\Facades\Route::apiResource('user',UserController::class);
