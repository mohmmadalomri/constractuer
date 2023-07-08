<?php


use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;


//Route::apiResource('search', SearchController::class)->middleware('auth:sanctum');
Route::controller(SearchController::class)->group(function(){
    Route::get('show_all','index');
    Route::post('show_client','show_client');
    Route::post('show_company','show_company');
    Route::post('show_invoice','show_invoice');
    Route::post('show_project','show_project');
    Route::post('show_task','show_task');
    Route::post('show_employee','show_employee');
    Route::post('show_team','show_team');
    Route::post('show_expense','show_expense');
});
