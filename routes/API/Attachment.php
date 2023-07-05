<?php


use App\Http\Controllers\Api\AttachmentController;
use Illuminate\Support\Facades\Route;


Route::apiResource('Attachment', AttachmentController::class)->middleware('auth:sanctum');
