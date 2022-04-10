<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CondidatController;
use App\Http\Controllers\MessageController;
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
Route::post('/activeOffre/{id}', [OffreController::class, 'activeOffre'])->middleware('auth:api');
Route::post('/deleteOffre/{id}', [OffreController::class, 'destroyOffre'])->middleware('auth:api');
Route::post('/closeJob', [OffreController::class, 'closeJob'])->middleware('auth:api');
Route::get('/offre/{id}',[OffreController::class, 'show'])->middleware('auth:api');
Route::delete('/deleteoffre/{id}',[OffreController::class, 'destroy'])->middleware('auth:api');
/*
** demandes
*/
Route::post('/ajoutdemande/{offre_id}',[DemandeController::class, 'ajoutDemande'])->middleware('auth:api');
Route::get('/demande/{id}',[DemandeController::class, 'show'])->middleware('auth:api');
Route::get('/demandes',[DemandeController::class, 'index'])->middleware('auth:api');
Route::post('/acceptDemande', [DemandeController::class, 'accept'])->middleware('auth:api');
Route::post('/rejectDemande', [DemandeController::class, 'reject'])->middleware('auth:api');
Route::get('/demandeEntreprise',[DemandeController::class, 'demandeEntreprise'])->middleware('auth:api');
Route::get('/afficherCondidats',[DemandeController::class, 'afficherCondidats'])->middleware('auth:api');
/*
** categories
*/
Route::post('/ajoutcategorie',[CategorieController::class, 'store'])->middleware('auth:api');
Route::get('/categorie/{id}',[CategorieController::class, 'show']);
Route::get('/categories',[CategorieController::class, 'index']);
Route::delete('/deletecategorie/{id}',[CategorieController::class, 'destroy'])->middleware('auth:api');
/*
** entreprises
*/
Route::post('/creerentreprise',[EntrepriseController::class, 'store'])->middleware('auth:api');
Route::get('/entreprise/{id}',[EntrepriseController::class, 'show']);
Route::get('/entreprises',[EntrepriseController::class, 'index']);


Route::put('/updateEntreprise/{id}',[EntrepriseController::class, 'update'])->middleware('auth:api');
Route::get('/offreEntreprise/{id}',[EntrepriseController::class, 'offres']);
Route::delete('/deleteEntreprise{id}',[EntrepriseController::class, 'destroy'])->middleware('auth:api');
/*
** condidats
*/
Route::post('/creerCondidat',[CondidatController::class, 'store'])->middleware('auth:api');
Route::get('/condidat/{id}',[CondidatController::class, 'show']);
Route::get('/condidats',[CondidatController::class, 'index']);
Route::get('/applied-jobs',[CondidatController::class, 'appliedJobs']);
Route::put('/updateCondidat/{id}',[CondidatController::class, 'update'])->middleware('auth:api');
Route::delete('/deleteCondidat{id}',[CondidatController::class, 'destroy'])->middleware('auth:api');
/*
** users
*/
Route::post('/ajoutUser',[UserController::class, 'store'])->middleware('auth:api');
Route::get('/user/{id}',[UserController::class, 'show']);
Route::get('/users',[UserController::class, 'index']);
Route::put('/updateUser/{id}',[UserController::class, 'update'])->middleware('auth:api');
Route::delete('/deleteUser/{id}',[UserController::class, 'destroy'])->middleware('auth:api');
/*
** documents
*/
//CV
Route::post('/ajoutCv',[DocumentController::class, 'ajoutCv'])->middleware('auth:api');
Route::put('/updateCv',[DocumentController::class, 'updateCv'])->middleware('auth:api');
Route::get('/showCv/{condidat_id}',[DocumentController::class, 'showCv'])->middleware('auth:api');
//cover_letter
Route::post('/ajoutCoverletter',[DocumentController::class, 'ajoutCoverletter'])->middleware('auth:api');
Route::put('/updateCoverletter',[DocumentController::class, 'updateCoverletter'])->middleware('auth:api');
Route::get('/showCover/{condidat_id}',[DocumentController::class, 'showCover'])->middleware('auth:api');
//documents by owner
Route::get('/documents/{condidat_id}',[DocumentController::class, 'showByOwner'])->middleware('auth:api');
//documents by id
Route::get('/document/{id}',[DocumentController::class, 'show'])->middleware('auth:api');
Route::delete('/deleteDocument/{id}',[DocumentController::class, 'destroy'])->middleware('auth:api');
//messages
Route::post('/sendMessage',[MessageController::class, 'snedMessage'])->middleware('auth:api');
Route::delete('/deleteMessage/{id}',[MessageController::class, 'destroy'])->middleware('auth:api');