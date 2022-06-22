<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BureauController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\GestionUsersController;
use App\Http\Controllers\InventaireController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\PatrimoineController;
use App\Http\Controllers\RetourController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::resource('commande', CommandeController::class)->only('index');
    Route::resource('article', ArticleController::class)->only('index');
    Route::resource('type_article', TypeController::class)->only('index');
    Route::resource('marque_article', MarqueController::class)->only('index');
    Route::resource('fournisseur', FournisseurController::class)->only('index');
    Route::resource('livraison', LivraisonController::class)->only('index');
    Route::resource('stock', StockController::class)->only('index');
    Route::resource('inventaire', InventaireController::class)->only('index');
    Route::resource('demande', DemandeController::class)->only('index');
    Route::resource('sortie', SortieController::class)->only('index');
    Route::resource('site', SiteController::class)->only('index');
    Route::resource('bureau', BureauController::class)->only('index');
    Route::resource('patrimoine', PatrimoineController::class)->only('index');
    Route::resource('retour', RetourController::class)->only('index');
    Route::resource('mouvement', MouvementController::class)->only('index');

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('dashboard', [GestionUsersController::class, 'dashboard'])->name('dashboard');
        Route::get('show_user/{id}', [GestionUsersController::class, 'show'])->name('user.show');
        Route::post('attribution_role', [GestionUsersController::class, 'attributionRole'])->name('user.role_att');
        Route::post('modification_role', [GestionUsersController::class, 'modificationRole'])->name('user.role_modif');
    });

    Route::middleware('responsable')->group(function (){
        Route::post('commande/validation', [CommandeController::class, 'validation'])->name('commande.validation');
        Route::post('livraison/validation', [LivraisonController::class, 'validation'])->name('livraison.validation');
        Route::post('demande/validation', [DemandeController::class, 'validation'])->name('demande.validation');
    });

    Route::middleware('agent_responsable')->group(function () {
        Route::resource('commande', CommandeController::class)->except('index');
        Route::resource('article', ArticleController::class)->except('index');
        Route::resource('type_article', TypeController::class)->except('index');
        Route::resource('marque_article', MarqueController::class)->except('index');
        Route::resource('fournisseur', FournisseurController::class)->except('index');
        Route::resource('livraison', LivraisonController::class)->except('index');
        Route::resource('stock', StockController::class)->except('index');
        Route::resource('inventaire', InventaireController::class)->except('index');
        Route::resource('demande', DemandeController::class)->except('index');
        Route::resource('sortie', SortieController::class)->except('index');
        Route::resource('site', SiteController::class)->except('index');
        Route::resource('bureau', BureauController::class)->except('index');
        Route::resource('patrimoine', PatrimoineController::class)->except('index');
        Route::resource('retour', RetourController::class)->except('index');
        Route::resource('mouvement', MouvementController::class)->except('index');
    });
});
