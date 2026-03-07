<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\KaryawanController;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::get('karyawan', [KaryawanController::class , 'index'])->name('karyawan');
    Route::inertia('departemen', 'departemen')->name('departemen');
});

require __DIR__ . '/settings.php';