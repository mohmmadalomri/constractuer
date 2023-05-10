<?php

use App\Http\Controllers\Api\ItemController;
//
//Route::get('items' , [ItemController::class , 'index']);
//Route::get('item/{id}/show' , [ItemController::class , 'show']);
//Route::post('item/add' , [ItemController::class , 'store']);
//Route::put('item/{id}/update' , [ItemController::class , 'update']);
//Route::delete('item/{id}/delete' , [ItemController::class , 'destroy']);

\Illuminate\Support\Facades\Route::apiResource('item',ItemController::class);
