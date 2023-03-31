<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

Route::get('/', [DashboardController::class, 'dashboard'])->name('home')->middleware('auth');

Route::get('contact/leads', [ContactController::class, 'leads'])->name('contact.leads');
Route::get('contact/prospects', [ContactController::class, 'prospects'])->name('contact.prospects');
Route::get('contact/clients', [ContactController::class, 'clients'])->name('contact.clients');

Route::middleware('admin')->group(function () {
    Route::resource('users', UserController::class);
});

// web.php
Route::resource('contact.contacts', ContactController::class)->except(['contact.index']);
Route::get('contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/clients-by-month', function () {
    $currentYear = Carbon::now()->year;
    $clientsByMonth = DB::table('contacts')
        ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as count'))
        ->where('status', 'client')
        ->whereYear('created_at', '=', $currentYear)
        ->groupBy(DB::raw('strftime("%m", created_at)'))
        ->get();

    $leadsByMonth = DB::table('contacts')
        ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as count'))
        ->where('status', 'lead')
        ->whereYear('created_at', '=', $currentYear)
        ->groupBy(DB::raw('strftime("%m", created_at)'))
        ->get();

    $prospectsByMonth = DB::table('contacts')
        ->select(DB::raw('strftime("%m", created_at) as month'), DB::raw('COUNT(*) as count'))
        ->where('status', 'prospect')
        ->whereYear('created_at', '=', $currentYear)
        ->groupBy(DB::raw('strftime("%m", created_at)'))
        ->get();

    return response()->json([
        'clients' => $clientsByMonth,
        'leads' => $leadsByMonth,
        'prospects' => $prospectsByMonth
    ]);
})->name('clients-by-month');

Route::resource('actions', ActionController::class);

Route::fallback(function () {
    return redirect('/');
});
