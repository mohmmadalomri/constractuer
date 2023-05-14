<?php

use App\Http\Controllers\Api\InvoiceController;

//    Route::get('invoices',[InvoiceController::class ,'index']);
//    Route::post('invoice/add',[InvoiceController::class ,'store']);
//    Route::put('invoice/{id}/update',[InvoiceController::class ,'update']);
//    Route::get('invoice/show/{id}',[InvoiceController::class ,'show']);
//    Route::delete('invoice/{id}/delete',[InvoiceController::class ,'delete']);

\Illuminate\Support\Facades\Route::apiResource('invoice',InvoiceController::class)->middleware('auth:sanctum');
