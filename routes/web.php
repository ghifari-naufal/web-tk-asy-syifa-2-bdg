<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminResetPwController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DaftarUlangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\MonitoringPerkembanganController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');


Route::get('tentang/sejarah', function () {
    return view('slicing-page.tentang-page.sejarah');
})->name('tentang.sejarah');

Route::get('tentang/visimisi', function () {
    return view('slicing-page.tentang-page.visimisi');
})->name('tentang.visimisi');

Route::get('informasi/kegiatan', function () {
    return view('slicing-page.informasi-page.kegiatan');
})->name('informasi.kegiatan');

Route::get('informasi/ppdb', function () {
    return view('slicing-page.informasi-page.ppdb');
})->name('informasi.ppdb');

Route::get('informasi/kalender', function () {
    return view('slicing-page.informasi-page.kalender');
})->name('informasi.kalender');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');

// Pendaftaran Routes dengan File Support
Route::resource('pendaftaran', PendaftaranController::class);

// Routes untuk dokumen persyaratan
Route::get('/pendaftaran/{id}/download-dokumen-persyaratan', [PendaftaranController::class, 'downloadDokumenPersyaratan'])
    ->name('pendaftaran.download-dokumen-persyaratan');
    
Route::get('/pendaftaran/{id}/view-dokumen-persyaratan', [PendaftaranController::class, 'viewDokumenPersyaratan'])
    ->name('pendaftaran.view-dokumen-persyaratan');

// File handling routes untuk pendaftaran
Route::get('pendaftaran/{id}/download-file', [PendaftaranController::class, 'downloadFile'])->name('pendaftaran.download-file');
Route::get('pendaftaran/{id}/view-file', [PendaftaranController::class, 'viewFile'])->name('pendaftaran.view-file');

// Routes untuk approve/reject
Route::post('pendaftaran/{pendaftaran}/approve', [PendaftaranController::class, 'approve'])->name('pendaftaran.approve');
Route::post('pendaftaran/{pendaftaran}/reject', [PendaftaranController::class, 'reject'])->name('pendaftaran.reject');

Route::get('/informasi/ppdb', [PendaftaranController::class, 'create'])
    ->name('informasi.ppdb');

// Forgot password user
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'submitForgotPassword'])->name('password.submit');

// Route::get('registration', [AuthController::class, 'registration'])->name('register');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('monitoringperkembangan', MonitoringPerkembanganController::class);
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change.password.form');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::resource('daftar-ulang', DaftarUlangController::class);
    Route::get('/my-registration', [DaftarUlangController::class, 'myRegistration'])->name('my-registration');

    // Route::post('/admin/users/{user}/reset-password-wa', [AdminResetPwController::class, 'resetAndOpenWA'])->name('admin.users.resetPasswordWA');
    Route::post('/pendaftaran/{id}/reset-password', [PendaftaranController::class, 'resetPassword'])
    ->name('pendaftaran.resetPassword')
    ->middleware('permission:pendaftaran-edit');

    // Reset otomatis
    Route::post('/users/{id}/reset-password/auto', [UserController::class, 'resetPasswordAuto'])->name('users.reset.auto');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
