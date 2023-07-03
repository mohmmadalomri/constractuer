<?php

use App\Http\Controllers\Api\AccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('search/{name}', [\App\Http\Controllers\Api\SearchController::class, 'search']);


Route::group(['prefix' => 'v1', 'namspace' => 'Api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'login']);

    Route::post('access-tokens', [AccessTokenController::class, 'store'])
        ->middleware('guest:sanctum');
    Route::delete('access-tokens/{token?}', [AccessTokenController::class, 'destroy'])
        ->middleware('auth:sanctum');


}
);

Route::group(['prefix' => 'v1', 'namspace' => 'Api'], function () {

//    Route::post('access-tokens', [AccessTokenController::class, 'store'])
//        ->middleware('guest:sanctum')->name('access-tokens');
//    Route::delete('access-tokens/{token?}', [AccessTokenController::class, 'destroy'])
//        ->middleware('auth:sanctum');


    require 'API\user.php';

    require 'API\company.php';

    require 'API\client.php';

    require 'API\item.php';

    require 'API\task.php';

    require 'API\team.php';

    require 'API\project.php';

    require 'API\invoice.php';

    require 'API\employee.php';

    require 'API\profession.php';

    require 'API\job.php';

    require 'API\quote.php';

    require 'API\expense.php';

    require 'API\request.php';
}

);
