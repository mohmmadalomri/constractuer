<?php
use App\Http\Controllers\Api\CompanyController;

//        Route::get('company',[CompanyController::class ,'index']);
//        Route::post('company/add_info',[CompanyController::class ,'store']);
//        Route::put('company/update',[CompanyController::class ,'update']);
//        Route::get('company/show',[CompanyController::class ,'show']);
//        Route::delete('company/delete',[CompanyController::class ,'delete']);
\Illuminate\Support\Facades\Route::apiResource('company',CompanyController::class);
