<?php

use App\Http\Controllers\Api\EmployeeController;

//        Route::get('employees',[EmployeeController::class ,'index']);
//        Route::get('employee/show',[EmployeeController::class ,'show']);
//        Route::post('employee/add_info',[EmployeeController::class ,'store']);
//        Route::put('employee/update',[EmployeeController::class ,'update']);
//        Route::delete('employee/delete',[EmployeeController::class ,'destroy']);


\Illuminate\Support\Facades\Route::apiResource('employee', EmployeeController::class)->middleware('auth:sanctum');
