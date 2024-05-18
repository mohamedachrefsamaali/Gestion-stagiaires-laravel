<?php

use App\Http\Controllers\AffectController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\PersoController;
use App\Http\Controllers\StageSujetController;
use App\Http\Controllers\TachesController;
use App\Models\Evaluation;
use App\Models\Personnel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//for all users
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::controller(PersoController::class)->group(function (){
    //log out
    Route::get('/logout','logoutn')->name('logoutn');
});




//ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/GestionStagiaires', function () {
        return view('acceuil');
    })->name('Gestionstag');

    //RegisterNewAdmin
    Route::get('/RegisterNewAdmin', [PersoController::class, 'RegisterNewAdmin'])->name('RegisterNewAdmin');
    Route::post('/StoreNewAdmin', [PersoController::class, 'storeNewAdmin'])->name('storeAdmin');
    Route::get('/consulterAdmin', [PersoController::class, 'consulterAdmin'])->name('consulterAdmin');
    Route::get('/editAdministrateur/{id}', [PersoController::class, 'editAdministrateur'])->name('editAdministrateur');
    Route::put('/updateAdmin/{id}', [PersoController::class, 'updateAdmin'])->name('updateAdmin');
    Route::delete('/softDeleteAdmin/{id}', [PersoController::class, 'softDeleteAdmin'])->name('softDeleteAdmin');
    Route::get('/archive/restoreAdmin/{id}', [PersoController::class, 'restoreAdmin'])->name('restoreAdmin');
    Route::delete('/users/forcedeleteAdmin/{id}', [PersoController::class, 'forceDeleteAdmin'])->name('forceDeleteAdmin');

    //filtre filtreParEtablissement et sujet
    Route::get('/users/indexS/filtreParEtablissement', [PersoController::class, 'filtreParEtablissement'])->name('filtreParEtablissement');
    Route::get('/users/indexS/filtreParSujet', [PersoController::class, 'filtreParSujet'])->name('filtreParSujet');



    // Routes pour l'archive
    Route::get('/archive/restore/{id}', [PersoController::class, 'restore'])->name('restore');
    Route::get('/archive', [PersoController::class, 'showSoftdeletes'])->name('archive');
    Route::delete('/users/forcedelete/{id}', [PersoController::class, 'forceDelete'])->name('forceDelete');
    Route::get('/users/deleteAllStagiaire', [PersoController::class, 'deleteAllStagiaire'])->name('deleteAllStagiaire');
    Route::get('/users/deleteAllEncadrant', [PersoController::class, 'deleteAllEncadrant'])->name('deleteAllEncadrant');
    Route::get('/users/deleteAll', [PersoController::class, 'deleteAllFromArchive'])->name('deleteAll');

    // Routes pour les stagiaires
    Route::get('/users/createS', [PersoController::class, 'createS'])->name('createS');
    Route::get('/users/indexS', [PersoController::class, 'indexS'])->name('stagiaires');
    Route::post('/users/storeS', [PersoController::class, 'storeS'])->name('storeS');
    Route::get('/users/editS/{id}', [PersoController::class, 'editS'])->name('editStagiaire');
    Route::put('/users/updateS/{id}', [PersoController::class, 'updateS'])->name('updateStagiaire');
    Route::delete('/users/destroyS/{id}', [PersoController::class, 'destroyS'])->name('destroyStagiaire');

    // Routes pour les encadrants
    Route::get('/users/indexE', [PersoController::class, 'indexE'])->name('encadrants');
    Route::post('/users/storeE', [PersoController::class, 'storeE'])->name('storeE');
    Route::get('/users/createE', [PersoController::class, 'createE'])->name('createE');
    Route::get('/users/editE/{id}', [PersoController::class, 'editE'])->name('editEncadrant');
    Route::put('/users/updateE/{id}', [PersoController::class, 'updateE'])->name('updateEncadrant');
    Route::delete('/users/destroyE/{id}', [PersoController::class, 'destroyE'])->name('destroyEncadrant');

    // Routes pour les affectations
    Route::get('/gestion/affecterPage', [AffectController::class, 'affecterPage'])->name('affecterPage');
    Route::get('/gestion/consulter', [AffectController::class, 'consulterPage'])->name('consulterPage');
    Route::get('/gestion/affecterE/{id}', [AffectController::class, 'goAffecter'])->name('goAffecter');
    Route::get('/gestion/affecterEncadrant/{id}', [AffectController::class, 'affecterEncadrant'])->name('affecterEncadrant');

    // Routes pour les sujets de stage
    Route::post('/sujet/create', [StageSujetController::class, 'createSujet'])->name('createSujet');
    Route::get('/sujet/editSujet/{id}', [StageSujetController::class, 'editSujet'])->name('editSujet');
    Route::put('/sujet/updateSujet/{id}', [StageSujetController::class, 'updateSujet'])->name('updateSujet');
    Route::delete('/sujet/destroySujet/{id}', [StageSujetController::class, 'destroySujet'])->name('destroySujet');
    Route::get('/sujet/consulter', [StageSujetController::class, 'getAllSujet'])->name('getAllSujet');
    Route::get('/sujet/ajouterSujetPage', [StageSujetController::class, 'ajouterSujetPage'])->name('ajouterSujetPage');
    Route::get('/sujet/goAffecterSujet/{id}', [StageSujetController::class, 'goAffecterSujet'])->name('goAffecterSujet');
    Route::get('/gestion/AffecterSujet/{id}', [StageSujetController::class, 'AffecterSujet'])->name('affecterSujet');
    Route::get('/gestion/RejeterEncadrant/{id}', [StageSujetController::class, 'RejeterEncadrant'])->name('RejeterEncadrant');
    Route::get('/gestion/RejeterSujet/{id}', [StageSujetController::class, 'RejeterSujet'])->name('RejeterSujet');

    // Routes pour les stages
    Route::get('/gestion/AffecterStage', [StageSujetController::class, 'AffecterStage'])->name('AffecterStage');
    Route::get('/gestion/pasDeStage/AffecterStage/{id}', [StageSujetController::class, 'pasDeStage'])->name('pasDeStage');
    Route::post('/gestion/creerStagePasdeStage', [StageSujetController::class, 'creerStagePasdeStage'])->name('creerStagePasdeStage');
    Route::post('/gestion/creerStage', [StageSujetController::class, 'creerStage'])->name('creerStage');
    Route::get('/gestion/getAllStages', [StageSujetController::class, 'getAllStages'])->name('getAllStages');
    Route::get('/gestion/editStage/{id}', [StageSujetController::class, 'editStage'])->name('editStage');
    Route::put('/sujet/updateStage/{id}', [StageSujetController::class, 'updateStage'])->name('updateStage');
    Route::delete('/sujet/deleteStage/{id}', [StageSujetController::class, 'deleteStage'])->name('deleteStage');
});

//STAGIAIRE
Route::middleware(['auth', 'stagiaire'])->prefix('stagiaire')->group(function () {
    Route::get('/ConsulterTaches', function () {
        $user = auth()->user();
        $stagiaire = Personnel::where('user_id', $user->id)->first();
        $evaluation = Evaluation::where('stagiaire_id', $stagiaire->id)->get();
        return view('taches.EspaceStagiaire', compact('evaluation'));
//        return $evaluation;
    })->name('ConsulterTaches');

    Route::get('/GestionTaches/getAllTaches',[TachesController::class,'getAllTaches'])->name('getAllTaches');
    Route::get('/GestionTaches/tacheTerminer/{id}',[TachesController::class,'tacheTerminer'])->name('tacheTerminer');
    Route::get('/GestionTaches/tacheNonTerminer/{id}',[TachesController::class,'tacheNonTerminer'])->name('tacheNonTerminer');


});

//ENCADRANT
Route::middleware(['auth', 'encadrant'])->prefix('encadrant')->group(function () {
    Route::get('/GestionTaches', function () {
        return view('taches.EspaceEncadrant');
    })->name('GestionTaches');
    // route controller TachesController
    Route::controller(TachesController::class)->group(function (){
        Route::get('/GestionTaches/getAllStagiaires','getAllStagiaires')->name('getAllStagiaires');
    });
    //route tache
    Route::get('/GestionTaches/ajouter/{id}', [TachesController::class, 'ajouterTache'])->name('ajouterTache');
    Route::post('/GestionTaches/storeTache', [TachesController::class, 'storeTache'])->name('storeTache');
    Route::get('/GestionTaches/getTacheDeStag/{id}', [TachesController::class, 'getTacheDeStag'])->name('getTacheDeStag');
    Route::get('/GestionTaches/editTache/{id}', [TachesController::class, 'editTache'])->name('editTache');
    Route::put('/GestionTaches/updateTache/{id}', [TachesController::class, 'updateTache'])->name('updateTache');
    Route::delete('/GestionTaches/deleteTache/{id}', [TachesController::class, 'deleteTache'])->name('deleteTache');
    //Evaluation
    Route::get('/GestionTaches/EvaluationPage/{id}',[EvaluationController::class,'goPageEvaluer'])->name('goPageEvaluer');
    Route::post('/GestionTaches/storeEvaluation',[EvaluationController::class,'storeEvaluation'])->name('storeEvaluation');
    Route::get('/GestionTaches/RejeterEvaluation/{id}',[EvaluationController::class,'RejeterEvaluation'])->name('RejeterEvaluation');



});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
});

