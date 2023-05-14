<?php

use App\Http\Controllers\Api\RequsetsController;
use Illuminate\Support\Facades\Route;

//
//Route::get('requests' , [RequsetsController::class , 'index']);
//Route::get('request/show/{id}' , [RequsetsController::class , 'show']);
//Route::post('request/add' , [RequsetsController::class , 'store']);
//Route::put('request/{id}/update' , [RequsetsController::class , 'update']);
//Route::delete('request/{id}/delete' , [RequsetsController::class , 'destroy']);

Route::apiResource('request', RequsetsController::class)->middleware('auth:sanctum');
