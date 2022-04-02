<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DemandeController;
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
Route::apiResource('offres', OffreController::class)->middleware('auth:api');
Route::post('/ajoutoffre',[OffreController::class, 'ajoutOffre']);
Route::put('/updateoffre{id}',[OffreController::class, 'update']);
Route::get('/offres',[OffreController::class, 'index']);
Route::get('/offre{id}',[OffreController::class, 'show']);
Route::delete('/deleteoffre{id}',[OffreController::class, 'destroy']);
/*
** demandes
*/
Route::post('/ajoutdemande',[DemandeController::class, 'ajoutDemande']);
Route::get('/demande{id}',[DemandeController::class, 'show']);
Route::get('/demandes',[DemandeController::class, 'index']);