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

Route::get('contact/leads', [ContactController::class, 'leads'])->name('contact.leads');
Route::get('contact/prospects', [ContactController::class, 'prospects'])->name('contact.prospects');
Route::get('contact/clients', [ContactController::class, 'clients'])->name('contact.clients');

Route::get('/gestionUsers', function () {
    return view('gestionUsers');
})->name('gestionUsers');

// web.php
Route::resource('contact.contacts', ContactController::class)->except(['contact.index']);
Route::get('contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



