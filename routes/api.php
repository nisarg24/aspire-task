<?php

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

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoanController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-account', [AuthenticationController::class, 'createAccount']);

Route::post('signin', [AuthenticationController::class, 'signin']);

Route::group(
    [
        'middleware' => ['auth:sanctum']
    ],
    function () {
        Route::post('sign-out', [AuthenticationController::class, 'signout']);
        
        Route::post('/create-loan', [LoanController::class, 'create']);

        Route::post('/approve-loan', [LoanController::class, 'approve']);
    }
);
