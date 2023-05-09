<?php
use App\Http\Controllers\Api\ProfessionController;

        Route::get('professions',[ProfessionController::class ,'index']);
        Route::post('profession/add_info',[ProfessionController::class ,'store']);
        Route::put('profession/update',[ProfessionController::class ,'update']);
        Route::get('profession/show',[ProfessionController::class ,'show']);
        Route::delete('profession/delete',[ProfessionController::class ,'destroy']);
