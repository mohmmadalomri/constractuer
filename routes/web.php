<?php

use App\Http\Controllers\PaypalController;
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

Route::get('laravel-signature-pad', [SignaturePadController::class, 'index'])->name('laravel_signature_pad_client');
Route::get('laravel-signature-pad-company', [SignaturePadController::class, 'index_company']);
Route::post('laravel-signature-pad', [SignaturePadController::class, 'store']);

//require __DIR__.'/auth.php';

/* PayPal */
Route::get('paypal/form', [PaypalController::class, 'form'])->name('paypal_form');
Route::post('paypal/payment', [PaypalController::class, 'payment'])->name('paypal');
Route::get('paypal/success', [PaypalController::class, 'success'])->name('paypal_success');
Route::get('paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal_cancel');
