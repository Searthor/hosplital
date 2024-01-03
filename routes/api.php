<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//customer
Route::group(['middleware' => ['auth:sanctum', 'customer']], function () {
    Route::post('/update_user_by_regis_driver', [TaxiController::class, 'update_user_by_regis_driver']);
});
