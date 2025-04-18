<?php

use App\Http\Controllers\BankAccount\CreateBankAccountController;
use App\Http\Controllers\BankAccount\UpdateBankAccountController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => redirect()->route('dashboard'))->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('clientes', function () {
    return Inertia::render('Clientes/Index', [
        'clientsList' => Client::get(),
    ]);
})->middleware(['auth', 'verified'])->name('clientes.index');

Route::prefix('dados-bancarios')->name('dados-bancarios.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('DadosBancarios/Index');
    })->middleware(['auth', 'verified'])->name('index');

    Route::post('/', CreateBankAccountController::class)
        ->middleware(['auth', 'verified'])
        ->name('store');

    Route::put('/{bankAccount}', UpdateBankAccountController::class)
        ->middleware(['auth', 'verified'])
        ->name('update');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
