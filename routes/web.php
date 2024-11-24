<?php

use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/roles', [RolesController::class, 'getAll'])->name('roles');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/contribuyentes', [ContribuyenteController::class, 'getAll'])->name('contribuyentes.get');
    Route::post('/contribuyentes', [ContribuyenteController::class, 'store'])->name('contribuyentes.store');
    Route::put('/contribuyentes/{id}', [ContribuyenteController::class, 'update'])->name('contribuyentes.update');
    Route::delete('/contribuyentes/{id}', [ContribuyenteController::class, 'delete'])->name('contribuyentes.delete');
    Route::post('/check-documento', [ContribuyenteController::class, 'checkDocumentoExistence'])->name('contribuyentes.documento');
});

require __DIR__ . '/auth.php';
