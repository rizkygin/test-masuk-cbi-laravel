<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;

use Illuminate\Http\Request;


Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home')->middleware('auth:sanctum');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class , 'index'])->name('dashboard');
    Route::get('karyawan', [KaryawanController::class , 'index'])->name('karyawan');
    Route::get('karyawan/{karyawan}/show', [KaryawanController::class , 'show'])->name('karyawan.show');
    Route::put('karyawan/{karyawan}/show', [KaryawanController::class , 'update'])->name('karyawan.update');
    Route::delete('karyawan/{id}/destroy', [KaryawanController::class , 'destroy'])->name('karyawan.destroy');
    Route::get('karyawan/create', [KaryawanController::class , 'create'])->name('karyawan.create');
    Route::post('karyawan/create', [KaryawanController::class , 'store'])->name('karyawan.store');
    Route::inertia('departemen', 'departemen')->name('departemen');

    Route::get('kelolaDepartemen', [DepartemenController::class , 'index'])->name('kelolaDepartemen');
    Route::get('departemen/{departemen}/show', [DepartemenController::class , 'show'])->name('departemen.show');
    Route::put('departemen/{departemen}/show', [DepartemenController::class , 'update'])->name('departemen.update');
    Route::delete('departemen/{id}/destroy', [DepartemenController::class , 'destroy'])->name('departemen.destroy');
    Route::get('departemen/create', [DepartemenController::class , 'create'])->name('departemen.create');
    Route::post('departemen/create', [DepartemenController::class , 'store'])->name('departemen.store');

    Route::get('kelolaJabatan', [JabatanController::class , 'index'])->name('kelolaJabatan');
    Route::get('jabatan/{jabatan}/show', [JabatanController::class , 'show'])->name('jabatan.show');
    Route::put('jabatan/{jabatan}/show', [JabatanController::class , 'update'])->name('jabatan.update');
    Route::delete('jabatan/{id}/destroy', [JabatanController::class , 'destroy'])->name('jabatan.destroy');
    Route::get('jabatan/create', [JabatanController::class , 'create'])->name('jabatan.create');
    Route::post('jabatan/create', [JabatanController::class , 'store'])->name('jabatan.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('rekapAbsen', [AbsenController::class , 'index'])->name('rekapAbsen');

    Route::get('absenPagi', [AbsenController::class , 'absenPagi'])->name('absenPagi');
    Route::get('absenPulang', [AbsenController::class , 'absenPulang'])->name('absenPulang');
    Route::post('absenPagi', [AbsenController::class , 'absenPagiStore'])->name('absenPagiStore');
    Route::post('absenPulang', [AbsenController::class , 'absenPulangStore'])->name('absenPulangStore');


    Route::get('kelolaIzin', [IzinController::class , 'index'])->name('kelolaIzin');
    Route::get('izinTidakMasuk', [IzinController::class , 'create'])->name('izinTidakMasukCreate');
    Route::post('izinTidakMasuk', [IzinController::class , 'store'])->name('izinTidakMasukStore');
    Route::post('izinTidakMasuk/{izin}/update/', [IzinController::class , 'update'])->name('izinTidakMasukUpdate');

})->middleware('employee_reguler');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
})->name('requestToken');



require __DIR__ . '/settings.php';