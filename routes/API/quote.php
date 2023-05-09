<?php

use App\Http\Controllers\Api\QuoteController;

        Route::get('quotes',[QuoteController::class ,'index']);
        Route::post('quote/add',[QuoteController::class ,'store']);
        Route::put('quote/{id}/update',[QuoteController::class ,'update']);
        Route::get('quote/show/{id}',[QuoteController::class ,'show']);
        Route::delete('quote/{id}/delete',[QuoteController::class ,'destroy']);
