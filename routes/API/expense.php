<?php

use App\Http\Controllers\Api\ExpenseController;

Route::get('expenses' , [ExpenseController::class , 'index']);
Route::get('expense/show/{id}' , [ExpenseController::class , 'show']);
Route::post('expense/add' , [ExpenseController::class , 'store']);
Route::put('expense/{id}/update' , [ExpenseController::class , 'update']);
Route::delete('expense/{id}/delete' , [ExpenseController::class , 'destroy']);


