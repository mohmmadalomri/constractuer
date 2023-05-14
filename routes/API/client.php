<?php
use App\Http\Controllers\Api\ClientController;
use Illuminate\Support\Facades\Route;

//        Route::get('clients',[ClientController::class ,'index']);
//        Route::post('client/add',[ClientController::class ,'store']);
//        Route::put('client/{id}/update',[ClientController::class ,'update']);
//        Route::get('client/show/{id}',[ClientController::class ,'show']);
//        Route::delete('client/delete/{id}',[ClientController::class ,'destroy']);

Route::apiResource('client', \App\Http\Controllers\Api\ClientController::class)->middleware('auth:sanctum');
