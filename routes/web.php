<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LigneCommandeController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// 🚀 Espace Admin (Accueil)

// 🚀 🚀 Partie Admin protégée par Middleware "admin"
Route::middleware(['admin'])->group(function () {
    Route::get('/', [AuthController::class, 'home'])->name('home');
    

// 🔹 Ressources (Admin seulement)
    Route::resource('clients', ClientController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('lignecommandes', LigneCommandeController::class);
    // 🔹 Recherche
    Route::get('/recherche/commandes-par-client', [RechercheController::class, 'rechercheParClient'])->name('recherche.commandes.client');
    Route::post('/recherche/commandes-par-client', [RechercheController::class, 'afficherCommandesClient'])->name('recherche.commandes.client.result');

    Route::get('/recherche/periode-etat', [RechercheController::class, 'rechercheParPeriodeEtat'])->name('recherche.periode.etat');
    Route::post('/recherche/periode-etat', [RechercheController::class, 'resultatParPeriodeEtat'])->name('recherche.periode.etat.result');

    Route::get('/recherche/statistiques-produit', [RechercheController::class, 'statistiquesParProduit'])->name('recherche.produit.statistiques');
        
    // 🚀 Page Profil (Vue pour l'admin)
    Route::get('/profile', [ProfileController::class , 'index'])->name('profile');

    Route::get('/profile/edit',[ProfileController::class , 'edit'])->name('profile.edit');
    
    Route::put('/profile/admin/update',[ProfileController::class , 'update'])->name('admin.profile.update');

    Route::get('/profile/changePassword',[ProfileController::class , 'password'])->name('admin.profile.password');

    Route::put('/profile/changePassword',[ProfileController::class , 'updatePassword'])->name('admin.password.change');
    
    // Route::resource('profile', RechercheController::class);

    // Explorer
    Route::get('/explorer', function(){
        return view('admin.explorer');
    })->name('explorer');

});
// 🚀 Espace Client

Route::middleware(['user'])->group(function () {
    Route::get('/user',[UserController::class,'index'])
        ->name('menu');
    Route::get('/explore',[UserController::class,'explorer'])
        ->name('explore');
    
    // 🚀 Page Profil (Vue pour l'admin)
    Route::get('/user/profile', [UserController::class , 'profile'])->name('user.profile');

    Route::get('/user/profile/edit',[UserController::class , 'edit'])->name('user.profile.edit');
    
    Route::put('/user/profile/update',[UserController::class , 'update'])->name('user.profile.update');

    Route::get('/user/profile/change-password',[UserController::class , 'password'])->name('user.profile.passwordChange');

    // update password
    Route::put('/user/password/update', [UserController::class, 'updatePassword'])->name('profile.passwordUpdate');
});