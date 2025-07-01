<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('houses', function () {
    return Inertia::render('Houses');
})->middleware(['auth', 'verified'])->name('houses.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/api.php';
