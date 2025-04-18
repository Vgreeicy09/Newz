<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


// Route de la page d'accueil (affiche les derniers articles)
Route::get('/', [ArticleController::class, 'index'])->name('home');


// Gestion des articles (CRUD avec Resource Controller)
Route::resource('articles', ArticleController::class)->except(['create', 'store']);

// Routes spécifiques pour l'administration
Route::get('/admin', [ArticleController::class, 'create'])->name('articles.create'); // Formulaire d'ajout
Route::post('/admin', [ArticleController::class, 'store'])->name('articles.store');  // Enregistrer un article

Route::get('/international', [ArticleController::class, 'international'])->name('articles.international');
Route::get('/politique', [ArticleController::class, 'politique'])->name('articles.politique');
Route::get('/economie', [ArticleController::class, 'economie'])->name('articles.economie');
Route::get('/culture', [ArticleController::class, 'culture'])->name('articles.culture');
Route::get('/sports', [ArticleController::class, 'sports'])->name('articles.sports');
Route::get('/divers', [ArticleController::class, 'divers'])->name('articles.divers');


