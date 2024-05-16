<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);



Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::group(['middleware' => ['is_admin']], function() {
        Route::resource('jabatan', App\Http\Controllers\Admin\JabatanController::class);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('potongan-gaji', App\Http\Controllers\Admin\PotonganGajiController::class);
        Route::get('absensis', [App\Http\Controllers\Admin\AbsensiController::class, 'index'])->name('absensis.index');
        Route::get('absensis/kehadiran', [App\Http\Controllers\Admin\AbsensiController::class, 'show'])->name('absensis.show');
        Route::post('absensis/kehadiran', [App\Http\Controllers\Admin\AbsensiController::class, 'store'])->name('absensis.store');
        
        Route::get('loadCuti', [App\Http\Controllers\Admin\AbsensiController::class, 'loadCuti'])->name('absensis.loadCuti');
        Route::post('absensis/terimaCuti', [App\Http\Controllers\Admin\AbsensiController::class, 'terimaCuti'])->name('absensis.terimaCuti');
        Route::post('absensis/batalCuti', [App\Http\Controllers\Admin\AbsensiController::class, 'batalCuti'])->name('absensis.batalCuti');
       
       Route::get('infogaji', [App\Http\Controllers\Admin\InfoGajiController::class, 'index'])->name('infogaji.index');
        Route::get('infogaji/cetak/{bulan}/{tahun}', [App\Http\Controllers\Admin\InfoGajiController::class, 'cetak'])->name('infogaji.cetak');
        
        Route::get('laporan/slip-gaji', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
        Route::post('laporan/slip-gaji', [App\Http\Controllers\Admin\LaporanController::class, 'store'])->name('laporan.store');
    });
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::get('laporan/slip-gaji/karyawan', [App\Http\Controllers\Admin\LaporanController::class, 'show'])->name('laporan.show');
    Route::post('laporan/slip-gaji/karyawan', [App\Http\Controllers\Admin\LaporanController::class, 'cekGaji'])->name('laporan.karyawan');
    
    Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('karyawan', [App\Http\Controllers\Karyawan\AbsensiController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/kehadiran', [App\Http\Controllers\Karyawan\AbsensiController::class, 'show'])->name('karyawan.show');
    Route::post('karyawan/kehadiran', [App\Http\Controllers\Karyawan\AbsensiController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/cuti', [App\Http\Controllers\Karyawan\AbsensiController::class, 'cuti'])->name('karyawan.cuti');
    Route::post('karyawan/prosescuti', [App\Http\Controllers\Karyawan\AbsensiController::class, 'prosescuti'])->name('karyawan.prosescuti');

    Route::get('gaji', [App\Http\Controllers\Karyawan\GajiKaryawanController::class, 'index'])->name('gajikaryawan.index');
    Route::get('gaji/cetak/{bulan}/{tahun}', [App\Http\Controllers\Karyawan\GajiKaryawanController::class, 'cetak'])->name('gajikaryawan.cetak');

});
