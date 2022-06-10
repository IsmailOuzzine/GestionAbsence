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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/etudiants/', [App\Http\Controllers\EtudiantController::class, 'index']);
Route::get('/etudiants/create', [App\Http\Controllers\EtudiantController::class, 'create']);
Route::post('/etudiants/', [App\Http\Controllers\EtudiantController::class, 'store'])->name('addStudent');
Route::get('/etudiants/{id}/absences', [App\Http\Controllers\EtudiantController::class, 'absences'])
    ->name('etudiants.abs');

Route::get('enseignants/profile', [App\Http\Controllers\EnseignantController::class, 'index'])
    ->name('enseignants.profile');
Route::get('/enseignants/create', [App\Http\Controllers\EnseignantController::class, 'create']);
Route::post('/enseignants/', [App\Http\Controllers\EnseignantController::class, 'store'])->name('addEnseignant');
Route::get('/enseignants/modules/{id}/absences', [App\Http\Controllers\EnseignantController::class, 'absencesModules'])->name('ens.abs');
Route::get('/enseignants/{id}/absences', [App\Http\Controllers\EnseignantController::class, 'absences']);




Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
