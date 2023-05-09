<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

//
//Route::get('tasks',[TaskController::class ,'index']);
//Route::get('task/{id}/show',[TaskController::class ,'show']);
//Route::post('task/add',[TaskController::class ,'store']);
//Route::put('task/{id}/update',[TaskController::class ,'update']);
//Route::delete('task/{id}/delete',[TaskController::class ,'destroy']);

Route::apiResource('task', \App\Http\Controllers\Api\TaskController::class);
