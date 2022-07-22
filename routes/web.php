<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\Home@index')->name('index');

// COMPLETION COMPTE
Route::resource('/Completion_compte', 'App\Http\Controllers\Completer_compte')->middleware(['auth']);

// PROFIL
Route::resource('/Profil', 'App\Http\Controllers\Profil')->middleware(['auth']);

// MOT DE PASSE
Route::resource('/Mot_de_passe', 'App\Http\Controllers\Mot_de_passe')->middleware(['auth']);

// 404
Route::get('/Erreur/404', 'App\Http\Controllers\Erreur@erreur_404')->name('404');

// AGENTS
Route::resource('/Agents', 'App\Http\Controllers\Users')->middleware(['auth']);

// VALIDATION AGENT
Route::post('/Validation_agent', 'App\Http\Controllers\Valider_agent@validation_agent')->middleware(['auth'])->name('valider_agent');

//ARTICLES
Route::resource('/Articles', 'App\Http\Controllers\Article');

// PANIER
Route::resource('/Panier', 'App\Http\Controllers\Panier')->middleware(['auth']);

// LIVRAISON
Route::resource('/Livraison', 'App\Http\Controllers\Livraison')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
