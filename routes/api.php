<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Fruitcake\Cors\HandleCors;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Customer_sitesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Predefined_observationsController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UserController;
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
Route::get("/questions", [QuestionController::class, 'index']);
Route::get('/questions/{categorie_id}', [QuestionController::class, 'getQuestionbyCategorie']);
Route::get("/projects", [ProjectController::class, 'index']);
Route::get("/projects/{customerId}", [ProjectController::class, 'getProjectbyCustomerId']);
Route::get('/projet/{id}',[ProjectController::class, 'getProjectByID']);
Route::post('/updateproj/{id}',[ProjectController::class, 'updateProject']);
Route::get('/getprojsubmit',[ProjectController::class, 'getSubmittedProjects']);
Route::get('/getprojunsubmit',[ProjectController::class, 'getUnSubmittedProjects']);
Route::get("/customer_sites", [Customer_sitesController::class, 'index']);

// Route for getSitebyCustomerId method
Route::get('/customer_sites/{customerId}', [Customer_sitesController::class, 'getSitebyCustomerId']);
Route::get('/project_sites/{projectId}', [Customer_sitesController::class, 'getSitebyProjectId']);
Route::get('/customer_site/{id}', [Customer_sitesController::class, 'getCustomerSiteByID']);
Route::get('/categorie/{site_id}',[CategorieController::class,'getCategorieBySiteId']);
Route::get("categories",[CategorieController::class,'index']);
Route::get("categories/{id}",[CategorieController::class,'getCategorieByID']);

Route::resource('imageadd', 'Api\ImageController@addimage');
// Show the form to create a new customer



Route::resource('customers', CustomerController::class)->except([
    'create'
]);

Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/predefined_observation/{question}', [Predefined_observationsController::class, 'getobservationsbyQuestion']);
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customer/{id}',[CustomerController::class, 'getCustomerByID']);
Route::get('/customerpage', [CustomerController::class, 'display'])->name('customer.display');
Route::get('/imageshow',[ImagesController::class, 'displayimage']);
// Route::post('/addIma', [ImagesController::class, 'addImage']);
Route::middleware(HandleCors::class)->post('/addIma', [ImagesController::class, 'addImage']);
Route::get('/predefined_observation/{question}', [Predefined_observationsController::class, 'getobservationsbyQuestion']);
Route::put('/reponses/{id}', [ReponseController::class, 'putReponsebyId']);
Route::put('/updatereponse/{question_id}', [ReponseController::class, 'putResponseByQuestionId']);
Route::get('/displayreponse/{question_id}', [ReponseController::class, 'getResponseByQuestionId']);
Route::post('/addImage', [CustomerController::class, 'sstoree'])->name('addImage');
Route::get('/images/{reponse_id}', [ImagesController::class, 'getImagebyReponseId']);
Route::delete('/deletimage/{id}', [ImagesController::class, 'deleteImageById']);
Route::post('/reponses/{question_id}', [ReponseController::class,'createResponseByQuestionId']);
Route::delete('/deletreponse/{id}', [ReponseController::class, 'deleteReponseById']);
Route::post('/send-reclamation-email', [UserController::class, 'sendReclamationEmail']);