<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\admin\PlanController;


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
Route::post('/register',[ApiController::class,"create"]);
Route::post('/login',[ApiController::class,"login"]);
Route::get('/get-plans',[ApiController::class,"getplans"]);
Route::post('/subscription',[PlanController::class,"subscription"]);


// Route::get('/show/{id}',[ApiController::class,"show"]);
// Route::delete('/delete/{id}',[ApiController::class,"delete"]);


