<?php

use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\SignaturePadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('laravel-signature-pad', [SignaturePadController::class, 'index']);
Route::get('laravel-signature-pad-company', [SignaturePadController::class, 'index_company']);
Route::post('laravel-signature-pad', [SignaturePadController::class, 'store']);

require __DIR__.'/auth.php';


Route::get('/payment', [PaypalController::class, 'payment']);
Route::get('/cancel', [PaypalController::class, 'cancel']);
Route::get('/payment/success', [PaypalController::class, 'success']);
