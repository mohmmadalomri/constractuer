<?php


use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Api\ScheduleController::class)->prefix('/schedule')->group(function(){

    Route::post('show_project/{id}','show_project');

    Route::post('show_task/{id}','show_task');

    Route::post('show_request/{id}','show_request');

    Route::post('show_job/{id}','show_job');
});
