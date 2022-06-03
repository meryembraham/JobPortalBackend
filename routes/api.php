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
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ExperienceController;
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
Route::post('/UpdatePassword',[PassportAuthController::class, 'change_password'])->middleware('auth:api');
Route::post('/logout',[PassportAuthController::class, 'logout'])->middleware('auth:api');
Route::get('/whoami',[PassportAuthController::class, 'whoami'])->middleware('auth:api');

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile", [PassportAuthController::class, "profile"]);
    Route::delete('/deleteoffre/{id}',[OffreController::class, 'destroy']);
    Route::post('/updateoffre/{id}',[OffreController::class, 'updateoffre']);
    Route::post('/updateCV/{id}',[CondidatController::class, 'update']);
    Route::get('/demandeCondidat',[DemandeController::class, 'demandeCondidat']);
    Route::get('/demandeOffre',[DemandeController::class, 'demandeOffre']);
    Route::get('/Offredemandes/{id}',[OffreController::class, 'Offredemandes']);
    Route::post('/addEdu',[FormationController::class, 'addEdu']);
    Route::post('/addExp',[ExperienceController::class, 'addExp']);
    Route::put('/block/{id}',[UserController::class, 'block']);
    Route::put('/unblock/{id}',[UserController::class, 'unblock']);
    Route::post('/addDemande/{offre_id}',[DemandeController::class, 'ajoutDemande']);
    Route::put('/closeoffre/{id}',[OffreController::class, 'closeOffre']);
    Route::put('/activeoffre/{id}',[OffreController::class, 'activeOffre']);
});
/*
** offres
*/
//Route::apiResource('offres', OffreController::class)->middleware('auth:api');
/*Route::post('/createOffre',[OffreController::class, 'ajoutOffre'])->middleware('auth:api');
Route::put('/updateoffre/{id}',[OffreController::class, 'update'])->middleware('auth:api');
Route::get('/offres',[OffreController::class, 'index']);
Route::post('/activeOffre/{id}', [OffreController::class, 'activeOffre'])->middleware('auth:api');
Route::post('/deleteOffre/{id}', [OffreController::class, 'destroyOffre'])->middleware('auth:api');
Route::post('/closeJob', [OffreController::class, 'closeJob'])->middleware('auth:api');
Route::get('/offre/{id}',[OffreController::class, 'show']);
Route::delete('/deleteoffre/{id}',[OffreController::class, 'destroy'])->middleware('auth:api');*/
Route::resource('/offres', OffreController::class);

Route::get('/offresWEntreprises',[OffreController::class, 'all']);
Route::post('/addoffre',[OffreController::class, 'ajoutOffre']);
Route::get('/offre/{id}',[OffreController::class, 'show']);
Route::middleware(['auth:sanctum', 'type.entreprise'])->group(function () {
});
/*
** demandes
*/

Route::get('/demande/{id}',[DemandeController::class, 'show'])->middleware('auth:api');
Route::get('/demandes',[DemandeController::class, 'index'])->middleware('auth:api');
Route::put('/acceptcand/{id}', [DemandeController::class, 'accept'])->middleware('auth:api');
Route::put('/rejectcand/{id}', [DemandeController::class, 'reject'])->middleware('auth:api');
Route::get('/demandeEntreprise',[DemandeController::class, 'demandeEntreprise'])->middleware('auth:api');
Route::get('/demandeCondidat',[DemandeController::class, 'demandeCondidat'])->middleware('auth:api');
Route::get('/afficherCondidats',[DemandeController::class, 'afficherCondidats'])->middleware('auth:api');
/*
** categories
*/
/* Route::post('/ajoutcategorie',[CategorieController::class, 'store'])->middleware('auth:api');
Route::get('/categorie/{id}',[CategorieController::class, 'show']);
Route::get('/categories',[CategorieController::class, 'index']);
Route::delete('/deletecategorie/{id}',[CategorieController::class, 'destroy'])->middleware('auth:api'); */
Route::resource('/categories', CategorieController::class);
Route::get('/categorieswithoffre/{id}', [CategorieController::class,'showWithoffre']);
Route::any('/searchO',[OffreController::class, 'search']);
Route::any('/searchC',[CondidatController::class, 'search']);
Route::any('/searchE',[EntrepriseController::class, 'search']);
Route::any('/expC/{id}',[ExperienceController::class, 'expC']);
Route::any('/formC/{id}',[FormationController::class, 'formC']);
Route::any('/expU/{id}',[ExperienceController::class, 'expU']);
Route::any('/formU/{id}',[FormationController::class, 'formU']);
/*
** entreprises
*/

Route::post('/creerentreprise',[EntrepriseController::class, 'store'])->middleware('auth:api');
Route::get('/entreprise/{id}',[EntrepriseController::class, 'show']);
Route::get('/listentreprise',[EntrepriseController::class, 'List']);
Route::get('/entreprises',[EntrepriseController::class, 'index']);
Route::put('/updateEntreprise/{id}',[EntrepriseController::class, 'update'])->middleware('auth:api');
Route::get('/offreEntreprise',[EntrepriseController::class, 'offres'])->middleware('auth:api');
Route::get('/offreEntreprise/{id}',[EntrepriseController::class, 'offresEntreprise']);
Route::delete('/deleteEntreprise{id}',[EntrepriseController::class, 'destroy'])->middleware('auth:api');
/*
** condidats
*/
Route::post('/creerCondidat',[CondidatController::class, 'store'])->middleware('auth:api');
Route::get('/condidat/{id}',[CondidatController::class, 'show']);
Route::get('/condidats',[CondidatController::class, 'index']);
Route::get('/appliedjobs',[CondidatController::class, 'appliedJobs'])->middleware('auth:api');
Route::put('/updateCondidat/{id}',[CondidatController::class, 'update'])->middleware('auth:api');
Route::put('/updateEN/{id}',[EntrepriseController::class, 'update'])->middleware('auth:api');
Route::delete('/deleteCondidat{id}',[CondidatController::class, 'destroy'])->middleware('auth:api');
Route::get('/candidatdata/{id}',[UserController::class, 'candidat']);
Route::get('/entreprisedata/{id}',[UserController::class, 'entreprise']);
/*
** users
*/
Route::post('/ajoutUser',[UserController::class, 'store'])->middleware('auth:api');
Route::get('/user/{id}',[UserController::class, 'show']);
Route::get('/users',[UserController::class, 'index'])->middleware('auth:api');
Route::put('/updateUser/{id}',[UserController::class, 'update'])->middleware('auth:api');
Route::delete('/deleteUser/{id}',[UserController::class, 'destroy'])->middleware('auth:api');
/*
** documents
*/
//CV
Route::post('/ajoutCv',[DocumentController::class, 'ajoutCv'])->middleware('auth:api');
Route::post('/upload',[DocumentController::class, 'uploadPDF'])->middleware('auth:api');
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
Route::post('/sendMessage',[MessageController::class, 'sendMessage'])->middleware('auth:api');
Route::delete('/deleteMessage/{id}',[MessageController::class, 'destroy'])->middleware('auth:api');
//regions
Route::resource('/regions', RegionController::class);
//secteurs
Route::get('/secteurs8',[SecteurController::class,'index']);
Route::get('/users5',[UserController::class,'users']);
Route::get('/secteurs', [SecteurController::class,'all']);
Route::get('/secteur/{id}', [SecteurController::class,'SecteurWithOffre']);