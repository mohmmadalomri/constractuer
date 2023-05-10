<?php

use App\Http\Controllers\Api\TeamController;
//
//Route::get('teams' , [TeamController::class , 'index']);
//Route::get('team/{id}/show' , [TeamController::class , 'show']);
//Route::post('team/add' , [TeamController::class , 'store']);
//Route::put('team/{id}/updte' , [TeamController::class , 'update']);
//Route::delete('team/{id}/delete' , [TeamController::class , 'destroy']);

\Illuminate\Support\Facades\Route::apiResource('team',TeamController::class);
