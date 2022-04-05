<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\CategorieController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
/*
** authentification
*/
Route::post('/register',[PassportAuthController::class, 'register']);
Route::post('/login',[PassportAuthController::class, 'login']);
Route::get('/whoami',[PassportAuthController::class, 'whoami']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile", [PassportAuthController::class, "profile"]);
});
/*
** offres
*/
//Route::apiResource('offres', OffreController::class)->middleware('auth:api');
Route::post('/ajoutoffre',[OffreController::class, 'ajoutOffre'])->middleware('auth:api');
Route::put('/updateoffre/{id}',[OffreController::class, 'update'])->middleware('auth:api');
Route::get('/offres',[OffreController::class, 'index'])->middleware('auth:api');
Route::get('/offre/{id}',[OffreController::class, 'show'])->middleware('auth:api');
Route::delete('/deleteoffre/{id}',[OffreController::class, 'destroy'])->middleware('auth:api');
/*
** demandes
*/
Route::post('/ajoutdemande/{offre_id}',[DemandeController::class, 'ajoutDemande'])->middleware('auth:api');
Route::get('/demande/{id}',[DemandeController::class, 'show'])->middleware('auth:api');
Route::get('/demandes',[DemandeController::class, 'index'])->middleware('auth:api');
/*
** categories
*/
Route::post('/ajoutcategorie',[CategorieController::class, 'store'])->middleware('auth:api');
Route::get('/categorie/{id}',[CategorieController::class, 'show']);
Route::get('/categories',[CategorieController::class, 'index']);
Route::delete('/deletecategorie{id}',[CategorieController::class, 'destroy'])->middleware('auth:api');