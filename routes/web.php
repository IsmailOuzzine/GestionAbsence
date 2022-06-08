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

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
