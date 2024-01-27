<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Customer_sitesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Predefined_observationsController;
use App\Http\Controllers\ReponseController;
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
// Route for getSitebyCustomerId method
Route::get('/customer_sites/{customerId}', [Customer_sitesController::class, 'getSitebyCustomerId']);
Route::get("categories",[CategorieController::class,'index']);
Route::get("customers",[CustomerController::class,'index']);
// Route definition in routes/api.php or web.php
// routes/api.php or web.php
Route::get('/predefined_observation/{question}', [Predefined_observationsController::class, 'getobservationsbyQuestion']);
Route::put('/reponses/{id}', [ReponseController::class, 'putReponsebyId']);
