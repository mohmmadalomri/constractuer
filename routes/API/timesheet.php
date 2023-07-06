<?php


use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\Api\TimesheetController::class)->prefix('/timesheet')->group(function(){

    Route::post('show_expense/{id}','show_expense');

    Route::post('show_invoice/{id}','show_invoice');


});
