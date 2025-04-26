<?php

use App\Http\Controllers\BankAccount\CreateBankAccountController;
use App\Http\Controllers\BankAccount\UpdateBankAccountController;
use App\Http\Controllers\Client\Charges\ListClientChargesController;
use App\Http\Controllers\Client\CreateClientController;
use App\Http\Controllers\Client\EditClientController;
use App\Http\Controllers\Client\IndexClientController;
use App\Http\Controllers\Client\StoreClientController;
use App\Http\Controllers\Client\UpdateClientController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => redirect()->route('dashboard'))->name('home');

Route::middleware(['auth', 'verified'])->get('dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('clientes')->name('clients.')->group(function () {
    Route::get('/', IndexClientController::class)->name('index');
    Route::get('/create', CreateClientController::class)->name('create');
    Route::get('{client}', EditClientController::class)->name('edit');
    Route::post('/', StoreClientController::class)->name('store');
    Route::put('/{client}', UpdateClientController::class)->name('update');

    Route::get('{client}/charges', ListClientChargesController::class)->name('charges');
});

Route::middleware(['auth', 'verified'])->prefix('dados-bancarios')->name('dados-bancarios.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('DadosBancarios/Index');
    })->name('index');

    Route::post('/', CreateBankAccountController::class)->name('store');
    Route::put('/{bankAccount}', UpdateBankAccountController::class)->name('update');

});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
