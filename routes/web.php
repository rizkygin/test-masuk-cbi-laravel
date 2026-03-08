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
    Route::get('karyawan/{id}', [KaryawanController::class , 'show'])->name('karyawan.show');
    Route::put('karyawan/{id}', [KaryawanController::class , 'update'])->name('karyawan.update');
    Route::delete('karyawan/{id}', [KaryawanController::class , 'destroy'])->name('karyawan.destroy');
    Route::inertia('departemen', 'departemen')->name('departemen');
});

require __DIR__ . '/settings.php';