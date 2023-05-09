<?php

use App\Http\Controllers\Api\ProjectController;

//        Route::get('projects',[ProjectController::class ,'index']);
//        Route::post('project/add_info',[ProjectController::class ,'store']);
//        Route::put('project/{id}/update',[ProjectController::class ,'update']);
//        Route::get('project/{id}/show',[ProjectController::class ,'show']);
//        Route::delete('project/{id}/delete',[ProjectController::class ,'destroy']);

\Illuminate\Support\Facades\Route::apiResource('project',ProjectController::class);
