<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasiController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\PenginapanController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GaleriController as PublicGaleriController;
use App\Http\Controllers\GeositeController;
use App\Http\Controllers\InformasiController as PublicInformasiController;
use App\Http\Controllers\KontakController;

Route::get('/', [DestinasiController::class, 'indexX'])->name('home');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi');
Route::get('/destinasi/alam', [DestinasiController::class, 'alam'])->name('destinasi.alam');
Route::get('/destinasi/buatan', [DestinasiController::class, 'buatan'])->name('destinasi.buatan');
Route::get('/destinasi/budaya', [DestinasiController::class, 'budaya'])->name('destinasi.budaya');
Route::get('/destinasi/{slug}', [DestinasiController::class, 'detail'])->name('destinasi.detail');

Route::get('/informasi', [PublicInformasiController::class, 'index'])->name('informasi');

Route::get('/galeri', [PublicGaleriController::class, 'index'])->name('galeri');
Route::get('/galeri/{id}', [PublicGaleriController::class, 'show'])->name('galeri.detail');

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.detail');

Route::get('/umkm', [HomeController::class, 'umkm'])->name('umkm');
Route::get('/budaya', [HomeController::class, 'budaya'])->name('budaya');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');

Route::get('/tuktuk', [GeositeController::class, 'tuktuk'])->name('geosite.tuktuk');
Route::get('/ambarita', [GeositeController::class, 'ambarita'])->name('geosite.ambarita');
Route::get('/tomok', [GeositeController::class, 'tomok'])->name('geosite.tomok');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.send-otp');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('password.verify-otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('password.reset-form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('galeri', GaleriController::class)->names('admin.galeri');
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    Route::resource('informasi', InformasiController::class)->names('admin.informasi');
    Route::resource('destinasi', AdminDestinasiController::class)->names('admin.destinasi');
    Route::resource('umkm', UmkmController::class)->names('admin.umkm');
    Route::resource('penginapan', PenginapanController::class)->names('admin.penginapan');
    Route::resource('fasilitas', FasilitasController::class)->names('admin.fasilitas');
    Route::resource('sejarah', SejarahController::class)->names('admin.sejarah');

    Route::post('galeri/toggle-status/{id}', [GaleriController::class, 'toggleStatus'])->name('admin.galeri.toggle-status');
    Route::post('berita/toggle-status/{id}', [BeritaController::class, 'toggleStatus'])->name('admin.berita.toggle-status');
    Route::post('informasi/toggle-status/{id}', [InformasiController::class, 'toggleStatus'])->name('admin.informasi.toggle-status');
    Route::post('destinasi/toggle-status/{id}', [AdminDestinasiController::class, 'toggleStatus'])->name('admin.destinasi.toggle-status');
    Route::post('umkm/toggle-status/{id}', [UmkmController::class, 'toggleStatus'])->name('admin.umkm.toggle-status');
    Route::post('penginapan/toggle-status/{id}', [PenginapanController::class, 'toggleStatus'])->name('admin.penginapan.toggle-status');
    Route::post('fasilitas/toggle-status/{id}', [FasilitasController::class, 'toggleStatus'])->name('admin.fasilitas.toggle-status');
    Route::post('sejarah/toggle-status/{id}', [SejarahController::class, 'toggleStatus'])->name('admin.sejarah.toggle-status');
});