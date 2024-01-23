<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Customer_sitesController;
use App\Http\Controllers\CustomerController;
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

Route::get("questions",[QuestionController::class,'index']);
Route::get("projects",[ProjectController::class,'index']);
Route::get("customer_sites",[Customer_sitesController::class,'index']);
Route::get("customers",[CustomerController::class,'index']);