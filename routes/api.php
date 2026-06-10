<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\FilieresController;
use App\Http\Controllers\MatieresController;
use App\Http\Controllers\AnneeAcademiquesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AffectationsProfController;
use App\Http\Controllers\PaiementsController;
use App\Http\Controllers\ReclamationsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\BulletinsController;

// Route publique
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/devices', [DevicesController::class, 'store']);
    Route::delete('/devices', [DevicesController::class, 'destroy']);

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Utilisateurs
        Route::get('/utilisateurs', [UtilisateurController::class, 'index']);
        Route::post('/utilisateurs', [UtilisateurController::class, 'store']);
        Route::get('/utilisateurs/{id}', [UtilisateurController::class, 'show']);
        Route::put('/utilisateurs/{id}', [UtilisateurController::class, 'update']);
        Route::delete('/utilisateurs/{id}', [UtilisateurController::class, 'destroy']);

        // Filières
        Route::get('/filieres', [FilieresController::class, 'index']);
        Route::post('/filieres', [FilieresController::class, 'store']);
        Route::put('/filieres/{id}', [FilieresController::class, 'update']);
        Route::delete('/filieres/{id}', [FilieresController::class, 'destroy']);

        // Matières
        Route::get('/matieres', [MatieresController::class, 'index']);
        Route::post('/matieres', [MatieresController::class, 'store']);
        Route::put('/matieres/{id}', [MatieresController::class, 'update']);
        Route::delete('/matieres/{id}', [MatieresController::class, 'destroy']);

        // Années académiques
        Route::get('/annees', [AnneeAcademiquesController::class, 'index']);
        Route::post('/annees', [AnneeAcademiquesController::class, 'store']);
        Route::delete('/annees/{id}', [AnneeAcademiquesController::class, 'destroy']);

        // Classes
        Route::get('/classes', [ClassesController::class, 'index']);
        Route::post('/classes', [ClassesController::class, 'store']);
        Route::put('/classes/{id}', [ClassesController::class, 'update']);
        Route::delete('/classes/{id}', [ClassesController::class, 'destroy']);

        // Inscriptions
        Route::get('/inscriptions', [InscriptionController::class, 'index']);
        Route::post('/inscriptions', [InscriptionController::class, 'store']);
        Route::delete('/inscriptions/{id}', [InscriptionController::class, 'destroy']);

        // Affectations profs
        Route::get('/affectations', [AffectationsProfController::class, 'index']);
        Route::post('/affectations', [AffectationsProfController::class, 'store']);
        Route::delete('/affectations/{id}', [AffectationsProfController::class, 'destroy']);

        // Paiements
        Route::get('/paiements', [PaiementsController::class, 'index']);
        Route::post('/paiements', [PaiementsController::class, 'store']);
        Route::put('/paiements/{id}/status', [PaiementsController::class, 'updateStatus']);
        Route::delete('/paiements/{id}', [PaiementsController::class, 'destroy']);

        // Réclamations
        Route::get('/reclamations', [ReclamationsController::class, 'index']);
        Route::post('/reclamations/{id}/repondre', [ReclamationsController::class, 'repondre']);
        Route::delete('/reclamations/{id}', [ReclamationsController::class, 'destroy']);

        // Bulletins
        Route::get('/bulletins', [BulletinsController::class, 'index']);
        Route::post('/bulletins/generer', [BulletinsController::class, 'generer']);
        Route::put('/bulletins/{id}/publier', [BulletinsController::class, 'publier']);
        Route::delete('/bulletins/{id}', [BulletinsController::class, 'destroy']);

        // Notifications
        Route::post('/notifications', [NotificationsController::class, 'store']);
    });

    // ENSEIGNANT
    Route::middleware('role:enseignant')->prefix('enseignant')->group(function () {
        Route::get('/affectations', [AffectationsProfController::class, 'index']);
        Route::get('/notes/{matieres_id}', [NotesController::class, 'parMatiere']);
        Route::post('/notes', [NotesController::class, 'store']);
        Route::put('/notes/{id}', [NotesController::class, 'update']);
        Route::delete('/notes/{id}', [NotesController::class, 'destroy']);
    });

    // ETUDIANT
    Route::middleware('role:etudiant')->prefix('etudiant')->group(function () {
        Route::get('/notes', [NotesController::class, 'parEtudiant', ]);
        Route::get('/bulletins', [BulletinsController::class, 'parEtudiant']);
        Route::get('/bulletins/{id}/telecharger', [BulletinsController::class, 'telecharger']);
        Route::get('/paiements', [PaiementsController::class, 'parEtudiant']);
        Route::get('/reclamations', [ReclamationsController::class, 'parEtudiant']);
        Route::post('/reclamations', [ReclamationsController::class, 'store']);
    });

    // COMMUN (tous les roles)
    Route::get('/notifications', [NotificationsController::class, 'mesNotifications']);
    Route::put('/notifications/{id}/lu', [NotificationsController::class, 'marquerLu']);
});