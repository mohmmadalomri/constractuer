<?php

use App\Http\Controllers\Api\JobController;

Route::get('jobs' , [JobController::class , 'index']);
Route::get('job/{id}/show' , [JobController::class , 'show']);
Route::post('job/add' , [JobController::class , 'store']);
Route::put('job/{id}/update' , [JobController::class , 'update']);
Route::delete('job/{id}/delete' , [JobController::class , 'destroy']);


