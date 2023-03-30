<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/leads', [ContactController::class, 'leads'])->name('leads');
Route::get('/prospects', [ContactController::class, 'prospects'])->name('prospects');
Route::get('/clients', [ContactController::class, 'clients'])->name('clients');

Route::get('/gestionUsers', function () {
    return view('gestionUsers');
})->name('gestionUsers');

// Add the resource routes for the ContactController except for the index method
Route::resource('contacts', ContactController::class)->except(['index']);
