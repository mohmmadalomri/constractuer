<?php


use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Api\ScheduleController::class)->prefix('/schedule')->group(function(){

    Route::post('show_expense/{id}','show_expense');

    Route::post('show_invoice/{id}','show_invoice');

    Route::post('show_job_schedule/{id}','show_job');

});
