<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('clientes', function () {
    return Inertia::render('Clientes/Index');
})->middleware(['auth', 'verified'])->name('clientes.index');

Route::get('dados-bancarios', function () {
    return Inertia::render('DadosBancarios/Index');
})->middleware(['auth', 'verified'])->name('dados-bancarios.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
